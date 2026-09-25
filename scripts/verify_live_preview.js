const https = require('https');

async function checkUrl(url) {
  return new Promise((resolve, reject) => {
    https.get(url, (res) => {
      let data = '';
      res.on('data', chunk => data += chunk);
      res.on('end', () => resolve({ status: res.statusCode, headers: res.headers, body: data }));
    }).on('error', reject);
  });
}

async function run() {
  // Branch alias (the project was renamed deploy → teabungalow; the old deploy-git-… alias is frozen).
  // Pass a specific deployment URL as the first argument to check that instead.
  const previewBase = (process.argv[2] || 'https://teabungalow-git-feature-platform-integrations-eranga-bowatte.vercel.app').replace(/\/$/, '');
  const prodBase = 'https://teaestate.vercel.app';
  
  console.log('=== 1. VERIFYING PREVIEW DEPLOYMENT ===');
  console.log('Target:', previewBase);
  
  const pages = [
    '/',
    '/the-bungalow',
    '/our-chambers',
    '/the-entire-estate',
    '/experiences',
    '/pekoe-trail',
    '/about',
    '/packages',
    '/gallery',
    '/contact',
    '/privacy',
    '/chairmans-bungalow-2027'
  ];

  let passed = 0;
  for (const p of pages) {
    const res = await checkUrl(`${previewBase}${p}`);
    const ok = res.status === 200;
    const hasPreloader = res.body.includes('id="tb-preloader"');
    const hasAntiFlash = res.body.includes("sessionStorage.getItem('tb_preloader_seen')");
    const hasConsentMode = res.body.includes("gtag('consent', 'default'");
    const hasConsentBanner = res.body.includes('id="tb-consent-banner"');
    const hasGtmHead = res.body.includes("googletagmanager.com/gtm.js") && res.body.includes("'GTM-TEABUNGALOW'");
    const hasGtmNoScript = res.body.includes("ns.html?id=GTM-TEABUNGALOW");
    
    if (ok && hasPreloader && hasAntiFlash && hasConsentMode && hasConsentBanner && hasGtmHead && hasGtmNoScript) {
      console.log(`  ✓ ${p} (Status ${res.status}, all assets present)`);
      passed++;
    } else {
      console.log(`  ✗ ${p} FAILED: status=${res.status}, preloader=${hasPreloader}, antiFlash=${hasAntiFlash}, consentMode=${hasConsentMode}, consentBanner=${hasConsentBanner}, gtmHead=${hasGtmHead}, gtmNoScript=${hasGtmNoScript}`);
    }
  }

  console.log(`\nPreview summary: ${passed}/${pages.length} pages verified.`);

  console.log('\n=== 2. VERIFYING EVENT TRACKING & HOOKS ON PREVIEW ===');
  const homeRes = await checkUrl(`${previewBase}/`);
  const contactRes = await checkUrl(`${previewBase}/contact`);
  const chairmansRes = await checkUrl(`${previewBase}/chairmans-bungalow-2027`);
  const privacyRes = await checkUrl(`${previewBase}/privacy`);

  const checks = [
    { name: 'Preloader Complete Event', condition: homeRes.body.includes("event: 'preloader_complete'") },
    { name: 'WhatsApp Concierge Click Event', condition: homeRes.body.includes("event: 'whatsapp_concierge_click'") },
    { name: 'Booking Widget Opened Event', condition: homeRes.body.includes("event: 'booking_widget_opened'") },
    { name: 'Consent Update Event Hook', condition: homeRes.body.includes("event: 'consent_update'") },
    { name: 'Enquiry Submitted Event', condition: contactRes.body.includes("event: 'enquiry_submitted'") },
    { name: 'Waitlist Signup Event', condition: chairmansRes.body.includes("event: 'waitlist_signup'") },
    { name: 'Reduced Motion Support', condition: homeRes.body.includes("prefers-reduced-motion: reduce") },
    { name: 'Session Storage Flag', condition: homeRes.body.includes("sessionStorage.setItem('tb_preloader_seen'") },
    { name: 'DOM Cleanup (removeChild)', condition: homeRes.body.includes("removeChild(preloader)") },
    { name: 'Privacy Page Statutory Citation (PDPA)', condition: privacyRes.body.includes("Personal Data Protection Act, No. 09 of 2022") }
  ];

  for (const c of checks) {
    console.log(`  ${c.condition ? '✓' : '✗'} ${c.name}: ${c.condition ? 'Passed' : 'Failed'}`);
  }
  const failures = (pages.length - passed) + checks.filter(c => !c.condition).length;

  console.log('\n=== 3. VERIFYING PRODUCTION BRANCH (MAIN) IS UNTOUCHED ===');
  console.log('Target:', prodBase);
  const prodRes = await checkUrl(`${prodBase}/`);
  const prodHasPreloader = prodRes.body.includes('id="tb-preloader"');
  console.log(`  Production status: ${prodRes.status}`);
  console.log(`  Production has preloader: ${prodHasPreloader} (expected: false)`);
  if (!prodHasPreloader) {
    console.log('  ✓ Verified: Production site on main is untouched and pristine.');
  } else {
    console.log('  ✗ Warning: Production site has preloader before merge!');
  }
  if (failures > 0) process.exitCode = 1;
}

run().catch(err => { console.error(err); process.exitCode = 1; });
