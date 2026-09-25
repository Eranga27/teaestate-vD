<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Tea Bungalow · Galaha Estate · Pekoe Trail Base · Sri Lanka</title>

<link rel="icon" type="image/png" href="images/favicon.png">
<meta property="og:type" content="website">
<meta property="og:title" content="The Tea Bungalow · Heritage Estate Stay · Galaha, Sri Lanka">
<meta property="og:description" content="Stay at The Tea Bungalow — a restored 1890s colonial estate in Galaha, Sri Lanka. Rooms, Pekoe Trail packages, experiences, and estate buyouts.">
<meta property="og:url" content="https://www.theteabungalow.com/">
<meta property="og:image" content="https://www.theteabungalow.com/images/heroimg-1.jpeg">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="The Tea Bungalow · Heritage Estate Stay · Galaha, Sri Lanka">
<meta name="twitter:description" content="Stay at The Tea Bungalow — a restored 1890s colonial estate in Galaha, Sri Lanka. Rooms, Pekoe Trail packages, experiences, and estate buyouts.">
<link rel="canonical" href="https://www.theteabungalow.com/">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Non-blocking Google Fonts: loads asynchronously so it never blocks window.load -->
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet" media="print" onload="this.media='all'; this.onload=null;">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap"></noscript>
  <style>
    /* ═══════════════════════════════════════════════════════════════
   ROOT & RESET
═══════════════════════════════════════════════════════════════ */
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
      --green-light: #3d8050;
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
      --shadow-green: rgba(30, 77, 43, 0.18);
    }

    body {
      background: var(--cream);
      font-family: 'EB Garamond', Georgia, serif;
      color: var(--ink);
      overflow-x: hidden;
      cursor: default;
    }

    /* ═══════════════════════════════════════════════════════════════
   GRAIN OVERLAY
═══════════════════════════════════════════════════════════════ */
    body::after {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 9999;
    }

    /* ═══════════════════════════════════════════════════════════════
   NAV
═══════════════════════════════════════════════════════════════ */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 100;
      padding: 0 48px;
      height: 72px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: background 0.4s ease, box-shadow 0.4s ease;
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
      gap: 36px;
      list-style: none;
    }

    .nav-links a {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.85);
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

    .nav-cta {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--white) !important;
      background: var(--green);
      border: 1px solid var(--green);
      padding: 9px 20px;
      text-decoration: none;
      transition: background 0.25s, color 0.25s, border-color 0.25s !important;
    }

    .nav-cta:hover {
      background: var(--gold) !important;
      border-color: var(--gold) !important;
      color: var(--white) !important;
    }

    nav.scrolled .nav-cta {
      background: var(--green);
      color: var(--white) !important;
    }

    /* ═══════════════════════════════════════════════════════════════
   HERO
═══════════════════════════════════════════════════════════════ */
    .hero {
      position: relative;
      height: 100vh;
      min-height: 700px;
      display: flex;
      align-items: flex-end;
      overflow: hidden;
    }

    /* Tea estate hero photo with rich atmospheric gradient */
    .hero-bg {
      position: absolute;
      inset: 0;
      background:
        linear-gradient(180deg,
          rgba(8, 22, 12, 0.70) 0%,
          rgba(8, 22, 12, 0.55) 35%,
          rgba(8, 22, 12, 0.75) 70%,
          rgba(6, 18, 10, 0.96) 100%),
        url('images/heroimg-1.jpeg') center/cover no-repeat;
    }

    /* Mist layer */
    .hero-mist {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 55%;
      background: linear-gradient(to top,
          rgba(10, 28, 15, 0.92) 0%,
          rgba(10, 28, 15, 0.4) 60%,
          transparent 100%);
    }

    /* Animated tea rows suggestion */
    .hero-texture {
      position: absolute;
      inset: 0;
      opacity: 0.12;
      background-image: repeating-linear-gradient(170deg,
          transparent 0px,
          transparent 22px,
          rgba(255, 255, 255, 0.06) 22px,
          rgba(255, 255, 255, 0.06) 24px);
    }

    .hero-content {
      position: relative;
      z-index: 2;
      width: 100%;
      padding: 0 10vw 9vh;
    }

    .hero-estate {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.45em;
      color: var(--gold-light);
      text-transform: uppercase;
      margin-bottom: 20px;
      opacity: 0;
      animation: riseIn 1s 0.3s ease forwards;
      display: inline-flex;
      align-items: center;
      padding: 7px 18px;
      background: rgba(8, 22, 12, 0.75);
      border: 1px solid rgba(199, 168, 94, 0.45);
      border-radius: 2px;
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.9);
    }

    .hero-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(44px, 7vw, 88px);
      font-weight: 700;
      color: var(--white);
      line-height: 1.0;
      letter-spacing: 0.02em;
      margin-bottom: 8px;
      opacity: 0;
      animation: riseIn 1s 0.55s ease forwards;
      text-shadow: 0 2px 16px rgba(0, 0, 0, 0.7), 0 1px 3px rgba(0, 0, 0, 0.9);
    }

    .hero-title em {
      display: block;
      font-style: normal;
      color: var(--gold-light);
    }

    .hero-rule {
      width: 60px;
      height: 1px;
      background: var(--gold);
      margin: 28px 0;
      opacity: 0;
      animation: riseIn 1s 0.75s ease forwards;
    }

    .hero-tagline {
      font-size: clamp(18px, 2.2vw, 24px);
      font-style: italic;
      color: rgba(255, 255, 255, 0.88);
      line-height: 1.5;
      max-width: 540px;
      margin-bottom: 40px;
      opacity: 0;
      animation: riseIn 1s 0.9s ease forwards;
      text-shadow: 0 1px 8px rgba(0, 0, 0, 0.8);
    }

    .hero-btns {
      display: flex;
      gap: 16px;
      flex-wrap: wrap;
      opacity: 0;
      animation: riseIn 1s 1.1s ease forwards;
    }

    .btn-primary {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      background: var(--gold);
      color: var(--ink);
      padding: 16px 32px;
      text-decoration: none;
      border: 1px solid var(--gold);
      transition: background 0.25s, color 0.25s, transform 0.2s;
      display: inline-block;
    }

    .btn-primary:hover {
      background: var(--white);
      color: var(--green);
      transform: translateY(-2px);
    }

    .btn-secondary {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      background: transparent;
      color: var(--white);
      padding: 16px 32px;
      text-decoration: none;
      border: 1px solid rgba(255, 255, 255, 0.4);
      transition: border-color 0.25s, color 0.25s, transform 0.2s;
      display: inline-block;
    }

    .btn-secondary:hover {
      border-color: var(--gold);
      color: var(--gold);
      transform: translateY(-2px);
    }

    /* ══════════════════════════════════════════════
       HERO AVAILABILITY BAR — Integrated Glassmorphic Entry
    ══════════════════════════════════════════════ */
    .hero-avail-wrap {
      margin-top: 40px;
      width: 100%;
      max-width: 860px;
      opacity: 0;
      animation: riseIn 1s 1.25s ease forwards;
    }
    .hero-avail-label {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.4em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .hero-avail-label::before,
    .hero-avail-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(199,168,94,0.4), transparent);
    }
    .hero-booking-bar {
      background: rgba(5, 18, 10, 0.75);
      backdrop-filter: blur(24px) saturate(1.6);
      -webkit-backdrop-filter: blur(24px) saturate(1.6);
      border: 1px solid rgba(199, 168, 94, 0.3);
      border-radius: 4px;
      padding: 0;
      display: flex;
      align-items: stretch;
      overflow: hidden;
      box-shadow:
        0 24px 60px rgba(0, 0, 0, 0.6),
        0 0 0 1px rgba(199, 168, 94, 0.06),
        inset 0 1px 0 rgba(255, 255, 255, 0.04);
      position: relative;
    }
    /* Gold shimmer on top edge */
    .hero-booking-bar::before {
      content: '';
      position: absolute;
      top: 0;
      left: 15%;
      right: 15%;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(199,168,94,0.7), transparent);
      animation: shimmerSlide 3.5s ease-in-out infinite;
    }
    @keyframes shimmerSlide {
      0%   { left: -20%; right: 120%; opacity: 0; }
      20%  { opacity: 1; }
      80%  { opacity: 1; }
      100% { left: 120%; right: -20%; opacity: 0; }
    }
    .hbb-field {
      display: flex;
      flex-direction: column;
      flex: 1;
      min-width: 0;
      padding: 16px 18px;
      position: relative;
      transition: background 0.2s;
    }
    .hbb-field:hover {
      background: rgba(199, 168, 94, 0.04);
    }
    .hbb-field-icon {
      font-size: 11px;
      margin-bottom: 5px;
      opacity: 0.55;
    }
    .hbb-label {
      font-family: 'Cinzel', serif;
      font-size: 8.5px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 6px;
      line-height: 1;
    }
    .hbb-input, .hbb-select {
      background: transparent;
      border: none;
      color: var(--white);
      font-family: 'EB Garamond', Georgia, serif;
      font-size: 15px;
      outline: none;
      cursor: pointer;
      width: 100%;
      padding: 0;
    }
    .hbb-select option {
      background: #0a1e12;
      color: #F5F1E9;
    }
    .hbb-divider {
      width: 1px;
      background: linear-gradient(to bottom, transparent 10%, rgba(199, 168, 94, 0.2) 40%, rgba(199, 168, 94, 0.2) 60%, transparent 90%);
      flex-shrink: 0;
      margin: 10px 0;
    }
    .hbb-btn-wrap {
      display: flex;
      align-items: center;
      padding: 10px 12px;
      flex-shrink: 0;
    }
    .hbb-btn {
      background: var(--gold);
      color: var(--ink);
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.16em;
      text-transform: uppercase;
      font-weight: 600;
      padding: 14px 22px;
      border-radius: 2px;
      border: none;
      cursor: pointer;
      white-space: nowrap;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
      flex-shrink: 0;
      position: relative;
      overflow: hidden;
    }
    .hbb-btn::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, transparent 50%);
      opacity: 0;
      transition: opacity 0.3s;
    }
    .hbb-btn:hover {
      background: #d4b568;
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(199, 168, 94, 0.45);
    }
    .hbb-btn:hover::after {
      opacity: 1;
    }
    @media (max-width: 900px) {
      .hero-avail-wrap {
        margin-top: 28px;
      }
      .hero-booking-bar {
        flex-direction: column;
      }
      .hbb-divider {
        width: auto;
        height: 1px;
        margin: 0 18px;
        background: linear-gradient(to right, transparent, rgba(199, 168, 94, 0.2), transparent);
      }
      .hbb-btn-wrap {
        padding: 12px 18px;
      }
      .hbb-btn {
        width: 100%;
        justify-content: center;
      }
    }

    /* Scroll cue */
    .hero-scroll {
      position: absolute;
      bottom: 36px;
      right: 10vw;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
      opacity: 0;
      animation: riseIn 1s 1.4s ease forwards;
    }

    .hero-scroll span {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.35em;
      color: rgba(255, 255, 255, 0.4);
      text-transform: uppercase;
      writing-mode: vertical-rl;
    }

    .hero-scroll-line {
      width: 1px;
      height: 48px;
      background: linear-gradient(to bottom, rgba(255, 255, 255, 0.4), transparent);
      animation: scrollPulse 2s 2s ease-in-out infinite;
    }

    /* Estate year badge */
    .hero-badge {
      position: absolute;
      top: 120px;
      right: 10vw;
      text-align: center;
      opacity: 0;
      animation: riseIn 1s 1.2s ease forwards;
    }

    .hero-badge-circle {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      border: 1px solid rgba(199, 168, 94, 0.5);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 0;
    }

    .hero-badge-year {
      font-family: 'Cinzel', serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
    }

    .hero-badge-label {
      font-family: 'Cinzel', serif;
      font-size: 8px;
      letter-spacing: 0.2em;
      color: rgba(255, 255, 255, 0.5);
      text-transform: uppercase;
    }

    /* ═══════════════════════════════════════════════════════════════
   SECTION — INTRO PULL QUOTE
═══════════════════════════════════════════════════════════════ */
    .intro-strip {
      background: var(--green);
      padding: 72px 10vw;
      position: relative;
      overflow: hidden;
    }

    .intro-strip::before {
      content: '"';
      position: absolute;
      top: -20px;
      left: 6vw;
      font-family: 'EB Garamond', Georgia, serif;
      font-size: 320px;
      color: rgba(255, 255, 255, 0.04);
      line-height: 1;
      pointer-events: none;
    }

    .intro-strip-inner {
      max-width: 780px;
      margin: 0 auto;
      text-align: center;
    }

    .intro-strip p {
      font-size: clamp(20px, 2.4vw, 28px);
      font-style: italic;
      color: rgba(255, 255, 255, 0.88);
      line-height: 1.7;
      margin-bottom: 28px;
    }

    .intro-strip-rule {
      width: 50px;
      height: 1px;
      background: var(--gold);
      margin: 0 auto 24px;
    }

    .intro-strip-tag {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.35em;
      color: var(--gold);
      text-transform: uppercase;
    }

    /* ═══════════════════════════════════════════════════════════════
   SECTION — CHOOSE YOUR STAY
═══════════════════════════════════════════════════════════════ */
    .choose-stay {
      padding: 100px 10vw;
      background: var(--cream);
    }

    .section-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 16px;
    }

    .section-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 3.5vw, 42px);
      font-weight: 600;
      color: var(--green);
      text-align: center;
      line-height: 1.15;
      margin-bottom: 16px;
    }

    .section-sub {
      font-size: 18px;
      font-style: italic;
      color: var(--ink-light);
      text-align: center;
      max-width: 560px;
      margin: 0 auto 64px;
      line-height: 1.6;
    }

    .stay-cards {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .stay-card {
      padding: 56px 48px;
      position: relative;
      overflow: hidden;
      transition: transform 0.3s ease;
      cursor: pointer;
    }

    .stay-card:hover {
      transform: translateY(-4px);
    }

    .stay-card-a {
      background: var(--green);
      color: var(--white);
    }

    .stay-card-b {
      background: var(--ink);
      color: var(--white);
    }

    .stay-card-accent {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: var(--gold);
    }

    .stay-card-b .stay-card-accent {
      background: linear-gradient(90deg, var(--gold), var(--gold-light));
    }

    .stay-card-icon {
      font-size: 32px;
      margin-bottom: 24px;
      display: block;
    }

    .stay-card-type {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.4em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 12px;
    }

    .stay-card-name {
      font-family: 'Cinzel', serif;
      font-size: clamp(22px, 2.5vw, 30px);
      font-weight: 600;
      color: var(--white);
      margin-bottom: 20px;
      line-height: 1.15;
    }

    .stay-card-desc {
      font-size: 17px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.7);
      line-height: 1.65;
      margin-bottom: 32px;
    }

    .stay-card-features {
      list-style: none;
      margin-bottom: 36px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .stay-card-features li {
      font-size: 14.5px;
      color: rgba(255, 255, 255, 0.75);
      display: flex;
      align-items: flex-start;
      gap: 10px;
      line-height: 1.4;
    }

    .stay-card-features li::before {
      content: '—';
      color: var(--gold);
      font-family: 'Cinzel', serif;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .stay-card-btn {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--gold);
      text-decoration: none;
      border: 1px solid rgba(199, 168, 94, 0.5);
      padding: 14px 28px;
      display: inline-block;
      transition: background 0.25s, color 0.25s, border-color 0.25s;
    }

    .stay-card-btn:hover {
      background: var(--gold);
      color: var(--ink);
      border-color: var(--gold);
    }

    /* ═══════════════════════════════════════════════════════════════
   SECTION — PEKOE TRAIL HOOK
═══════════════════════════════════════════════════════════════ */
    .trail-section {
      background: var(--cream-dark);
      padding: 100px 10vw;
      position: relative;
      overflow: hidden;
    }

    .trail-section::after {
      content: 'PEKOE';
      position: absolute;
      right: -2vw;
      top: 50%;
      transform: translateY(-50%) rotate(90deg);
      font-family: 'Cinzel', serif;
      font-size: 120px;
      font-weight: 700;
      color: rgba(30, 77, 43, 0.05);
      letter-spacing: 0.1em;
      pointer-events: none;
      white-space: nowrap;
    }

    .trail-inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: center;
      max-width: 1100px;
      margin: 0 auto;
    }

    .trail-content {}

    .trail-content .section-eyebrow {
      text-align: left;
    }

    .trail-content .section-title {
      text-align: left;
      font-size: clamp(26px, 3vw, 38px);
      margin-bottom: 24px;
    }

    .trail-content p {
      font-size: 17px;
      line-height: 1.75;
      color: var(--ink-mid);
      margin-bottom: 20px;
    }

    .trail-content p strong {
      color: var(--green);
      font-weight: 600;
    }

    .trail-hooks {
      margin: 32px 0;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .trail-hook {
      font-family: 'Cinzel', serif;
      font-size: 12px;
      letter-spacing: 0.08em;
      color: var(--green);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .trail-hook::before {
      content: '';
      width: 24px;
      height: 1px;
      background: var(--gold);
      flex-shrink: 0;
    }

    .trail-stages {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .trail-stage {
      background: var(--white);
      padding: 20px 24px;
      display: flex;
      align-items: center;
      gap: 20px;
      border-left: 3px solid transparent;
      transition: border-color 0.25s, transform 0.2s;
      cursor: default;
    }

    .trail-stage:hover {
      border-left-color: var(--green);
      transform: translateX(4px);
    }

    .trail-stage-num {
      font-family: 'Cinzel', serif;
      font-size: 28px;
      font-weight: 700;
      color: var(--green-pale);
      line-height: 1;
      min-width: 44px;
    }

    .trail-stage-info {
      flex: 1;
    }

    .trail-stage-name {
      font-family: 'Cinzel', serif;
      font-size: 13px;
      color: var(--green);
      letter-spacing: 0.04em;
      margin-bottom: 3px;
    }

    .trail-stage-route {
      font-size: 13px;
      font-style: italic;
      color: var(--ink-light);
      margin-bottom: 3px;
    }

    .trail-stage-meta {
      font-size: 12px;
      color: var(--mist);
      font-family: 'Cinzel', serif;
      letter-spacing: 0.06em;
    }

    .trail-stage-badge {
      font-size: 10px;
      font-family: 'Cinzel', serif;
      letter-spacing: 0.1em;
      padding: 4px 10px;
      border-radius: 2px;
      white-space: nowrap;
    }

    .badge-easy {
      background: #eaf5ed;
      color: #1e6e38;
    }

    .badge-difficult {
      background: #fdecea;
      color: #c0392b;
    }

    .badge-moderate {
      background: #fef9e7;
      color: #b7770d;
    }

    .trail-cta-row {
      margin-top: 36px;
      display: flex;
      gap: 16px;
      align-items: center;
    }

    .trail-cta-row .btn-green {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      background: var(--green);
      color: var(--white);
      padding: 14px 28px;
      text-decoration: none;
      border: 1px solid var(--green);
      transition: background 0.25s, color 0.25s;
      display: inline-block;
    }

    .trail-cta-row .btn-green:hover {
      background: var(--gold);
      border-color: var(--gold);
      color: var(--ink);
    }

    .trail-cta-row .link-text {
      font-size: 14px;
      font-style: italic;
      color: var(--ink-light);
      text-decoration: none;
      border-bottom: 1px solid var(--green-pale);
      padding-bottom: 2px;
      transition: border-color 0.2s, color 0.2s;
    }

    .trail-cta-row .link-text:hover {
      color: var(--green);
      border-color: var(--green);
    }

    /* ═══════════════════════════════════════════════════════════════
   SECTION — THE ESTATE (rooms teaser)
═══════════════════════════════════════════════════════════════ */
    .estate-section {
      padding: 100px 10vw;
      background: var(--cream);
    }

    .estate-grid {
      display: grid;
      grid-template-columns: 1.1fr 1fr 1fr;
      gap: 2px;
      max-width: 1100px;
      margin: 48px auto 0;
    }

    .estate-room {
      background: var(--white);
      padding: 36px 28px 28px;
      border-top: 3px solid transparent;
      transition: border-color 0.25s, transform 0.25s, box-shadow 0.25s;
      cursor: default;
      position: relative;
    }

    .estate-room:hover {
      border-top-color: var(--gold);
      transform: translateY(-5px);
      box-shadow: 0 12px 32px var(--shadow-green);
    }

    .estate-room-featured {
      background: var(--green);
      color: var(--white);
    }

    .estate-room-featured:hover {
      border-top-color: var(--gold-light);
    }

    .room-tag {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.35em;
      text-transform: uppercase;
      color: var(--gold);
      margin-bottom: 10px;
    }

    .estate-room-featured .room-tag {
      color: var(--gold-light);
    }

    .room-name {
      font-family: 'Cinzel', serif;
      font-size: 17px;
      font-weight: 600;
      color: var(--green);
      margin-bottom: 12px;
      line-height: 1.2;
    }

    .estate-room-featured .room-name {
      color: var(--white);
    }

    .room-desc {
      font-size: 14.5px;
      font-style: italic;
      color: var(--ink-light);
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .estate-room-featured .room-desc {
      color: rgba(255, 255, 255, 0.68);
    }

    .room-features {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-bottom: 24px;
    }

    .room-feature {
      font-size: 12.5px;
      color: var(--ink-light);
      display: flex;
      gap: 8px;
      align-items: flex-start;
    }

    .estate-room-featured .room-feature {
      color: rgba(255, 255, 255, 0.6);
    }

    .room-feature-dot {
      width: 4px;
      height: 4px;
      background: var(--gold);
      border-radius: 50%;
      flex-shrink: 0;
      margin-top: 6px;
    }

    .room-link {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.2em;
      color: var(--green);
      text-decoration: none;
      border-bottom: 1px solid var(--green-pale);
      padding-bottom: 2px;
      text-transform: uppercase;
      transition: color 0.2s, border-color 0.2s;
    }

    .estate-room-featured .room-link {
      color: var(--gold);
      border-bottom-color: rgba(199, 168, 94, 0.4);
    }

    .room-link:hover {
      color: var(--gold);
      border-color: var(--gold);
    }

    .estate-more {
      text-align: center;
      margin-top: 48px;
    }

    .estate-more a {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.25em;
      text-transform: uppercase;
      color: var(--green);
      text-decoration: none;
      border-bottom: 1px solid var(--green-pale);
      padding-bottom: 3px;
      transition: color 0.2s, border-color 0.2s;
    }

    .estate-more a:hover {
      color: var(--gold);
      border-color: var(--gold);
    }

    /* ═══════════════════════════════════════════════════════════════
   SECTION — HERITAGE STRIP
═══════════════════════════════════════════════════════════════ */
    .heritage-strip {
      background: var(--ink);
      padding: 80px 10vw;
      position: relative;
      overflow: hidden;
    }

    .heritage-strip::before {
      content: '1890';
      position: absolute;
      left: 5vw;
      top: 50%;
      transform: translateY(-50%);
      font-family: 'Cinzel', serif;
      font-size: 200px;
      font-weight: 700;
      color: rgba(255, 255, 255, 0.03);
      letter-spacing: 0.05em;
      pointer-events: none;
      line-height: 1;
    }

    .heritage-inner {
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      gap: 48px;
      align-items: center;
      max-width: 900px;
      margin: 0 auto;
    }

    .heritage-stat {
      text-align: center;
    }

    .heritage-stat-num {
      font-family: 'Cinzel', serif;
      font-size: clamp(36px, 5vw, 56px);
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
      margin-bottom: 8px;
    }

    .heritage-stat-label {
      font-size: 14px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.5);
      line-height: 1.4;
    }

    .heritage-divider {
      width: 1px;
      height: 80px;
      background: linear-gradient(to bottom, transparent, var(--gold), transparent);
    }

    /* ═══════════════════════════════════════════════════════════════
   SECTION — EXPERIENCES
═══════════════════════════════════════════════════════════════ */
    .experiences-section {
      padding: 100px 10vw;
      background: var(--green-ghost);
    }

    .experience-list {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      max-width: 1100px;
      margin: 56px auto 0;
    }

    .exp-card {
      background: var(--white);
      padding: 32px 24px;
      text-align: center;
      border-bottom: 3px solid transparent;
      transition: border-color 0.25s, transform 0.25s, box-shadow 0.25s;
      cursor: default;
    }

    .exp-card:hover {
      border-bottom-color: var(--gold);
      transform: translateY(-4px);
      box-shadow: 0 8px 24px var(--shadow-green);
    }

    .exp-icon {
      font-size: 28px;
      margin-bottom: 16px;
      display: block;
    }

    .exp-name {
      font-family: 'Cinzel', serif;
      font-size: 13px;
      color: var(--green);
      letter-spacing: 0.04em;
      margin-bottom: 10px;
      line-height: 1.3;
    }

    .exp-desc {
      font-size: 13.5px;
      font-style: italic;
      color: var(--ink-light);
      line-height: 1.55;
      margin-bottom: 16px;
    }

    .exp-price {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.15em;
      color: var(--gold);
      text-transform: uppercase;
    }

    /* ═══════════════════════════════════════════════════════════════
   SECTION — PROMOTIONS BANNER
═══════════════════════════════════════════════════════════════ */
    .promo-banner {
      background: var(--gold-pale);
      border-top: 1px solid rgba(199, 168, 94, 0.3);
      border-bottom: 1px solid rgba(199, 168, 94, 0.3);
      padding: 36px 10vw;
    }

    .promo-inner {
      display: flex;
      align-items: center;
      gap: 32px;
      max-width: 900px;
      margin: 0 auto;
      flex-wrap: wrap;
    }

    .promo-tag {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.4em;
      color: var(--gold);
      text-transform: uppercase;
      background: var(--gold);
      color: var(--white);
      padding: 4px 12px;
      flex-shrink: 0;
      white-space: nowrap;
    }

    .promo-text {
      flex: 1;
      font-size: 16px;
      font-style: italic;
      color: var(--ink-mid);
      line-height: 1.5;
    }

    .promo-text strong {
      color: var(--green);
      font-style: normal;
    }

    .promo-cta {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--green);
      border: 1px solid var(--green);
      padding: 12px 24px;
      text-decoration: none;
      white-space: nowrap;
      transition: background 0.25s, color 0.25s;
      flex-shrink: 0;
    }

    .promo-cta:hover {
      background: var(--green);
      color: var(--white);
    }

    /* ═══════════════════════════════════════════════════════════════
   SECTION — LOCATION
═══════════════════════════════════════════════════════════════ */
    .location-section {
      padding: 100px 10vw;
      background: var(--cream);
    }

    .location-inner {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 72px;
      align-items: start;
      max-width: 1100px;
      margin: 0 auto;
    }

    .location-content .section-eyebrow {
      text-align: left;
    }

    .location-content .section-title {
      text-align: left;
      font-size: clamp(24px, 3vw, 36px);
      margin-bottom: 24px;
    }

    .location-content p {
      font-size: 17px;
      line-height: 1.75;
      color: var(--ink-mid);
      margin-bottom: 16px;
    }

    .distance-list {
      margin-top: 32px;
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    .distance-item {
      display: flex;
      align-items: center;
      gap: 20px;
      padding: 14px 0;
      border-bottom: 1px solid var(--green-pale);
    }

    .distance-item:first-child {
      border-top: 1px solid var(--green-pale);
    }

    .distance-icon {
      font-size: 16px;
      flex-shrink: 0;
    }

    .distance-info {
      flex: 1;
    }

    .distance-name {
      font-size: 14.5px;
      color: var(--ink);
      line-height: 1.3;
    }

    .distance-sub {
      font-size: 12px;
      font-style: italic;
      color: var(--mist);
      margin-top: 2px;
    }

    .distance-time {
      font-family: 'Cinzel', serif;
      font-size: 12px;
      letter-spacing: 0.06em;
      color: var(--green);
      font-weight: 600;
      flex-shrink: 0;
    }

    /* Map placeholder */
    .map-placeholder {
      background: var(--green);
      aspect-ratio: 4/3;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .map-placeholder::before {
      content: '';
      position: absolute;
      inset: 0;
      background: repeating-linear-gradient(0deg, transparent, transparent 40px,
          rgba(255, 255, 255, 0.03) 40px, rgba(255, 255, 255, 0.03) 41px),
        repeating-linear-gradient(90deg, transparent, transparent 40px,
          rgba(255, 255, 255, 0.03) 40px, rgba(255, 255, 255, 0.03) 41px);
    }

    .map-pin {
      position: relative;
      z-index: 1;
      text-align: center;
    }

    .map-pin-dot {
      width: 16px;
      height: 16px;
      background: var(--gold);
      border-radius: 50%;
      margin: 0 auto 8px;
      box-shadow: 0 0 0 6px rgba(199, 168, 94, 0.25);
      animation: pinPulse 2s ease-in-out infinite;
    }

    .map-pin-label {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.15em;
      color: rgba(255, 255, 255, 0.7);
      text-transform: uppercase;
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


    @keyframes waPulse {
      0% {
        transform: scale(1);
        opacity: 0.8;
      }

      70% {
        transform: scale(1.5);
        opacity: 0;
      }

      100% {
        transform: scale(1.5);
        opacity: 0;
      }
    }

    /* ═══════════════════════════════════════════════════════════════
   ANIMATIONS
═══════════════════════════════════════════════════════════════ */
    @keyframes riseIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes scrollPulse {

      0%,
      100% {
        opacity: 0.4;
        transform: scaleY(1);
      }

      50% {
        opacity: 0.8;
        transform: scaleY(1.2);
      }
    }

    @keyframes pinPulse {

      0%,
      100% {
        box-shadow: 0 0 0 6px rgba(199, 168, 94, 0.25);
      }

      50% {
        box-shadow: 0 0 0 12px rgba(199, 168, 94, 0.1);
      }
    }

    /* Scroll reveal */
    .reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .reveal-delay-1 {
      transition-delay: 0.1s;
    }

    .reveal-delay-2 {
      transition-delay: 0.2s;
    }

    .reveal-delay-3 {
      transition-delay: 0.3s;
    }

    .reveal-delay-4 {
      transition-delay: 0.4s;
    }

    /* ═══════════════════════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════════════════════ */
    @media (max-width: 1024px) {
      .trail-inner {
        grid-template-columns: 1fr;
        gap: 48px;
      }

      .experience-list {
        grid-template-columns: repeat(2, 1fr);
      }

      .location-inner {
        grid-template-columns: 1fr;
      }

      .footer-top {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 768px) {
      nav {
        padding: 0 24px;
      }

      .nav-links {
        display: none;
      }

      .hero-content {
        padding: 0 6vw 10vh;
      }

      .hero-estate {
        letter-spacing: 0.12em;
        font-size: 9px;
        line-height: 1.5;
        margin-bottom: 14px;
        word-break: break-word;
      }

      .hero-title {
        font-size: clamp(34px, 9vw, 52px);
      }

      .hero-btns {
        flex-direction: column;
        width: 100%;
        gap: 12px;
      }

      .btn-primary, .btn-secondary {
        text-align: center;
        width: 100%;
        box-sizing: border-box;
      }

      .hero-badge {
        display: none;
      }

      .stay-cards {
        grid-template-columns: 1fr;
      }

      .estate-grid {
        grid-template-columns: 1fr;
      }

      .heritage-inner {
        grid-template-columns: 1fr;
        gap: 32px;
      }

      .heritage-divider {
        display: none;
      }

      .experience-list {
        grid-template-columns: 1fr;
      }

      .location-section {
        padding: 60px 20px;
      }

      .location-inner {
        grid-template-columns: 1fr;
        min-width: 0;
        width: 100%;
        gap: 36px;
      }

      .location-content,
      .map-placeholder {
        min-width: 0;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
      }

      .footer-top {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>

  <!-- ═══════ NAV ═══════ -->
  <?php include 'layout/navbar.php'; ?>


  <!-- ═══════ HERO ═══════ -->
  <section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-texture"></div>
    <div class="hero-mist"></div>

    <div class="hero-badge">
      <div class="hero-badge-circle">
        <div class="hero-badge-year">1890</div>
        <div class="hero-badge-label">Est.</div>
      </div>
    </div>

    <div class="hero-content">
      <div class="hero-estate">Galaha Estate · Sri Lanka · Old Ceylon Heritage Collection</div>
      <h1 class="hero-title">
        The Tea<br>
        <em>Bungalow</em>
      </h1>
      <div class="hero-rule"></div>
      <p class="hero-tagline">
        Where tea country becomes home. A restored 1890 colonial planter's residence, “perfectly placed on the Pekoe Trail”.
      </p>
      <div class="hero-btns">
        <a href="/vD/our-chambers.php" class="btn-primary">Browse Chambers</a>
        <a href="/vD/pekoe-trail.php" class="btn-secondary">Pekoe Trail Base</a>
      </div>

      <!-- Hero Availability Bar (Phase 2 Live Engine Entry) -->
      <div class="hero-avail-wrap">
        <div class="hero-avail-label">Check Availability</div>
        <div class="hero-booking-bar">
          <div class="hbb-field">
            <div class="hbb-field-icon">📅</div>
            <label class="hbb-label" for="hbbArrival">Arrival</label>
            <input type="date" id="hbbArrival" class="hbb-input">
          </div>
          <div class="hbb-divider"></div>
          <div class="hbb-field">
            <div class="hbb-field-icon">📅</div>
            <label class="hbb-label" for="hbbDeparture">Departure</label>
            <input type="date" id="hbbDeparture" class="hbb-input">
          </div>
          <div class="hbb-divider"></div>
          <div class="hbb-field">
            <div class="hbb-field-icon">🏡</div>
            <label class="hbb-label" for="hbbChamber">Chamber</label>
            <select id="hbbChamber" class="hbb-select">
              <option value="All Chambers">Any Available</option>
              <option value="The Founder's Suite">01 · Founder's Suite</option>
              <option value="The Highlands Suite">02 · Highlands Suite</option>
              <option value="The Pekoe Room">03 · Pekoe Room</option>
              <option value="The Verandah Chamber">04 · Verandah Chamber</option>
              <option value="The Camellia Room">05 · Camellia Room</option>
              <option value="The Galaha Room">06 · Galaha Room</option>
              <option value="The Carriage House Cottage">07 · Carriage House</option>
            </select>
          </div>
          <div class="hbb-divider"></div>
          <div class="hbb-field">
            <div class="hbb-field-icon">👥</div>
            <label class="hbb-label" for="hbbGuests">Guests</label>
            <select id="hbbGuests" class="hbb-select">
              <option value="1">1 Guest</option>
              <option value="2" selected>2 Guests</option>
              <option value="3">3 Guests</option>
              <option value="4">4 Guests</option>
              <option value="8">8 Guests</option>
            </select>
          </div>
          <div class="hbb-btn-wrap">
            <button type="button" class="hbb-btn tb-reserve-trigger" id="hbbSubmitBtn" data-source="hero_booking_bar">
              <span>Check Rates</span>
              <span aria-hidden="true">→</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="hero-scroll">
      <div class="hero-scroll-line"></div>
      <span>Discover</span>
    </div>
  </section>

  <!-- ═══════ INTRO PULL QUOTE ═══════ -->
  <section class="intro-strip">
    <div class="intro-strip-inner">
      <div class="intro-strip-rule"></div>
      <p>
        “There is a moment in the hills when the mist lifts slowly from the tea. The light softens. The air cools. And the house begins to wake.”
      </p>
      <div class="intro-strip-rule"></div>
      <div class="intro-strip-tag">Not a hotel. A house in the hills.</div>
    </div>
  </section>

  <!-- ═══════ CHOOSE YOUR STAY ═══════ -->
  <section class="choose-stay" id="stay">
    <div class="section-eyebrow" data-reveal="clip">Choose Your Experience</div>
    <h2 class="section-title" data-reveal="fade-up" data-reveal-delay="80">Two Ways to Stay</h2>
    <p class="section-sub" data-reveal="fade-up" data-reveal-delay="180">Book an individual chamber for a personal retreat, or reserve the entire estate for complete privacy.</p>

    <div class="stay-cards" data-reveal="stagger" data-reveal-delay="120">
      <div class="stay-card stay-card-a">
        <div class="stay-card-accent"></div>
        <span class="stay-card-icon">🛏️</span>
        <div class="stay-card-type">Individual</div>
        <div class="stay-card-name">An Estate Chamber</div>
        <p class="stay-card-desc">Six individually named rooms, each with its own character. Shared verandahs, gardens, and the long table, where trail stories are exchanged over dinner.</p>
        <ul class="stay-card-features">
          <li>Ideal for solo hikers, couples, or pairs</li>
          <li>Shared access to verandah, pool, Planter's Lounge</li>
          <li>Perfect base for Pekoe Trail Stages 1, 2 & 3</li>
          <li>Current rates available on request</li>
        </ul>
        <a href="/vD/our-chambers.php" class="stay-card-btn">Browse Chambers</a>
      </div>
      <div class="stay-card stay-card-b">
        <div class="stay-card-accent"></div>
        <span class="stay-card-icon">🏛️</span>
        <div class="stay-card-type">Exclusive</div>
        <div class="stay-card-name">The Entire Estate</div>
        <p class="stay-card-desc">No other guests. No imposed schedules. The full bungalow, garden, Carriage House Cottage, Planter's Lounge and fireplace — entirely yours.</p>
        <ul class="stay-card-features">
          <li>Families, groups, and private celebrations</li>
          <li>Up to 12 guests across all rooms and cottage</li>
          <li>Private chef, dedicated transfers, full staff</li>
          <li>Multi-generational — fully accessible rooms</li>
        </ul>
        <a href="/vD/the-entire-estate.php#enquire" class="stay-card-btn">Reserve the Estate</a>
      </div>
    </div>
  </section>

  <!-- ═══════ PEKOE TRAIL HOOK ═══════ -->
  <section class="trail-section" id="trail">
    <div class="trail-inner">
      <div class="trail-content">
        <div class="section-eyebrow" data-reveal="clip">Stages 1, 2 & 3</div>
        <h2 class="section-title" data-reveal="fade-up" data-reveal-delay="80">Your Pekoe Trail Base</h2>
        <p data-reveal="fade-left" data-reveal-delay="160">
          <strong>Walk Stage 1, stay the night, walk Stage 2 from our front door.</strong> The Tea Bungalow sits directly between the end of Stage 1 at Galaha Post Office and the start of Stage 2 — five minutes from your boots to the trail.
        </p>
        <p data-reveal="fade-left" data-reveal-delay="280">
          Stage 3 starts just 20 minutes away by car. We offer full trail logistics — transfers, luggage collection, packed lunches, and trail briefings — so you carry only a daypack.
        </p>
        <div class="trail-hooks" data-reveal="stagger" data-reveal-delay="200">
          <div class="trail-hook">We move your bags. You enjoy the trail.</div>
          <div class="trail-hook">Pickup from Kandy or Peradeniya Station</div>
          <div class="trail-hook">Early breakfast from 6:30 AM</div>
          <div class="trail-hook">Packed lunches prepared the night before</div>
          <div class="trail-hook">Leech socks, trail briefing & weather updates</div>
        </div>
        <div class="trail-cta-row" data-reveal="fade-up" data-reveal-delay="360">
          <a href="/vD/packages.php" class="btn-green">View Hiker Packages</a>
          <a href="/vD/pekoe-trail.php" class="link-text">Full trail information →</a>
        </div>
      </div>

      <div class="trail-stages" data-reveal="fade-right" data-reveal-delay="100">
        <div class="trail-stage">
          <div class="trail-stage-num">1</div>
          <div class="trail-stage-info">
            <div class="trail-stage-name">Hanthana → Galaha</div>
            <div class="trail-stage-route">Ceylon Tea Museum to Galaha Post Office</div>
            <div class="trail-stage-meta">12.84 km · ~4 hours · Drop-off ~20 min</div>
          </div>
          <div class="trail-stage-badge badge-easy">Easy</div>
        </div>
        <div class="trail-stage" style="background:#f5f1e9; border-left: 4px solid var(--green);">
          <div class="trail-stage-num" style="color:var(--green-pale); opacity:0.5">⌂</div>
          <div class="trail-stage-info">
            <div class="trail-stage-name" style="color:var(--gold)">The Tea Bungalow</div>
            <div class="trail-stage-route" style="font-style:normal; color:var(--green); font-size:13px;">Galaha Estate · Your base between stages</div>
            <div class="trail-stage-meta">Walking distance · Stage 1 pick-up included</div>
          </div>
          <div class="trail-stage-badge" style="background:#eaf5ed; color:#1e6e38; font-family:'Cinzel',serif; font-size:9px; letter-spacing:0.15em; padding:4px 10px;">You Are Here</div>
        </div>
        <div class="trail-stage">
          <div class="trail-stage-num">2</div>
          <div class="trail-stage-info">
            <div class="trail-stage-name">Galaha → Loolecondera</div>
            <div class="trail-stage-route">Birthplace of Ceylon Tea · James Taylor's Estate</div>
            <div class="trail-stage-meta">14.7 km · ~5 hours · Start from our door</div>
          </div>
          <div class="trail-stage-badge badge-difficult">Difficult</div>
        </div>
        <div class="trail-stage">
          <div class="trail-stage-num">3</div>
          <div class="trail-stage-info">
            <div class="trail-stage-name">Loolecondera → Uda Peradeniya</div>
            <div class="trail-stage-route">Onwards through the highlands</div>
            <div class="trail-stage-meta">~15 km · ~5–6 hours · Drop-off ~20 min</div>
          </div>
          <div class="trail-stage-badge badge-moderate">Moderate</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════ ESTATE ROOMS ═══════ -->
  <section class="estate-section">
    <div class="section-eyebrow" data-reveal="clip">The Estate Chambers</div>
    <h2 class="section-title" data-reveal="fade-up" data-reveal-delay="80">Six Rooms, One House</h2>
    <p class="section-sub" data-reveal="fade-up" data-reveal-delay="180">Each chamber holds its own character, named for the heritage of the estate and the land.</p>

    <div class="estate-grid">
      <div class="estate-room estate-room-featured" data-reveal="zoom">
        <div class="room-tag">Principal Chamber</div>
        <div class="room-name">The Founder's Suite</div>
        <p class="room-desc">The most distinguished room in the house. Opens onto its own private verandah with direct access to the pool.</p>
        <div class="room-features">
          <div class="room-feature">
            <div class="room-feature-dot"></div>Private verandah with pool access
          </div>
          <div class="room-feature">
            <div class="room-feature-dot"></div>Fully accessible · Step-free throughout
          </div>
          <div class="room-feature">
            <div class="room-feature-dot"></div>Private tea service on verandah
          </div>
        </div>
        <a href="/vD/our-chambers.php#founders" class="room-link">View this Chamber →</a>
      </div>

      <div class="estate-room" data-reveal="fade-up" data-reveal-delay="90">
        <div class="room-tag">Family Wing</div>
        <div class="room-name">The Highlands Suite</div>
        <p class="room-desc">Elevated and cool. Connects to the Pekoe Room via dressing room to form a private family wing for 6–8 guests.</p>
        <div class="room-features">
          <div class="room-feature">
            <div class="room-feature-dot"></div>Fully accessible · Wide circulation
          </div>
          <div class="room-feature">
            <div class="room-feature-dot"></div>Connects to Pekoe Room as family wing
          </div>
        </div>
        <a href="/vD/our-chambers.php#highlands" class="room-link">View this Chamber →</a>
      </div>

      <div class="estate-room" data-reveal="fade-up" data-reveal-delay="180">
        <div class="room-tag">Carriage House</div>
        <div class="room-name">The Cottage</div>
        <p class="room-desc">A former estate outbuilding, now a fully stepless 2-bedroom cottage with its own living, dining, and cooking facilities.</p>
        <div class="room-features">
          <div class="room-feature">
            <div class="room-feature-dot"></div>The Saddle Room & The Lantern Room
          </div>
          <div class="room-feature">
            <div class="room-feature-dot"></div>Private living & dining space
          </div>
        </div>
        <a href="/vD/our-chambers.php#cottage" class="room-link">View the Cottage →</a>
      </div>
    </div>

    <div class="estate-more" data-reveal="fade-up" data-reveal-delay="80">
      <a href="/vD/our-chambers.php">View all six chambers and the Carriage House Cottage →</a>
    </div>
  </section>

  <!-- ═══════ HERITAGE STATS ═══════ -->
  <section class="heritage-strip">
    <div class="heritage-inner">
      <div class="heritage-stat" data-reveal="zoom">
        <div class="heritage-stat-num">circa 1890</div>
        <div class="heritage-stat-label">Colonial planter's bungalow — built in the golden era of Ceylon Tea</div>
      </div>
      <div class="heritage-divider"></div>
      <div class="heritage-stat" data-reveal="zoom" data-reveal-delay="120">
        <div class="heritage-stat-num">5 km</div>
        <div class="heritage-stat-label">From Loolecondera Estate — where James Taylor planted the first Ceylon tea in 1867</div>
      </div>
      <div class="heritage-divider"></div>
      <div class="heritage-stat" data-reveal="zoom" data-reveal-delay="240">
        <div class="heritage-stat-num">Stages 1–3</div>
        <div class="heritage-stat-label">Of the Pekoe Trail covered from a single, seamless base</div>
      </div>
    </div>
  </section>

  <!-- ═══════ EXPERIENCES ═══════ -->
  <section class="experiences-section">
    <div class="section-eyebrow" data-reveal="clip">Life on the Estate</div>
    <h2 class="section-title" data-reveal="fade-up" data-reveal-delay="80">Experiences</h2>
    <p class="section-sub" data-reveal="fade-up" data-reveal-delay="180">From trail briefings at dawn to fireside dinners after dark.</p>

    <div class="experience-list">
      <div class="exp-card" data-reveal="fade-up">
        <span class="exp-icon">🔥</span>
        <div class="exp-name">Fireside Evening</div>
        <p class="exp-desc">Armchairs, Ceylon arrack, and the original stone fireplace lit by 6:30 PM.</p>
        <div class="exp-price">Planter's Lounge · Complimentary</div>
      </div>
      <div class="exp-card" data-reveal="fade-up" data-reveal-delay="90">
        <span class="exp-icon">🍵</span>
        <div class="exp-name">Planter's Afternoon Tea</div>
        <p class="exp-desc">Three-tier tea service on the verandah with estate-fresh Ceylon tea tasting.</p>
      </div>
      <div class="exp-card" data-reveal="fade-up" data-reveal-delay="180">
        <span class="exp-icon">🌿</span>
        <div class="exp-name">Tea Estate Walk</div>
        <p class="exp-desc">A guided hour through Galaha Estate tea fields. The history beneath your feet.</p>
      </div>
      <div class="exp-card" data-reveal="fade-up" data-reveal-delay="270">
        <span class="exp-icon">🌙</span>
        <div class="exp-name">Private Fireside Dinner</div>
        <p class="exp-desc">Exclusive use of the Planter's Lounge. Three courses for two, by firelight.</p>
      </div>
    </div>
  </section>

  <!-- ═══════ SOFT OPENING PROMO ═══════ -->
  <div class="promo-banner" data-reveal="zoom">
    <div class="promo-inner">
      <div class="promo-tag">Introductory Offer</div>
      <p class="promo-text">
        <strong>Double BB — $75 introductory rate.</strong> Enquire for availability, packages, and tailored arrangements.
      </p>
      <a href="/vD/packages.php" class="promo-cta">View Offers</a>
    </div>
  </div>

  <!-- ═══════ LOCATION ═══════ -->
  <section class="location-section">
    <div class="location-inner">
      <div class="location-content">
        <div class="section-eyebrow" data-reveal="clip">Getting Here</div>
        <h2 class="section-title" data-reveal="fade-up" data-reveal-delay="80">Find Us in the Hills</h2>
        <p data-reveal="fade-left" data-reveal-delay="160">Galaha Estate sits in Sri Lanka's central highlands, approximately 45 minutes from Kandy. We offer private transfers from Kandy city, Kandy Railway Station, and Peradeniya Station.</p>

        <div class="distance-list" data-reveal="stagger" data-reveal-delay="200">
          <div class="distance-item">
            <div class="distance-icon">🚂</div>
            <div class="distance-info">
              <div class="distance-name">Peradeniya Railway Station</div>
              <div class="distance-sub">Transfer included in all packages</div>
            </div>
            <div class="distance-time">~45 min</div>
          </div>
          <div class="distance-item">
            <div class="distance-icon">🏙️</div>
            <div class="distance-info">
              <div class="distance-name">Kandy City / Temple of the Tooth</div>
              <div class="distance-sub">Transfer on request</div>
            </div>
            <div class="distance-time">~45 min</div>
          </div>
          <div class="distance-item">
            <div class="distance-icon">🥾</div>
            <div class="distance-info">
              <div class="distance-name">Pekoe Trail Stage 1 End</div>
              <div class="distance-sub">Galaha Post Office — pick-up included</div>
            </div>
            <div class="distance-time">5 min</div>
          </div>
          <div class="distance-item">
            <div class="distance-icon">🍃</div>
            <div class="distance-info">
              <div class="distance-name">Stage 2 Start / Stage 1 Museum</div>
              <div class="distance-sub">Drop-off service included</div>
            </div>
            <div class="distance-time">On-site / 20 min</div>
          </div>
          <div class="distance-item">
            <div class="distance-icon">🌱</div>
            <div class="distance-info">
              <div class="distance-name">Loolecondera Estate</div>
              <div class="distance-sub">Birthplace of Ceylon Tea · James Taylor memorial</div>
            </div>
            <div class="distance-time">~20 min</div>
          </div>
        </div>
      </div>

      <div class="map-placeholder" data-reveal="fade-right" data-reveal-delay="120" style="position: relative; overflow: hidden; min-height: 380px;">
        <iframe
          title="Map to The Tea Bungalow, Galaha Estate"
          src="https://www.google.com/maps?q=The%20Tea%20Bungalow%2C%20Moragolla%20Road%2C%20Galaha%2C%20Sri%20Lanka&output=embed"
          width="100%" height="100%" style="border:0; position:absolute; inset:0; min-height:380px;" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
      </div>
    </div>
  </section>

  <!-- ═══════ FOOTER ═══════ -->
  <?php include 'layout/footer.php'; ?>

  <script>
    // Sticky nav
    const nav = document.getElementById('nav');
    window.addEventListener('scroll', () => {
      nav.classList.toggle('scrolled', window.scrollY > 60);
    });

    // Hero Bar — sync date & room selections into the modal on open
    const hbbArr = document.getElementById('hbbArrival');
    const hbbDep = document.getElementById('hbbDeparture');
    const hbbChamber = document.getElementById('hbbChamber');
    const hbbGuests = document.getElementById('hbbGuests');

    if (hbbArr && hbbDep) {
      const today = new Date();
      const tmrw = new Date(today); tmrw.setDate(tmrw.getDate() + 1);
      const plus3 = new Date(today); plus3.setDate(plus3.getDate() + 3);
      const fmt = d => `${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')}`;
      hbbArr.min = fmt(tmrw);  hbbArr.value  = fmt(tmrw);
      hbbDep.min = fmt(plus3); hbbDep.value  = fmt(plus3);
    }

    // When Check Rates is clicked, sync hero bar values into the modal and open it
    document.addEventListener('click', function(e) {
      var btn = e.target.closest('#hbbSubmitBtn');
      if (!btn) return;
      e.preventDefault();
      // Sync to modal inputs
      var ciEl = document.getElementById('tbCheckIn');
      var coEl = document.getElementById('tbCheckOut');
      var rs   = document.getElementById('tbRoomSelect');
      var gs   = document.getElementById('tbGuestsCount');
      if (ciEl && hbbArr) ciEl.value = hbbArr.value;
      if (coEl && hbbDep) coEl.value = hbbDep.value;
      var selectedChamber = (hbbChamber && hbbChamber.value !== 'All Chambers') ? hbbChamber.value : '';
      if (rs && selectedChamber) {
        for (var i = 0; i < rs.options.length; i++) {
          if (rs.options[i].value === selectedChamber) { rs.selectedIndex = i; break; }
        }
      }
      if (gs && hbbGuests) gs.value = hbbGuests.value;
      if (typeof window.updateStayQuote === 'function') window.updateStayQuote();
      if (typeof window.openReserveModal === 'function') {
        window.openReserveModal('hero_booking_bar', selectedChamber);
      }
    });
  </script>
</body>

</html>