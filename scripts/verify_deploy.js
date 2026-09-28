const fs = require('fs');
const path = require('path');

const DEPLOY_DIR = path.resolve(__dirname, '..', 'public');
const htmlFiles = fs.readdirSync(DEPLOY_DIR).filter(f => f.endsWith('.html'));
let missingImgs = 0;
let totalImgRefs = 0;
let brokenLinks = 0;

// Every built page is a valid clean-URL target (vercel.json cleanUrls)
const validPages = new Set(['/', ...htmlFiles.map(f => '/' + f.replace(/\.html$/, ''))]);

// Pages live at the site root, so "images/x.jpg" and "/images/x.jpg" resolve to the same file
const existsInBuild = ref => fs.existsSync(path.join(DEPLOY_DIR, decodeURIComponent(ref.split('?')[0].replace(/^\//, ''))));

for (const file of htmlFiles) {
  const content = fs.readFileSync(path.join(DEPLOY_DIR, file), 'utf8');

  // Check every src (images, video, scripts) plus every /media/ reference (srcset, posters, data attributes)
  const refs = new Set();
  let match;
  const srcRegex = /\ssrc=["']([^"']*)["']/g;
  while ((match = srcRegex.exec(content)) !== null) refs.add(match[1]);
  const mediaRegex = /\/media\/[A-Za-z0-9._-]+/g;
  while ((match = mediaRegex.exec(content)) !== null) refs.add(match[0]);
  for (const src of refs) {
    if (!src || /^(https?:|data:|\/\/)/.test(src)) continue;
    totalImgRefs++;
    if (!existsInBuild(src)) {
      console.log(`[Missing file] in ${file}: ${src}`);
      missingImgs++;
    }
  }

  // Check internal links
  const hrefRegex = /href=["']([^"']+)["']/g;
  while ((match = hrefRegex.exec(content)) !== null) {
    const href = match[1];
    if (href.startsWith('http') || href.startsWith('mailto:') || href.startsWith('tel:') || href.startsWith('#')) continue;
    const cleanPath = href.split('#')[0].split('?')[0];
    // Asset links (favicon, css…) are valid if the file exists in public/
    const isAsset = path.extname(cleanPath) && fs.existsSync(path.join(DEPLOY_DIR, cleanPath));
    if (cleanPath && !isAsset && !validPages.has(cleanPath)) {
      console.log(`[Unexpected link target] in ${file}: ${href}`);
      brokenLinks++;
    }
  }
}

console.log('--- VERIFICATION SUMMARY ---');
console.log(`HTML Pages Verified: ${htmlFiles.length}`);
console.log(`Total Image References: ${totalImgRefs} (Missing: ${missingImgs})`);
console.log(`Internal Links Checked: Broken = ${brokenLinks}`);

if (htmlFiles.length === 0 || missingImgs > 0 || brokenLinks > 0) process.exit(1);
