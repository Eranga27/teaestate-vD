const fs = require('fs');
const path = require('path');

// src/ holds the PHP templates, CMS data, admin and images; public/ is the
// generated site Vercel serves (gitignored — never edit it by hand).
const ROOT_DIR = path.resolve(__dirname, '..');
const SOURCE_DIR = path.join(ROOT_DIR, 'src');
const OUT_DIR = path.join(ROOT_DIR, 'public');

// Google Tag Manager container, e.g. GTM-AB12CD3 (Vercel env var, read at build time).
// Templates use the GTM-TEABUNGALOW placeholder; without a real ID the GTM loader is left
// out (the placeholder container 404s), while Consent Mode + dataLayer events stay in place.
const GTM_ID = (process.env.GTM_ID || '').trim().toUpperCase();
if (GTM_ID && !/^GTM-[A-Z0-9]{4,12}$/.test(GTM_ID)) {
  throw new Error(`GTM_ID "${GTM_ID}" doesn't look like a Tag Manager container ID (GTM-XXXXXXX)`);
}
console.log(GTM_ID ? `Google Tag Manager: ${GTM_ID}` : 'Google Tag Manager: GTM_ID not set — GTM loader omitted');

// Start from an empty output dir so removed pages/images don't linger
fs.rmSync(OUT_DIR, { recursive: true, force: true });
fs.mkdirSync(OUT_DIR, { recursive: true });

// 1. Copy images (recursive, so CMS uploads in images/cms/ are included)
console.log('Copying images...');
const SOURCE_IMAGES_DIR = path.join(SOURCE_DIR, 'images');
const OUT_IMAGES_DIR = path.join(OUT_DIR, 'images');
copyDirRecursive(SOURCE_IMAGES_DIR, OUT_IMAGES_DIR);
console.log(`Copied ${fs.readdirSync(OUT_IMAGES_DIR).length} image/media entries to public/images`);

// 2. Define page mappings
const pages = [
  // ve: true = vE design (src/ve/*, src/layout/ve/*); the legacy header chrome is stripped
  { phpFile: 'home.php', htmlFile: 'index.html', pageName: 'home', ve: true },
  { phpFile: 'about.php', htmlFile: 'about.html', pageName: 'about', ve: true },
  { phpFile: 'our-chambers.php', htmlFile: 'our-chambers.html', pageName: 'our-chambers', ve: true },
  { phpFile: 'the-bungalow.php', htmlFile: 'the-bungalow.html', pageName: 'the-bungalow', ve: true },
  { phpFile: 'the-entire-estate.php', htmlFile: 'the-entire-estate.html', pageName: 'the-entire-estate', ve: true },
  { phpFile: 'pekoe-trail.php', htmlFile: 'pekoe-trail.html', pageName: 'pekoe-trail', ve: true },
  { phpFile: 'experiences.php', htmlFile: 'experiences.html', pageName: 'experiences', ve: true },
  { phpFile: 'packages.php', htmlFile: 'packages.html', pageName: 'packages', ve: true },
  { phpFile: 'gallery.php', htmlFile: 'gallery.html', pageName: 'gallery', ve: true },
  { phpFile: 'contact.php', htmlFile: 'contact.html', pageName: 'contact' },
  { phpFile: 'privacy.php', htmlFile: 'privacy.html', pageName: 'privacy' },
  { phpFile: 'chairmans-bungalow-2027.php', htmlFile: 'chairmans-bungalow-2027.html', pageName: 'chairmans-bungalow-2027' }
];

const navbarTpl = fs.readFileSync(path.join(SOURCE_DIR, 'layout', 'navbar.php'), 'utf8');
const footerTpl = fs.readFileSync(path.join(SOURCE_DIR, 'layout', 'footer.php'), 'utf8');
// Cinematic intro injected after <body> on every page (single source of truth)
const preloaderHtml = fs.readFileSync(path.join(SOURCE_DIR, 'layout', 'preloader.html'), 'utf8').replace(/^\uFEFF/, '');
const segueHtml = fs.readFileSync(path.join(SOURCE_DIR, 'layout', 'segue.html'), 'utf8').replace(/^\uFEFF/, '');
// <!-- tb:sinhala-font -->: Noto Serif Sinhala subset (&text=) to exactly the glyphs this page, the
// preloader greeting and the segue curtain's page names use
function sinhalaFontLink(content) {
  const glyphs = [...new Set((content + segueHtml + preloaderHtml).match(/[\u0D80-\u0DFF]/g) || [])].sort().join('');
  return glyphs ? `<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Serif+Sinhala:wght@400&display=swap&text=${encodeURIComponent(glyphs)}">` : '';
}

