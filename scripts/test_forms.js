// Tests for the guest forms (api/enquiry.js, api/waitlist.js) and their Brevo integration.
// Brevo is mocked; nothing leaves this machine.
const assert = require('assert');
const fs = require('fs');
const path = require('path');
const ROOT = path.resolve(__dirname, '..');

const enquiry = require(path.join(ROOT, 'api/enquiry.js'));
const waitlist = require(path.join(ROOT, 'api/waitlist.js'));

function mockRes() {
  const r = { statusCode: 200, body: undefined };
  r.status = c => { r.statusCode = c; return r; };
  r.json = b => { r.body = b; return r; };
  return r;
}
let calls = [];
let brevoReply = () => ({ ok: true, status: 201, json: async () => ({}) });
global.fetch = async (url, opts) => { calls.push({ url, body: JSON.parse(opts.body), headers: opts.headers }); return brevoReply(url, calls.length); };
console.warn = () => {}; console.error = () => {}; // keep test output readable

const post = async (handler, body) => { calls = []; const res = mockRes(); await handler({ method: 'POST', body }, res); return res; };
const guest = { first: 'Ada', last: 'Lovelace', email: 'Ada@Example.com', phone: '+44 20 1234', arrival: '2026-12-20', departure: '2026-12-23', adults: '2', children: '0', how: 'Friend', message: 'Hello <script>alert(1)</script>\nSecond line' };

