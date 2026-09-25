const fs = require('fs');
const path = require('path');

// src/ holds the PHP templates, CMS data, admin and images; public/ is the
// generated site Vercel serves (gitignored — never edit it by hand).
const ROOT_DIR = path.resolve(__dirname, '..');
const SOURCE_DIR = path.join(ROOT_DIR, 'src');
const OUT_DIR = path.join(ROOT_DIR, 'public');

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
  { phpFile: 'home.php', htmlFile: 'index.html', pageName: 'home' },
  { phpFile: 'about.php', htmlFile: 'about.html', pageName: 'about' },
  { phpFile: 'our-chambers.php', htmlFile: 'our-chambers.html', pageName: 'our-chambers' },
  { phpFile: 'the-bungalow.php', htmlFile: 'the-bungalow.html', pageName: 'the-bungalow' },
  { phpFile: 'the-entire-estate.php', htmlFile: 'the-entire-estate.html', pageName: 'the-entire-estate' },
  { phpFile: 'pekoe-trail.php', htmlFile: 'pekoe-trail.html', pageName: 'pekoe-trail' },
  { phpFile: 'experiences.php', htmlFile: 'experiences.html', pageName: 'experiences' },
  { phpFile: 'packages.php', htmlFile: 'packages.html', pageName: 'packages' },
  { phpFile: 'gallery.php', htmlFile: 'gallery.html', pageName: 'gallery' },
  { phpFile: 'contact.php', htmlFile: 'contact.html', pageName: 'contact' },
  { phpFile: 'privacy.php', htmlFile: 'privacy.html', pageName: 'privacy' },
  { phpFile: 'chairmans-bungalow-2027.php', htmlFile: 'chairmans-bungalow-2027.html', pageName: 'chairmans-bungalow-2027' }
];

const navbarTpl = fs.readFileSync(path.join(SOURCE_DIR, 'layout', 'navbar.php'), 'utf8');
const footerTpl = fs.readFileSync(path.join(SOURCE_DIR, 'layout', 'footer.php'), 'utf8');

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

