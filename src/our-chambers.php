<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Chambers · The Tea Bungalow · Galaha Estate</title>

<link rel="icon" type="image/png" href="images/favicon.png">
<meta property="og:type" content="website">
<meta property="og:title" content="Our Chambers · Rooms & Suites · The Tea Bungalow">
<meta property="og:description" content="Five unique chambers inside the colonial bungalow at Galaha Estate — each with estate views, heritage furnishings, and colonial character.">
<meta property="og:url" content="https://www.theteabungalow.com/our-chambers">
<meta property="og:image" content="https://www.theteabungalow.com/images/838733193.jpg">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Our Chambers · Rooms & Suites · The Tea Bungalow">
<meta name="twitter:description" content="Five unique chambers inside the colonial bungalow at Galaha Estate — each with estate views, heritage furnishings, and colonial character.">
<link rel="canonical" href="https://www.theteabungalow.com/our-chambers">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">
  <style>
    /* ══════════════════════════════════════════════
   ROOT & RESET
══════════════════════════════════════════════ */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      scroll-behavior: smooth;
    }

    :root {
      --green: #1E4D2B;
      --green-mid: #2a6638;
      --green-pale: #c8dece;
      --green-ghost: #eaf2ec;
      --gold: #C7A85E;
      --gold-light: #dfc080;
      --gold-pale: #f5edd4;
      --cream: #F5F1E9;
      --cream-dark: #ede7db;
      --ink: #1a1510;
      --ink-mid: #3d3428;
      --ink-light: #7a6e60;
      --mist: #8a9e8f;
      --white: #ffffff;
      --shadow: rgba(30, 77, 43, 0.13);
    }

    body {
      background: var(--cream);
      font-family: 'EB Garamond', Georgia, serif;
      color: var(--ink);
      overflow-x: hidden;
    }

    body::after {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 9999;
    }

    /* ══════════════════════════════════════════════
   NAV
══════════════════════════════════════════════ */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 200;
      height: 72px;
      padding: 0 48px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: background 0.4s, box-shadow 0.4s;
    }

    nav.scrolled {
      background: rgba(245, 241, 233, 0.96);
      backdrop-filter: blur(12px);
      box-shadow: 0 1px 0 rgba(30, 77, 43, 0.1);
    }

    .nav-logo {
      font-family: 'Cinzel', serif;
      font-size: 15px;
      font-weight: 600;
      letter-spacing: 0.12em;
      color: var(--white);
      text-decoration: none;
      transition: color 0.3s;
    }

    nav.scrolled .nav-logo {
      color: var(--green);
    }

    .nav-links {
      display: flex;
      gap: 32px;
      list-style: none;
    }

    .nav-links a {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: color 0.25s;
    }

    nav.scrolled .nav-links a {
      color: var(--ink-mid);
    }

    .nav-links a:hover {
      color: var(--gold);
    }

    nav.scrolled .nav-links a:hover {
      color: var(--green);
    }

    .nav-links .active {
      color: var(--gold) !important;
    }

    .nav-cta {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--white);
      background: var(--green);
      border: 1px solid var(--green);
      padding: 9px 20px;
      text-decoration: none;
      transition: background 0.25s, border-color 0.25s;
    }

    .nav-cta:hover {
      background: var(--gold);
      border-color: var(--gold);
    }

    /* ══════════════════════════════════════════════
   HERO — horizontal strip with floating room count
══════════════════════════════════════════════ */
    .page-hero {
      min-height: 100vh;
      display: grid;
      grid-template-rows: 1fr auto;
      position: relative;
      overflow: hidden;
      background:
        linear-gradient(180deg,
          rgba(10, 25, 14, 0.08) 0%,
          rgba(10, 25, 14, 0.0) 25%,
          rgba(10, 25, 14, 0.55) 70%,
          rgba(10, 25, 14, 0.92) 100%),
        radial-gradient(ellipse 130% 90% at 55% 45%, #2a6040 0%, #1a4028 45%, #0a1e10 100%);
    }

    .hero-texture {
      position: absolute;
      inset: 0;
      pointer-events: none;
      background-image: repeating-linear-gradient(168deg,
          transparent 0, transparent 28px,
          rgba(255, 255, 255, 0.022) 28px, rgba(255, 255, 255, 0.022) 29px);
    }

    /* Floating chamber thumbnails row */
    .hero-thumbs {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      height: 30vh;
      min-height: 180px;
      gap: 2px;
      position: relative;
      z-index: 2;
      opacity: 0;
      animation: fadeIn 1s 0.2s ease forwards;
    }

    .hero-thumb {
      position: relative;
      overflow: hidden;
      cursor: pointer;
    }

    .hero-thumb-bg {
      position: absolute;
      inset: 0;
      transition: transform 0.6s ease, filter 0.4s ease;
      filter: brightness(0.6);
    }

    .hero-thumb:hover .hero-thumb-bg {
      transform: scale(1.08);
      filter: brightness(0.85);
    }

    .th-01 {
      background: url('images/838733193.jpg') center/cover no-repeat;
    }

    .th-02 {
      background: url('images/838733260.jpg') center/cover no-repeat;
    }

    .th-03 {
      background: url('images/838733265.jpg') center/cover no-repeat;
    }

    .th-04 {
      background: url('images/838733269.jpg') center/cover no-repeat;
    }

    .th-05 {
      background: url('images/838733276.jpg') center/cover no-repeat;
    }

    .th-06 {
      background: url('images/IMG_7653.jpeg') center/cover no-repeat;
    }

    .th-07 {
      background: url('images/IMG_7654.jpeg') center/cover no-repeat;
    }

    .hero-thumb-label {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 24px 8px 12px;
      background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.4) 60%, transparent 100%);
      font-family: 'Cinzel', serif;
      font-size: 9.5px;
      letter-spacing: 0.22em;
      color: rgba(255, 255, 255, 0.9);
      text-transform: uppercase;
      text-align: center;
      transform: translateY(2px);
      transition: transform 0.3s, color 0.3s;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
    }

    .hero-thumb:hover .hero-thumb-label {
      transform: translateY(0);
      color: var(--gold);
    }

    .hero-thumb-num {
      position: absolute;
      top: 10px;
      left: 12px;
      font-family: 'Cinzel', serif;
      font-size: 11px;
      color: rgba(255, 255, 255, 0.7);
      letter-spacing: 0.1em;
      text-shadow: 0 1px 4px rgba(0, 0, 0, 0.9);
    }

    /* Hero main content */
    .hero-content {
      position: relative;
      z-index: 2;
      padding: 0 10vw 72px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      min-height: 70vh;
    }

    .hero-breadcrumb {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.4em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 22px;
      opacity: 0;
      animation: fadeUp 0.8s 0.3s ease forwards;
    }

    .hero-breadcrumb a {
      color: rgba(199, 168, 94, 0.55);
      text-decoration: none;
    }

    .hero-breadcrumb a:hover {
      color: var(--gold);
    }

    .hero-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(48px, 7.5vw, 96px);
      font-weight: 700;
      color: var(--white);
      line-height: 0.95;
      letter-spacing: 0.01em;
      margin-bottom: 10px;
      opacity: 0;
      animation: fadeUp 0.9s 0.5s ease forwards;
    }

    .hero-title em {
      font-style: normal;
      color: var(--gold-light);
      display: block;
    }

    .hero-rule {
      width: 56px;
      height: 1px;
      background: var(--gold);
      margin: 28px 0;
      opacity: 0;
      animation: fadeUp 0.8s 0.7s ease forwards;
    }

    .hero-sub {
      font-size: clamp(17px, 1.8vw, 22px);
      font-style: italic;
      color: rgba(255, 255, 255, 0.7);
      line-height: 1.6;
      max-width: 560px;
      opacity: 0;
      animation: fadeUp 0.8s 0.85s ease forwards;
    }

    /* Chamber count pill */
    .hero-count {
      position: absolute;
      top: 100px;
      right: 10vw;
      opacity: 0;
      animation: fadeUp 0.8s 1s ease forwards;
      text-align: center;
    }

    .count-circle {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      border: 1px solid rgba(199, 168, 94, 0.45);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .count-num {
      font-family: 'Cinzel', serif;
      font-size: 30px;
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
    }

    .count-label {
      font-family: 'Cinzel', serif;
      font-size: 8px;
      letter-spacing: 0.2em;
      color: rgba(255, 255, 255, 0.45);
      text-transform: uppercase;
      margin-top: 4px;
    }

    /* ══════════════════════════════════════════════
   FILTER / SORT BAR
══════════════════════════════════════════════ */
    .filter-bar {
      background: var(--green);
      border-bottom: 2px solid var(--gold);
      padding: 0 10vw;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
      flex-wrap: wrap;
      min-height: 64px;
      position: sticky;
      top: 72px;
      z-index: 100;
    }

    .filter-label {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.35em;
      color: var(--gold);
      text-transform: uppercase;
      flex-shrink: 0;
    }

    .filter-chips {
      display: flex;
      gap: 2px;
      flex-wrap: wrap;
    }

    .filter-chip {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.55);
      padding: 10px 18px;
      cursor: pointer;
      border: none;
      background: transparent;
      transition: color 0.2s, background 0.2s;
      white-space: nowrap;
    }

    .filter-chip:hover {
      color: var(--gold);
      background: rgba(255, 255, 255, 0.05);
    }

    .filter-chip.active {
      color: var(--gold);
      background: rgba(199, 168, 94, 0.12);
    }

    .filter-cta {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      color: var(--gold);
      padding: 10px 20px;
      border: 1px solid rgba(199, 168, 94, 0.4);
      text-decoration: none;
      white-space: nowrap;
      transition: background 0.2s, color 0.2s;
    }

    .filter-cta:hover {
      background: var(--gold);
      color: var(--ink);
    }

    /* ══════════════════════════════════════════════
   CHAMBERS INTRO
══════════════════════════════════════════════ */
    .chambers-intro {
      max-width: 820px;
      margin: 80px auto;
      padding: 0 10vw;
      text-align: center;
    }

    .intro-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 16px;
    }

    .intro-heading {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 3.5vw, 44px);
      font-weight: 600;
      color: var(--green);
      line-height: 1.1;
      margin-bottom: 20px;
    }

    .intro-body {
      font-size: 17.5px;
      font-style: normal;
      color: var(--ink-mid);
      line-height: 1.75;
    }

    /* ══════════════════════════════════════════════
   CHAMBER CARDS — large immersive format
══════════════════════════════════════════════ */
    .chambers-list {
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    /* Each chamber = full-width two-panel layout */
    .chamber {
      display: grid;
      grid-template-columns: 1fr 1fr;
      min-height: 560px;
      opacity: 0;
      transform: translateY(32px);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .chamber.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .chamber:nth-child(even) {
      direction: rtl;
    }

    .chamber:nth-child(even)>* {
      direction: ltr;
    }

    /* Visual side */
    .ch-visual {
      position: relative;
      overflow: hidden;
      min-height: 420px;
    }

    .ch-img {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .chamber:hover .ch-img {
      transform: scale(1.04);
    }

    /* Room colour gradients — swap for real images */
    .c-founders {
      background: url('images/838733193.jpg') center/cover no-repeat;
    }

    .c-highlands {
      background: url('images/838733260.jpg') center/cover no-repeat;
    }

    .c-pekoe {
      background: url('images/838733265.jpg') center/cover no-repeat;
    }

    .c-verandah {
      background: url('images/838733269.jpg') center/cover no-repeat;
    }

    .c-camellia {
      background: url('images/838733276.jpg') center/cover no-repeat;
    }

    .c-galaha {
      background: url('images/IMG_7653.jpeg') center/cover no-repeat;
    }

    .c-cottage {
      background: url('images/IMG_7654.jpeg') center/cover no-repeat;
    }

    /* Visual overlays & details */
    .ch-img-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to right, rgba(0, 0, 0, 0.1), transparent 50%, rgba(0, 0, 0, 0.05));
    }

    .chamber:nth-child(even) .ch-img-overlay {
      background: linear-gradient(to left, rgba(0, 0, 0, 0.1), transparent 50%, rgba(0, 0, 0, 0.05));
    }

    /* Photo placeholder */
    .ch-ph {
      display: none !important;
    }

    .ch-ph-icon {
      font-size: 40px;
      opacity: 0.22;
    }

    .ch-ph-text {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.3em;
      color: rgba(255, 255, 255, 0.2);
      text-transform: uppercase;
      text-align: center;
      line-height: 1.8;
    }

    /* Room number watermark */
    .ch-num {
      position: absolute;
      bottom: 16px;
      right: 20px;
      font-family: 'Cinzel', serif;
      font-size: 96px;
      font-weight: 700;
      color: rgba(255, 255, 255, 0.06);
      line-height: 1;
      pointer-events: none;
      letter-spacing: 0.05em;
    }

    /* Badge strip on visual */
    .ch-badges {
      position: absolute;
      top: 24px;
      left: 24px;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .chamber:nth-child(even) .ch-badges {
      left: auto;
      right: 24px;
      align-items: flex-end;
    }

    .ch-badge {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      padding: 5px 12px;
      backdrop-filter: blur(6px);
      white-space: nowrap;
    }

    .ch-badge-gold {
      background: rgba(199, 168, 94, 0.85);
      color: var(--ink);
    }

    .ch-badge-green {
      background: rgba(30, 77, 43, 0.85);
      color: var(--white);
    }

    .ch-badge-cream {
      background: rgba(245, 241, 233, 0.85);
      color: var(--green);
    }

    .ch-badge-dark {
      background: rgba(26, 21, 16, 0.85);
      color: var(--gold);
    }

    /* Info side */
    .ch-info {
      padding: 56px 52px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: var(--white);
      position: relative;
    }

    .chamber:nth-child(even) .ch-info {
      background: var(--cream);
    }

    .chamber:last-child .ch-info {
      background: var(--green);
    }

    /* Top accent line */
    .ch-info::before {
      content: '';
      position: absolute;
      top: 0;
      left: 52px;
      right: 52px;
      height: 2px;
      background: linear-gradient(90deg, var(--gold), transparent);
    }

    .chamber:nth-child(even) .ch-info::before {
      background: linear-gradient(270deg, var(--gold), transparent);
    }

    .ch-tag {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.42em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 14px;
    }

    .chamber:last-child .ch-tag {
      color: var(--gold-light);
    }

    .ch-name {
      font-family: 'Cinzel', serif;
      font-size: clamp(24px, 2.8vw, 36px);
      font-weight: 700;
      color: var(--green);
      line-height: 1.05;
      margin-bottom: 20px;
      letter-spacing: 0.02em;
    }

    .chamber:last-child .ch-name {
      color: var(--white);
    }

    .ch-desc {
      font-size: 16.5px;
      font-style: italic;
      color: var(--ink-light);
      line-height: 1.75;
      margin-bottom: 28px;
    }

    .chamber:last-child .ch-desc {
      color: rgba(255, 255, 255, 0.65);
    }

    /* Features list */
    .ch-features {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 32px;
    }

    .ch-feat {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      font-size: 14px;
      color: var(--ink-mid);
      line-height: 1.5;
    }

    .chamber:last-child .ch-feat {
      color: rgba(255, 255, 255, 0.65);
    }

    .ch-feat-icon {
      width: 28px;
      height: 28px;
      border-radius: 2px;
      background: var(--green-ghost);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      flex-shrink: 0;
    }

    .chamber:last-child .ch-feat-icon {
      background: rgba(255, 255, 255, 0.1);
    }

    /* Capacity + rate row */
    .ch-meta {
      display: flex;
      gap: 0;
      margin-bottom: 28px;
      border-top: 1px solid var(--green-pale);
      border-bottom: 1px solid var(--green-pale);
    }

    .chamber:nth-child(even) .ch-meta,
    .chamber:last-child .ch-meta {
      border-color: rgba(199, 168, 94, 0.2);
    }

    .ch-meta-item {
      flex: 1;
      padding: 14px 0;
      border-right: 1px solid var(--green-pale);
      text-align: center;
    }

    .chamber:nth-child(even) .ch-meta-item,
    .chamber:last-child .ch-meta-item {
      border-color: rgba(199, 168, 94, 0.2);
    }

    .ch-meta-item:last-child {
      border-right: none;
    }

    .ch-meta-val {
      font-family: 'Cinzel', serif;
      font-size: 15px;
      font-weight: 600;
      color: var(--green);
      line-height: 1;
      margin-bottom: 4px;
    }

    .chamber:last-child .ch-meta-val {
      color: var(--gold);
    }

    .ch-meta-key {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.25em;
      color: var(--mist);
      text-transform: uppercase;
    }

    /* CTA row */
    .ch-cta-row {
      display: flex;
      gap: 12px;
      align-items: center;
      flex-wrap: wrap;
    }

    .btn-enquire {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      background: var(--green);
      color: var(--white);
      padding: 14px 28px;
      text-decoration: none;
      border: 1px solid var(--green);
      transition: background 0.25s, color 0.25s, transform 0.2s;
      display: inline-block;
    }

    .btn-enquire:hover {
      background: var(--gold);
      border-color: var(--gold);
      color: var(--ink);
      transform: translateY(-2px);
    }

    .chamber:last-child .btn-enquire {
      background: var(--gold);
      color: var(--ink);
      border-color: var(--gold);
    }

    .chamber:last-child .btn-enquire:hover {
      background: var(--white);
      border-color: var(--white);
    }

    .btn-ghost {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      background: transparent;
      color: var(--green);
      padding: 14px 24px;
      text-decoration: none;
      border: 1px solid var(--green-pale);
      transition: border-color 0.25s, color 0.25s;
      display: inline-block;
    }

    .btn-ghost:hover {
      border-color: var(--green);
      color: var(--green);
    }

    .chamber:last-child .btn-ghost {
      color: rgba(255, 255, 255, 0.6);
      border-color: rgba(255, 255, 255, 0.2);
    }

    .chamber:last-child .btn-ghost:hover {
      border-color: var(--gold);
      color: var(--gold);
    }

    /* ══════════════════════════════════════════════
   FAMILY WING CALLOUT
══════════════════════════════════════════════ */
    .family-callout {
      background: var(--gold-pale);
      border: 1px solid rgba(199, 168, 94, 0.35);
      margin: 0;
      padding: 48px 10vw;
      display: flex;
      align-items: center;
      gap: 40px;
      flex-wrap: wrap;
    }

    .family-callout-icon {
      font-size: 40px;
      flex-shrink: 0;
    }

    .family-callout-body {
      flex: 1;
    }

    .family-callout-title {
      font-family: 'Cinzel', serif;
      font-size: 18px;
      font-weight: 600;
      color: var(--green);
      margin-bottom: 8px;
      letter-spacing: 0.04em;
    }

    .family-callout-text {
      font-size: 16px;
      font-style: italic;
      color: var(--ink-light);
      line-height: 1.65;
      max-width: 620px;
    }

    .family-callout-text strong {
      color: var(--green);
      font-style: normal;
    }

    .family-callout-cta {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--green);
      border: 1px solid rgba(30, 77, 43, 0.35);
      padding: 14px 28px;
      text-decoration: none;
      white-space: nowrap;
      transition: background 0.25s, color 0.25s;
    }

    .family-callout-cta:hover {
      background: var(--green);
      color: var(--white);
    }

    /* ══════════════════════════════════════════════
   COMPARISON TABLE
══════════════════════════════════════════════ */
    .comparison-section {
      padding: 96px 10vw;
      background: var(--cream-dark);
    }

    .comp-header {
      text-align: center;
      margin-bottom: 56px;
    }

    .comp-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 14px;
    }

    .comp-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(26px, 3vw, 38px);
      font-weight: 600;
      color: var(--green);
      margin-bottom: 12px;
    }

    .comp-sub {
      font-size: 17px;
      font-style: italic;
      color: var(--ink-light);
    }

    .comp-table-wrap {
      overflow-x: auto;
    }

    .comp-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
      min-width: 860px;
    }

    .comp-table th {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      padding: 16px 20px;
      background: var(--green);
      color: var(--white);
      text-align: center;
      white-space: nowrap;
      border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .comp-table th:first-child {
      text-align: left;
      background: var(--ink);
    }

    .comp-table th:last-child {
      border-right: none;
    }

    .comp-table tr:nth-child(even) td {
      background: rgba(30, 77, 43, 0.03);
    }

    .comp-table td {
      padding: 14px 20px;
      border-bottom: 1px solid var(--green-pale);
      border-right: 1px solid var(--green-pale);
      vertical-align: middle;
      color: var(--ink-mid);
      text-align: center;
    }

    .comp-table td:first-child {
      text-align: left;
      font-weight: 600;
      color: var(--green);
      font-family: 'Cinzel', serif;
      font-size: 12px;
      letter-spacing: 0.06em;
      white-space: nowrap;
    }

    .comp-table td:last-child {
      border-right: none;
    }

    .tick {
      color: var(--green);
      font-size: 15px;
    }

    .dot {
      color: var(--mist);
      font-size: 10px;
    }

    .highlight-col {
      background: rgba(199, 168, 94, 0.07) !important;
    }

    .comp-table .room-col-name {
      font-family: 'EB Garamond', serif;
      font-size: 13px;
      font-style: italic;
      color: var(--ink-light);
      font-weight: 400;
      letter-spacing: 0;
    }

    /* ══════════════════════════════════════════════
   ESTATE BUYOUT STRIP
══════════════════════════════════════════════ */
    .buyout-strip {
      background: var(--ink);
      padding: 72px 10vw;
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 48px;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    .buyout-strip::before {
      content: 'YOURS';
      position: absolute;
      right: 8vw;
      top: 50%;
      transform: translateY(-50%);
      font-family: 'Cinzel', serif;
      font-size: 160px;
      font-weight: 700;
      color: rgba(255, 255, 255, 0.025);
      letter-spacing: 0.15em;
      pointer-events: none;
      white-space: nowrap;
    }

    .buyout-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 14px;
    }

    .buyout-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(26px, 3vw, 40px);
      font-weight: 600;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 16px;
    }

    .buyout-body {
      font-size: 17px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.6);
      line-height: 1.7;
      max-width: 580px;
    }

    .btn-gold {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      background: var(--gold);
      color: var(--ink);
      padding: 18px 36px;
      text-decoration: none;
      border: 1px solid var(--gold);
      display: inline-block;
      white-space: nowrap;
      transition: background 0.25s, color 0.25s, transform 0.2s;
    }

    .btn-gold:hover {
      background: var(--white);
      color: var(--green);
      transform: translateY(-2px);
    }

    /* ══════════════════════════════════════════════
   ACCESSIBILITY CALLOUT
══════════════════════════════════════════════ */
    .access-strip {
      background: var(--green-ghost);
      border-top: 1px solid var(--green-pale);
      border-bottom: 1px solid var(--green-pale);
      padding: 40px 10vw;
      display: flex;
      align-items: center;
      gap: 32px;
      flex-wrap: wrap;
    }

    .access-icon {
      font-size: 32px;
      flex-shrink: 0;
    }

    .access-body {
      flex: 1;
    }

    .access-title {
      font-family: 'Cinzel', serif;
      font-size: 14px;
      font-weight: 600;
      color: var(--green);
      margin-bottom: 6px;
      letter-spacing: 0.06em;
    }

    .access-text {
      font-size: 15px;
      color: var(--ink-light);
      font-style: italic;
      line-height: 1.6;
    }

    .access-text strong {
      color: var(--green);
      font-style: normal;
    }

    /* ══════════════════════════════════════════════
   ENQUIRE SECTION
══════════════════════════════════════════════ */
    .enquire-section {
      padding: 96px 10vw;
      background: var(--cream);
      text-align: center;
    }

    .enq-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 16px;
    }

    .enq-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 3.5vw, 44px);
      font-weight: 600;
      color: var(--green);
      margin-bottom: 20px;
      line-height: 1.1;
    }

    .enq-body {
      font-size: 18px;
      font-style: italic;
      color: var(--ink-light);
      max-width: 520px;
      margin: 0 auto 44px;
      line-height: 1.7;
    }

    .enq-btns {
      display: flex;
      gap: 14px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .enq-note {
      margin-top: 28px;
      font-size: 14px;
      font-style: italic;
      color: var(--mist);
    }

   /* ═══════════════════════════════════════════════════════════════
   FOOTER
═══════════════════════════════════════════════════════════════ */
footer {
  background: var(--ink);
  padding: 72px 10vw 40px;
}
.footer-top {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr 1fr;
  gap: 48px;
  padding-bottom: 56px;
  border-bottom: 1px solid rgba(255,255,255,0.08);
  margin-bottom: 32px;
}
.footer-brand {}
.footer-logo {
  font-family: 'Cinzel', serif;
  font-size: 18px;
  font-weight: 600;
  color: var(--white);
  letter-spacing: 0.08em;
  margin-bottom: 8px;
}
.footer-tagline {
  font-size: 14px;
  font-style: italic;
  color: rgba(255,255,255,0.4);
  line-height: 1.5;
  margin-bottom: 20px;
}
.footer-contact-item {
  font-size: 13.5px;
  color: rgba(255,255,255,0.55);
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.footer-contact-item a { color: var(--gold); text-decoration: none; }

.footer-col-title {
  font-family: 'Cinzel', serif;
  font-size: 10px;
  letter-spacing: 0.35em;
  color: var(--gold);
  text-transform: uppercase;
  margin-bottom: 20px;
}
.footer-links { list-style: none; display: flex; flex-direction: column; gap: 10px; }
.footer-links a {
  font-size: 14px;
  color: rgba(255,255,255,0.5);
  text-decoration: none;
  transition: color 0.2s;
}
.footer-links a:hover { color: var(--white); }

.footer-bottom {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 16px;
}
.footer-copy {
  font-size: 12px;
  color: rgba(255,255,255,0.25);
  font-style: italic;
}
.footer-collection {
  font-family: 'Cinzel', serif;
  font-size: 10px;
  letter-spacing: 0.3em;
  color: var(--gold);
  text-transform: uppercase;
  opacity: 0.6;
}

    /* ═══════════════════════════════════════════════════════════════
   WHATSAPP FLOATING BUTTON
═══════════════════════════════════════════════════════════════ */
    .whatsapp-float {
      position: fixed;
      bottom: 24px;
      right: 20px;
      z-index: 9999;
      display: flex;
      align-items: center;
      gap: 10px;
      background: #3d8050;
      color: white;
      text-decoration: none;
      border-radius: 50px;
      padding: 13px 20px 13px 16px;
      box-shadow: 0 4px 20px rgba(37, 211, 102, 0.45);
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      font-weight: 600;
      letter-spacing: 0.01em;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      animation: wa-pulse 2.8s ease-in-out 1.5s 3;
    }

    .whatsapp-float:hover {
      transform: translateY(-3px) scale(1.03);
      box-shadow: 0 8px 28px rgba(37, 211, 102, 0.55);
    }

    .whatsapp-float:active {
      transform: scale(0.97);
    }

    .whatsapp-label {
      white-space: nowrap;
    }

    @keyframes wa-pulse {
      0% {
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.45);
      }

      50% {
        box-shadow: 0 4px 32px rgba(37, 211, 102, 0.75), 0 0 0 8px rgba(37, 211, 102, 0.12);
      }

      100% {
        box-shadow: 0 4px 20px rgba(37, 211, 102, 0.45);
      }
    }

    /* On very small screens, collapse to icon-only circle */
    @media (max-width: 360px) {
      .whatsapp-float {
        padding: 14px;
        border-radius: 50%;
      }

      .whatsapp-label {
        display: none;
      }
    }

    /* ══════════════════════════════════════════════
   ANIMATIONS
══════════════════════════════════════════════ */
    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    /* ══════════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════════ */
    @media (max-width: 1100px) {

      .chamber,
      .chamber:nth-child(even) {
        grid-template-columns: 1fr;
        direction: ltr;
      }

      .ch-visual {
        min-height: 320px;
      }

      .hero-thumbs {
        grid-template-columns: repeat(4, 1fr);
      }

      .footer-top {
        grid-template-columns: 1fr 1fr;
      }

      .buyout-strip {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 768px) {
      nav {
        padding: 0 24px;
      }

      .nav-links {
        display: none;
      }

      .hero-thumbs {
        grid-template-columns: repeat(4, 1fr);
        height: 20vh;
      }

      .hero-title {
        font-size: clamp(40px, 10vw, 64px);
      }

      .filter-bar {
        gap: 16px;
        padding: 12px 6vw;
      }

      .ch-info {
        padding: 40px 28px;
      }

      .comp-table {
        font-size: 12px;
      }

      .footer-top {
        grid-template-columns: 1fr;
      }

      .access-strip {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>

<body>

  <!-- ═══ NAV ═══ -->
  <?php include 'layout/navbar.php'; ?>

  <!-- ═══ HERO ═══ -->
  <section class="page-hero">
    <div class="hero-texture"></div>

    <div class="hero-count">
      <div class="count-circle">
        <div class="count-num">7</div>
        <div class="count-label">Rooms</div>
      </div>
    </div>

    <div class="hero-content">
      <div class="hero-breadcrumb">
        <a href="/vD/home.php">Home</a> &nbsp;/&nbsp; Our Chambers
      </div>
      <h1 class="hero-title">Our<br><em>Chambers</em></h1>
      <div class="hero-rule"></div>
      <p class="hero-sub">Six individually named rooms and the Carriage House Cottage. Each with its own character. Book one for a quiet retreat — or reserve them all.</p>
    </div>

    <!-- Room thumbnail strip -->
    <div class="hero-thumbs">
      <div class="hero-thumb" onclick="document.getElementById('founders').scrollIntoView({behavior:'smooth'})">
        <div class="hero-thumb-bg th-01"></div>
        <div class="hero-thumb-num">01</div>
        <div class="hero-thumb-label">Founder's Suite</div>
      </div>
      <div class="hero-thumb" onclick="document.getElementById('highlands').scrollIntoView({behavior:'smooth'})">
        <div class="hero-thumb-bg th-02"></div>
        <div class="hero-thumb-num">02</div>
        <div class="hero-thumb-label">Highlands Suite</div>
      </div>
      <div class="hero-thumb" onclick="document.getElementById('pekoe').scrollIntoView({behavior:'smooth'})">
        <div class="hero-thumb-bg th-03"></div>
        <div class="hero-thumb-num">03</div>
        <div class="hero-thumb-label">Pekoe Room</div>
      </div>
      <div class="hero-thumb" onclick="document.getElementById('verandah').scrollIntoView({behavior:'smooth'})">
        <div class="hero-thumb-bg th-04"></div>
        <div class="hero-thumb-num">04</div>
        <div class="hero-thumb-label">Verandah Chamber</div>
      </div>
      <div class="hero-thumb" onclick="document.getElementById('camellia').scrollIntoView({behavior:'smooth'})">
        <div class="hero-thumb-bg th-05"></div>
        <div class="hero-thumb-num">05</div>
        <div class="hero-thumb-label">Camellia Room</div>
      </div>
      <div class="hero-thumb" onclick="document.getElementById('galaha').scrollIntoView({behavior:'smooth'})">
        <div class="hero-thumb-bg th-06"></div>
        <div class="hero-thumb-num">06</div>
        <div class="hero-thumb-label">Galaha Room</div>
      </div>
      <div class="hero-thumb" onclick="document.getElementById('cottage').scrollIntoView({behavior:'smooth'})">
        <div class="hero-thumb-bg th-07"></div>
        <div class="hero-thumb-num">CH</div>
        <div class="hero-thumb-label">The Cottage</div>
      </div>
    </div>
  </section>

  <!-- ═══ FILTER BAR ═══ -->
  <div class="filter-bar">
    <span class="filter-label">Filter by</span>
    <div class="filter-chips">
      <button class="filter-chip active" data-filter="all">All Rooms</button>
      <button class="filter-chip" data-filter="accessible">Accessible</button>
      <button class="filter-chip" data-filter="family">Family</button>
      <button class="filter-chip" data-filter="private">Private Cottage</button>
      <button class="filter-chip" data-filter="trail">Pekoe Trail</button>
    </div>
    <a href="#" class="filter-cta tb-reserve-trigger" data-source="chambers_filter_cta">Check Availability →</a>
  </div>

  <!-- ═══ INTRO ═══ -->
  <div class="chambers-intro reveal">
    <div class="intro-eyebrow">The Estate Chambers</div>
    <h2 class="intro-heading">Seven Rooms: Six in the House,<br>One Carriage House</h2>
    <p class="intro-body">Seven distinctive rooms across the estate — six individually named chambers in the main bungalow and the private Carriage House Cottage. Each has been named for the heritage of the estate — the tea, the land, and the planters who built this house. Book a single room for a personal retreat, or take the house entirely.</p>
  </div>

  <!-- ═══ CHAMBERS ═══ -->
  <div class="chambers-list">

    <!-- 01 FOUNDER'S SUITE -->
    <div class="chamber" id="founders">
      <div class="ch-visual">
        <div class="ch-img c-founders"></div>
        <div class="ch-img-overlay"></div>
        <div class="ch-badges">
          <div class="ch-badge ch-badge-gold">Most Distinguished</div>
          <div class="ch-badge ch-badge-green">Fully Accessible</div>
          <div class="ch-badge ch-badge-dark">Pool Access</div>
        </div>
        <div class="ch-num">01</div>
      </div>
      <div class="ch-info">
        <div class="ch-tag">Principal Chamber · Room 01</div>
        <h2 class="ch-name">The Founder's Suite</h2>
        <p class="ch-desc">The most distinguished room in the house. Generous in scale and privately positioned, the suite opens onto its own secluded verandah — the only room with direct access to The Private Pool. The verandah itself serves as a private tea terrace for breakfast, afternoon service, or candlelit suppers.</p>
        <div class="ch-features">
          <div class="ch-feat">
            <div class="ch-feat-icon">🌿</div>
            Private verandah opening onto the estate garden — tea service and private dining available
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">💧</div>
            Direct, exclusive access to The Private Pool from the suite verandah
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">♿</div>
            Fully step-free throughout — spacious circulation, wide doorways
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🔇</div>
            Most privately positioned room — separated from other chambers
          </div>
        </div>
        <div class="ch-meta">
          <div class="ch-meta-item">
            <div class="ch-meta-val">2 Guests</div>
            <div class="ch-meta-key">Capacity</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">King Bed</div>
            <div class="ch-meta-key">Bed Type</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">En-Suite</div>
            <div class="ch-meta-key">Bathroom</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">From $450</div>
            <div class="ch-meta-key">Per Night</div>
          </div>
        </div>
        <div class="ch-cta-row">
          <a href="#" class="btn-enquire tb-reserve-trigger" data-room="The Founder's Suite" data-source="chamber_cta">Check Availability &amp; Reserve</a>
        </div>
      </div>
    </div>

    <!-- 02 HIGHLANDS SUITE -->
    <div class="chamber" id="highlands">
      <div class="ch-visual">
        <div class="ch-img c-highlands"></div>
        <div class="ch-img-overlay"></div>
        <div class="ch-ph">
          <div class="ch-ph-icon">🏔️</div>
          <div class="ch-ph-text">Highlands Suite</div>
        </div>
        <div class="ch-badges">
          <div class="ch-badge ch-badge-green">Fully Accessible</div>
          <div class="ch-badge ch-badge-cream">Family Wing</div>
        </div>
        <div class="ch-num">02</div>
      </div>
      <div class="ch-info">
        <div class="ch-tag">Elevated Chamber · Room 02</div>
        <h2 class="ch-name">The Highlands Suite</h2>
        <p class="ch-desc">Elevated in character and calm in tone, the Highlands Suite reflects the cool upland climate of Galaha. Through its adjoining dressing room, it connects to the Pekoe Room — allowing the two to function as a private family wing for 6 to 8 guests when needed.</p>
        <div class="ch-features">
          <div class="ch-feat">
            <div class="ch-feat-icon">♿</div>
            Step-free access throughout — generous room proportions
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🚪</div>
            Internal dressing room connects directly to The Pekoe Room
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">👨‍👩‍👧‍👦</div>
            As a family wing with the Pekoe Room: comfortably fits 6–8 guests
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🌤️</div>
            Cool highland atmosphere — hill views and upland light
          </div>
        </div>
        <div class="ch-meta">
          <div class="ch-meta-item">
            <div class="ch-meta-val">2–3 Guests</div>
            <div class="ch-meta-key">Capacity</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">King Bed</div>
            <div class="ch-meta-key">Bed Type</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">En-Suite</div>
            <div class="ch-meta-key">Bathroom</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">From $390</div>
            <div class="ch-meta-key">Per Night</div>
          </div>
        </div>
        <div class="ch-cta-row">
          <a href="#" class="btn-enquire tb-reserve-trigger" data-room="The Highlands Suite" data-source="chamber_cta">Check Availability &amp; Reserve</a>
        </div>
      </div>
    </div>

    <!-- FAMILY WING CALLOUT between 02 and 03 -->
    <div class="family-callout reveal">
      <div class="family-callout-icon">👨‍👩‍👧</div>
      <div class="family-callout-body">
        <div class="family-callout-title">The Family Wing — Highlands Suite + Pekoe Room</div>
        <p class="family-callout-text">
          Rooms 02 and 03 connect internally via a shared dressing room. Booked together, they form a <strong>private family wing accommodating 6–8 guests</strong>, with separate sleeping quarters, shared access to the main bungalow, and the option of complete privacy within the wing.
        </p>
      </div>
      <a href="#" class="family-callout-cta tb-reserve-trigger" data-room="The Highlands Suite & Pekoe Room (Family Wing)" data-source="family_wing_cta">Enquire About the Family Wing</a>
    </div>

    <!-- 03 PEKOE ROOM -->
    <div class="chamber" id="pekoe">
      <div class="ch-visual">
        <div class="ch-img c-pekoe"></div>
        <div class="ch-img-overlay"></div>
        <div class="ch-ph">
          <div class="ch-ph-icon">🍃</div>
          <div class="ch-ph-text">The Pekoe Room</div>
        </div>
        <div class="ch-badges">
          <div class="ch-badge ch-badge-gold">Named for the Leaf</div>
          <div class="ch-badge ch-badge-cream">Family Wing</div>
        </div>
        <div class="ch-num">03</div>
      </div>
      <div class="ch-info">
        <div class="ch-tag">Named for the Leaf · Room 03</div>
        <h2 class="ch-name">The Pekoe Room</h2>
        <p class="ch-desc">Named after the celebrated Pekoe leaf grade — the finest from which Ceylon Tea takes its international reputation. This refined chamber may be booked independently as a solo or couple's retreat, or as part of the family wing with the Highlands Suite.</p>
        <div class="ch-features">
          <div class="ch-feat">
            <div class="ch-feat-icon">🍃</div>
            Named for the Pekoe grade — the finest grade of Ceylon tea leaf
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🚪</div>
            Connects internally to the Highlands Suite via dressing room
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🛏️</div>
            Standalone room or part of the family wing — flexible arrangement
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🥾</div>
            Ideal for Pekoe Trail hikers — the room named for the trail itself
          </div>
        </div>
        <div class="ch-meta">
          <div class="ch-meta-item">
            <div class="ch-meta-val">2 Guests</div>
            <div class="ch-meta-key">Capacity</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">King / Twin</div>
            <div class="ch-meta-key">Bed Type</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">En-Suite</div>
            <div class="ch-meta-key">Bathroom</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">From $320</div>
            <div class="ch-meta-key">Per Night</div>
          </div>
        </div>
        <div class="ch-cta-row">
          <a href="#" class="btn-enquire tb-reserve-trigger" data-room="The Pekoe Room" data-source="chamber_cta">Check Availability &amp; Reserve</a>
        </div>
      </div>
    </div>

    <!-- 04 VERANDAH CHAMBER -->
    <div class="chamber" id="verandah">
      <div class="ch-visual">
        <div class="ch-img c-verandah"></div>
        <div class="ch-img-overlay"></div>
        <div class="ch-ph">
          <div class="ch-ph-icon">🌿</div>
          <div class="ch-ph-text">Verandah Chamber</div>
        </div>
        <div class="ch-badges">
          <div class="ch-badge ch-badge-green">Garden Access</div>
          <div class="ch-badge ch-badge-dark">Trail Friendly</div>
        </div>
        <div class="ch-num">04</div>
      </div>
      <div class="ch-info">
        <div class="ch-tag">Garden Access · Room 04</div>
        <h2 class="ch-name">The Verandah Chamber</h2>
        <p class="ch-desc">With direct access to the long rear verandah, this room offers seamless indoor-outdoor living — the most immediate connection to the garden and the estate beyond. Step from the bed to the mist, the tea fields, and the morning air without a corridor between you.</p>
        <div class="ch-features">
          <div class="ch-feat">
            <div class="ch-feat-icon">🚪</div>
            Direct private access to the long rear estate verandah
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🌿</div>
            Immediate connection to the garden — tea fields and morning mist
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🥾</div>
            Particularly suited to Pekoe Trail hikers — garden start for early departures
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🌅</div>
            First light on the tea fields — unfiltered estate mornings
          </div>
        </div>
        <div class="ch-meta">
          <div class="ch-meta-item">
            <div class="ch-meta-val">2 Guests</div>
            <div class="ch-meta-key">Capacity</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">King / Twin</div>
            <div class="ch-meta-key">Bed Type</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">En-Suite</div>
            <div class="ch-meta-key">Bathroom</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">From $340</div>
            <div class="ch-meta-key">Per Night</div>
          </div>
        </div>
        <div class="ch-cta-row">
          <a href="#" class="btn-enquire tb-reserve-trigger" data-room="The Verandah Chamber" data-source="chamber_cta">Check Availability &amp; Reserve</a>
        </div>
      </div>
    </div>

    <!-- 05 CAMELLIA ROOM -->
    <div class="chamber" id="camellia">
      <div class="ch-visual">
        <div class="ch-img c-camellia"></div>
        <div class="ch-img-overlay"></div>
        <div class="ch-ph">
          <div class="ch-ph-icon">🌺</div>
          <div class="ch-ph-text">The Camellia Room</div>
        </div>
        <div class="ch-badges">
          <div class="ch-badge ch-badge-gold">Named for the Plant</div>
          <div class="ch-badge ch-badge-dark">Couples · Quiet Retreat</div>
        </div>
        <div class="ch-num">05</div>
      </div>
      <div class="ch-info">
        <div class="ch-tag">Botanical Chamber · Room 05</div>
        <h2 class="ch-name">The Camellia Room</h2>
        <p class="ch-desc">Named for <em>Camellia sinensis</em> — the tea plant itself. Soft, botanical, and designed for restful evenings. The room that reminds you why you came here — not to be entertained, but to slow down entirely.</p>
        <div class="ch-features">
          <div class="ch-feat">
            <div class="ch-feat-icon">🌺</div>
            Named for Camellia sinensis — the species from which all tea is made
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🤫</div>
            Quiet, botanical interior — designed for complete rest and recovery
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">💑</div>
            Ideal for couples seeking an unhurried, uninterrupted retreat
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🌙</div>
            Positioned on the estate's inner side — calm, sheltered, peaceful
          </div>
        </div>
        <div class="ch-meta">
          <div class="ch-meta-item">
            <div class="ch-meta-val">2 Guests</div>
            <div class="ch-meta-key">Capacity</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">King Bed</div>
            <div class="ch-meta-key">Bed Type</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">En-Suite</div>
            <div class="ch-meta-key">Bathroom</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">From $310</div>
            <div class="ch-meta-key">Per Night</div>
          </div>
        </div>
        <div class="ch-cta-row">
          <a href="#" class="btn-enquire tb-reserve-trigger" data-room="The Camellia Room" data-source="chamber_cta">Check Availability &amp; Reserve</a>
        </div>
      </div>
    </div>

    <!-- 06 GALAHA ROOM -->
    <div class="chamber" id="galaha">
      <div class="ch-visual">
        <div class="ch-img c-galaha"></div>
        <div class="ch-img-overlay"></div>
        <div class="ch-ph">
          <div class="ch-ph-icon">🌄</div>
          <div class="ch-ph-text">The Galaha Room</div>
        </div>
        <div class="ch-badges">
          <div class="ch-badge ch-badge-green">Named for the Region</div>
          <div class="ch-badge ch-badge-dark">Estate Views</div>
        </div>
        <div class="ch-num">06</div>
      </div>
      <div class="ch-info">
        <div class="ch-tag">Estate Character · Room 06</div>
        <h2 class="ch-name">The Galaha Room</h2>
        <p class="ch-desc">Grounded in its setting. Named for Galaha itself — the region where James Taylor planted Ceylon's first tea in 1867, and the land on which this bungalow has stood ever since. A room that knows its place in history.</p>
        <div class="ch-features">
          <div class="ch-feat">
            <div class="ch-feat-icon">🗺️</div>
            Named for Galaha — the birthplace of Ceylon Tea, 5km from Loolecondera
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🌿</div>
            Working tea estate views — the fields, the pluckers, the mist
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🏠</div>
            Positioned near the kitchen — close to the working heart of the estate
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🥾</div>
            A strong choice for solo hikers and those arriving from Stage 1
          </div>
        </div>
        <div class="ch-meta">
          <div class="ch-meta-item">
            <div class="ch-meta-val">1–2 Guests</div>
            <div class="ch-meta-key">Capacity</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">Queen / Twin</div>
            <div class="ch-meta-key">Bed Type</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">En-Suite</div>
            <div class="ch-meta-key">Bathroom</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">From $310</div>
            <div class="ch-meta-key">Per Night</div>
          </div>
        </div>
        <div class="ch-cta-row">
          <a href="#" class="btn-enquire tb-reserve-trigger" data-room="The Galaha Room" data-source="chamber_cta">Check Availability &amp; Reserve</a>
        </div>
      </div>
    </div>

    <!-- CARRIAGE HOUSE COTTAGE -->
    <div class="chamber" id="cottage">
      <div class="ch-visual">
        <div class="ch-img c-cottage"></div>
        <div class="ch-img-overlay"></div>
        <div class="ch-badges">
          <div class="ch-badge ch-badge-gold">Fully Private Cottage</div>
          <div class="ch-badge ch-badge-green">Stepless Throughout</div>
          <div class="ch-badge ch-badge-cream">2 Bedrooms</div>
        </div>
        <div class="ch-num">CH</div>
      </div>
      <div class="ch-info">
        <div class="ch-tag">The Carriage House · Detached Cottage</div>
        <h2 class="ch-name">The Carriage House Cottage</h2>
        <p class="ch-desc">A former estate carriage house and stable, now converted into a fully self-contained two-bedroom private cottage with its own living room, dining area, and cooking facilities. Completely stepless throughout. Two named bedrooms — The Saddle Room and The Lantern Room — each with their own character.</p>
        <div class="ch-features">
          <div class="ch-feat">
            <div class="ch-feat-icon">🚗</div>
            Former estate carriage house — authentic outbuilding with its own history
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🛏️</div>
            The Saddle Room & The Lantern Room — two private bedrooms
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">🛋️</div>
            Own living room, dining area, and kitchen facilities — fully independent
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">♿</div>
            Completely stepless throughout — ideal for guests requiring full accessibility
          </div>
          <div class="ch-feat">
            <div class="ch-feat-icon">👴</div>
            Perfect for grandparents, extended-stay guests, or families needing independence
          </div>
        </div>
        <div class="ch-meta">
          <div class="ch-meta-item">
            <div class="ch-meta-val">4 Guests</div>
            <div class="ch-meta-key">Capacity</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">2 Bedrooms</div>
            <div class="ch-meta-key">Rooms</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">Private Bath</div>
            <div class="ch-meta-key">Bathroom</div>
          </div>
          <div class="ch-meta-item">
            <div class="ch-meta-val">From $580</div>
            <div class="ch-meta-key">Per Night</div>
          </div>
        </div>
        <div class="ch-cta-row">
          <a href="#" class="btn-enquire tb-reserve-trigger" data-room="The Carriage House Cottage" data-source="chamber_cta">Check Availability &amp; Reserve</a>
        </div>
      </div>
    </div>

  </div><!-- /chambers-list -->

  <!-- ═══ ACCESSIBILITY STRIP ═══ -->
  <div class="access-strip reveal">
    <div class="access-icon">♿</div>
    <div class="access-body">
      <div class="access-title">Accessibility at The Tea Bungalow</div>
      <p class="access-text">
        <strong>The Founder's Suite, The Highlands Suite, and The Carriage House Cottage</strong> are all designed with step-free access and generous circulation space throughout. Please mention any specific requirements when enquiring and we will ensure your arrangements are made with care.
      </p>
    </div>
  </div>

  <!-- ═══ COMPARISON TABLE ═══ -->
  <section class="comparison-section">
    <div class="comp-header reveal">
      <div class="comp-eyebrow">At a Glance</div>
      <h2 class="comp-title">Compare All Chambers</h2>
      <p class="comp-sub">Every room in one view — features, suitability, and highlights.</p>
    </div>
    <div class="comp-table-wrap reveal">
      <table class="comp-table">
        <thead>
          <tr>
            <th>Feature</th>
            <th>Founder's<br><span class="room-col-name">Suite</span></th>
            <th>Highlands<br><span class="room-col-name">Suite</span></th>
            <th>Pekoe<br><span class="room-col-name">Room</span></th>
            <th>Verandah<br><span class="room-col-name">Chamber</span></th>
            <th>Camellia<br><span class="room-col-name">Room</span></th>
            <th>Galaha<br><span class="room-col-name">Room</span></th>
            <th>Carriage<br><span class="room-col-name">Cottage</span></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>King Bed</td>
            <td class="highlight-col"><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="tick">✓</span></td>
          </tr>
          <tr>
            <td>En-Suite Bathroom</td>
            <td class="highlight-col"><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
          </tr>
          <tr>
            <td>Private Verandah</td>
            <td class="highlight-col"><span class="tick">✓</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
          </tr>
          <tr>
            <td>Pool Access</td>
            <td class="highlight-col"><span class="tick">✓</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
          </tr>
          <tr>
            <td>Fully Accessible</td>
            <td class="highlight-col"><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="tick">✓</span></td>
          </tr>
          <tr>
            <td>Family Wing Option</td>
            <td class="highlight-col"><span class="dot">—</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="tick">✓</span></td>
          </tr>
          <tr>
            <td>Garden / Verandah Access</td>
            <td class="highlight-col"><span class="tick">✓</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="tick">✓</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="tick">✓</span></td>
          </tr>
          <tr>
            <td>Private Living Area</td>
            <td class="highlight-col"><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="tick">✓</span></td>
          </tr>
          <tr>
            <td>Cooking Facilities</td>
            <td class="highlight-col"><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="dot">—</span></td>
            <td><span class="tick">✓</span></td>
          </tr>
          <tr>
            <td>Ideal For</td>
            <td class="highlight-col" style="font-style:italic; color: var(--ink-light); text-align:center; font-size:12px;">Couples &amp; accessibility needs</td>
            <td style="font-style:italic; color: var(--ink-light); text-align:center; font-size:12px;">Accessible stays &amp; families</td>
            <td style="font-style:italic; color: var(--ink-light); text-align:center; font-size:12px;">Trail hikers &amp; couples</td>
            <td style="font-style:italic; color: var(--ink-light); text-align:center; font-size:12px;">Hikers &amp; outdoor lovers</td>
            <td style="font-style:italic; color: var(--ink-light); text-align:center; font-size:12px;">Couples &amp; quiet retreats</td>
            <td style="font-style:italic; color: var(--ink-light); text-align:center; font-size:12px;">Solo travellers &amp; hikers</td>
            <td style="font-style:italic; color: var(--ink-light); text-align:center; font-size:12px;">Families &amp; extended stays</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- ═══ ESTATE BUYOUT ═══ -->
  <div class="buyout-strip reveal">
    <div>
      <div class="buyout-eyebrow">Estate Buyout</div>
      <h2 class="buyout-title">Take the Whole House</h2>
      <p class="buyout-body">
        All six chambers and the Carriage House Cottage — reserved exclusively for your party (up to 14 guests). From $2,600 / night. No other guests. No shared schedules. Private chef, dedicated transfers, full staff. The entire estate, entirely yours.
      </p>
    </div>
    <a href="#" class="btn-gold tb-reserve-trigger" data-room="The Entire Estate (Full Buyout)" data-source="chambers_estate_cta">Reserve the Entire Estate</a>
  </div>

  <!-- ═══ ENQUIRE ═══ -->
  <section id="enquire" class="enquire-section">
    <div class="enq-eyebrow reveal">Reserve Your Room</div>
    <h2 class="enq-title reveal">Enquire About Your Stay</h2>
    <p class="enq-body reveal">Tell us which chamber interests you, your preferred dates, and the size of your party. We will respond within 24 hours with availability, current rates, and any packages that suit your plans.</p>
    <div class="enq-btns reveal">
      <a href="mailto:stay@theteabungalow.com" class="btn-enquire" style="font-family:'Cinzel',serif;font-size:11px;letter-spacing:0.2em;text-transform:uppercase;background:var(--green);color:var(--white);padding:16px 32px;text-decoration:none;border:1px solid var(--green);transition:background 0.25s,color 0.25s;display:inline-block;">Enquire by Email</a>
      <a href="https://wa.me/94777874555" class="btn-ghost" target="_blank" rel="noopener noreferrer" style="font-family:'Cinzel',serif;font-size:11px;letter-spacing:0.2em;text-transform:uppercase;background:transparent;color:var(--green);padding:16px 28px;text-decoration:none;border:1px solid var(--green-pale);transition:border-color 0.25s,color 0.25s;display:inline-block;">WhatsApp Us</a>
      <a href="/vD/packages.php" class="btn-ghost" style="font-family:'Cinzel',serif;font-size:11px;letter-spacing:0.2em;text-transform:uppercase;background:transparent;color:var(--green);padding:16px 28px;text-decoration:none;border:1px solid var(--green-pale);transition:border-color 0.25s,color 0.25s;display:inline-block;">View Packages</a>
    </div>
    <p class="enq-note">Current rates are available on request · Free cancellation terms confirmed with your booking</p>
  </section>

  <!-- ═══ FOOTER ═══ -->
  <?php include 'layout/footer.php'; ?>

  <script>
    // Nav scroll
    const nav = document.getElementById('nav');
    window.addEventListener('scroll', () => {
      nav.classList.toggle('scrolled', window.scrollY > 60);
    });

    // Scroll reveal for .reveal elements
    const reveals = document.querySelectorAll('.reveal');
    const revObs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
          revObs.unobserve(e.target);
        }
      });
    }, {
      threshold: 0.08
    });
    reveals.forEach(el => revObs.observe(el));

    // Chamber cards reveal
    const chambers = document.querySelectorAll('.chamber');
    const chamberObs = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
          chamberObs.unobserve(e.target);
        }
      });
    }, {
      threshold: 0.06
    });
    chambers.forEach(el => chamberObs.observe(el));

    // Filter chips
    const chips = document.querySelectorAll('.filter-chip');
    const filterMap = {
      all: () => true,
      accessible: id => ['founders', 'highlands', 'cottage'].includes(id),
      family: id => ['highlands', 'pekoe', 'cottage'].includes(id),
      private: id => ['cottage'].includes(id),
      trail: id => ['verandah', 'pekoe', 'galaha'].includes(id),
    };

    chips.forEach(chip => {
      chip.addEventListener('click', () => {
        chips.forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
        const f = chip.dataset.filter;
        chambers.forEach(ch => {
          const show = filterMap[f] ? filterMap[f](ch.id) : true;
          ch.style.display = show ? '' : 'none';
        });
        // Also show/hide the family callout
        const fc = document.querySelector('.family-callout');
        if (fc) fc.style.display = (f === 'all' || f === 'family') ? '' : 'none';
      });
    });
  </script>
</body>

</html>