(async () => {
  let res = mockRes(); await enquiry({ method: 'GET' }, res); assert.equal(res.statusCode, 405);
  res = await post(enquiry, { ...guest, website: 'spam.example' }); assert.equal(res.body.ok, true); assert.equal(calls.length, 0);
  assert.equal((await post(enquiry, { ...guest, email: 'not-an-email' })).statusCode, 400);
  assert.equal((await post(enquiry, { ...guest, message: '   ' })).statusCode, 400);
  assert.equal((await post(enquiry, undefined)).statusCode, 400);
  console.log('✓ enquiry: 405 on GET, honeypot swallowed, bad email / empty message / empty body → 400');

  delete process.env.BREVO_API_KEY;
  res = await post(enquiry, guest); assert.equal(res.statusCode, 503); assert.equal(res.body.ok, false); assert.equal(calls.length, 0);
  assert.match(res.body.message, /WhatsApp/);
  res = await post(waitlist, { 'wl-first': 'Ada', 'wl-email': 'ada@example.com' }); assert.equal(res.statusCode, 503);
  console.log('✓ without BREVO_API_KEY → guest told to use WhatsApp/email (never a false "thank you"), no external calls');

  process.env.BREVO_API_KEY = 'xkeysib-test';
  process.env.ESTATE_NOTIFY_EMAIL = 'stay@theteabungalow.com, manager@example.com';
  process.env.BREVO_ENQUIRY_LIST_ID = '7';
  res = await post(enquiry, guest);
  assert.equal(res.statusCode, 200); assert.equal(calls.length, 2);
  const [mail, contact] = calls;
  assert.equal(mail.url, 'https://api.brevo.com/v3/smtp/email'); assert.equal(mail.headers['api-key'], 'xkeysib-test');
  assert.deepEqual(mail.body.to, [{ email: 'stay@theteabungalow.com' }, { email: 'manager@example.com' }]);
  assert.deepEqual(mail.body.replyTo, { email: 'ada@example.com', name: 'Ada Lovelace' });
  assert.equal(mail.body.subject, 'New enquiry — Ada Lovelace · arriving 2026-12-20');
  assert.ok(mail.body.htmlContent.includes('Hello &lt;script&gt;alert(1)&lt;/script&gt;<br>Second line'));
  assert.ok(!mail.body.htmlContent.includes('<script>'));
  assert.ok(mail.body.textContent.includes('Guests: 2 adults\n')); // "0 children" left out
  await post(enquiry, { ...guest, adults: '1', children: '1' });
  assert.ok(calls[0].body.textContent.includes('Guests: 1 adult, 1 child\n'));
  await post(enquiry, { ...guest, 'enquiry-type': 'pekoe', 'pekoe-stages': 'Stage 1 & 2' });
  assert.equal(calls[0].body.subject, 'New enquiry — Ada Lovelace · Pekoe Trail Package · arriving 2026-12-20');
  assert.ok(calls[0].body.textContent.includes('Enquiry type: Pekoe Trail Package\nPekoe Trail stages: Stage 1 & 2\n'));
  assert.ok(calls[0].body.htmlContent.includes('Stage 1 &amp; 2'));
  assert.equal(contact.url, 'https://api.brevo.com/v3/contacts');
  assert.deepEqual(contact.body, { email: 'ada@example.com', updateEnabled: true, listIds: [7], attributes: { FIRSTNAME: 'Ada', LASTNAME: 'Lovelace', ARRIVAL_DATE: '2026-12-20', DEPARTURE_DATE: '2026-12-23' } });
  console.log('✓ enquiry emails every estate address (guest as Reply-To, HTML escaped) and adds guest to list 7 with stay dates');

  res = await post(enquiry, { ...guest, arrival: 'next week' });
  assert.ok(!('ARRIVAL_DATE' in calls[1].body.attributes)); assert.ok(!calls[0].body.subject.includes('arriving'));
  console.log('✓ non-date arrival values are dropped');

  brevoReply = () => ({ ok: false, status: 500, text: async () => 'down' });
  res = await post(enquiry, guest); assert.equal(res.statusCode, 502); assert.equal(res.body.ok, false); assert.equal(calls.length, 1);
  console.log('✓ email failure → 502 so the guest is told to retry / use WhatsApp (never a false "thank you")');

  brevoReply = (url, n) => (url.endsWith('/contacts') && n === 2 ? { ok: false, status: 400, text: async () => 'attribute ARRIVAL_DATE not found' } : { ok: true, status: 201, json: async () => ({}) });
  res = await post(enquiry, guest); assert.equal(res.statusCode, 200); assert.equal(calls.length, 3);
  assert.deepEqual(calls[2].body.attributes, { FIRSTNAME: 'Ada', LASTNAME: 'Lovelace' });
  console.log('✓ unknown Brevo attributes → contact retried with name only');

  brevoReply = url => (url.endsWith('/contacts') ? { ok: false, status: 500, text: async () => 'down' } : { ok: true, status: 201, json: async () => ({}) });
  res = await post(enquiry, guest); assert.equal(res.statusCode, 200);
  console.log('✓ contact sync failure does not fail the enquiry (estate already emailed)');

  brevoReply = () => ({ ok: true, status: 201, json: async () => ({}) });
  delete process.env.BREVO_ENQUIRY_LIST_ID;
  res = await post(enquiry, guest); assert.equal(calls.length, 1);
  console.log('✓ no list configured → email only');

  // Waitlist uses wl-* field names from chairmans-bungalow-2027
  assert.equal((await post(waitlist, { 'wl-first': 'Ada', 'wl-email': 'bad' })).statusCode, 400);
  process.env.BREVO_WAITLIST_LIST_ID = '9';
  res = await post(waitlist, { 'wl-first': 'Ada', 'wl-last': 'Lovelace', 'wl-email': 'ada@example.com', 'wl-interest': 'Full buyout', 'wl-party': '6–8', 'wl-notes': 'Spring' });
  assert.equal(res.statusCode, 200); assert.equal(calls.length, 2);
  assert.equal(calls[0].body.subject, "Chairman's Bungalow waitlist — Ada Lovelace");
  assert.ok(calls[0].body.textContent.includes('Interest: Full buyout') && calls[0].body.textContent.includes('Party size: 6–8'));
  assert.deepEqual(calls[1].body.listIds, [9]);
  console.log('✓ waitlist reads wl-first / wl-last / wl-email, emails the estate and adds to list 9');

  // The built pages must send URL-encoded bodies (Vercel does not parse multipart form data)
  for (const [page, endpoint] of [['contact.html', '/api/enquiry'], ['chairmans-bungalow-2027.html', '/api/waitlist']]) {
    const html = fs.readFileSync(path.join(ROOT, 'public', page), 'utf8');
    assert.ok(html.includes(`fetch('${endpoint}'`), `${page} posts to ${endpoint}`);
    assert.ok(html.includes('new URLSearchParams(new FormData(this))'), `${page} sends URL-encoded data`);
  }
  console.log('✓ contact and waitlist pages post URL-encoded data to /api/enquiry and /api/waitlist');
})().catch(e => { console.log('✗', e.message); process.exit(1); });
