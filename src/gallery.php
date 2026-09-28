<!DOCTYPE html> 

<html lang="en"> 

<head> 

<meta charset="UTF-8"> 

<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

<title>Gallery · The Tea Bungalow · Galaha Estate</title>

<link rel="icon" type="image/png" href="images/favicon.png">
<meta property="og:type" content="website">
<meta property="og:title" content="Gallery · The Tea Bungalow · Galaha Estate">
<meta property="og:description" content="Photography of The Tea Bungalow — the estate, rooms, tea gardens, and bungalow interior.">
<meta property="og:url" content="https://www.theteabungalow.com/gallery">
<meta property="og:image" content="https://www.theteabungalow.com/images/838733193.jpg">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Gallery · The Tea Bungalow · Galaha Estate">
<meta name="twitter:description" content="Photography of The Tea Bungalow — the estate, rooms, tea gardens, and bungalow interior.">
<link rel="canonical" href="https://www.theteabungalow.com/gallery">
 

<meta name="description" content="Photography of The Tea Bungalow — the estate, chambers, verandahs, fireplace, pool, tea fields and Pekoe Trail views on Galaha Estate, Sri Lanka."> 

<link rel="preconnect" href="https://fonts.googleapis.com"> 

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet"> 

<style> 

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; } 

html { scroll-behavior: smooth; } 

:root { 

  --green:#1E4D2B; --green-pale:#c8dece; --green-ghost:#eaf2ec; 

  --gold:#C7A85E; --gold-light:#dfc080; --gold-pale:#f5edd4; 

  --cream:#F5F1E9; --cream-dark:#ede7db; 

  --ink:#1a1510; --ink-mid:#3d3428; --ink-light:#7a6e60; 

  --mist:#8a9e8f; --white:#ffffff; --shadow:rgba(30,77,43,0.15); 

} 

body { background:var(--ink); font-family:'EB Garamond',Georgia,serif; color:var(--white); overflow-x:hidden; } 

body::after { 

  content:''; position:fixed; inset:0; 

  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E"); 

  pointer-events:none; z-index:9999; 

} 

 

/* NAV */ 

nav { 

  position:fixed; top:0; left:0; right:0; z-index:200; 

  height:72px; padding:0 48px; 

  display:flex; align-items:center; justify-content:space-between; 

  transition:background 0.4s, box-shadow 0.4s; 

} 

nav.scrolled { background:rgba(26,21,16,0.96); backdrop-filter:blur(12px); box-shadow:0 1px 0 rgba(199,168,94,0.15); } 

.nav-logo { font-family:'Cinzel',serif; font-size:15px; font-weight:600; letter-spacing:0.12em; color:var(--white); text-decoration:none; } 

.nav-links { display:flex; gap:32px; list-style:none; } 

.nav-links a { font-family:'Cinzel',serif; font-size:11px; letter-spacing:0.16em; text-transform:uppercase; color:rgba(255,255,255,0.7); text-decoration:none; transition:color 0.25s; } 

.nav-links a:hover,.nav-links .active { color:var(--gold); } 

.nav-cta { font-family:'Cinzel',serif; font-size:11px; letter-spacing:0.18em; text-transform:uppercase; color:var(--white); background:var(--green); border:1px solid var(--green); padding:9px 20px; text-decoration:none; transition:background 0.25s; } 

.nav-cta:hover { background:var(--gold); border-color:var(--gold); } 

 

/* HERO */

.hero {
  min-height: 72vh;
  display: flex;
  align-items: flex-end;
  padding: 0 10vw 80px;
  position: relative;
  overflow: hidden;
  background: #050a06;
}

.hero-bg-img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center 40%;
  filter: brightness(0.38) saturate(0.9);
  display: block;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(5,10,6,0.92) 100%);
  pointer-events: none;
}

.hero-texture { position:absolute; inset:0; background-image:repeating-linear-gradient(168deg,transparent 0,transparent 30px,rgba(255,255,255,0.015) 30px,rgba(255,255,255,0.015) 31px); pointer-events:none; }

.hero-inner {
  position: relative;
  z-index: 2;
  width: 100%;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: end;
}

.hero-left { }

.hero-breadcrumb { font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.45em; color:var(--gold); text-transform:uppercase; margin-bottom:20px; opacity:0; animation:fadeUp 0.8s 0.2s ease forwards; }

.hero-breadcrumb a { color:rgba(199,168,94,0.5); text-decoration:none; }

.hero-title {
  font-family: 'Cinzel', serif;
  font-size: clamp(52px, 7.5vw, 96px);
  font-weight: 700;
  color: var(--white);
  line-height: 0.93;
  letter-spacing: 0.01em;
  opacity: 0;
  animation: fadeUp 0.9s 0.4s ease forwards;
}

.hero-title em { font-style:italic; color:var(--gold-light); font-weight:400; display:block; }

.hero-right { opacity:0; animation:fadeUp 0.9s 0.6s ease forwards; }

.hero-sub { font-size:17px; font-style:italic; color:rgba(255,255,255,0.65); line-height:1.7; margin-bottom:28px; }

.hero-count-row { display:flex; gap:20px; flex-wrap: wrap; }

.hero-count { text-align:center; padding:14px 22px; border:1px solid rgba(199,168,94,0.35); background: rgba(0,0,0,0.25); backdrop-filter: blur(6px); }

