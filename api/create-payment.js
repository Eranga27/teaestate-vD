const crypto = require('crypto');

/**
 * PayHere / Direct Booking Payment Session Endpoint (§05 Payment Gateway)
 * Generates secure payment hashes and checkout tokens for Sri Lankan and international cards.
 */
module.exports = async (req, res) => {
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
    const { name, email, phone, room, checkIn, checkOut, guests, amount } = body;

    // Generate unique estate reservation order reference
    const timestamp = Date.now();
    const randomSuffix = Math.floor(1000 + Math.random() * 9000);
    const orderId = `TB-${new Date().getFullYear()}-${randomSuffix}`;

    // Extract numeric amount in USD (default to deposit or full)
    let numericAmount = 350.00;
    if (amount) {
      const match = String(amount).match(/\$([0-9,]+)/);
      if (match) {
        numericAmount = parseFloat(match[1].replace(/,/g, ''));
      }
    }
    const formattedAmount = numericAmount.toFixed(2);
    const currency = 'USD';

    // PayHere Merchant Credentials (from Environment or Sandbox Fallback)
    const merchantId = process.env.PAYHERE_MERCHANT_ID || 'SANDBOX_1210000';
    const merchantSecret = process.env.PAYHERE_MERCHANT_SECRET || 'SANDBOX_SECRET';

    // Generate PayHere verification hash:
    // strtoupper(md5(merchant_id + order_id + amountFormatted + currency + strtoupper(md5(merchant_secret))))
    const hashedSecret = crypto.createHash('md5').update(merchantSecret).digest('hex').toUpperCase();
    const hashString = `${merchantId}${orderId}${formattedAmount}${currency}${hashedSecret}`;
    const payHereHash = crypto.createHash('md5').update(hashString).digest('hex').toUpperCase();

    console.log('[Payment Session Created]', {
      orderId,
      room,
      guest: name,
      email,
      checkIn,
      checkOut,
      amount: `${formattedAmount} ${currency}`
    });

    return res.status(200).json({
      ok: true,
      order_id: orderId,
      merchant_id: merchantId,
      amount: formattedAmount,
      currency: currency,
      hash: payHereHash,
      items: `The Tea Bungalow: ${room || 'Chamber Stay'} (${checkIn} to ${checkOut})`,
      first_name: name ? name.split(' ')[0] : 'Guest',
      last_name: name && name.split(' ').length > 1 ? name.split(' ').slice(1).join(' ') : 'Estate',
      email: email || '',
      phone: phone || '',
      address: 'The Tea Bungalow, Moragolla Road',
      city: 'Galaha',
      country: 'Sri Lanka',
      sandbox: !process.env.PAYHERE_MERCHANT_ID,
      message: 'Payment session generated successfully.'
    });
  } catch (error) {
    console.error('Payment creation error:', error);
    return res.status(500).json({ ok: false, message: 'Server error generating payment session.' });
  }
};
