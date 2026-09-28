/**
 * Guest-form helpers: input cleaning + Brevo email/CRM (not a route: Vercel skips "_" files).
 *
 * Env (Vercel):
 *   BREVO_API_KEY            required: without it the forms tell guests to use WhatsApp/email
 *                            instead (the submission is only written to the function log).
 *   BREVO_SENDER_EMAIL       a sender verified in Brevo (default stay@theteabungalow.com)
 *   ESTATE_NOTIFY_EMAIL      who receives enquiries; comma-separate several (default stay@theteabungalow.com)
 *   BREVO_ENQUIRY_LIST_ID    optional Brevo list for enquiry guests (drives guest-journey automations)
 *   BREVO_WAITLIST_LIST_ID   optional Brevo list for the Chairman's Bungalow waitlist
 */
const BREVO_API = 'https://api.brevo.com/v3';

function brevoConfig() {
  const apiKey = process.env.BREVO_API_KEY;
  if (!apiKey) return null;
  const list = s => (s || '').split(',').map(x => x.trim()).filter(Boolean);
  return {
    apiKey,
    sender: process.env.BREVO_SENDER_EMAIL || 'stay@theteabungalow.com',
    notify: list(process.env.ESTATE_NOTIFY_EMAIL || 'stay@theteabungalow.com'),
    enquiryListId: Number(process.env.BREVO_ENQUIRY_LIST_ID) || null,
    waitlistListId: Number(process.env.BREVO_WAITLIST_LIST_ID) || null
  };
}

// Single-line text: collapse whitespace, cap length
const line = (v, max = 200) => String(v ?? '').replace(/\s+/g, ' ').trim().slice(0, max);
const paragraph = (v, max = 5000) => String(v ?? '').replace(/\r\n/g, '\n').trim().slice(0, max);
const isEmail = v => v.length <= 254 && /^[^\s@<>]+@[^\s@<>]+\.[^\s@<>]+$/.test(v);
const isoDate = v => (/^\d{4}-\d{2}-\d{2}$/.test(v) ? v : '');
const escapeHtml = s => String(s).replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

async function brevoRequest(cfg, path, body) {
  const res = await fetch(BREVO_API + path, {
    method: 'POST',
    headers: { 'api-key': cfg.apiKey, 'Content-Type': 'application/json', Accept: 'application/json' },
    body: JSON.stringify(body)
  });
  if (!res.ok) {
    const err = new Error(`Brevo ${path} → ${res.status}: ${await res.text()}`);
    err.status = res.status;
    throw err;
  }
  return res.status === 204 ? null : res.json();
}

/** Email the estate. rows = [[label, value], ...]; the guest is the Reply-To. */
function notifyEstate(cfg, { subject, rows, replyTo, tag }) {
  const filled = rows.filter(([, v]) => v);
  const htmlRows = filled
    .map(([k, v]) => `<tr><th align="left" valign="top" style="padding:6px 16px 6px 0;color:#8a6a30;font:600 13px Georgia,serif">${escapeHtml(k)}</th><td style="padding:6px 0;font:15px Georgia,serif;color:#1a1510">${escapeHtml(v).replace(/\n/g, '<br>')}</td></tr>`)
    .join('');
  return brevoRequest(cfg, '/smtp/email', {
    sender: { email: cfg.sender, name: 'The Tea Bungalow Website' },
    to: cfg.notify.map(email => ({ email })),
    replyTo,
    subject,
    htmlContent: `<div style="max-width:640px"><h2 style="font:600 20px Georgia,serif;color:#1E4D2B">${escapeHtml(subject)}</h2><table cellspacing="0" cellpadding="0">${htmlRows}</table><p style="font:13px Georgia,serif;color:#7a6e60">Reply to this email to answer the guest directly.</p></div>`,
    textContent: filled.map(([k, v]) => `${k}: ${v}`).join('\n') + '\n\nReply to this email to answer the guest directly.',
    tags: [tag]
  });
}

/**
 * Add/update the guest in a Brevo list. Custom attributes (e.g. ARRIVAL_DATE) only stick if they
 * exist in Brevo; if Brevo rejects them we retry with just the name so the contact is still saved.
 */
async function upsertContact(cfg, { email, firstName, lastName, listId, attributes = {} }) {
  if (!listId) return;
  const base = { email, updateEnabled: true, listIds: [listId] };
  const names = { FIRSTNAME: firstName, LASTNAME: lastName };
  const extra = Object.fromEntries(Object.entries(attributes).filter(([, v]) => v));
  try {
    await brevoRequest(cfg, '/contacts', { ...base, attributes: { ...names, ...extra } });
  } catch (err) {
    if (err.status !== 400 || !Object.keys(extra).length) throw err;
    console.warn('[Brevo] Contact attributes rejected, saving name only. Create them in Brevo → Contacts → Settings:', Object.keys(extra).join(', '));
    await brevoRequest(cfg, '/contacts', { ...base, attributes: names });
  }
}

module.exports = { brevoConfig, line, paragraph, isEmail, isoDate, notifyEstate, upsertContact };