.hc-n { font-family:'Cinzel',serif; font-size:26px; font-weight:700; color:var(--gold); }

.hc-l { font-family:'Cinzel',serif; font-size:8px; letter-spacing:0.25em; color:rgba(255,255,255,0.45); text-transform:uppercase; margin-top:4px; } 

 

/* FILTER BAR */ 

.filter-bar { 

  background:rgba(26,21,16,0.98); border-bottom:2px solid var(--gold); 

  position:sticky; top:72px; z-index:100; 

  display:flex; align-items:center; gap:0; overflow-x:auto; 

  padding:0 10vw; 

} 

.f-label { font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.4em; color:var(--gold); text-transform:uppercase; padding:18px 24px 18px 0; flex-shrink:0; border-right:1px solid rgba(255,255,255,0.08); margin-right:4px; } 

.f-chip { font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.5); padding:18px 22px; cursor:pointer; border:none; background:transparent; white-space:nowrap; transition:color 0.2s,background 0.2s; border-right:1px solid rgba(255,255,255,0.06); } 

.f-chip:hover { color:var(--gold); background:rgba(255,255,255,0.04); } 

.f-chip.active { color:var(--gold); background:rgba(199,168,94,0.1); } 

 

/* MASONRY-STYLE GALLERY */ 

.gallery-section { padding:60px 10vw 120px; } 

 

/* Category label */ 

.cat-label { 

  display:flex; align-items:center; gap:16px; 

  margin:56px 0 28px; opacity:0; transform:translateY(16px); 

  transition:opacity 0.6s ease, transform 0.6s ease; 

} 

.cat-label.visible { opacity:1; transform:translateY(0); } 

.cat-rule { flex:1; height:1px; background:rgba(199,168,94,0.2); } 

.cat-text { font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.45em; color:var(--gold); text-transform:uppercase; white-space:nowrap; } 

 

/* Grid layout */ 

.photo-grid { 

  display:grid; 

  grid-template-columns:repeat(12,1fr); 

  gap:4px; 

  margin-bottom:4px; 

} 

 

.photo-tile { 

  position:relative; overflow:hidden; cursor:pointer; 

  background:rgba(255,255,255,0.03); 

  opacity:0; transform:translateY(20px); 

  transition:opacity 0.6s ease, transform 0.6s ease; 

} 

.photo-tile.visible { opacity:1; transform:translateY(0); } 

 

/* Span variants */ 

.span-4  { grid-column:span 4; } 

.span-6  { grid-column:span 6; } 

.span-8  { grid-column:span 8; } 

.span-3  { grid-column:span 3; } 

.span-12 { grid-column:span 12; } 

 

/* Height variants */ 

.h-sm  { aspect-ratio:4/3; } 

.h-md  { aspect-ratio:1/1; } 

.h-lg  { aspect-ratio:4/5; } 

.h-xl  { aspect-ratio:16/9; } 

.h-hero { aspect-ratio:21/9; } 

 

/* Photo image fills each tile */

.photo-tile-img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
  transition: transform 0.6s cubic-bezier(0.25,0.46,0.45,0.94);
}

.photo-tile:hover .photo-tile-img { transform: scale(1.04); }

/* Legacy photo-bg kept for any fallback */
.photo-bg {
  position:absolute; inset:0;
  background-size:cover; background-position:center;
  transition:transform 0.6s cubic-bezier(0.25,0.46,0.45,0.94);
}

.photo-tile:hover .photo-bg { transform:scale(1.04); } 

 

/* Colour themes for placeholders */ 

