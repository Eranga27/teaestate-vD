module.exports = async (req, res) => {
  // Enable CORS if needed
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');

  if (req.method === 'OPTIONS') {
    return res.status(200).end();
  }

  if (req.method !== 'POST') {
    return res.status(405).json({ ok: false, message: 'Method Not Allowed' });
  }

  try {
    const body = req.body || {};
    
    // Honeypot check
    if (body.website) {
      return res.status(200).json({ ok: true, message: 'Thank you. We will be in touch shortly.' });
    }

    const { first, last, email, phone, arrival, departure, adults, children, message } = body;
    console.log('[Enquiry Received]', {
      name: `${first || ''} ${last || ''}`.trim(),
      email,
      phone,
      arrival,
      departure,
      guests: `${adults || 0} adults, ${children || 0} children`,
      message
    });

    // In Vercel serverless environment, if SMTP / webhook / email service credentials are provided,
    // you can dispatch an email here.
    return res.status(200).json({
      ok: true,
      message: 'Thank you for your enquiry. We will contact you within 24 hours.'
    });
  } catch (error) {
    console.error('Enquiry handler error:', error);
    return res.status(500).json({ ok: false, message: 'Server error processing enquiry.' });
  }
};