function renderNavbar(pageName) {
  let nav = navbarTpl;
  // Remove top PHP declaration
  nav = nav.replace(/<\?php[\s\S]*?\?>/, '');
  // Active links
  nav = nav.replace(/<\?=\s*\$page\s*===\s*['"]([^'"]+)['"]\s*\?\s*['"]active['"]\s*:\s*['"]['"]\s*\?>/g, (m, target) => {
    return target === pageName ? 'active' : '';
  });
  return cleanUrlRewrites(nav);
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

console.log(`[CMS Bridge] Loaded: ${cmsExperiences.length} experiences, ${cmsPackages.length} packages, ${cmsStories.length} stories, ${cmsGallery.length} gallery items, ${cmsAnnouncements.length} announcements, ${cmsChambers.length} chambers`);

console.log('Rendering static HTML pages...');
for (const page of pages) {
  const srcPath = path.join(SOURCE_DIR, page.phpFile);
  let content = fs.readFileSync(srcPath, 'utf8');

  // Navbar include replacement
  const renderedNav = renderNavbar(page.pageName);
  content = content.replace(/<\?php\s+include\s+['"]layout\/navbar\.php['"];\s*\?>/g, () => renderedNav);

  // Footer include replacement
  const renderedFoot = renderFooter();
  content = content.replace(/<\?php\s+include\s+['"]layout\/footer\.php['"];\s*\?>/g, () => renderedFoot);

  // Remove session_start and CSRF PHP blocks at the top or anywhere
  content = content.replace(/<\?php[\s\S]*?\?>/g, '');
  content = content.replace(/<\?=[\s\S]*?\?>/g, '');

  // Perform link and URL clean rewrites
  content = cleanUrlRewrites(content);

  // ── CMS Content Ingestion Bridge ──────────────────────────────────────────
  if (page.pageName === 'experiences' && cmsExperiences.length > 0) {
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

  if (page.pageName === 'gallery' && cmsGallery.length > 0) {
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

  if (page.pageName === 'home') {
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

  if (page.pageName === 'our-chambers' && cmsChambers.length > 0) {
    for (const ch of cmsChambers) {
      if (ch.name && ch.rate_display) {
        const escapedName = ch.name.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const chamberRegex = new RegExp(`(<h3[^>]*>${escapedName}<\\/h3>[\\s\\S]*?<div class="ch-price">)[^<]*(<\\/div>)`, 'i');
        content = content.replace(chamberRegex, `$1${ch.rate_display}$2`);
      }
    }
  }

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

  // If page doesn't have navbar.php (like chairmans-bungalow-2027), inject preloader CSS & Consent styles in <head>
  if (!content.includes('id="tb-preloader"')) {
    headInject += `
  <style>
    html.tb-preloader-skip #tb-preloader { display: none !important; }
    @media (prefers-reduced-motion: reduce) { #tb-preloader { display: none !important; } }
    #tb-preloader {
      position: fixed; inset: 0; width: 100vw; height: 100vh;
      background: radial-gradient(ellipse at center, #0e2b15 0%, #081a0d 65%, #040c06 100%);
      z-index: 999999; display: flex; align-items: center; justify-content: center;
      opacity: 1; visibility: visible;
      transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.75s ease;
      pointer-events: all; user-select: none;
    }
    #tb-preloader.tb-preloader-fade { opacity: 0 !important; visibility: hidden !important; pointer-events: none !important; }
    .tb-preloader-inner { display: flex; flex-direction: column; align-items: center; text-align: center; padding: 24px; max-width: min(92vw, 560px); margin: 0 auto; box-sizing: border-box; }
    .tb-leaf-stage { display: flex; flex-direction: column; align-items: center; transform-origin: center bottom; animation: tbLeafBreathe 3.4s ease-in-out infinite alternate; }
    .tb-leaf-wrap { position: relative; width: clamp(56px, 8vw, 74px); height: clamp(80px, 11.5vw, 104px); margin-bottom: 22px; filter: drop-shadow(0 0 14px rgba(199, 168, 94, 0.22)); }
    .tb-leaf-svg { width: 100%; height: 100%; display: block; overflow: visible; }
    .tb-leaf-outline { stroke: #C7A85E; stroke-width: 1.3; stroke-linecap: round; stroke-linejoin: round; stroke-dasharray: 280; stroke-dashoffset: 280; animation: tbLeafDraw 1.1s cubic-bezier(0.25, 1, 0.5, 1) forwards; }
    .tb-leaf-stem { stroke-dasharray: 40; stroke-dashoffset: 40; animation: tbVeinDraw 0.6s cubic-bezier(0.25, 1, 0.5, 1) 0.2s forwards; }
    .tb-leaf-midrib { stroke-dasharray: 120; stroke-dashoffset: 120; animation: tbVeinDraw 0.9s cubic-bezier(0.25, 1, 0.5, 1) 0.3s forwards; }
    .tb-leaf-vein { stroke-dasharray: 40; stroke-dashoffset: 40; stroke-opacity: 0.85; }
    .tb-v1 { animation: tbVeinDraw 0.7s ease 0.45s forwards; }
    .tb-v2 { animation: tbVeinDraw 0.7s ease 0.60s forwards; }
    .tb-v3 { animation: tbVeinDraw 0.7s ease 0.75s forwards; }
    .tb-v4 { animation: tbVeinDraw 0.7s ease 0.90s forwards; }
    .tb-leaf-glint { opacity: 0; animation: tbGlintPulse 1.8s ease-in-out 1.0s infinite alternate; }
    @keyframes tbLeafDraw { to { stroke-dashoffset: 0; } }
    @keyframes tbVeinDraw { to { stroke-dashoffset: 0; } }
    @keyframes tbLeafBreathe { 0% { transform: translateY(0) rotate(0deg) scale(1); } 50% { transform: translateY(-3px) rotate(0.8deg) scale(1.015); } 100% { transform: translateY(0) rotate(0deg) scale(1); } }
    @keyframes tbGlintPulse { 0% { opacity: 0.25; transform: scale(0.9); filter: drop-shadow(0 0 2px #C7A85E); } 100% { opacity: 1; transform: scale(1.2); filter: drop-shadow(0 0 8px #dfc080); } }
    .tb-preloader-welcome { display: flex; flex-direction: column; align-items: center; margin-top: 2px; }
    .tb-welcome-intro { font-family: 'EB Garamond', Georgia, serif; font-style: italic; font-size: clamp(14px, 1.6vw, 17px); letter-spacing: 0.12em; color: rgba(245, 241, 233, 0.72); margin-bottom: 3px; opacity: 0; transform: translateY(6px); animation: tbFadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.9s forwards; }
    .tb-welcome-luxury { font-family: 'Cinzel', Georgia, serif; font-size: clamp(12px, 1.4vw, 15px); font-weight: 500; letter-spacing: 0.24em; text-transform: uppercase; color: rgba(199, 168, 94, 0.95); margin-bottom: 3px; opacity: 0; transform: translateY(6px); animation: tbFadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.1s forwards; }
    .tb-welcome-estate { font-family: 'Cinzel', Georgia, serif; font-size: clamp(17px, 2.3vw, 23px); font-weight: 600; letter-spacing: 0.26em; text-transform: uppercase; color: #F5F1E9; margin-bottom: 12px; opacity: 0; transform: translateY(6px); animation: tbFadeUp 0.85s cubic-bezier(0.16, 1, 0.3, 1) 1.3s forwards; }
    .tb-welcome-divider { height: 1px; width: 0; background: linear-gradient(90deg, transparent, rgba(199, 168, 94, 0.6) 30%, #dfc080 50%, rgba(199, 168, 94, 0.6) 70%, transparent); margin-bottom: 10px; opacity: 0; animation: tbRuleDraw 0.9s cubic-bezier(0.16, 1, 0.3, 1) 1.5s forwards; }
    .tb-welcome-tagline { font-family: 'Cinzel', Georgia, serif; font-size: clamp(8.5px, 1.05vw, 10.5px); letter-spacing: 0.32em; color: rgba(199, 168, 94, 0.82); text-transform: uppercase; opacity: 0; transform: translateY(4px); animation: tbFadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.65s forwards; }
    @keyframes tbFadeUp { to { opacity: 1; transform: translateY(0); } }
    @keyframes tbRuleDraw { to { width: 120px; opacity: 0.85; } }

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

    const preloaderBody = `
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TEABUNGALOW"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- Preloader Overlay (once-per-session luxury tea leaf intro) -->
  <div id="tb-preloader" aria-hidden="true" role="status" aria-label="Loading The Tea Bungalow">
    <div class="tb-preloader-inner">
      <div class="tb-leaf-stage">
        <div class="tb-leaf-wrap">
          <svg class="tb-leaf-svg" viewBox="0 0 100 140" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
              <linearGradient id="tbLeafWash" x1="50" y1="10" x2="50" y2="135" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#C7A85E" stop-opacity="0.25"/>
                <stop offset="45%" stop-color="#1E4D2B" stop-opacity="0.20"/>
                <stop offset="100%" stop-color="#081a0d" stop-opacity="0.05"/>
              </linearGradient>
              <linearGradient id="tbGoldStem" x1="50" y1="8" x2="50" y2="136" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#dfc080"/>
                <stop offset="60%" stop-color="#C7A85E"/>
                <stop offset="100%" stop-color="#967738"/>
              </linearGradient>
            </defs>
            <path class="tb-leaf-outline" d="M 50 134 C 49.5 126, 49 120, 50 116 C 36 100, 24 76, 29 48 C 32 32, 41 19, 50 8 C 59 19, 68 32, 71 48 C 76 76, 64 100, 50 116 C 50.8 120, 50.5 126, 50 134 Z" fill="url(#tbLeafWash)"/>
            <path class="tb-leaf-stem" d="M 50 116 C 50.4 122, 50 128, 49.5 136" stroke="url(#tbGoldStem)" stroke-width="1.3" stroke-linecap="round"/>
            <path class="tb-leaf-midrib" d="M 49.8 124 C 50.2 105, 50.8 75, 49.5 50 C 49 34, 49.5 20, 50 8" stroke="url(#tbGoldStem)" stroke-width="1.2" stroke-linecap="round"/>
            <path class="tb-leaf-vein tb-v1" d="M 50 96 C 43 90, 36 84, 34 76" stroke="#C7A85E" stroke-width="0.85" stroke-linecap="round"/>
            <path class="tb-leaf-vein tb-v2" d="M 49.7 78 C 42 72, 35 63, 33 52" stroke="#C7A85E" stroke-width="0.85" stroke-linecap="round"/>
            <path class="tb-leaf-vein tb-v3" d="M 49.5 60 C 43 53, 37 44, 38 35" stroke="#C7A85E" stroke-width="0.85" stroke-linecap="round"/>
            <path class="tb-leaf-vein tb-v4" d="M 49.7 42 C 45 35, 42 27, 45 20" stroke="#C7A85E" stroke-width="0.85" stroke-linecap="round"/>
            <path class="tb-leaf-vein tb-v1" d="M 50 92 C 57 86, 64 80, 66 72" stroke="#C7A85E" stroke-width="0.85" stroke-linecap="round"/>
            <path class="tb-leaf-vein tb-v2" d="M 49.7 74 C 58 68, 65 59, 67 48" stroke="#C7A85E" stroke-width="0.85" stroke-linecap="round"/>
            <path class="tb-leaf-vein tb-v3" d="M 49.5 56 C 57 49, 63 40, 62 31" stroke="#C7A85E" stroke-width="0.85" stroke-linecap="round"/>
            <path class="tb-leaf-vein tb-v4" d="M 49.7 38 C 55 31, 58 23, 55 16" stroke="#C7A85E" stroke-width="0.85" stroke-linecap="round"/>
            <circle class="tb-leaf-glint" cx="50" cy="8" r="1.5" fill="#dfc080"/>
          </svg>
        </div>
      </div>
      <div class="tb-preloader-welcome">
        <div class="tb-welcome-intro">Welcome to the</div>
        <div class="tb-welcome-luxury">Quiet Luxury of</div>
        <div class="tb-welcome-estate">The Tea Bungalow</div>
        <div class="tb-welcome-divider"></div>
        <div class="tb-welcome-tagline">Galaha Estate &middot; Circa 1890</div>
      </div>
    </div>
  </div>

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
    content = content.replace(/<body[^>]*>/i, (m) => m + '\n' + preloaderBody);

    const preloaderScript = `
  <script>
    (function() {
      const preloader = document.getElementById('tb-preloader');
      if (preloader) {
        let isReducedMotion = false;
        try { isReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches; } catch (e) {}
        let forcePreview = false;
        try { forcePreview = window.location.search.indexOf('preview_preloader=1') !== -1; } catch (e) {}
        let alreadySeen = false;
        try { alreadySeen = sessionStorage.getItem('tb_preloader_seen') === '1'; } catch (e) {}
        if ((alreadySeen && !forcePreview) || (isReducedMotion && !forcePreview)) {
          if (preloader.parentNode) preloader.parentNode.removeChild(preloader);
        } else {
          window.dataLayer = window.dataLayer || [];
          window.dataLayer.push({ event: 'preloader_started' });

          const minDisplayMs = 2400;
          const maxDisplayMs = 3800;
          const startTime = Date.now();
          let pageReady = false;
          let dismissed = false;

          setTimeout(function() {
            if (!dismissed) {
              window.dataLayer = window.dataLayer || [];
              window.dataLayer.push({ event: 'preloader_welcome_shown' });
            }
          }, 1300);

          function executeDismiss() {
            if (dismissed) return;
            dismissed = true;
            preloader.classList.add('tb-preloader-fade');
            try { sessionStorage.setItem('tb_preloader_seen', '1'); } catch (e) {}
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({ event: 'preloader_complete' });
            setTimeout(function() {
              if (preloader && preloader.parentNode) preloader.parentNode.removeChild(preloader);
            }, 780);
          }

          function checkReadinessAndDismiss() {
            const elapsed = Date.now() - startTime;
            const remaining = Math.max(0, minDisplayMs - elapsed);
            setTimeout(executeDismiss, remaining);
          }

          function onPageReady() {
            if (pageReady) return;
            pageReady = true;
            if (document.fonts && document.fonts.ready) {
              document.fonts.ready.then(checkReadinessAndDismiss).catch(checkReadinessAndDismiss);
            } else {
              checkReadinessAndDismiss();
            }
          }

          if (document.readyState === 'complete') onPageReady();
          else window.addEventListener('load', onPageReady);
          setTimeout(executeDismiss, maxDisplayMs);
        }
      }

      // Consent Engine for Chairmans Bungalow
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
  content = content.replace('</body>', () => preloaderScript + '\n</body>');
  }

  headInject += '\n</head>';
  content = content.replace('</head>', () => headInject);

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

console.log('Static site build complete!');

