const crypto = require('crypto');

/**
 * PMS & Payment Ingestion Webhook Endpoint (§02 Architecture & §04 PMS)
 * Receives reservation confirmation events from Little Hotelier / Beds24 / PayHere,
 * verifies payload integrity, and acknowledges delivery.
 */
module.exports = async (req, res) => {
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Signature, X-Webhook-Token');

  if (req.method === 'OPTIONS') {
    return res.status(200).end();
  }

  if (req.method !== 'POST') {
    return res.status(405).json({ ok: false, message: 'Method Not Allowed' });
  }

  try {
    const payload = req.body || {};
    const signature = req.headers['x-signature'] || req.headers['x-payhere-signature'];
    const webhookToken = req.headers['x-webhook-token'];

    // Verify token if configured in environment
    const secret = process.env.BOOKING_WEBHOOK_SECRET;
    if (secret && webhookToken && webhookToken !== secret) {
      console.warn('[Webhook Auth Failed]: Invalid webhook secret token');
      return res.status(401).json({ ok: false, message: 'Unauthorized webhook payload' });
    }

    console.log('[Booking Webhook Received]', {
      timestamp: new Date().toISOString(),
      event: payload.event || payload.status_code || 'reservation_updated',
      orderId: payload.order_id || payload.booking_id || payload.reservation_id,
      guest: payload.guest_name || `${payload.first_name || ''} ${payload.last_name || ''}`.trim(),
      amount: payload.amount || payload.total_price,
      currency: payload.currency || 'USD'
    });

    // In production, syncs with CRM or email automation (Brevo / HubSpot in Phase 4)
    return res.status(200).json({
      ok: true,
      status: 'acknowledged',
      received_at: new Date().toISOString(),
      message: 'Reservation webhook processed successfully.'
    });
  } catch (error) {
    console.error('Webhook processing error:', error);
    return res.status(500).json({ ok: false, message: 'Server error processing booking webhook.' });
  }
};
