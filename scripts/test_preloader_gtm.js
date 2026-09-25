const fs = require('fs');
const path = require('path');

const DEPLOY_DIR = path.resolve(__dirname, '..', 'public');
const htmlFiles = fs.readdirSync(DEPLOY_DIR).filter(f => f.endsWith('.html'));

console.log(`Checking ${htmlFiles.length} compiled HTML files in public/...`);
if (htmlFiles.length === 0) {
  console.error('❌ No HTML found in public/ — run `npm run build` first.');
  process.exit(1);
}

let allPassed = true;

for (const file of htmlFiles) {
  const content = fs.readFileSync(path.join(DEPLOY_DIR, file), 'utf8');

  const headIdx = content.indexOf('</head>');
  const bodyIdx = content.indexOf('<body');

  const antiFlashInHead = content.includes('tb-preloader-skip') && content.indexOf('tb-preloader-skip') < headIdx;
  const gtmScriptInHead = content.includes('googletagmanager.com/gtm.js') && content.indexOf('googletagmanager.com/gtm.js') < headIdx;
  const gtmNoscriptInBody = content.includes('googletagmanager.com/ns.html') && content.indexOf('googletagmanager.com/ns.html') > bodyIdx;
  const preloaderMarkupInBody = content.includes('id="tb-preloader"') && content.indexOf('id="tb-preloader"') > bodyIdx;
  const preloaderCss = content.includes('.tb-preloader-fade') && content.includes('tbRuleDraw');
  const preloaderScript = content.includes('minDisplayMs') && content.includes('maxDisplayMs');
  const sessionCheck = content.includes("sessionStorage.getItem('tb_preloader_seen')");
  const reducedMotion = content.includes('prefers-reduced-motion');
  const eventsHook = content.includes('preloader_complete');

  const consentModeInHead = content.includes("gtag('consent', 'default'") && content.indexOf("gtag('consent', 'default'") < headIdx;
  const consentBannerInBody = content.includes('id="tb-consent-banner"') && content.indexOf('id="tb-consent-banner"') > bodyIdx;

  const checks = [
    { name: 'Anti-Flash in <head>', pass: antiFlashInHead },
    { name: 'Google Consent Mode in <head>', pass: consentModeInHead },
    { name: 'GTM script in <head>', pass: gtmScriptInHead },
    { name: 'GTM noscript in <body>', pass: gtmNoscriptInBody },
    { name: 'Preloader markup in <body>', pass: preloaderMarkupInBody },
    { name: 'Consent Banner in <body>', pass: consentBannerInBody },
    { name: 'Preloader CSS styles', pass: preloaderCss },
    { name: 'Preloader lifecycle script', pass: preloaderScript },
    { name: 'sessionStorage check', pass: sessionCheck },
    { name: 'prefers-reduced-motion check', pass: reducedMotion },
    { name: 'preloader_complete event hook', pass: eventsHook }
  ];

  const failed = checks.filter(c => !c.pass);
  if (failed.length > 0) {
    console.error(`❌ ${file} FAILED:`, failed.map(f => f.name).join(', '));
    allPassed = false;
  } else {
    console.log(`✓ ${file}: All 11 checks passed`);
  }
}

if (allPassed) {
  console.log(`\n🎉 ALL ${htmlFiles.length} HTML FILES PASSED ALL AUDIT CHECKS!`);
} else {
  process.exit(1);
}
