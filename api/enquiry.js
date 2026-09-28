const { brevoConfig, line, paragraph, isEmail, isoDate, notifyEstate, upsertContact } = require('./_brevo');

/**
 * Contact-page enquiry. Emails the estate (guest as Reply-To) and adds the guest to the
 * Brevo enquiry list, whose automations can use ARRIVAL_DATE / DEPARTURE_DATE for
 * pre-arrival and post-stay emails. See api/_brevo.js for the env vars.
 */
// Option values of the contact form's "enquiry-type" select
const ENQUIRY_TYPES = {
  room: 'Individual Room / Chamber',
  pekoe: 'Pekoe Trail Package',
  buyout: 'Estate Buyout (Entire Bungalow)',
  celebration: 'Private Celebration / Anniversary',
  family: 'Family Stay',
  tiffin: "Planter's Tiffin Lunch (Day Visit)",
  group: 'Group Booking (6+ people)',
  experience: 'Experiences Only',
  other: 'General Question'
};

// "1 adult, 2 children"; zero or empty counts are left out
const count = (n, singular, plural) => (n && n !== '0' ? `${n} ${n === '1' ? singular : plural}` : '');

const UNAVAILABLE = 'We could not send your enquiry just now. Please try again, message us on WhatsApp, or email stay@theteabungalow.com.';

module.exports = async (req, res) => {
  if (req.method !== 'POST') {
    return res.status(405).json({ ok: false, message: 'Method Not Allowed' });
  }

  const body = req.body && typeof req.body === 'object' ? req.body : {};

  // Honeypot: bots fill the hidden "website" field
  if (body.website) {
    return res.status(200).json({ ok: true, message: 'Thank you. We will be in touch shortly.' });
  }

  const enquiry = {
    first: line(body.first, 80),
    last: line(body.last, 80),
    email: line(body.email, 254).toLowerCase(),
    phone: line(body.phone, 40),
    arrival: isoDate(line(body.arrival, 10)),
    departure: isoDate(line(body.departure, 10)),
    adults: line(body.adults, 10),
    children: line(body.children, 10),
    type: line(body['enquiry-type'], 40),
    stages: line(body['pekoe-stages'], 80),
    how: line(body.how, 120),
    message: paragraph(body.message)
  };
  const typeLabel = ENQUIRY_TYPES[enquiry.type] || enquiry.type;

  if (!enquiry.first || !isEmail(enquiry.email) || !enquiry.message) {
    return res.status(400).json({ ok: false, message: 'Please add your name, a valid email address and a message.' });
  }

  const name = `${enquiry.first} ${enquiry.last}`.trim();
  const cfg = brevoConfig();
  // Never thank a guest for an enquiry nobody will receive
  if (!cfg) {
    console.error('[Enquiry] BREVO_API_KEY not set — enquiry NOT delivered:', enquiry);
    return res.status(503).json({ ok: false, message: UNAVAILABLE });
  }

  try {
    await notifyEstate(cfg, {
      subject: `New enquiry — ${name}${typeLabel ? ` · ${typeLabel}` : ''}${enquiry.arrival ? ` · arriving ${enquiry.arrival}` : ''}`,
      replyTo: { email: enquiry.email, name },
      tag: 'website-enquiry',
      rows: [
        ['Name', name], ['Email', enquiry.email], ['Phone', enquiry.phone],
        ['Enquiry type', typeLabel], ['Pekoe Trail stages', enquiry.stages],
        ['Arrival', enquiry.arrival], ['Departure', enquiry.departure],
        ['Guests', [count(enquiry.adults, 'adult', 'adults'), count(enquiry.children, 'child', 'children')].filter(Boolean).join(', ')],
        ['Heard about us', enquiry.how], ['Message', enquiry.message]
      ]
    });
  } catch (err) {
    console.error('[Enquiry] Notification email failed:', err.message, enquiry);
    return res.status(502).json({ ok: false, message: UNAVAILABLE });
  }

  // CRM sync is best-effort: the estate already has the enquiry by email
  try {
    await upsertContact(cfg, {
      email: enquiry.email, firstName: enquiry.first, lastName: enquiry.last, listId: cfg.enquiryListId,
      attributes: { ARRIVAL_DATE: enquiry.arrival, DEPARTURE_DATE: enquiry.departure }
    });
  } catch (err) {
    console.error('[Enquiry] Brevo contact sync failed:', err.message);
  }

  return res.status(200).json({ ok: true, message: 'Thank you for your enquiry. We will contact you within 24 hours.' });
};