function cleanUrlRewrites(content) {
  let c = content;

  c = c.replace(/href=(['"])\/vD\/home\.php\1/g, 'href=$1/$1');
  c = c.replace(/href=(['"])\/vD\/home\.php#/g, 'href=$1/#');
  c = c.replace(/href=(['"])\/vD\/about\.php\1/g, 'href=$1/about$1');
  c = c.replace(/href=(['"])\/vD\/about\.php#/g, 'href=$1/about#');
  c = c.replace(/href=(['"])\/vD\/privacy\.php\1/g, 'href=$1/privacy$1');
  c = c.replace(/href=(['"])\/vD\/privacy\.php#/g, 'href=$1/privacy#');
  c = c.replace(/href=(['"])\/vD\/our-chambers\.php\1/g, 'href=$1/our-chambers$1');
  c = c.replace(/href=(['"])\/vD\/our-chambers\.php#/g, 'href=$1/our-chambers#');
  c = c.replace(/href=(['"])\/vD\/the-bungalow\.php\1/g, 'href=$1/the-bungalow$1');
  c = c.replace(/href=(['"])\/vD\/the-bungalow\.php#/g, 'href=$1/the-bungalow#');
  c = c.replace(/href=(['"])\/vD\/the-entire-estate\.php\1/g, 'href=$1/the-entire-estate$1');
  c = c.replace(/href=(['"])\/vD\/the-entire-estate\.php#/g, 'href=$1/the-entire-estate#');
  c = c.replace(/href=(['"])\/vD\/pekoe-trail\.php\1/g, 'href=$1/pekoe-trail$1');
  c = c.replace(/href=(['"])\/vD\/pekoe-trail\.php#/g, 'href=$1/pekoe-trail#');
  c = c.replace(/href=(['"])\/vD\/experiences\.php\1/g, 'href=$1/experiences$1');
  c = c.replace(/href=(['"])\/vD\/experiences\.php#/g, 'href=$1/experiences#');
  c = c.replace(/href=(['"])\/vD\/packages\.php\1/g, 'href=$1/packages$1');
  c = c.replace(/href=(['"])\/vD\/packages\.php#/g, 'href=$1/packages#');
  c = c.replace(/href=(['"])\/vD\/gallery\.php\1/g, 'href=$1/gallery$1');
  c = c.replace(/href=(['"])\/vD\/gallery\.php#/g, 'href=$1/gallery#');
  c = c.replace(/href=(['"])\/vD\/contact\.php\1/g, 'href=$1/contact$1');
  c = c.replace(/href=(['"])\/vD\/contact\.php#/g, 'href=$1/contact#');
  c = c.replace(/href=(['"])\/vD\/chairmans-bungalow-2027\.php\1/g, 'href=$1/chairmans-bungalow-2027$1');
  c = c.replace(/href=(['"])\/vD\/chairmans-bungalow-2027\.php#/g, 'href=$1/chairmans-bungalow-2027#');

  // Also replace any standalone "/vD/..." occurrences
  c = c.replace(/\/vD\/images\//g, '/images/');
  c = c.replace(/["']\/vD\/?["']/g, '"/"');

  // Form submit endpoints
  c = c.replace(/fetch\(['"]submit_enquiry\.php['"]/g, "fetch('/api/enquiry'");
  c = c.replace(/fetch\(['"]submit_waitlist\.php['"]/g, "fetch('/api/waitlist'");
  c = c.replace(/action=['"]submit_enquiry\.php['"]/g, "action='/api/enquiry'");
  c = c.replace(/action=['"]submit_waitlist\.php['"]/g, "action='/api/waitlist'");

  return c;
}

function renderNavbar(pageName, ve) {
  let nav = navbarTpl;
  // Remove top PHP declaration
  nav = nav.replace(/<\?php[\s\S]*?\?>/, '');
  // Active links
  nav = nav.replace(/<\?=\s*\$page\s*===\s*['"]([^'"]+)['"]\s*\?\s*['"]active['"]\s*:\s*['"]['"]\s*\?>/g, (m, target) => {
    return target === pageName ? 'active' : '';
  });
  if (ve) nav = stripLegacyChrome(nav);
  return cleanUrlRewrites(nav);
}

// vE pages keep the shared consent banner, reservation drawer and analytics hooks from
// navbar.php, but replace its header, mobile drawer and floating bar with src/layout/ve/header.html
function stripLegacyChrome(nav) {
  const cut = (startMarker, endMarker) => {
    const a = nav.indexOf(startMarker);
    const b = a === -1 ? -1 : nav.indexOf(endMarker, a + startMarker.length);
    if (a === -1 || b === -1) throw new Error(`stripLegacyChrome: "${startMarker}" … "${endMarker}" not found in navbar.php`);
    nav = nav.slice(0, a) + nav.slice(b);
  };
  cut('<!-- Floating Luxury Booking Bar', '<!-- Concierge Enquiry Drawer');
  cut('<nav id="nav">', '<!-- Mobile Navigation Drawer -->');
  cut('<!-- Mobile Navigation Drawer -->', '<script>');
  return nav;
}

// <?php include 'layout/…/x.html'; ?> → file contents (plain-HTML partials, e.g. the vE header)
function resolveIncludes(content) {
  return content.replace(/<\?php\s+include\s+['"](layout\/[a-z0-9\/_-]+\.html)['"];\s*\?>/gi, (m, rel) =>
    fs.readFileSync(path.join(SOURCE_DIR, rel), 'utf8').replace(/^﻿/, ''));
}

function renderFooter() {
  let foot = footerTpl;
  foot = foot.replace(/<\?php[\s\S]*?\?>/g, '');
  return cleanUrlRewrites(foot);
}

// ── CMS Build Bridge (§08 Decap CMS & Phase 3) ──────────────────────────────
const DATA_SRC = path.join(SOURCE_DIR, 'data');
const DATA_DEST = path.join(OUT_DIR, 'data');

function loadCmsCollection(collectionName) {
  const collectionDir = path.join(DATA_SRC, collectionName);
  if (!fs.existsSync(collectionDir)) return [];

  // One JSON file per CMS entry. Sort so output doesn't depend on filesystem order
  // (Vercel's Linux build returns directory entries unsorted).
  const files = fs.readdirSync(collectionDir).sort();
  const items = [];

  for (const file of files) {
    if (file.endsWith('.json')) {
      try {
        const fullPath = path.join(collectionDir, file);
        let raw = fs.readFileSync(fullPath, 'utf8');
        if (raw.charCodeAt(0) === 0xFEFF) {
          raw = raw.slice(1);
        }
        const parsed = JSON.parse(raw);
        if (Array.isArray(parsed)) {
          parsed.forEach(item => items.push(item));
        } else {
          parsed._filename = file;
          parsed._slug = path.basename(file, '.json');
          items.push(parsed);
        }
      } catch (err) {
        console.warn(`[CMS Bridge] Warning parsing ${collectionName}/${file}:`, err.message);
      }
    }
  }
  return items;
}

const cmsExperiences = loadCmsCollection('experiences');
const cmsPackages = loadCmsCollection('packages');
const cmsStories = loadCmsCollection('journal');
const cmsGallery = loadCmsCollection('gallery');
const cmsAnnouncements = loadCmsCollection('announcements');
const cmsChambers = loadCmsCollection('chambers');

// CMS text is plain text (editors type "&", not "&amp;"), so escape it for HTML
const escapeHtml = s => String(s ?? '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');

function renderPackageCard(p, index) {
  const accent = p.accent === 'gold' ? ' gold-top' : p.accent === 'ink' ? ' ink-top' : '';
  const delay = ['', ' d1', ' d2'][index % 3];
  return `    <!-- CMS Package: ${escapeHtml(p.name)} -->
    <div class="pkg-card${accent} reveal${delay}">
${p.badge ? `      <span class="pkg-pop-tag">${escapeHtml(p.badge)}</span>\n` : ''}      <div class="pkg-duration">${escapeHtml(p.duration)}</div>
      <div class="pkg-name">${escapeHtml(p.name)}</div>
      <p class="pkg-tagline">${escapeHtml(p.tagline)}</p>
      <div class="pkg-includes">
${(p.inclusions || []).map(item => `        <div class="pkg-include">${escapeHtml(item)}</div>`).join('\n')}
      </div>
      <div class="pkg-rate">
${p.rate_prefix ? `        <span class="pkg-rate-from">${escapeHtml(p.rate_prefix)}</span>\n` : ''}        <span class="pkg-rate-amount">${escapeHtml(p.rate || 'Price on request')}</span>
${p.rate_period ? `        <span class="pkg-rate-period">${escapeHtml(p.rate_period)}</span>\n` : ''}      </div>
      <a href="#" class="pkg-cta tb-reserve-trigger" data-package="${escapeHtml(p.enquiry_name || p.name)}" data-source="package_cta">${escapeHtml(p.cta_label || 'Enquire')}</a>
    </div>`;
}

function renderFeaturedPackage(p) {
  const meta = [['Duration', p.duration], ['Stages Covered', p.stages_covered], ['Rate', p.rate], ['Solo Rate', p.solo_rate]]
    .filter(([, value]) => value)
    .map(([label, value]) => `          <div><div class="phd-meta-label">${label}</div><div class="phd-meta-val">${escapeHtml(value)}</div></div>`)
    .join('\n');
  return `    <!-- CMS Package (featured): ${escapeHtml(p.name)} -->
    <div class="pkg-hero-card reveal">
      <div class="pkg-hero-visual">
        <div class="phv-nights">${escapeHtml(p.hero_nights)}</div>
        <div class="phv-label">${escapeHtml(p.hero_label)}</div>
        <div class="phv-title">${escapeHtml(p.name)}</div>
      </div>
      <div class="pkg-hero-detail">
${p.badge ? `        <span class="phd-popular">${escapeHtml(p.badge)}</span>\n` : ''}        <p class="phd-tagline">${escapeHtml(p.tagline)}</p>
        <div class="phd-includes">
${(p.inclusions || []).map(item => `          <div class="phd-include">${escapeHtml(item)}</div>`).join('\n')}
        </div>
        <div class="phd-meta">
${meta}
        </div>
        <a href="#" class="phd-cta tb-reserve-trigger" data-package="${escapeHtml(p.enquiry_name || p.name)}" data-source="package_cta">${escapeHtml(p.cta_label || 'Enquire About This Package')}</a>
      </div>
    </div>`;
}

// ── vE helpers ──────────────────────────────────────────────────────────────
const VE_SRC = path.join(SOURCE_DIR, 've');
const MEDIA_SRC = path.join(SOURCE_DIR, 'media');
const VENDOR_FILES = [
  ['gsap/dist/gsap.min.js', 'gsap.min.js'],
  ['gsap/dist/ScrollTrigger.min.js', 'ScrollTrigger.min.js'],
  ['lenis/dist/lenis.min.js', 'lenis.min.js'],
];
const mediaManifestPath = path.join(MEDIA_SRC, 'manifest.json');
const mediaManifest = fs.existsSync(mediaManifestPath) ? JSON.parse(fs.readFileSync(mediaManifestPath, 'utf8')) : {};

// Web-sized version of an original (e.g. a CMS "/images/IMG_7674.jpeg"), or null if none exists
function mediaFor(imagePath, want = 900) {
  const m = mediaManifest[decodeURIComponent(path.basename(String(imagePath || '')))];
  if (!m) return null;
  return `/media/${m.name}-${m.widths.find(w => w >= want) || m.widths[m.widths.length - 1]}.webp`;
}
// Used when a CMS photo has no web version, or is one we keep off the vE pages (see optimize_media.js)
const CATEGORY_MEDIA = {
  'tea-estate': '/media/tea-factory-900.webp', 'tea-heritage': '/media/tea-factory-900.webp',
  'pekoe-trail': '/media/trail-forest-900.webp', dining: '/media/dining-outdoor-900.webp', culinary: '/media/afternoon-tea-900.webp',
  'colonial-heritage': '/media/lounge-fireplace-900.webp', 'estate-life': '/media/lounge-fireplace-900.webp',
  wellness: '/media/garden-900.webp', 'flora-fauna': '/media/garden-900.webp',
};
const imageFor = (imagePath, category) => mediaFor(imagePath) || CATEGORY_MEDIA[category] || '/media/lounge-main-900.webp';

// Cache-busting: /ve/*.css|js and /js/vendor/*.js get ?v=<content hash>
const assetVersions = {};
const hashFile = f => require('crypto').createHash('sha1').update(fs.readFileSync(f)).digest('hex').slice(0, 10);
if (fs.existsSync(VE_SRC)) for (const f of fs.readdirSync(VE_SRC)) assetVersions[`/ve/${f}`] = hashFile(path.join(VE_SRC, f));
for (const [from, to] of VENDOR_FILES) {
  const p = path.join(ROOT_DIR, 'node_modules', from);
  if (fs.existsSync(p)) assetVersions[`/js/vendor/${to}`] = hashFile(p);
}
function versionAssets(content) {
  return content.replace(/(["'])(\/(?:ve|js\/vendor)\/[A-Za-z0-9._-]+\.(?:css|js))\1/g,
    (m, q, p) => (assetVersions[p] ? `${q}${p}?v=${assetVersions[p]}${q}` : m));
}

const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const formatDate = d => { const m = /^(\d{4})-(\d{2})-(\d{2})/.exec(d || ''); return m ? `${+m[3]} ${MONTHS[+m[2] - 1]} ${m[1]}` : (d || ''); };
const labelFor = s => String(s || '').replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase());

// Experiences (vE): the tasting table. Each experience is a cup, in time-of-day order, its tea steeping
// from pale morning gold to dark evening liquor. A photo uploaded in the CMS always wins; until the
// estate photographs each experience, these are the closest estate photos (the CMS defaults are stock).
const EXPERIENCE_PHOTOS = {
  'early-morning-tea': 'lounge-windows', 'breakfast-at-the-long-table': 'lounge-main', 'packed-trail-lunch': 'trail-forest',
  'guided-tea-estate-walk': 'tea-factory', 'the-private-pool': 'garden', 'the-planter-s-afternoon-tea': 'afternoon-tea',
  'sunset-sundowner': 'estate-house', 'the-evening-heritage-talk': 'lounge-red', 'private-fireside-dinner': 'lounge-evening',
  'dinner-at-the-tea-pavilion': 'dining-outdoor',
};
const experiencePhoto = e => (/^\/images\/cms\//.test(e.image || '') ? encodeURI(e.image)
  : EXPERIENCE_PHOTOS[e._slug] ? `/media/${EXPERIENCE_PHOTOS[e._slug]}-900.webp` : imageFor(e.image, e.category));
// The hour an experience happens, from its "timing" text ("7:30 PM", "Collect at breakfast", "By arrangement")
function experienceHour(e) {
  const t = String(e.timing || '').toLowerCase();
  const m = /(\d{1,2})(?::(\d{2}))?\s*(am|pm)/.exec(t);
  if (m) return (+m[1] % 12) + (m[3] === 'pm' ? 12 : 0) + (+m[2] || 0) / 60;
  if (/breakfast|morning|dawn|sunrise/.test(t)) return 7;
  if (/lunch|midday|noon/.test(t)) return 12.5;
  if (/afternoon/.test(t)) return 15;
  if (/pre-dinner|sundown|sunset|dusk/.test(t)) return 18.5;
  if (/dinner|evening|night/.test(t)) return 19.5;
  return { 'pekoe-trail': 7.5, 'tea-estate': 10, 'tea-heritage': 10, wellness: 12, culinary: 15, 'colonial-heritage': 18.5, 'estate-life': 18.5, dining: 19.5 }[e.category] ?? 12;
}
// Tea liquor by hour: pale gold at dawn → amber → copper → near-black by the fire
const LIQUOR = [[6, [220, 185, 110]], [9, [201, 154, 69]], [12, [181, 122, 44]], [15.5, [156, 90, 29]], [18, [122, 58, 20]], [19.5, [78, 33, 13]], [21, [44, 18, 8]]];
function liquorAt(h) {
  let a = LIQUOR[0], b = LIQUOR[LIQUOR.length - 1];
  for (let i = 1; i < LIQUOR.length; i++) if (h <= LIQUOR[i][0]) { a = LIQUOR[i - 1]; b = LIQUOR[i]; break; }
  const t = h <= a[0] ? 0 : h >= b[0] ? 1 : (h - a[0]) / (b[0] - a[0]);
  return '#' + a[1].map((v, c) => Math.round(v + (b[1][c] - v) * t).toString(16).padStart(2, '0')).join('');
}
// Gallery (vE): a photo shows only if it resolves to a web-sized image: a CMS upload, a /media file, or an
// original in src/images that optimize_media.js has turned into WebP (multi-MB originals never go on the page).
function galleryPhoto(image) {
  const img = String(image || '');
  if (/^\/images\/cms\//.test(img)) return { thumb: encodeURI(img), large: encodeURI(img) };
  const m = /^\/media\/([a-z0-9-]+?)-(\d+)\.webp$/.exec(img);
  if (m) {
    const sizes = fs.readdirSync(MEDIA_SRC).map(f => new RegExp(`^${m[1]}-(\\d+)\\.webp$`).exec(f)).filter(Boolean).map(x => +x[1]).sort((a, b) => a - b);
    if (!sizes.length) return null;
    const thumb = sizes.find(w => w >= 900) || sizes[sizes.length - 1];
    return { thumb: `/media/${m[1]}-${thumb}.webp`, large: `/media/${m[1]}-${sizes[sizes.length - 1]}.webp` };
  }
  const thumb = mediaFor(img, 900), large = mediaFor(img, 1600);
  return thumb ? { thumb, large: large || thumb } : null;
}
// The CMS's six categories, shown as three filters
const GALLERY_GROUP = { fire: 'inside', dining: 'inside', chambers: 'chambers', estate: 'outside', garden: 'outside', trail: 'outside' };
const GALLERY_LABELS = { inside: 'Inside the house', chambers: 'Chambers', outside: 'Outdoors' };
const galleryItems = () => [...cmsGallery].sort((a, b) => (a.sort_order ?? 99) - (b.sort_order ?? 99))
  .map(item => ({ item, photo: galleryPhoto(item.image) })).filter(x => x.photo);

const activeExperiences = () => cmsExperiences.filter(e => e.active !== false)
  .map(e => ({ e, h: experienceHour(e) }))
  .sort((a, b) => a.h - b.h || (a.e.sort_order ?? 9999) - (b.e.sort_order ?? 9999));
const isComplimentary = e => /complimentary|included/i.test(e.rate || '');

// <!-- tb:announcement -->, <!-- tb:experiences -->, <!-- tb:stories --> and data-cms-rate="Chamber"
function renderVeMarkers(content) {
  if (content.includes('<!-- tb:announcement -->')) {
    const a = cmsAnnouncements.find(x => x.active !== false);
    content = content.replace('<!-- tb:announcement -->', () => (a
      ? `<p class="ve-notice" title="${escapeHtml(a.body)}"><span class="ve-notice__tag">${escapeHtml(a.type || 'Notice')}</span><span class="ve-notice__text">${escapeHtml(a.title)}</span></p>`
      : ''));
  }
  if (content.includes('<!-- tb:experiences -->')) {
    const rows = cmsExperiences.filter(e => e.active !== false)
      .sort((a, b) => (a.sort_order ?? 9999) - (b.sort_order ?? 9999)).slice(0, 6)
      .map((e, i) => {
        const img = experiencePhoto(e);
        const meta = [e.timing, e.location].filter(Boolean).join(' · ');
        return `<li class="vh-exp__row"><a href="/experiences" data-img="${img}"><span class="ve-num">${String(i + 1).padStart(2, '0')}</span>` +
          `<span class="vh-exp__title">${escapeHtml(e.title)}</span><span class="vh-exp__meta">${escapeHtml(meta)}</span>` +
          `<img class="vh-exp__thumb" src="${img}" alt="" width="72" height="88" loading="lazy" decoding="async"><span class="vh-exp__arrow" aria-hidden="true">&rarr;</span></a></li>`;
      }).join('\n          ');
    content = content.replace('<!-- tb:experiences -->', () => rows);
  }
  if (content.includes('<!-- tb:stories -->')) {
    const stories = cmsStories.filter(s => s.published !== false).slice(0, 3);
    const cards = stories.map((s, i) => `
          <a class="vh-story" href="/about#heritage" data-reveal="up" data-delay="${(i * 0.12).toFixed(2)}">
            <figure class="vh-story__media"><img src="${imageFor(s.featured_image, s.category)}" alt="${escapeHtml(s.image_caption || s.title)}" loading="lazy" decoding="async"></figure>
            <p class="vh-story__meta">${escapeHtml(labelFor(s.category || 'Heritage'))} &middot; ${escapeHtml(formatDate(s.date))} &middot; ${escapeHtml(s.read_time || '5 min read')}</p>
            <h3 class="vh-story__title">${escapeHtml(s.title)}</h3>
            <p class="vh-story__text">${escapeHtml(s.excerpt || '')}</p>
            <span class="ve-link">Read story <span aria-hidden="true">&rarr;</span></span>
          </a>`).join('');
    content = content.replace('<!-- tb:stories -->', () => (stories.length ? `<section class="vh-stories" data-theme="light">
      <div class="ve-wrap">
        <div class="vh-stories__head">
          <p class="ve-label ve-kicker">06 &mdash; Estate stories</p>
          <h2 class="ve-h2" data-split>From the<br><em>estate journal.</em></h2>
          <a class="ve-link" href="/about#heritage">About the estate <span aria-hidden="true">&rarr;</span></a>
        </div>
        <div class="vh-stories__grid">${cards}
        </div>
      </div>
    </section>` : ''));
  }
  if (content.includes('<!-- tb:exp-table -->')) {
    const items = activeExperiences().map(({ e, h }, i) => {
      const free = isComplimentary(e);
      const when = [e.timing, e.location].filter(Boolean).map(escapeHtml).join(' &middot; ');
      const price = free ? `<span class="xp-tag xp-tag--free">Complimentary</span><span>${escapeHtml(e.rate_unit || 'Part of every stay')}</span>`
        : `<span class="xp-tag">${escapeHtml(e.rate || 'Price on request')}</span><span>${escapeHtml([e.rate_unit, e.duration].filter(Boolean).join(' · '))}</span>`;
      const action = free ? '<p class="xp-item__free">Waiting for you, nothing to book</p>'
        : `<button type="button" class="xp-add" data-add="${escapeHtml(e.title)}" data-label-off="Add to my stay" data-label-on="Added to your stay" aria-pressed="false"><span class="xp-add__icon" aria-hidden="true"></span><span class="xp-add__label" data-add-label>Add to my stay</span></button>`;
      return `<li class="xp-item${free ? ' is-free' : ''}" style="--liq: ${liquorAt(h)}" data-hour="${h.toFixed(2)}">
            <figure class="xp-item__cup" aria-hidden="true"><span class="xp-item__handle"></span><span class="xp-item__liquor"><img src="${experiencePhoto(e)}" alt="" loading="lazy" decoding="async"></span></figure>
            <p class="xp-item__when"><span class="ve-num">${String(i + 1).padStart(2, '0')}</span>${when}</p>
            <h3 class="xp-item__title">${escapeHtml(e.title)}</h3>
            <p class="xp-item__desc">${escapeHtml(e.description || '')}</p>
            <p class="xp-item__meta">${price}</p>
            ${action}
          </li>`;
    }).join('\n          ');
    content = content.replace('<!-- tb:exp-table -->', () => items);
  }
  if (content.includes('<!-- tb:exp-count -->')) {
    const n = activeExperiences().length;
    const words = ['No', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve'];
    content = content.split('<!-- tb:exp-count -->').join(words[n] || String(n));
  }
  if (content.includes('<!-- tb:exp-free -->')) {
    const names = activeExperiences().filter(({ e }) => isComplimentary(e)).map(({ e }) => escapeHtml(e.title.replace(/^The /, 'the ')));
    const list = names.length > 1 ? names.slice(0, -1).join(', ') + ' and ' + names[names.length - 1] : (names[0] || '');
    content = content.replace('<!-- tb:exp-free -->', () => list);
  }
  // Packages (vE): the stay packages as cards, and their names in the hero's panels. Rates are shown exactly
  // as entered in the CMS (prefix, rate, period); never computed or rewritten here.
  if (content.includes('<!-- tb:pk-')) {
    const packs = section => cmsPackages.filter(p => p.active !== false && (p.section || 'heritage') === section)
      .sort((a, b) => (a.sort_order ?? 9999) - (b.sort_order ?? 9999));
    const words = ['No', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen'];
    const rateHtml = (p, cls) => `<p class="${cls}">${p.rate_prefix ? `<span>${escapeHtml(p.rate_prefix)}</span> ` : ''}<b>${escapeHtml(p.rate || 'Price on request')}</b>${p.rate_period ? ` <em>${escapeHtml(p.rate_period)}</em>` : ''}</p>`;
    const card = (p, i) => {
      const tone = p.accent === 'gold' ? ' pk-card--gold' : p.accent === 'ink' ? ' pk-card--ink' : '';
      const items = (p.inclusions || []).map(x => `<li>${escapeHtml(x)}</li>`).join('');
      return `<article class="pk-card${tone}" data-reveal="up" data-delay="${((i % 3) * 0.08).toFixed(2)}">
            <p class="pk-card__top"><span class="pk-card__no">${String(i + 1).padStart(2, '0')}</span><span class="pk-card__dur">${escapeHtml(p.duration || '')}</span></p>
            <h3 class="pk-card__name">${escapeHtml(p.name)}</h3>
            ${p.badge ? `<p class="pk-card__badge">${escapeHtml(p.badge)}</p>` : ''}
            <p class="pk-card__tag">${escapeHtml(p.tagline || '')}</p>
            ${items ? `<ul class="pk-card__list">${items}</ul>` : ''}
            ${rateHtml(p, 'pk-card__rate')}
            <button type="button" class="ve-btn ve-btn--sm tb-reserve-trigger" data-package="${escapeHtml(p.enquiry_name || p.name)}" data-source="package_card"><span>${escapeHtml(p.cta_label || 'Enquire')}</span></button>
          </article>`;
    };
    for (const section of ['trail', 'heritage']) {
      const list = packs(section);
      content = content.split(`<!-- tb:pk-count:${section} -->`).join(words[list.length] || String(list.length));
      content = content.replace(`<!-- tb:pk-names:${section} -->`, () => list.map(p => `<span class="pk-panel__item"><span>${escapeHtml(p.name)}</span><em>${escapeHtml(p.duration || '')}</em></span>`).join(''));
      content = content.replace(`<!-- tb:pk-cards:${section} -->`, () => list.filter(p => p.layout !== 'featured').map(card).join('\n          '));
    }
    const all = cmsPackages.filter(p => p.active !== false).length;
    content = content.split('<!-- tb:pk-count:all -->').join(String(all));
    const f = cmsPackages.filter(p => p.active !== false && p.layout === 'featured')
      .sort((a, b) => (a.sort_order ?? 9999) - (b.sort_order ?? 9999))[0];
    content = content.replace('<!-- tb:pk-featured -->', () => {
      if (!f) return '';
      const items = (f.inclusions || []).map(x => `<li>${escapeHtml(x)}</li>`).join('');
      const meta = [['Duration', f.duration], ['Stages', f.stages_covered], ['Rate', f.rate], ['Solo', f.solo_rate]].filter(([, v]) => v)
        .map(([k, v]) => `<div><dt>${k}</dt><dd>${escapeHtml(v)}</dd></div>`).join('');
      return `<article class="pk-feature" data-reveal="up">
            <figure class="pk-feature__media"><img src="/media/trail-forest-1600.webp" srcset="/media/trail-forest-900.webp 900w, /media/trail-forest-1600.webp 1600w" sizes="(max-width: 900px) 100vw, 44vw" alt="A hiker on a forest section of the Pekoe Trail" loading="lazy" decoding="async">
              <figcaption>${f.hero_nights ? `<span class="pk-feature__nights">${escapeHtml(f.hero_nights)}</span>` : ''}${f.hero_label ? `<span class="pk-feature__label">${escapeHtml(f.hero_label)}</span>` : ''}</figcaption></figure>
            <div class="pk-feature__body">
              ${f.badge ? `<p class="pk-feature__badge">${escapeHtml(f.badge)}</p>` : ''}
              <h3 class="pk-feature__name">${escapeHtml(f.name)}</h3>
              <p class="pk-feature__tag">${escapeHtml(f.tagline || '')}</p>
              ${items ? `<ul class="pk-feature__list">${items}</ul>` : ''}
              <dl class="pk-feature__meta">${meta}</dl>
              <button type="button" class="ve-btn ve-btn--gold tb-reserve-trigger" data-package="${escapeHtml(f.enquiry_name || f.name)}" data-source="package_featured" data-magnetic><span>${escapeHtml(f.cta_label || 'Enquire About This Package')}</span></button>
            </div>
          </article>`;
    });
  }
  if (content.includes('<!-- tb:gallery -->')) {
    const items = galleryItems();
    const tiles = items.map(({ item, photo }, i) => {
      const cat = GALLERY_GROUP[item.category] || 'outside';
      return `<li class="gl-tile ${escapeHtml(item.span || 'span-4')} ${escapeHtml(item.height || 'h-sm')}" data-cat="${cat}">
            <a class="gl-tile__link" href="${photo.large}" data-index="${i}" data-title="${escapeHtml(item.caption || '')}" data-sub="${escapeHtml(item.subcaption || '')}" aria-label="${escapeHtml(item.caption || 'Photo')}, open larger">
              <img src="${photo.thumb}" alt="${escapeHtml(item.alt || item.caption || '')}" loading="lazy" decoding="async">
              <span class="gl-tile__cap"><b>${escapeHtml(item.caption || '')}</b>${item.subcaption ? `<em>${escapeHtml(item.subcaption)}</em>` : ''}</span>
            </a>
          </li>`;
    }).join('\n          ');
    const counts = {};
    items.forEach(({ item }) => { const c = GALLERY_GROUP[item.category] || 'outside'; counts[c] = (counts[c] || 0) + 1; });
    const chips = [`<button type="button" class="gl-chip is-on" data-filter="all" aria-pressed="true">All <span>${items.length}</span></button>`]
      .concat(Object.keys(GALLERY_LABELS).filter(c => counts[c]).map(c => `<button type="button" class="gl-chip" data-filter="${c}" aria-pressed="false">${GALLERY_LABELS[c]} <span>${counts[c]}</span></button>`)).join('');
    content = content.replace('<!-- tb:gallery -->', () => tiles).replace('<!-- tb:gallery-filters -->', () => chips)
      .split('<!-- tb:gallery-count -->').join(String(items.length));
  }
  if (content.includes('<!-- tb:trail-packages -->')) {
    const packs = cmsPackages.filter(p => p.section === 'trail' && p.active !== false)
      .sort((a, b) => (a.sort_order ?? 9999) - (b.sort_order ?? 9999));
    const cards = packs.map((p, i) => {
      const featured = p.layout === 'featured';
      const items = (p.inclusions || []).map(x => `<li>${escapeHtml(x)}</li>`).join('');
      const solo = p.solo_rate ? `<span class="vt-pack__solo">Solo &middot; ${escapeHtml(p.solo_rate)}</span>` : '';
      return `
          <article class="vt-pack${featured ? ' vt-pack--featured' : ''}" data-reveal="up" data-delay="${((i % 3) * 0.1).toFixed(1)}">
            <p class="vt-pack__top"><span class="vt-pack__dur">${escapeHtml(p.duration || '')}</span>${p.badge ? `<span class="vt-pack__badge">${escapeHtml(p.badge)}</span>` : ''}</p>
            <h3 class="vt-pack__name">${escapeHtml(p.name)}</h3>
            ${p.stages_covered ? `<p class="vt-pack__stages">${escapeHtml(p.stages_covered)}</p>` : ''}
            <p class="vt-pack__tag">${escapeHtml(p.tagline || '')}</p>
            ${items ? `<ul class="vt-pack__list">${items}</ul>` : ''}
            <p class="vt-pack__rate"><span>${escapeHtml(p.rate || 'Price on request')}</span>${solo}</p>
            <button type="button" class="ve-btn${featured ? ' ve-btn--gold' : ''} tb-reserve-trigger" data-package="${escapeHtml(p.enquiry_name || p.name)}" data-source="trail_package"><span>${escapeHtml(p.cta_label || 'Enquire')}</span></button>
          </article>`;
    }).join('');
    content = content.replace('<!-- tb:trail-packages -->', () => cards);
  }
  const byName = Object.fromEntries(cmsChambers.filter(c => c.name).map(c => [c.name, c]));
  // data-cms-note="Chamber": the chamber's availability / seasonal note and minimum stay (empty if none)
  content = content.replace(/(<(\w+)\b[^>]*\sdata-cms-note="([^"]+)"[^>]*>)([^<]*)(<\/\2>)/g, (m, open, tag, name, text, close) => {
    const c = byName[name] || {};
    const notes = [c.availability_note, c.seasonal_note].filter(Boolean);
    // min_stay only when no note already states a minimum (they usually describe the same rule)
    const minStay = c.min_stay > 1 && !notes.some(n => /minimum/i.test(n)) ? `Minimum stay ${c.min_stay} nights` : '';
    const note = [c.active === false ? 'Currently unavailable' : '', ...notes, minStay].filter(Boolean).join(' · ');
    return open + escapeHtml(note) + close;
  });
  return content.replace(/(<(\w+)\b[^>]*\sdata-cms-rate="([^"]+)"[^>]*>)([^<]*)(<\/\2>)/g,
    (m, open, tag, name, text, close) => open + escapeHtml((byName[name] && byName[name].rate_display) || text) + close);
}

console.log(`[CMS Bridge] Loaded: ${cmsExperiences.length} experiences, ${cmsPackages.length} packages, ${cmsStories.length} stories, ${cmsGallery.length} gallery items, ${cmsAnnouncements.length} announcements, ${cmsChambers.length} chambers`);

console.log('Rendering static HTML pages...');
for (const page of pages) {
  const srcPath = path.join(SOURCE_DIR, page.phpFile);
  let content = fs.readFileSync(srcPath, 'utf8');

  // Navbar include replacement
  const renderedNav = renderNavbar(page.pageName, page.ve);
  content = content.replace(/<\?php\s+include\s+['"]layout\/navbar\.php['"];\s*\?>/g, () => renderedNav);

  // Footer include replacement
  const renderedFoot = renderFooter();
  content = content.replace(/<\?php\s+include\s+['"]layout\/footer\.php['"];\s*\?>/g, () => renderedFoot);
  content = resolveIncludes(content);

  // Remove session_start and CSRF PHP blocks at the top or anywhere
  content = content.replace(/<\?php[\s\S]*?\?>/g, '');
  content = content.replace(/<\?=[\s\S]*?\?>/g, '');

  // Perform link and URL clean rewrites
  content = cleanUrlRewrites(content);

  // ── CMS Content Ingestion Bridge ──────────────────────────────────────────
  if (page.pageName === 'experiences' && !page.ve && cmsExperiences.length > 0) {
    const activeExperiences = cmsExperiences
      .filter(e => e.active !== false)
      .sort((a, b) => (a.sort_order ?? 9999) - (b.sort_order ?? 9999));
    const expCardsHtml = activeExperiences
      .map(e => {
        const catSlug = (e.category || 'tea-estate').toLowerCase();
        let filterCats = catSlug.includes('tea') ? 'tea' : catSlug.replace('colonial-', '');
        if (catSlug.includes('pekoe') || catSlug.includes('trail')) filterCats += ' trail';
        const isFree = e.rate && e.rate.toLowerCase().includes('complimentary');
        if (isFree) filterCats += ' free';
        
        const tagLabel = isFree ? 'Included' : (e.featured ? 'Signature' : (e.availability === 'on-request' ? 'On Request' : 'Bookable'));
        const tagClass = isFree ? 'free' : (e.featured ? 'signature' : '');
        const categoryLabel = (e.category || 'Estate Experience').replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

        return `    <!-- CMS Experience: ${e.title} -->
    <div class="exp-card" data-cat="${filterCats}">
      <div class="exp-visual">
        <div class="exp-visual-bg" style="${e.image ? `background: url('${e.image}') center/cover no-repeat;` : ''}"></div>
        <div class="exp-visual-overlay"></div>
        <div class="exp-ph">
          <div class="exp-ph-icon">${e.icon || '🌿'}</div>
          <div class="exp-ph-text">${e.title}</div>
        </div>
        <div class="exp-tag ${tagClass}">${tagLabel}</div>
        <div class="exp-category">${categoryLabel}</div>
      </div>
      <div class="exp-body">
        <h3 class="exp-name">${e.title}</h3>
        <p class="exp-desc">${e.description}</p>
        <div class="exp-meta">
          <div class="exp-meta-item">
            <div class="exp-meta-label">When</div>
            <div class="exp-meta-val">${e.timing || 'By arrangement'}</div>
          </div>
          <div class="exp-meta-item">
            <div class="exp-meta-label">Duration</div>
            <div class="exp-meta-val">${e.duration || '~1 hr'}</div>
          </div>
          <div class="exp-meta-item">
            <div class="exp-meta-label">Where</div>
            <div class="exp-meta-val">${e.location || 'Galaha Estate'}</div>
          </div>
        </div>
        <div class="exp-price ${isFree ? 'complimentary' : ''}">${e.rate || 'Price on request'} ${e.rate_unit ? `<span>${e.rate_unit}</span>` : ''}</div>
        <a href="#enquire" class="exp-cta tb-reserve-trigger" data-package="${e.title}" data-source="experience_card">${isFree ? 'Included Automatically' : 'Book This Experience'}</a>
      </div>
    </div>`;
      })
      .join('\n\n');

    content = content.replace(
      /(<div class="experiences-grid" id="tea-experiences">)[\s\S]*?(<\/div>\s*<!-- ═══ A DAY AT THE ESTATE ═══ -->)/i,
      (m, openTag, trailing) => `${openTag}\n\n${expCardsHtml}\n\n  ${trailing}`
    );
  }

  if (page.pageName === 'packages' && !page.ve && cmsPackages.length > 0) {
    // Pekoe Trail and Heritage grids come from CMS packages (buyout rates stay in the template)
    for (const section of ['trail', 'heritage']) {
      const sectionPackages = cmsPackages
        .filter(p => p.active !== false && (p.section || 'heritage') === section)
        .sort((a, b) => (a.sort_order ?? 9999) - (b.sort_order ?? 9999));
      let cardIndex = 0;
      const cardsHtml = sectionPackages
        .map(p => (p.layout === 'featured' ? renderFeaturedPackage(p) : renderPackageCard(p, cardIndex++)))
        .join('\n\n');
      content = content.replace(
        new RegExp(`(<div class="${section}-pkgs-grid">)[\\s\\S]*?(<\\/div>\\s*<\\/section>)`),
        (m, openTag, trailing) => `${openTag}\n\n${cardsHtml}\n\n  ${trailing}`
      );
    }
  }

  if (page.pageName === 'gallery' && !page.ve && cmsGallery.length > 0) {
    const gallerySorted = [...cmsGallery].sort((a, b) => (a.sort_order || 10) - (b.sort_order || 10));
    const galleryHtml = gallerySorted.map(item => `
    <div class="photo-tile ${item.span || 'span-4'} ${item.height || 'h-sm'}" data-category="${item.category || 'estate'}" data-title="${item.caption}" data-sub="${item.subcaption || ''}" data-img="${item.image}">
      <img src="${item.image}" alt="${item.alt || item.caption}" class="photo-tile-img" loading="lazy">
      <div class="photo-overlay"></div>
      <div class="photo-label">
        <div class="photo-label-text">${item.caption}</div>
        ${item.subcaption ? `<div class="photo-label-sub">${item.subcaption}</div>` : ''}
      </div>
      <div class="photo-expand">⤢</div>
    </div>`).join('\n');

    content = content.replace(
      /(<div class="photo-grid">)[\s\S]*?(<\/div>\s*<\/div><!-- \/gallery-section -->)/i,
      (m, openTag, trailing) => `${openTag}\n${galleryHtml}\n  ${trailing}`
    );
  }

  if (page.pageName === 'home' && !page.ve) { // vE homepage uses the tb: markers below instead
    // 1. Announcements banner
    const activeAnnouncement = cmsAnnouncements.find(a => a.active !== false);
    if (activeAnnouncement) {
      const annBanner = `
  <!-- Estate Announcement Banner (CMS Managed) -->
  <aside class="tb-announcement-strip" role="region" aria-label="Estate Notice" style="background: rgba(15, 46, 28, 0.95); border-bottom: 1px solid rgba(199, 168, 94, 0.4); padding: 12px 24px; text-align: center; color: #F5F1E9; font-size: 13.5px; position: relative; z-index: 150; backdrop-filter: blur(10px); display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 8px;">
    <span style="font-family:'Cinzel',serif; font-size:9px; letter-spacing:0.25em; text-transform:uppercase; color:#C7A85E; border:1px solid rgba(199,168,94,0.5); padding:2px 8px; border-radius:2px;">${(activeAnnouncement.type || 'Notice').toUpperCase()}</span>
    <strong>${activeAnnouncement.title}</strong> — <span style="font-style:italic; opacity:0.9;">${activeAnnouncement.body}</span>
  </aside>`;
      content = content.replace(/(<\/nav>)/i, `$1\n${annBanner}`);
    }

    // 2. Journal & Stories section
    const publishedStories = cmsStories.filter(s => s.published !== false);
    if (publishedStories.length > 0) {
      const storiesHtml = `
  <!-- ═══════ CMS ESTATE STORIES & JOURNAL ═══════ -->
  <section class="estate-stories-section" id="stories" style="padding: 96px 10vw; background: #ede7db; border-top: 1px solid rgba(199,168,94,0.3); border-bottom: 1px solid rgba(199,168,94,0.2);">
    <div style="max-width: 1140px; margin: 0 auto;">
      <div style="text-align: center; margin-bottom: 56px;" data-reveal="fade-up">
        <div style="font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.45em; color:#8a6a30; text-transform:uppercase; margin-bottom:12px;">Estate Chronicle</div>
        <h2 style="font-family:'Cinzel',serif; font-size:clamp(24px, 3.2vw, 38px); font-weight:600; color:#1E4D2B; line-height:1.2; margin-bottom:14px;">Stories from the Estate</h2>
        <div style="width:40px; height:1px; background:#C7A85E; margin:0 auto 18px;"></div>
        <p style="font-family:'EB Garamond',serif; font-size:18px; font-style:italic; color:#7a6e60; max-width:640px; margin:0 auto; line-height:1.5;">History, walking notes, and evening reflections from our 1890 planter's bungalow in Galaha.</p>
      </div>
      <div class="stories-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 32px;" data-reveal="stagger">
        ${publishedStories.slice(0, 3).map(s => `
          <article class="story-card" style="background:#ffffff; border: 1px solid rgba(199,168,94,0.25); border-radius:4px; overflow:hidden; display:flex; flex-direction:column; box-shadow: 0 4px 16px rgba(30,77,43,0.06); transition:transform 0.3s ease, box-shadow 0.3s ease;">
            ${s.featured_image ? `
              <div style="position:relative; aspect-ratio:16/10; overflow:hidden; background:#07130E;">
                <img src="${s.featured_image}" alt="${s.title}" style="width:100%; height:100%; object-fit:cover; display:block;" loading="lazy">
                <div style="position:absolute; top:12px; left:12px; background:rgba(7,19,14,0.85); backdrop-filter:blur(4px); color:#C7A85E; font-family:'Cinzel',serif; font-size:9px; letter-spacing:0.2em; text-transform:uppercase; padding:4px 10px; border-radius:2px; border:1px solid rgba(199,168,94,0.3);">
                  ${(s.category || 'Heritage').replace(/-/g, ' ').toUpperCase()}
                </div>
              </div>
            ` : ''}
            <div style="padding: 28px 24px; flex:1; display:flex; flex-direction:column;">
              <div style="font-family:'Cinzel',serif; font-size:10.5px; letter-spacing:0.12em; color:#8a6a30; margin-bottom:8px;">${s.date} · ${s.read_time || '5 min read'}</div>
              <h3 style="font-family:'Cinzel',serif; font-size:18px; font-weight:600; color:#1E4D2B; line-height:1.35; margin-bottom:12px;">${s.title}</h3>
              <p style="font-family:'EB Garamond',serif; font-size:15px; color:#3d3428; line-height:1.6; margin-bottom:20px; flex:1;">${s.excerpt || ''}</p>
              <div style="border-top:1px solid rgba(0,0,0,0.06); padding-top:14px; display:flex; justify-content:space-between; align-items:center;">
                <span style="font-size:13px; font-style:italic; color:#7a6e60;">By ${s.author || 'Estate Historian'}</span>
                <a href="/about#heritage" style="font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.15em; color:#1E4D2B; text-transform:uppercase; font-weight:600; text-decoration:none;">Read Story →</a>
              </div>
            </div>
          </article>
        `).join('\n')}
      </div>
    </div>
  </section>`;
      content = content.replace(/(<!-- ═══════ FOOTER ═══════ -->|<footer)/i, `${storiesHtml}\n\n$1`);
    }
  }

  if (page.pageName === 'our-chambers' && !page.ve && cmsChambers.length > 0) {
    for (const ch of cmsChambers) {
      if (ch.name && ch.rate_display) {
        const escapedName = ch.name.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const chamberRegex = new RegExp(`(<h3[^>]*>${escapedName}<\\/h3>[\\s\\S]*?<div class="ch-price">)[^<]*(<\\/div>)`, 'i');
        content = content.replace(chamberRegex, `$1${ch.rate_display}$2`);
      }
    }
  }

  content = renderVeMarkers(content);
  content = content.replace(/<!-- tb:sinhala-font[^>]*-->/, () => sinhalaFontLink(content));

  // Inject synchronous Preloader Anti-Flash Script, Google Consent Mode & GTM into <head>
  let headInject = `
  <!-- Preloader Immediate Anti-Flash Script -->
  <script>
    try {
      if (sessionStorage.getItem('tb_preloader_seen') === '1') {
        document.documentElement.classList.add('tb-preloader-skip');
      }
    } catch (e) {}
  </script>

  <!-- Page-to-page segue hand-off (src/layout/segue.html): arrive under the same curtain -->
  <script>
    try {
      var tbSg = JSON.parse(sessionStorage.getItem('tb_segue') || 'null');
      sessionStorage.removeItem('tb_segue');
      if (tbSg && Date.now() - tbSg.at < 8000 && sessionStorage.getItem('tb_preloader_seen') === '1' &&
          !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.documentElement.classList.add('tb-segue-in');
        window.__tbSegue = tbSg;
      }
    } catch (e) {}
  </script>

  <!-- Google Consent Mode v2 Default (PDPA / GDPR Compliant) -->
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    var tbInitialConsent = null;
    try { tbInitialConsent = localStorage.getItem('tb_cookie_consent'); } catch (e) {}
    gtag('consent', 'default', {
      'analytics_storage': tbInitialConsent === 'granted' ? 'granted' : 'denied',
      'ad_storage': tbInitialConsent === 'granted' ? 'granted' : 'denied',
      'wait_for_update': 500
    });
  </script>

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+dl:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-TEABUNGALOW');</script>
  <!-- End Google Tag Manager -->`;

  // Pages without the shared navbar (privacy, chairmans-bungalow-2027): consent banner + GTM noscript
  if (!content.includes('id="tb-consent-banner"')) {
    headInject += `
  <style>
    #tb-consent-banner {
      position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%) translateY(120%);
      width: min(92vw, 680px); background: rgba(7, 19, 14, 0.94); backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px); border: 1px solid rgba(199, 168, 94, 0.35);
      border-radius: 12px; padding: 20px 24px; z-index: 99990; box-shadow: 0 16px 40px rgba(0, 0, 0, 0.5);
      color: #F5F1E9; opacity: 0; visibility: hidden;
      transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.6s ease, visibility 0.6s;
    }
    #tb-consent-banner.tb-consent-show { transform: translateX(-50%) translateY(0); opacity: 1; visibility: visible; }
    .tb-consent-header { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
    .tb-consent-crest { width: 14px; height: 14px; stroke: #C7A85E; flex-shrink: 0; }
    .tb-consent-title { font-family: 'Cinzel', serif; font-size: 11px; letter-spacing: 0.18em; color: #C7A85E; text-transform: uppercase; font-weight: 600; }
    .tb-consent-text { font-family: 'EB Garamond', Georgia, serif; font-size: 14.5px; line-height: 1.5; color: rgba(245, 241, 233, 0.88); margin-bottom: 16px; }
    .tb-consent-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; }
    .tb-btn-consent-accept { background: #C7A85E; color: #07130E; font-family: 'Cinzel', serif; font-size: 10px; letter-spacing: 0.14em; text-transform: uppercase; font-weight: 600; padding: 9px 18px; border-radius: 6px; border: 1px solid #C7A85E; cursor: pointer; transition: background 0.25s, transform 0.2s; }
    .tb-btn-consent-accept:hover { background: #dfc080; transform: translateY(-1px); }
    .tb-btn-consent-decline { background: transparent; color: #F5F1E9; font-family: 'Cinzel', serif; font-size: 10px; letter-spacing: 0.14em; text-transform: uppercase; padding: 9px 16px; border-radius: 6px; border: 1px solid rgba(199, 168, 94, 0.4); cursor: pointer; transition: all 0.25s; }
    .tb-btn-consent-decline:hover { background: rgba(199, 168, 94, 0.1); border-color: #C7A85E; }
    .tb-consent-link { font-family: 'EB Garamond', Georgia, serif; font-size: 14px; color: #dfc080; text-decoration: underline; text-underline-offset: 3px; margin-left: auto; }
    @media (max-width: 600px) {
      #tb-consent-banner { bottom: 16px; padding: 16px; }
      .tb-consent-actions { flex-direction: column; align-items: stretch; gap: 8px; }
      .tb-btn-consent-accept, .tb-btn-consent-decline { text-align: center; width: 100%; }
      .tb-consent-link { margin-left: 0; text-align: center; margin-top: 4px; }
    }
  </style>`;

    const consentBody = `
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TEABUNGALOW"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- Privacy & Cookie Consent Banner -->
  <div id="tb-consent-banner" role="dialog" aria-labelledby="tbConsentTitle" aria-describedby="tbConsentDesc" aria-modal="false">
    <div class="tb-consent-header">
      <svg class="tb-consent-crest" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <path d="M12 2L3 7v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-9-5z"/>
      </svg>
      <div class="tb-consent-title" id="tbConsentTitle">Guest Privacy &amp; Consent</div>
    </div>
    <p class="tb-consent-text" id="tbConsentDesc">
      We respect your privacy. The Tea Bungalow uses essential cookies to ensure seamless estate navigation, and optional analytics to understand guest journeys in accordance with Sri Lanka's Personal Data Protection Act.
    </p>
    <div class="tb-consent-actions">
      <button type="button" class="tb-btn-consent-accept" id="tbConsentAccept">Accept All</button>
      <button type="button" class="tb-btn-consent-decline" id="tbConsentDecline">Essential Only</button>
      <a href="/privacy" class="tb-consent-link">Privacy &amp; Data Policy</a>
    </div>
  </div>`;
    content = content.replace(/<body[^>]*>/i, (m) => m + '\n' + consentBody);

    const consentScript = `
  <script>
    (function() {
      // Consent engine (pages without the shared navbar)
      const consentBanner = document.getElementById('tb-consent-banner');
      const btnAccept = document.getElementById('tbConsentAccept');
      const btnDecline = document.getElementById('tbConsentDecline');
      if (consentBanner) {
        let consentStatus = null;
        try { consentStatus = localStorage.getItem('tb_cookie_consent'); } catch (e) {}
        function updateGtmConsent(granted) {
          if (typeof gtag === 'function') {
            gtag('consent', 'update', { 'analytics_storage': granted ? 'granted' : 'denied', 'ad_storage': granted ? 'granted' : 'denied' });
          }
          window.dataLayer = window.dataLayer || [];
          window.dataLayer.push({ event: 'consent_update', consent_level: granted ? 'all' : 'essential' });
        }
        function dismissConsent() {
          consentBanner.classList.remove('tb-consent-show');
          setTimeout(function() { if (consentBanner && consentBanner.parentNode) consentBanner.parentNode.removeChild(consentBanner); }, 600);
        }
        if (!consentStatus) {
          setTimeout(function() { consentBanner.classList.add('tb-consent-show'); }, 1400);
          if (btnAccept) btnAccept.addEventListener('click', function() { try { localStorage.setItem('tb_cookie_consent', 'granted'); } catch (e) {} updateGtmConsent(true); dismissConsent(); });
          if (btnDecline) btnDecline.addEventListener('click', function() { try { localStorage.setItem('tb_cookie_consent', 'denied'); } catch (e) {} updateGtmConsent(false); dismissConsent(); });
        } else {
          if (consentBanner.parentNode) consentBanner.parentNode.removeChild(consentBanner);
          if (consentStatus === 'granted') updateGtmConsent(true);
        }
      }
    })();
  </script>`;
  content = content.replace('</body>', () => consentScript + '\n</body>');
  }

  // Cinematic intro (src/layout/preloader.html) goes first after <body> on every page
  // then the page-to-page segue curtain (src/layout/segue.html)
  content = content.replace(/<body[^>]*>/i, (m) => m + '\n' + preloaderHtml + '\n' + segueHtml);

  headInject += '\n</head>';
  content = content.replace('</head>', () => headInject);

  if (GTM_ID) {
    content = content.split('GTM-TEABUNGALOW').join(GTM_ID);
  } else {
    content = content
      .replace(/[ \t]*<!-- Google Tag Manager -->[\s\S]*?<!-- End Google Tag Manager -->\n?/g, '')
      .replace(/[ \t]*<!-- Google Tag Manager \(noscript\) -->[\s\S]*?<!-- End Google Tag Manager \(noscript\) -->\n?/g, '');
  }

  content = versionAssets(content);

  const outPath = path.join(OUT_DIR, page.htmlFile);
  fs.writeFileSync(outPath, content, 'utf8');
  console.log(`Generated: public/${page.htmlFile}`);
}

// ── Copy Decap CMS /admin into public/admin ─────────────────────────────────
function copyDirRecursive(src, dest) {
  if (!fs.existsSync(dest)) {
    fs.mkdirSync(dest, { recursive: true });
  }
  const entries = fs.readdirSync(src, { withFileTypes: true });
  for (const entry of entries) {
    const srcPath = path.join(src, entry.name);
    const destPath = path.join(dest, entry.name);
    if (entry.isDirectory()) {
      copyDirRecursive(srcPath, destPath);
    } else {
      fs.copyFileSync(srcPath, destPath);
    }
  }
}

const ADMIN_SRC = path.join(SOURCE_DIR, 'admin');
const ADMIN_DEST = path.join(OUT_DIR, 'admin');
if (fs.existsSync(ADMIN_SRC)) {
  copyDirRecursive(ADMIN_SRC, ADMIN_DEST);
  const adminFiles = fs.readdirSync(ADMIN_DEST);
  console.log(`Copied Decap CMS /admin → public/admin (${adminFiles.length} files: ${adminFiles.join(', ')})`);
} else {
  console.warn('⚠️ No /admin directory found in source — skipping CMS copy.');
}

if (fs.existsSync(DATA_SRC)) {
  copyDirRecursive(DATA_SRC, DATA_DEST);
  console.log('Copied Decap CMS data → public/data');
}

// vE assets: styles/scripts, optimised media, and the GSAP + Lenis builds from node_modules
if (fs.existsSync(VE_SRC)) copyDirRecursive(VE_SRC, path.join(OUT_DIR, 've'));
if (fs.existsSync(MEDIA_SRC)) copyDirRecursive(MEDIA_SRC, path.join(OUT_DIR, 'media'));
fs.mkdirSync(path.join(OUT_DIR, 'js', 'vendor'), { recursive: true });
for (const [from, to] of VENDOR_FILES) fs.copyFileSync(path.join(ROOT_DIR, 'node_modules', from), path.join(OUT_DIR, 'js', 'vendor', to));
console.log(`Copied vE assets → public/ve, public/media (${fs.readdirSync(path.join(OUT_DIR, 'media')).length} files), public/js/vendor`);

console.log('Static site build complete!');

