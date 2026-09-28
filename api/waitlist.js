const { brevoConfig, line, paragraph, isEmail, notifyEstate, upsertContact } = require('./_brevo');

/**
 * Chairman's Bungalow (2027) waitlist. Emails the estate and adds the guest to the Brevo
 * waitlist list ("one email per milestone — no newsletters", as promised on the page).
 */
const UNAVAILABLE = 'We could not add you just now. Please try again, message us on WhatsApp, or email stay@theteabungalow.com.';

module.exports = async (req, res) => {
  if (req.method !== 'POST') {
    return res.status(405).json({ ok: false, message: 'Method Not Allowed' });
  }

  const body = req.body && typeof req.body === 'object' ? req.body : {};

  if (body.website) {
    return res.status(200).json({ ok: true, message: "Thank you — you're on the list." });
  }

  const entry = {
    first: line(body['wl-first'], 80),
    last: line(body['wl-last'], 80),
    email: line(body['wl-email'], 254).toLowerCase(),
    interest: line(body['wl-interest'], 120),
    party: line(body['wl-party'], 60),
    notes: paragraph(body['wl-notes'], 2000)
  };

  if (!entry.first || !isEmail(entry.email)) {
    return res.status(400).json({ ok: false, message: 'Please add your name and a valid email address.' });
  }

  const name = `${entry.first} ${entry.last}`.trim();
  const cfg = brevoConfig();
  if (!cfg) {
    console.error('[Waitlist] BREVO_API_KEY not set — signup NOT delivered:', entry);
    return res.status(503).json({ ok: false, message: UNAVAILABLE });
  }

  try {
    await notifyEstate(cfg, {
      subject: `Chairman's Bungalow waitlist — ${name}`,
      replyTo: { email: entry.email, name },
      tag: 'website-waitlist',
      rows: [['Name', name], ['Email', entry.email], ['Interest', entry.interest], ['Party size', entry.party], ['Notes', entry.notes]]
    });
  } catch (err) {
    console.error('[Waitlist] Notification email failed:', err.message, entry);
    return res.status(502).json({ ok: false, message: UNAVAILABLE });
  }

  try {
    await upsertContact(cfg, { email: entry.email, firstName: entry.first, lastName: entry.last, listId: cfg.waitlistListId });
  } catch (err) {
    console.error('[Waitlist] Brevo contact sync failed:', err.message);
  }

  return res.status(200).json({ ok: true, message: "Thank you — you're on the list." });
};
