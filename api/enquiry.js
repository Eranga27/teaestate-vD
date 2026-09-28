const { brevoConfig, line, paragraph, isEmail, isoDate, notifyEstate, upsertContact } = require('./_brevo');

/**
 * Contact-page enquiry. Emails the estate (guest as Reply-To) and adds the guest to the
 * Brevo enquiry list, whose automations can use ARRIVAL_DATE / DEPARTURE_DATE for
 * pre-arrival and post-stay emails. See api/_brevo.js for the env vars.
 */
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
    how: line(body.how, 120),
    message: paragraph(body.message)
  };

  if (!enquiry.first || !isEmail(enquiry.email) || !enquiry.message) {
    return res.status(400).json({ ok: false, message: 'Please add your name, a valid email address and a message.' });
  }

  const name = `${enquiry.first} ${enquiry.last}`.trim();
  const cfg = brevoConfig();
  if (!cfg) {
    console.warn('[Enquiry] BREVO_API_KEY not set — enquiry only logged, nobody was emailed:', enquiry);
    return res.status(200).json({ ok: true, message: 'Thank you for your enquiry. We will contact you within 24 hours.' });
  }

  try {
    await notifyEstate(cfg, {
      subject: `New enquiry — ${name}${enquiry.arrival ? ` · arriving ${enquiry.arrival}` : ''}`,
      replyTo: { email: enquiry.email, name },
      tag: 'website-enquiry',
      rows: [
        ['Name', name], ['Email', enquiry.email], ['Phone', enquiry.phone],
        ['Arrival', enquiry.arrival], ['Departure', enquiry.departure],
        ['Guests', [enquiry.adults && `${enquiry.adults} adults`, enquiry.children && `${enquiry.children} children`].filter(Boolean).join(', ')],
        ['Heard about us', enquiry.how], ['Message', enquiry.message]
      ]
    });
  } catch (err) {
    console.error('[Enquiry] Notification email failed:', err.message, enquiry);
    return res.status(502).json({ ok: false, message: 'We could not send your enquiry just now. Please try again, or message us on WhatsApp.' });
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