.ph-estate   { background:linear-gradient(155deg,#1a4a24 0%,#2d7038 45%,#0d2415 100%); } 

.ph-dawn     { background:linear-gradient(155deg,#1a3d40 0%,#2d6058 45%,#0d2020 100%); } 

.ph-fire     { background:linear-gradient(155deg,#3d1a08 0%,#8a4018 45%,#1e0d05 100%); } 

.ph-gold     { background:linear-gradient(155deg,#3d3018 0%,#8a6a2d 45%,#1e1a0d 100%); } 

.ph-forest   { background:linear-gradient(155deg,#0d2010 0%,#1a4022 45%,#081408 100%); } 

.ph-rooms    { background:linear-gradient(155deg,#1a2a3d 0%,#2d4a6e 45%,#0d1824 100%); } 

.ph-trail    { background:linear-gradient(155deg,#1e3d28 0%,#3d7050 45%,#0d2015 100%); } 

.ph-evening  { background:linear-gradient(155deg,#1a1a3d 0%,#2d2d6e 45%,#0d0d24 100%); } 

.ph-morning  { background:linear-gradient(155deg,#3d3a18 0%,#706a28 45%,#1e1c0a 100%); } 

.ph-pool     { background:linear-gradient(155deg,#1a3040 0%,#3d5a70 45%,#0d1820 100%); } 

.ph-cottage  { background:linear-gradient(155deg,#3d2a18 0%,#6e4a28 45%,#1e1008 100%); } 

.ph-table    { background:linear-gradient(155deg,#2a1a3d 0%,#4a2d70 45%,#140d1e 100%); } 

 

/* Overlay & label */ 

.photo-overlay { 

  position:absolute; inset:0; 

  background:linear-gradient(to top,rgba(10,14,10,0.7) 0%,transparent 50%); 

  opacity:0; transition:opacity 0.35s ease; 

} 

.photo-tile:hover .photo-overlay { opacity:1; } 

.photo-label { 

  position:absolute; bottom:0; left:0; right:0; padding:16px 20px; 

  transform:translateY(8px); opacity:0; 

  transition:opacity 0.3s ease, transform 0.3s ease; 

} 

.photo-tile:hover .photo-label { opacity:1; transform:translateY(0); } 

.photo-label-text { 

  font-family:'Cinzel',serif; font-size:11px; letter-spacing:0.18em; 

  color:var(--white); text-transform:uppercase; 

} 

.photo-label-sub { 

  font-size:12px; font-style:italic; color:rgba(255,255,255,0.6); 

  margin-top:3px; line-height:1.4; 

} 

 

/* Placeholder icon overlay */ 

.photo-ph {
  display:none !important;
} 

.photo-ph-icon { font-size:32px; opacity:0.22; } 

.photo-ph-text { 

  font-family:'Cinzel',serif; font-size:8px; letter-spacing:0.3em; 

  color:rgba(255,255,255,0.18); text-transform:uppercase; text-align:center; line-height:1.8; 

} 

 

/* Expand icon */ 

.photo-expand { 

  position:absolute; top:14px; right:14px; 

  width:32px; height:32px; border-radius:50%; 

  background:rgba(255,255,255,0.1); backdrop-filter:blur(4px); 

  display:flex; align-items:center; justify-content:center; 

  font-size:14px; opacity:0; transition:opacity 0.3s; 

} 

.photo-tile:hover .photo-expand { opacity:1; } 

 

/* LIGHTBOX */ 

.lightbox { 

  position:fixed; inset:0; z-index:1000; 

  background:rgba(10,14,10,0.97); 

  display:flex; align-items:center; justify-content:center; 

  opacity:0; pointer-events:none; 

  transition:opacity 0.3s ease; 

} 

.lightbox.open { opacity:1; pointer-events:all; } 

.lb-inner { 

  max-width:90vw; max-height:90vh; 

  display:flex; flex-direction:column; align-items:center; 

  position:relative; 

} 

.lb-visual { 

  width:min(1100px,85vw); height:min(680px,70vh); 

  position:relative; overflow:hidden; 

} 

.lb-bg { position:absolute; inset:0; transition:none; } 

.lb-ph {
  display:none !important;
} 

.lb-ph-icon { font-size:64px; opacity:0.25; } 

.lb-ph-txt { font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.3em; color:rgba(255,255,255,0.2); text-transform:uppercase; } 

.lb-info { 

  padding:20px 0; text-align:center; max-width:600px; 

} 

.lb-title { font-family:'Cinzel',serif; font-size:18px; color:var(--white); letter-spacing:0.06em; margin-bottom:6px; } 

.lb-sub { font-size:15px; font-style:italic; color:rgba(255,255,255,0.5); } 

.lb-close { 

  position:absolute; top:-48px; right:0; 

  width:40px; height:40px; border-radius:50%; 

  background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); 

  color:var(--white); font-size:18px; cursor:pointer; 

  display:flex; align-items:center; justify-content:center; 

  transition:background 0.2s; 

} 

.lb-close:hover { background:rgba(199,168,94,0.25); } 

.lb-prev,.lb-next { 

  position:absolute; top:50%; transform:translateY(-50%); 

  width:48px; height:48px; border-radius:50%; 

  background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); 

  color:var(--white); font-size:20px; cursor:pointer; 

  display:flex; align-items:center; justify-content:center; 

  transition:background 0.2s; z-index:10; 

} 

.lb-prev { left:-64px; } 

.lb-next { right:-64px; } 

.lb-prev:hover,.lb-next:hover { background:rgba(199,168,94,0.2); } 

.lb-counter { 

  position:absolute; bottom:-36px; left:50%; transform:translateX(-50%); 

  font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.25em; 

  color:rgba(255,255,255,0.4); white-space:nowrap; 

} 

 

/* PHOTO CTA STRIP */ 

.photo-cta-strip { 

  background:var(--green); 

  padding:60px 10vw; 

  border-top:2px solid var(--gold); 

  display:flex; align-items:center; justify-content:space-between; gap:40px; flex-wrap:wrap; 

} 

.pcs-left {} 

.pcs-eyebrow { font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.45em; color:var(--gold); text-transform:uppercase; margin-bottom:12px; } 

.pcs-title { font-family:'Cinzel',serif; font-size:clamp(22px,3vw,34px); font-weight:600; color:var(--white); line-height:1.1; } 

.pcs-body { font-size:16px; font-style:italic; color:rgba(255,255,255,0.65); line-height:1.6; margin-top:10px; max-width:520px; } 

.pcs-btns { display:flex; gap:14px; flex-wrap:wrap; flex-shrink:0; } 

.btn-gold { font-family:'Cinzel',serif; font-size:11px; letter-spacing:0.2em; text-transform:uppercase; background:var(--gold); color:var(--ink); padding:16px 32px; text-decoration:none; border:1px solid var(--gold); transition:background 0.25s,color 0.25s,transform 0.2s; display:inline-block; } 

.btn-gold:hover { background:var(--white); color:var(--green); transform:translateY(-2px); } 

.btn-outline { font-family:'Cinzel',serif; font-size:11px; letter-spacing:0.2em; text-transform:uppercase; background:transparent; color:var(--white); padding:16px 28px; text-decoration:none; border:1px solid rgba(255,255,255,0.35); transition:border-color 0.25s,color 0.25s; display:inline-block; } 

.btn-outline:hover { border-color:var(--gold); color:var(--gold); } 

 

/* INSTAGRAM STRIP */ 

.instagram-strip { background:var(--ink); padding:72px 10vw; border-top:1px solid rgba(199,168,94,0.15); } 

.ig-header { text-align:center; margin-bottom:40px; } 

.ig-eyebrow { font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.45em; color:var(--gold); text-transform:uppercase; margin-bottom:14px; } 

.ig-title { font-family:'Cinzel',serif; font-size:clamp(22px,2.8vw,32px); font-weight:600; color:var(--white); margin-bottom:10px; } 

.ig-handle { font-size:16px; font-style:italic; color:rgba(255,255,255,0.5); } 

.ig-grid { display:grid; grid-template-columns:repeat(6,1fr); gap:3px; max-width:900px; margin:0 auto; } 

.ig-tile { aspect-ratio:1; position:relative; overflow:hidden; cursor:pointer; } 

.ig-tile-bg { position:absolute; inset:0; transition:transform 0.4s; } 

.ig-tile:hover .ig-tile-bg { transform:scale(1.06); } 

.ig-tile-overlay { position:absolute; inset:0; background:rgba(0,0,0,0.4); opacity:0; transition:opacity 0.3s; display:flex; align-items:center; justify-content:center; } 

.ig-tile:hover .ig-tile-overlay { opacity:1; } 

.ig-icon { font-size:24px; color:var(--white); } 

.ig-t1 { background:url('images/tea-estate.jpg') center/cover no-repeat; } 

.ig-t2 { background:url('images/IMG_7651.jpeg') center/cover no-repeat; } 

.ig-t3 { background:url('images/front-view-woman-pouring-iced-tea.jpg') center/cover no-repeat; } 

.ig-t4 { background:url('images/house.jpeg') center/cover no-repeat; } 

.ig-t5 { background:url('images/swimming-pool-resort.jpg') center/cover no-repeat; } 

.ig-t6 { background:url('images/Pekoe Trail access.jpg') center/cover no-repeat; } 

.ig-cta { text-align:center; margin-top:28px; } 

.ig-follow { font-family:'Cinzel',serif; font-size:11px; letter-spacing:0.22em; text-transform:uppercase; color:var(--gold); text-decoration:none; border-bottom:1px solid rgba(199,168,94,0.3); padding-bottom:3px; transition:border-color 0.2s; } 

.ig-follow:hover { border-color:var(--gold); } 

 

/* FOOTER */ 

footer { background:#0d0a07; padding:72px 10vw 40px; } 

.footer-top { display:grid; grid-template-columns:1.5fr 1fr 1fr 1fr; gap:48px; padding-bottom:56px; border-bottom:1px solid rgba(255,255,255,0.06); margin-bottom:32px; } 

.footer-logo { font-family:'Cinzel',serif; font-size:18px; font-weight:600; color:var(--white); letter-spacing:0.08em; margin-bottom:8px; } 

.footer-tagline { font-size:14px; font-style:italic; color:rgba(255,255,255,0.3); line-height:1.5; margin-bottom:20px; } 

.footer-contact { font-size:13px; color:rgba(255,255,255,0.4); margin-bottom:6px; } 

.footer-contact a { color:var(--gold); text-decoration:none; } 

.footer-col-title { font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.35em; color:var(--gold); text-transform:uppercase; margin-bottom:20px; } 

.footer-links { list-style:none; display:flex; flex-direction:column; gap:10px; } 

.footer-links a { font-size:14px; color:rgba(255,255,255,0.45); text-decoration:none; transition:color 0.2s; } 

.footer-links a:hover { color:var(--white); } 

.footer-bottom { display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; } 

.footer-copy { font-size:12px; color:rgba(255,255,255,0.18); font-style:italic; } 

.footer-collection { font-family:'Cinzel',serif; font-size:10px; letter-spacing:0.3em; color:var(--gold); opacity:0.55; text-transform:uppercase; } 

 

/* ANIMATIONS */ 

@keyframes fadeUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } } 

.reveal { opacity:0; transform:translateY(24px); transition:opacity 0.7s ease,transform 0.7s ease; } 

.reveal.visible { opacity:1; transform:translateY(0); } 

 

/* RESPONSIVE */ 

@media(max-width:1100px) { 

  .photo-grid { grid-template-columns:repeat(6,1fr); } 

  .span-8 { grid-column:span 6; } 

  .span-4 { grid-column:span 3; } 

  .span-3 { grid-column:span 3; } 

  .ig-grid { grid-template-columns:repeat(4,1fr); } 

  .footer-top { grid-template-columns:1fr 1fr; } 

} 

@media(max-width:768px) { 

  nav { padding:0 24px; } 

  .nav-links { display:none; } 

  .hero-inner { grid-template-columns:1fr; gap:24px; } 

  .photo-grid { grid-template-columns:repeat(2,1fr); } 

  .span-4,.span-6,.span-8,.span-3,.span-12 { grid-column:span 2; } 

  .h-hero { aspect-ratio:4/3; } 

  .pcs-btns { width:100%; } 

  .ig-grid { grid-template-columns:repeat(3,1fr); } 

  .footer-top { grid-template-columns:1fr; } 

} 

</style> 

</head> 

<body> 

 

<!-- NAV --> 
<?php $page = basename($_SERVER['PHP_SELF'], '.php'); ?>
<?php include 'layout/navbar.php'; ?> 

 

<!-- HERO --> 

<section class="hero">
  <img src="images/tea-estate.jpg" alt="Galaha tea estate, Sri Lanka" class="hero-bg-img">
  <div class="hero-overlay"></div>
  <div class="hero-texture"></div>

  <div class="hero-inner">

    <div class="hero-left">
      <div class="hero-breadcrumb"><a href="/vD/home.php">Home</a> &nbsp;/&nbsp; Gallery</div>
      <h1 class="hero-title">The <em>Estate</em> in&nbsp;Frame</h1>
    </div>

    <div class="hero-right">
      <p class="hero-sub">Photography of The Tea Bungalow — the estate rooms, verandahs, tea fields, fireplace, and the Pekoe Trail views from Galaha.</p>

      <div class="hero-count-row">
        <div class="hero-count"><div class="hc-n">7</div><div class="hc-l">Categories</div></div>
        <div class="hero-count"><div class="hc-n">40+</div><div class="hc-l">Images</div></div>
        <div class="hero-count"><div class="hc-n">1890</div><div class="hc-l">Est.</div></div>
      </div>
    </div>

  </div>
</section> 

 

<!-- FILTER BAR --> 

<div class="filter-bar"> 

  <span class="f-label">View</span> 

  <button class="f-chip active" data-filter="all">All</button> 

  <button class="f-chip" data-filter="estate">The Estate</button> 

  <button class="f-chip" data-filter="chambers">Chambers</button> 

  <button class="f-chip" data-filter="dining">Dining</button> 

  <button class="f-chip" data-filter="fire">Fireplace</button> 

  <button class="f-chip" data-filter="trail">Pekoe Trail</button> 

  <button class="f-chip" data-filter="garden">Garden &amp; Pool</button> 

</div> 

 

<!-- GALLERY --> 

<div class="gallery-section"> 

 

  <!-- THE ESTATE --> 

  <div class="cat-label" data-category="estate"> 

    <div class="cat-rule"></div> 

    <div class="cat-text">The Estate</div> 

    <div class="cat-rule"></div> 

  </div> 

  <div class="photo-grid">

    <div class="photo-tile span-8 h-xl" data-category="estate" data-title="The Bungalow, Galaha Estate" data-sub="Exterior · circa 1890 · Mist on the hills" data-img="images/house.jpeg">
      <img src="images/house.jpeg" alt="The Bungalow, Galaha Estate" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Bungalow</div><div class="photo-label-sub">Galaha Estate · circa 1890</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="estate" data-title="The Car Porch" data-sub="Arrival · Galaha Estate" data-img="images/IMG_7674.jpeg">
      <img src="images/IMG_7674.jpeg" alt="The Car Porch" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Car Porch</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="estate" data-title="Tea Fields, Galaha" data-sub="Working estate · Morning mist" data-img="images/tea-estate.jpg">
      <img src="images/tea-estate.jpg" alt="Tea Fields, Galaha" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Tea Fields</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="estate" data-title="Mist on Galaha Estate" data-sub="Early morning · Hill country" data-img="images/img6.jpg">
      <img src="images/img6.jpg" alt="Morning Mist, Galaha Estate" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Morning Mist</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="estate" data-title="The Long Verandah" data-sub="Rear of the bungalow · Estate views" data-img="images/IMG_7619.jpeg">
      <img src="images/IMG_7619.jpeg" alt="The Long Verandah" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Long Verandah</div></div>
      <div class="photo-expand">⤢</div>
    </div>

  </div> 

 

  <!-- CHAMBERS --> 

  <div class="cat-label" data-category="chambers"> 

    <div class="cat-rule"></div> 

    <div class="cat-text">The Chambers</div> 

    <div class="cat-rule"></div> 

  </div> 

  <div class="photo-grid">

    <div class="photo-tile span-6 h-md" data-category="chambers" data-title="The Founder's Suite" data-sub="Principal chamber · Private verandah · Pool access" data-img="images/838733193.jpg">
      <img src="images/838733193.jpg" alt="The Founder's Suite" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Founder's Suite</div><div class="photo-label-sub">Principal chamber · Private verandah</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-3 h-md" data-category="chambers" data-title="The Highlands Suite" data-sub="Elevated · Accessible · Family wing" data-img="images/838733260.jpg">
      <img src="images/838733260.jpg" alt="The Highlands Suite" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Highlands Suite</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-3 h-md" data-category="chambers" data-title="The Pekoe Room" data-sub="Named for the leaf · Ceylon Tea" data-img="images/838733265.jpg">
      <img src="images/838733265.jpg" alt="The Pekoe Room" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Pekoe Room</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-3 h-sm" data-category="chambers" data-title="The Verandah Chamber" data-sub="Direct garden access" data-img="images/838733269.jpg">
      <img src="images/838733269.jpg" alt="The Verandah Chamber" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Verandah Chamber</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-3 h-sm" data-category="chambers" data-title="The Camellia Room" data-sub="Named for Camellia sinensis" data-img="images/838733276.jpg">
      <img src="images/838733276.jpg" alt="The Camellia Room" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Camellia Room</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-3 h-sm" data-category="chambers" data-title="The Galaha Room" data-sub="Grounded · Estate views" data-img="images/IMG_7653.jpeg">
      <img src="images/IMG_7653.jpeg" alt="The Galaha Room" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Galaha Room</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-3 h-sm" data-category="chambers" data-title="Carriage House Cottage" data-sub="Former stable · 2BR · Stepless" data-img="images/IMG_7654.jpeg">
      <img src="images/IMG_7654.jpeg" alt="Carriage House Cottage" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Carriage House Cottage</div></div>
      <div class="photo-expand">⤢</div>
    </div>

  </div> 

 

  <!-- DINING --> 

  <div class="cat-label" data-category="dining"> 

    <div class="cat-rule"></div> 

    <div class="cat-text">Dining &amp; Tea</div> 

    <div class="cat-rule"></div> 

  </div> 

  <div class="photo-grid">

    <div class="photo-tile span-4 h-md" data-category="dining" data-title="The Long Table" data-sub="Heart of the house · Seats 12" data-img="images/eating outdoor.jpg">
      <img src="images/eating outdoor.jpg" alt="The Long Table" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Long Table</div><div class="photo-label-sub">Seats twelve · Breakfasts &amp; suppers</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-8 h-xl" data-category="dining" data-title="The Planter's Afternoon Tea" data-sub="Three-tier service · Verandah · 3–5 PM" data-img="images/front-view-woman-pouring-iced-tea.jpg">
      <img src="images/front-view-woman-pouring-iced-tea.jpg" alt="Planter's Afternoon Tea" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Planter's Afternoon Tea</div><div class="photo-label-sub">On the verandah · 3–5 PM</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-6 h-sm" data-category="dining" data-title="Tea Pavilion Dinner" data-sub="Lanterns · Garden · Evening meals" data-img="images/IMG_7639.jpeg">
      <img src="images/IMG_7639.jpeg" alt="Tea Pavilion Dinner" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Tea Pavilion</div><div class="photo-label-sub">Lantern-lit evenings</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-6 h-sm" data-category="dining" data-title="Morning Tea Ritual" data-sub="Morning Room · Estate-fresh · From 6 AM" data-img="images/IMG_7643 (1).jpeg">
      <img src="images/IMG_7643 (1).jpeg" alt="Morning Tea Ritual" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Morning Tea Ritual</div><div class="photo-label-sub">Morning Room · From 6:00 AM</div></div>
      <div class="photo-expand">⤢</div>
    </div>

  </div> 

 

  <!-- FIREPLACE --> 

  <div class="cat-label" data-category="fire"> 

    <div class="cat-rule"></div> 

    <div class="cat-text">The Fireplace</div> 

    <div class="cat-rule"></div> 

  </div> 

  <div class="photo-grid">

    <div class="photo-tile span-12 h-hero" data-category="fire" data-title="The Planter's Lounge" data-sub="Original stone fireplace · Lit nightly 6:30 PM · Since 1890" data-img="images/IMG_7650.jpeg">
      <img src="images/IMG_7650.jpeg" alt="The Planter's Lounge fireplace" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Planter's Lounge</div><div class="photo-label-sub">Original stone fireplace · Lit nightly from 6:30 PM · Since 1890</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-md" data-category="fire" data-title="Fireside Evening" data-sub="Ceylon arrack · Leather armchairs · Mist outside" data-img="images/IMG_7651.jpeg">
      <img src="images/IMG_7651.jpeg" alt="Fireside Evening" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Fireside Evening</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-md" data-category="fire" data-title="Private Fireside Dinner" data-sub="For two · Three courses · One seating per evening" data-img="images/eating outdoor.jpg">
      <img src="images/eating outdoor.jpg" alt="Private Fireside Dinner" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Private Fireside Dinner</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-md" data-category="fire" data-title="The Billiards Room" data-sub="Former estate kitchen · Snooker · Rainy afternoons" data-img="images/Snooker evenings.jpg">
      <img src="images/Snooker evenings.jpg" alt="The Billiards Room" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Billiards Room</div></div>
      <div class="photo-expand">⤢</div>
    </div>

  </div> 

 

  <!-- PEKOE TRAIL --> 

  <div class="cat-label" data-category="trail"> 

    <div class="cat-rule"></div> 

    <div class="cat-text">Pekoe Trail</div> 

    <div class="cat-rule"></div> 

  </div> 

  <div class="photo-grid">

    <div class="photo-tile span-6 h-xl" data-category="trail" data-title="Stage 1 — Hanthana to Galaha" data-sub="12.84 km · Easy · Through tea estates and pine forest" data-img="images/Pekoe Trail access.jpg">
      <img src="images/Pekoe Trail access.jpg" alt="Pekoe Trail Stage 1" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Stage 1</div><div class="photo-label-sub">Hanthana to Galaha · 12.84 km</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-6 h-xl" data-category="trail" data-title="Stage 2 — Galaha to Loolecondera" data-sub="14.7 km · Difficult · Birthplace of Ceylon Tea" data-img="images/tea-estate.jpg">
      <img src="images/tea-estate.jpg" alt="Pekoe Trail Stage 2" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Stage 2</div><div class="photo-label-sub">Galaha to Loolecondera · 14.7 km</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="trail" data-title="Recovery on the Verandah" data-sub="After Stage 1 · Packed lunches on the trail" data-img="images/IMG_7660.jpeg">
      <img src="images/IMG_7660.jpeg" alt="Post-trail recovery" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Post-Trail Recovery</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="trail" data-title="Packed Lunch Preparation" data-sub="Estate kitchen · Pre-ordered the night before" data-img="images/IMG_7675.jpeg">
      <img src="images/IMG_7675.jpeg" alt="Trail packed lunches" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Trail Packed Lunches</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="trail" data-title="Loolecondera Estate" data-sub="Birthplace of Ceylon Tea · James Taylor · 1867" data-img="images/tea-factory.jpg">
      <img src="images/tea-factory.jpg" alt="Loolecondera Estate" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Loolecondera</div><div class="photo-label-sub">Birthplace of Ceylon Tea · 1867</div></div>
      <div class="photo-expand">⤢</div>
    </div>

  </div> 

 

  <!-- GARDEN & POOL --> 

  <div class="cat-label" data-category="garden"> 

    <div class="cat-rule"></div> 

    <div class="cat-text">Garden &amp; Pool</div> 

    <div class="cat-rule"></div> 

  </div> 

  <div class="photo-grid">

    <div class="photo-tile span-8 h-xl" data-category="garden" data-title="The Private Pool" data-sub="Estate planting · Stone-edged · Tea-border garden" data-img="images/swimming-pool-resort.jpg">
      <img src="images/swimming-pool-resort.jpg" alt="The Private Pool" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">The Private Pool</div><div class="photo-label-sub">Stone-edged · Tea-border planting · All guests</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="garden" data-title="Garden at Dusk" data-sub="Lantern lighting · Evening atmosphere" data-img="images/garden.webp">
      <img src="images/garden.webp" alt="Garden at Dusk" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Garden at Dusk</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="garden" data-title="Sunset Sundowner" data-sub="Garden drinks · Mist settling over tea fields" data-img="images/hero-img2.jpg">
      <img src="images/hero-img2.jpg" alt="Sunset Sundowner" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Sunset Sundowner</div></div>
      <div class="photo-expand">⤢</div>
    </div>

    <div class="photo-tile span-4 h-sm" data-category="garden" data-title="Tea Estate Walk" data-sub="Guided · Galaha Estate · Morning light" data-img="images/tea-estate.jpg">
      <img src="images/tea-estate.jpg" alt="Tea Estate Walk" class="photo-tile-img">
      <div class="photo-overlay"></div>
      <div class="photo-label"><div class="photo-label-text">Tea Estate Walk</div></div> 

      <div class="photo-expand">⤢</div> 

    </div> 

    <div class="photo-tile span-4 h-sm" data-category="garden" data-title="Morning Pool" data-sub="Founder's Suite verandah · Dawn light" data-img="images/swimming-pool-resort.jpg">
       

      <div class="photo-bg ph-pool" style="background-image: url('images/swimming-pool-resort.jpg');"></div> 

      <div class="photo-ph"><div class="photo-ph-icon">🏊</div><div class="photo-ph-text">Morning pool</div></div> 

      <div class="photo-overlay"></div> 

      <div class="photo-label"><div class="photo-label-text">Morning Pool</div></div> 

      <div class="photo-expand">⤢</div> 

    </div> 

  </div> 

 

</div><!-- /gallery-section --> 

 

<!-- LIGHTBOX --> 

<div class="lightbox" id="lightbox"> 

  <div class="lb-inner"> 

    <button class="lb-close" id="lb-close">✕</button> 

    <button class="lb-prev" id="lb-prev">‹</button> 

    <button class="lb-next" id="lb-next">›</button> 

    <div class="lb-visual"> 

      <div class="lb-bg" id="lb-bg"></div> 

      <div class="lb-ph"> 

        <div class="lb-ph-icon" id="lb-icon">🏛️</div> 

        <div class="lb-ph-txt"></div> 

      </div> 

    </div> 

    <div class="lb-info"> 

      <div class="lb-title" id="lb-title">Photo Title</div> 

      <div class="lb-sub" id="lb-sub">Photo detail</div> 

    </div> 

    <div class="lb-counter" id="lb-counter">1 / 30</div> 

  </div> 

</div> 

 

<!-- PHOTO CTA --> 

<div class="photo-cta-strip reveal"> 

  <div class="pcs-left"> 

    <div class="pcs-eyebrow">See It In Person</div> 

    <div class="pcs-title">Every photograph is a placeholder<br>until you arrive.</div> 

    <p class="pcs-body">No photograph captures the mist at first light, or the fire against the dark outside the lounge windows. Enquire about a stay and see it yourself.</p> 

  </div> 

  <div class="pcs-btns"> 

    <a href="/vD/our-chambers.php" class="btn-gold">Browse Chambers</a> 

    <a href="/vD/packages.php" class="btn-outline">View Packages</a> 

  </div> 

</div> 

 

<!-- INSTAGRAM --> 

<div class="instagram-strip"> 

  <div class="ig-header reveal"> 

    <div class="ig-eyebrow">Follow the Estate</div> 

    <div class="ig-title">On Instagram</div> 

    <div class="ig-handle">@theteabungalow</div> 

  </div> 

  <div class="ig-grid reveal"> 

    <div class="ig-tile"><div class="ig-tile-bg ig-t1"></div><div class="ig-tile-overlay"><div class="ig-icon">📷</div></div></div> 

    <div class="ig-tile"><div class="ig-tile-bg ig-t2"></div><div class="ig-tile-overlay"><div class="ig-icon">📷</div></div></div> 

    <div class="ig-tile"><div class="ig-tile-bg ig-t3"></div><div class="ig-tile-overlay"><div class="ig-icon">📷</div></div></div> 

    <div class="ig-tile"><div class="ig-tile-bg ig-t4"></div><div class="ig-tile-overlay"><div class="ig-icon">📷</div></div></div> 

    <div class="ig-tile"><div class="ig-tile-bg ig-t5"></div><div class="ig-tile-overlay"><div class="ig-icon">📷</div></div></div> 

    <div class="ig-tile"><div class="ig-tile-bg ig-t6"></div><div class="ig-tile-overlay"><div class="ig-icon">📷</div></div></div> 

  </div> 

  <div class="ig-cta reveal"><a href="/vD/gallery.php" class="ig-follow">Explore the full gallery →</a></div> 

</div> 

 

<!-- FOOTER --> 

<?php include 'layout/footer.php'; ?> 

 

<script> 

// Nav 

const nav = document.getElementById('nav'); 

window.addEventListener('scroll', () => { nav.classList.toggle('scrolled', window.scrollY > 60); }); 

 

// Reveal 

const reveals = document.querySelectorAll('.reveal,.cat-label,.photo-tile'); 

const obs = new IntersectionObserver(entries => { 

  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } }); 

}, { threshold: 0.06 }); 

reveals.forEach(el => obs.observe(el)); 

 

// Filter 

const chips = document.querySelectorAll('.f-chip'); 

chips.forEach(chip => { 

  chip.addEventListener('click', () => { 

    chips.forEach(c => c.classList.remove('active')); 

    chip.classList.add('active'); 

    const f = chip.dataset.filter; 

    document.querySelectorAll('.photo-tile').forEach(t => { 

      t.style.display = (f === 'all' || t.dataset.category === f) ? '' : 'none'; 

    }); 

    document.querySelectorAll('.cat-label').forEach(l => { 

      l.style.display = (f === 'all' || l.dataset.category === f) ? '' : 'none'; 

    }); 

  }); 

}); 

 

// Lightbox 

const lightbox = document.getElementById('lightbox'); 

const lbBg = document.getElementById('lb-bg'); 

const lbIcon = document.getElementById('lb-icon'); 

const lbTitle = document.getElementById('lb-title'); 

const lbSub = document.getElementById('lb-sub'); 

const lbCounter = document.getElementById('lb-counter'); 

let tiles = []; 

let current = 0; 

 

function openLb(idx) { 

  current = idx; 

  const t = tiles[idx]; 

  const bg = t.querySelector('.photo-bg'); 

  const ph = t.querySelector('.photo-ph-icon'); 

  if (t.dataset.img) {
    lbBg.style.backgroundImage = "url('" + t.dataset.img + "')";
    lbBg.style.backgroundSize = "contain";
    lbBg.style.backgroundPosition = "center";
    lbBg.style.backgroundRepeat = "no-repeat";
  } else {
    lbBg.style.background = bg ? getComputedStyle(bg).background : '#1a3d22';
  } 

  lbIcon.textContent = ph ? ph.textContent : '🏛️'; 

  lbTitle.textContent = t.dataset.title || ''; 

  lbSub.textContent = t.dataset.sub || ''; 

  lbCounter.textContent = (idx + 1) + ' / ' + tiles.length; 

  lightbox.classList.add('open'); 

  document.body.style.overflow = 'hidden'; 

} 

 

function closeLb() { 

  lightbox.classList.remove('open'); 

  document.body.style.overflow = ''; 

} 

 

document.querySelectorAll('.photo-tile').forEach((t, i) => { 

  tiles.push(t); 

  t.addEventListener('click', () => { 

    tiles = Array.from(document.querySelectorAll('.photo-tile:not([style*="none"])')); 

    const vis = tiles.indexOf(t); 

    openLb(vis >= 0 ? vis : 0); 

  }); 

}); 

 

document.getElementById('lb-close').addEventListener('click', closeLb); 

document.getElementById('lb-prev').addEventListener('click', () => { current = (current - 1 + tiles.length) % tiles.length; openLb(current); }); 

document.getElementById('lb-next').addEventListener('click', () => { current = (current + 1) % tiles.length; openLb(current); }); 

lightbox.addEventListener('click', e => { if (e.target === lightbox) closeLb(); }); 

document.addEventListener('keydown', e => { 

  if (!lightbox.classList.contains('open')) return; 

  if (e.key === 'Escape') closeLb(); 

  if (e.key === 'ArrowLeft') { current = (current - 1 + tiles.length) % tiles.length; openLb(current); } 

  if (e.key === 'ArrowRight') { current = (current + 1) % tiles.length; openLb(current); } 

}); 

</script> 

</body> 

</html> 