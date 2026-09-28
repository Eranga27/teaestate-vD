const fs = require('fs');
const path = require('path');

const DEPLOY_DIR = path.resolve(__dirname, '..', 'public');
const htmlFiles = fs.readdirSync(DEPLOY_DIR).filter(f => f.endsWith('.html'));

console.log(`Checking ${htmlFiles.length} compiled HTML files in public/...`);
if (htmlFiles.length === 0) {
  console.error('❌ No HTML found in public/ — run `npm run build` first.');
  process.exit(1);
}

// Mirrors build_static.js: GTM is only loaded when a real container ID is configured
const GTM_ID = (process.env.GTM_ID || '').trim().toUpperCase();

let allPassed = true;

for (const file of htmlFiles) {
  const content = fs.readFileSync(path.join(DEPLOY_DIR, file), 'utf8');

  const headIdx = content.indexOf('</head>');
  const bodyIdx = content.indexOf('<body');

  const antiFlashInHead = content.includes('tb-preloader-skip') && content.indexOf('tb-preloader-skip') < headIdx;
  const gtmScriptInHead = content.includes('googletagmanager.com/gtm.js') && content.indexOf('googletagmanager.com/gtm.js') < headIdx;
  const gtmNoscriptInBody = content.includes('googletagmanager.com/ns.html') && content.indexOf('googletagmanager.com/ns.html') > bodyIdx;
  // Exactly one preloader (src/layout/preloader.html), placed right after <body>
  const preloaderCount = content.split('id="tb-preloader"').length - 1;
  const preloaderMarkupInBody = preloaderCount === 1 && content.indexOf('id="tb-preloader"') > bodyIdx;
  const preloaderCss = content.includes('html.tb-preloader-skip #tb-preloader') && content.includes('.tb-pl-veil');
  const preloaderScript = content.includes("sessionStorage.setItem('tb_preloader_seen'") && content.includes('removeChild(preloader)') && content.includes('clip-path');
  const sessionCheck = content.includes("sessionStorage.getItem('tb_preloader_seen')");
  const reducedMotion = content.includes('prefers-reduced-motion');
  const eventsHook = content.includes('preloader_complete');
  // Page-to-page segue: one curtain after <body>, plus the head hand-off that lets a page arrive under it
  const segueCount = content.split('id="tb-segue"').length - 1;
  const segueHandoff = content.indexOf("sessionStorage.getItem('tb_segue')");
  const segue = segueCount === 1 && content.indexOf('id="tb-segue"') > bodyIdx && segueHandoff > -1 && segueHandoff < headIdx;

  const consentModeInHead = content.includes("gtag('consent', 'default'") && content.indexOf("gtag('consent', 'default'") < headIdx;
  const consentBannerInBody = content.includes('id="tb-consent-banner"') && content.indexOf('id="tb-consent-banner"') > bodyIdx;

  const checks = [
    { name: 'Anti-Flash in <head>', pass: antiFlashInHead },
    { name: 'Google Consent Mode in <head>', pass: consentModeInHead },
    GTM_ID
      ? { name: `GTM ${GTM_ID} script in <head> + noscript in <body>`, pass: gtmScriptInHead && gtmNoscriptInBody && content.includes(`'${GTM_ID}'`) }
      : { name: 'No GTM request while GTM_ID is unset', pass: !content.includes('googletagmanager.com') },
    { name: 'No placeholder GTM ID', pass: !content.includes('GTM-TEABUNGALOW') },
    { name: 'Exactly one preloader, in <body>', pass: preloaderMarkupInBody },
    { name: 'Consent Banner in <body>', pass: consentBannerInBody },
    { name: 'Preloader CSS styles', pass: preloaderCss },
    { name: 'Preloader lifecycle script', pass: preloaderScript },
    { name: 'sessionStorage check', pass: sessionCheck },
    { name: 'prefers-reduced-motion check', pass: reducedMotion },
    { name: 'preloader_complete event hook', pass: eventsHook },
    { name: 'Page segue curtain + head hand-off', pass: segue }
  ];

  const failed = checks.filter(c => !c.pass);
  if (failed.length > 0) {
    console.error(`❌ ${file} FAILED:`, failed.map(f => f.name).join(', '));
    allPassed = false;
  } else {
    console.log(`✓ ${file}: All ${checks.length} checks passed`);
  }
}

if (allPassed) {
  console.log(`\n🎉 ALL ${htmlFiles.length} HTML FILES PASSED ALL AUDIT CHECKS!`);
} else {
  process.exit(1);
}
