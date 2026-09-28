<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Bungalow · A Colonial Planter's Estate · The Tea Bungalow Galaha</title>

<link rel="icon" type="image/png" href="images/favicon.png">
<meta property="og:type" content="website">
<meta property="og:title" content="The Bungalow · Colonial Heritage · The Tea Bungalow">
<meta property="og:description" content="Explore the colonial bungalow itself — a circa-1890 planters' estate with original architecture, verandahs, and sweeping tea estate views.">
<meta property="og:url" content="https://www.theteabungalow.com/the-bungalow">
<meta property="og:image" content="https://www.theteabungalow.com/images/heroimg-1.jpeg">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="The Bungalow · Colonial Heritage · The Tea Bungalow">
<meta name="twitter:description" content="Explore the colonial bungalow itself — a circa-1890 planters' estate with original architecture, verandahs, and sweeping tea estate views.">
<link rel="canonical" href="https://www.theteabungalow.com/the-bungalow">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">
  <style>
    /* ════════════════════════════════════════════════════════
   ROOT & RESET
════════════════════════════════════════════════════════ */
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
      --shadow: rgba(30, 77, 43, 0.14);
    }

    body {
      background: var(--cream);
      font-family: 'EB Garamond', Georgia, serif;
      color: var(--ink);
      overflow-x: hidden;
    }

    /* grain */
    body::after {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 9999;
    }

    /* ════════════════════════════════════════════════════════
   NAV
════════════════════════════════════════════════════════ */
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
      background: rgba(245, 241, 233, 0.97);
      backdrop-filter: blur(14px);
      border-bottom: 1px solid rgba(30, 77, 43, 0.08);
      box-shadow: 0 1px 24px rgba(30, 77, 43, 0.06);
    }

    .nav-logo {
      font-family: 'Cinzel', serif;
      font-size: 15px;
      font-weight: 600;
      letter-spacing: 0.12em;
      color: var(--green);
      text-decoration: none;
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
      color: var(--ink-mid);
      text-decoration: none;
      transition: color 0.2s;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: var(--green);
    }

    .nav-links a.active {
      border-bottom: 1px solid var(--gold);
      padding-bottom: 2px;
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

    /* ════════════════════════════════════════════════════════
   PAGE HEADER
════════════════════════════════════════════════════════ */
    .page-header {
      margin-top: 72px;
      position: relative;
      height: 72vh;
      min-height: 560px;
      display: flex;
      align-items: flex-end;
      overflow: hidden;
    }

    .page-header-bg {
      position: absolute;
      inset: 0;
      background:
        linear-gradient(180deg,
          rgba(10, 28, 15, 0.55) 0%,
          rgba(10, 28, 15, 0.45) 25%,
          rgba(10, 28, 15, 0.75) 65%,
          rgba(10, 28, 15, 0.96) 100%),
        url('images/house.jpeg') center/cover no-repeat;
    }

    /* Subtle plank texture suggestion */
    .page-header-texture {
      position: absolute;
      inset: 0;
      background-image: repeating-linear-gradient(90deg,
          transparent 0px, transparent 80px,
          rgba(255, 255, 255, 0.04) 80px, rgba(255, 255, 255, 0.04) 82px);
      pointer-events: none;
    }

    .page-header-content {
      position: relative;
      z-index: 2;
      width: 100%;
      padding: 0 10vw 64px;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
      gap: 40px;
    }

    .page-header-left {}

    .page-header-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold-light);
      text-transform: uppercase;
      margin-bottom: 14px;
      opacity: 0;
      animation: riseIn 0.9s 0.2s ease forwards;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.9);
    }

    .page-header-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(40px, 6vw, 74px);
      font-weight: 700;
      color: var(--white);
      line-height: 1.0;
      letter-spacing: 0.02em;
      opacity: 0;
      animation: riseIn 0.9s 0.4s ease forwards;
      text-shadow: 0 2px 14px rgba(0, 0, 0, 0.7), 0 1px 3px rgba(0, 0, 0, 0.9);
    }

    .page-header-title em {
      display: block;
      font-style: normal;
      color: var(--gold-light);
    }

    .page-header-rule {
      width: 50px;
      height: 1px;
      background: var(--gold);
      margin: 22px 0;
      opacity: 0;
      animation: riseIn 0.9s 0.55s ease forwards;
    }

    .page-header-sub {
      font-size: clamp(16px, 1.8vw, 20px);
      font-style: italic;
      color: rgba(255, 255, 255, 0.72);
      max-width: 480px;
      line-height: 1.55;
      opacity: 0;
      animation: riseIn 0.9s 0.7s ease forwards;
    }

    .page-header-right {
      flex-shrink: 0;
      opacity: 0;
      animation: riseIn 0.9s 0.9s ease forwards;
    }

    .estate-plate {
      border: 1px solid rgba(199, 168, 94, 0.5);
      padding: 20px 28px;
      text-align: center;
      min-width: 160px;
    }

    .estate-plate-year {
      font-family: 'Cinzel', serif;
      font-size: 32px;
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
      margin-bottom: 4px;
    }

    .estate-plate-label {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.3em;
      color: rgba(255, 255, 255, 0.45);
      text-transform: uppercase;
    }

    /* ════════════════════════════════════════════════════════
   BREADCRUMB
════════════════════════════════════════════════════════ */
    .breadcrumb {
      background: var(--green);
      padding: 14px 10vw;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .breadcrumb a,
    .breadcrumb span {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.5);
      text-decoration: none;
      transition: color 0.2s;
    }

    .breadcrumb a:hover {
      color: var(--gold);
    }

    .breadcrumb .sep {
      color: rgba(199, 168, 94, 0.4);
    }

    .breadcrumb .current {
      color: var(--gold);
    }

    /* ════════════════════════════════════════════════════════
   ESTATE NARRATIVE — ARRIVAL SEQUENCE
════════════════════════════════════════════════════════ */
    .arrival-section {
      padding: 100px 10vw;
      background: var(--cream);
      position: relative;
    }

    .arrival-inner {
      display: grid;
      grid-template-columns: 1fr 1.6fr;
      gap: 80px;
      align-items: start;
      max-width: 1140px;
      margin: 0 auto;
    }

    .arrival-label {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 16px;
    }

    .arrival-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 3.2vw, 40px);
      font-weight: 600;
      color: var(--green);
      line-height: 1.15;
      margin-bottom: 28px;
    }

    .arrival-body {
      font-size: 18px;
      line-height: 1.85;
      color: var(--ink-mid);
      margin-bottom: 20px;
    }

    .arrival-body strong {
      color: var(--green);
      font-weight: 600;
    }

    /* Sticky sidebar — estate key facts */
    .arrival-facts {
      position: sticky;
      top: 100px;
    }

    .fact-card {
      background: var(--white);
      border: 1px solid var(--green-pale);
      border-top: 3px solid var(--green);
      padding: 28px 24px;
      margin-bottom: 16px;
    }

    .fact-card-label {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.35em;
      color: var(--mist);
      text-transform: uppercase;
      margin-bottom: 6px;
    }

    .fact-card-value {
      font-family: 'Cinzel', serif;
      font-size: 20px;
      font-weight: 600;
      color: var(--green);
      margin-bottom: 4px;
    }

    .fact-card-note {
      font-size: 13px;
      font-style: italic;
      color: var(--ink-light);
      line-height: 1.4;
    }

    .fact-card-gold {
      border-top-color: var(--gold);
    }

    .fact-card-gold .fact-card-value {
      color: #8a6a2a;
    }

    /* ════════════════════════════════════════════════════════
   ESTATE FLOOR PLAN — ROOM-BY-ROOM NARRATIVE
════════════════════════════════════════════════════════ */
    .floorplan-section {
      background: var(--ink);
      padding: 100px 10vw;
      position: relative;
      overflow: hidden;
    }

    .floorplan-section::before {
      content: 'THE ESTATE';
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font-family: 'Cinzel', serif;
      font-size: 140px;
      font-weight: 700;
      color: rgba(255, 255, 255, 0.025);
      letter-spacing: 0.1em;
      white-space: nowrap;
      pointer-events: none;
    }

    .floorplan-header {
      text-align: center;
      margin-bottom: 72px;
    }

    .floorplan-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 14px;
    }

    .floorplan-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 3.5vw, 44px);
      font-weight: 600;
      color: var(--white);
      line-height: 1.15;
    }

    .floorplan-sub {
      font-size: 18px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.5);
      margin-top: 14px;
      line-height: 1.6;
    }

    /* The room flow — alternating layout */
    .room-flow {
      max-width: 1000px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .room-item {
      display: grid;
      grid-template-columns: 80px 1fr;
      gap: 0;
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.06);
      border-left: 3px solid rgba(199, 168, 94, 0.3);
      transition: background 0.25s, border-left-color 0.25s;
      cursor: default;
    }

    .room-item:hover {
      background: rgba(255, 255, 255, 0.06);
      border-left-color: var(--gold);
    }

    .room-item-num {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 28px 0;
      border-right: 1px solid rgba(255, 255, 255, 0.06);
    }

    .room-num-text {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.15em;
      color: rgba(199, 168, 94, 0.4);
      text-transform: uppercase;
      writing-mode: vertical-rl;
      transform: rotate(180deg);
    }

    .room-item-body {
      padding: 28px 32px;
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 24px;
      align-items: start;
    }

    .room-item-text {}

    .room-item-tag {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.4em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 8px;
    }

    .room-item-name {
      font-family: 'Cinzel', serif;
      font-size: 20px;
      font-weight: 600;
      color: var(--white);
      margin-bottom: 10px;
      line-height: 1.15;
    }

    .room-item-desc {
      font-size: 16px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.6);
      line-height: 1.65;
      margin-bottom: 14px;
    }

    .room-item-features {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .room-feature-pill {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: rgba(199, 168, 94, 0.7);
      border: 1px solid rgba(199, 168, 94, 0.2);
      padding: 4px 10px;
      border-radius: 1px;
    }

    .room-item-arrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.2em;
      color: rgba(199, 168, 94, 0.4);
      margin-top: 4px;
      white-space: nowrap;
      align-self: center;
      transition: color 0.2s;
    }

    .room-item:hover .room-item-arrow {
      color: var(--gold);
    }

    /* Connector arrow between rooms */
    .room-connector {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 32px;
      position: relative;
    }

    .room-connector::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 1px;
      height: 100%;
      background: linear-gradient(to bottom, rgba(199, 168, 94, 0.2), rgba(199, 168, 94, 0.5), rgba(199, 168, 94, 0.2));
    }

    .room-connector-label {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.3em;
      color: rgba(199, 168, 94, 0.4);
      text-transform: uppercase;
      background: var(--ink);
      padding: 0 12px;
      position: relative;
      z-index: 1;
    }

    /* ════════════════════════════════════════════════════════
   SPACES — SHARED LIVING AREAS
════════════════════════════════════════════════════════ */
    .spaces-section {
      padding: 100px 10vw;
      background: var(--cream-dark);
    }

    .spaces-header {
      text-align: center;
      margin-bottom: 64px;
    }

    .spaces-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 14px;
    }

    .spaces-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(26px, 3.2vw, 40px);
      font-weight: 600;
      color: var(--green);
      line-height: 1.15;
    }

    .spaces-sub {
      font-size: 17px;
      font-style: normal;
      color: var(--ink-mid);
      margin-top: 12px;
      line-height: 1.65;
      max-width: 580px;
      margin-left: auto;
      margin-right: auto;
    }

    .spaces-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      max-width: 1160px;
      margin: 0 auto;
    }

    .space-card {
      background: var(--white);
      padding: 34px 28px 28px;
      border-radius: 8px;
      border: 1px solid rgba(30, 77, 43, 0.12);
      border-top: 3px solid var(--gold);
      box-shadow: 0 4px 18px rgba(30, 77, 43, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
      cursor: default;
      position: relative;
      display: flex;
      flex-direction: column;
    }

    .space-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 14px 32px rgba(30, 77, 43, 0.12);
      border-color: rgba(199, 168, 94, 0.45);
      border-top-color: var(--green);
    }

    .space-card-icon {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--green-ghost);
      border: 1px solid rgba(30, 77, 43, 0.14);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      margin-bottom: 20px;
      transition: transform 0.3s ease, background 0.3s ease, border-color 0.3s ease;
    }

    .space-card:hover .space-card-icon {
      transform: scale(1.08);
      background: var(--gold-pale);
      border-color: var(--gold);
    }

    .space-card-tag {
      font-family: 'Cinzel', serif;
      font-size: 9.5px;
      letter-spacing: 0.3em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 8px;
      font-weight: 600;
    }

    .space-card-name {
      font-family: 'Cinzel', serif;
      font-size: 18px;
      font-weight: 600;
      color: var(--green);
      margin-bottom: 12px;
      line-height: 1.25;
      letter-spacing: 0.03em;
    }

    .space-card-desc {
      font-size: 15.5px;
      font-style: normal;
      color: var(--ink-mid);
      line-height: 1.7;
      margin-bottom: 20px;
    }

    .space-card-detail {
      font-size: 13px;
      color: var(--ink-light);
      line-height: 1.55;
      border-top: 1px solid var(--green-pale);
      padding-top: 14px;
      margin-top: auto;
    }

    /* ════════════════════════════════════════════════════════
   POOL & GARDEN
════════════════════════════════════════════════════════ */
    .pool-section {
      padding: 0;
      background: var(--cream);
      display: grid;
      grid-template-columns: 1fr 1fr;
    }

    .pool-visual {
      background: url('images/swimming-pool-resort.jpg') center/cover no-repeat;
      min-height: 520px;
      position: relative;
      overflow: hidden;
      transition: transform 0.6s ease;
    }

    .pool-visual::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(to right, rgba(0, 0, 0, 0.15) 0%, transparent 45%, rgba(0, 0, 0, 0.08) 100%);
      pointer-events: none;
    }

    .pool-inner-ring,
    .pool-icon,
    .pool-grid-pattern {
      display: none !important;
    }

    .pool-content {
      padding: 72px 56px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .pool-content .spaces-eyebrow {
      text-align: left;
    }

    .pool-content .spaces-title {
      text-align: left;
      font-size: clamp(24px, 2.8vw, 36px);
    }

    .pool-content p {
      font-size: 17px;
      line-height: 1.8;
      color: var(--ink-mid);
      margin-top: 20px;
    }

    .pool-content p strong {
      color: var(--green);
    }

    .pool-note {
      margin-top: 28px;
      background: var(--gold-pale);
      border-left: 3px solid var(--gold);
      padding: 14px 18px;
      font-size: 14px;
      font-style: italic;
      color: #8a6a2a;
      line-height: 1.5;
    }

    /* ════════════════════════════════════════════════════════
   HERITAGE TIMELINE
════════════════════════════════════════════════════════ */
    .heritage-section {
      padding: 100px 10vw;
      background: var(--cream);
      position: relative;
    }

    .heritage-inner {
      max-width: 900px;
      margin: 0 auto;
    }

    .heritage-header {
      text-align: center;
      margin-bottom: 64px;
    }

    .heritage-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 14px;
    }

    .heritage-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(26px, 3.2vw, 40px);
      font-weight: 600;
      color: var(--green);
      line-height: 1.15;
    }

    .timeline {
      position: relative;
      padding-left: 40px;
    }

    .timeline::before {
      content: '';
      position: absolute;
      left: 8px;
      top: 8px;
      bottom: 8px;
      width: 1px;
      background: linear-gradient(to bottom, var(--gold), var(--green-pale), var(--gold));
    }

    .timeline-item {
      position: relative;
      margin-bottom: 48px;
      opacity: 0;
      transform: translateX(-16px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .timeline-item.visible {
      opacity: 1;
      transform: translateX(0);
    }

    .timeline-dot {
      position: absolute;
      left: -36px;
      top: 6px;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: var(--gold);
      border: 2px solid var(--cream);
      box-shadow: 0 0 0 3px rgba(199, 168, 94, 0.25);
    }

    .timeline-year {
      font-family: 'Cinzel', serif;
      font-size: 13px;
      font-weight: 600;
      color: var(--gold);
      letter-spacing: 0.08em;
      margin-bottom: 6px;
    }

    .timeline-title {
      font-family: 'Cinzel', serif;
      font-size: 17px;
      font-weight: 600;
      color: var(--green);
      margin-bottom: 8px;
      line-height: 1.25;
    }

    .timeline-body {
      font-size: 16px;
      font-style: italic;
      color: var(--ink-mid);
      line-height: 1.7;
    }

    .timeline-highlight {
      background: var(--gold-pale);
      border-left: 3px solid var(--gold);
    }

    .timeline-highlight .timeline-dot {
      background: var(--green);
    }

    .timeline-highlight .timeline-year {
      color: var(--green);
    }

    /* ════════════════════════════════════════════════════════
   ACCESSIBILITY NOTE
════════════════════════════════════════════════════════ */
    .access-strip {
      background: var(--green);
      padding: 48px 10vw;
    }

    .access-inner {
      max-width: 900px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      gap: 40px;
      flex-wrap: wrap;
    }

    .access-icon {
      font-size: 36px;
      flex-shrink: 0;
    }

    .access-content {
      flex: 1;
    }

    .access-title {
      font-family: 'Cinzel', serif;
      font-size: 16px;
      font-weight: 600;
      color: var(--white);
      letter-spacing: 0.04em;
      margin-bottom: 8px;
    }

    .access-body {
      font-size: 15px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.65);
      line-height: 1.6;
    }

    .access-list {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 12px;
    }

    .access-pill {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--gold);
      border: 1px solid rgba(199, 168, 94, 0.3);
      padding: 5px 12px;
    }

    /* ════════════════════════════════════════════════════════
   CTA — BOOK THE BUNGALOW
════════════════════════════════════════════════════════ */
    .book-cta {
      padding: 100px 10vw;
      background: var(--cream-dark);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .book-cta::before {
      content: '🍃';
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font-size: 480px;
      opacity: 0.03;
      pointer-events: none;
      line-height: 1;
    }

    .book-cta-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 16px;
    }

    .book-cta-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 4vw, 48px);
      font-weight: 700;
      color: var(--green);
      line-height: 1.1;
      margin-bottom: 20px;
    }

    .book-cta-sub {
      font-size: 19px;
      font-style: italic;
      color: var(--ink-light);
      max-width: 540px;
      margin: 0 auto 44px;
      line-height: 1.65;
    }

    .book-cta-btns {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 40px;
    }

    .btn-gold {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      background: var(--gold);
      color: var(--ink);
      padding: 16px 36px;
      text-decoration: none;
      border: 1px solid var(--gold);
      transition: background 0.25s, color 0.25s, transform 0.2s;
      display: inline-block;
    }

    .btn-gold:hover {
      background: var(--green);
      color: var(--white);
      border-color: var(--green);
      transform: translateY(-2px);
    }

    .btn-outline-green {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.22em;
      text-transform: uppercase;
      background: transparent;
      color: var(--green);
      padding: 16px 36px;
      text-decoration: none;
      border: 1px solid var(--green);
      transition: background 0.25s, color 0.25s, transform 0.2s;
      display: inline-block;
    }

    .btn-outline-green:hover {
      background: var(--green);
      color: var(--white);
      transform: translateY(-2px);
    }

    .book-cta-note {
      font-size: 13px;
      font-style: italic;
      color: var(--mist);
    }

    .book-cta-note a {
      color: var(--green);
      text-decoration: none;
      border-bottom: 1px solid var(--green-pale);
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

    /* ════════════════════════════════════════════════════════
   ANIMATIONS
════════════════════════════════════════════════════════ */
    @keyframes riseIn {
      from {
        opacity: 0;
        transform: translateY(18px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes poolRipple {

      0%,
      100% {
        transform: scale(1);
        opacity: 1;
      }

      50% {
        transform: scale(1.08);
        opacity: 0.6;
      }
    }

    .reveal {
      opacity: 0;
      transform: translateY(24px);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .rd1 {
      transition-delay: 0.08s;
    }

    .rd2 {
      transition-delay: 0.16s;
    }

    .rd3 {
      transition-delay: 0.24s;
    }

    .rd4 {
      transition-delay: 0.32s;
    }

    /* ════════════════════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════════════════════ */
    @media (max-width: 1024px) {
      .arrival-inner {
        grid-template-columns: 1fr;
      }

      .arrival-facts {
        position: static;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
      }

      .spaces-grid {
        grid-template-columns: 1fr 1fr;
      }

      .pool-section {
        grid-template-columns: 1fr;
      }

      .pool-visual {
        min-height: 300px;
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

      .page-header-content {
        flex-direction: column;
        align-items: flex-start;
      }

      .page-header-right {
        display: none;
      }

      .spaces-grid {
        grid-template-columns: 1fr;
      }

      .arrival-facts {
        grid-template-columns: 1fr;
      }

      .room-item-body {
        grid-template-columns: 1fr;
      }

      .room-item-arrow {
        display: none;
      }

      .access-inner {
        flex-direction: column;
      }

      .footer-top {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>

  <!-- ═══ NAV ═══ -->
  <?php include 'layout/navbar.php'; ?>

  <!-- ═══ PAGE HEADER ═══ -->
  <div class="page-header">
    <div class="page-header-bg"></div>
    <div class="page-header-texture"></div>
    <div class="page-header-content">
      <div class="page-header-left">
        <div class="page-header-eyebrow">Galaha Estate · Sri Lanka</div>
        <h1 class="page-header-title">The<br><em>Bungalow</em></h1>
        <div class="page-header-rule"></div>
        <p class="page-header-sub">A restored colonial planter's residence built circa 1890. Six chambers, a long verandah, a fireplace, and a garden that opens onto the tea.</p>
      </div>
      <div class="page-header-right">
        <div class="estate-plate">
          <div class="estate-plate-year">c.1890</div>
          <div class="estate-plate-label">Galaha Estate</div>
          <div class="estate-plate-label" style="margin-top:4px">Kandy District</div>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ BREADCRUMB ═══ -->
  <div class="breadcrumb">
    <a href="/vD/home.php">Home</a>
    <span class="sep">›</span>
    <span class="current">The Bungalow</span>
  </div>

  <!-- ═══ ARRIVAL NARRATIVE ═══ -->
  <section class="arrival-section">
    <div class="arrival-inner">
      <div class="arrival-facts reveal">
        <div class="fact-card">
          <div class="fact-card-label">Built</div>
          <div class="fact-card-value">Circa 1890</div>
          <div class="fact-card-note">Colonial planter's era — the golden age of Ceylon Tea</div>
        </div>
        <div class="fact-card fact-card-gold">
          <div class="fact-card-label">Chambers</div>
          <div class="fact-card-value">6 + Cottage</div>
          <div class="fact-card-note">Six estate rooms plus the two-bedroom Carriage House Cottage</div>
        </div>
        <div class="fact-card">
          <div class="fact-card-label">Estate</div>
          <div class="fact-card-value">Galaha</div>
          <div class="fact-card-note">Working tea estate · Kandy District · Central Highlands</div>
        </div>
        <div class="fact-card fact-card-gold">
          <div class="fact-card-label">Location</div>
          <div class="fact-card-value">5 km</div>
          <div class="fact-card-note">From Loolecondera — birthplace of Ceylon Tea, 1867</div>
        </div>
        <div class="fact-card">
          <div class="fact-card-label">Capacity</div>
          <div class="fact-card-value">Up to 12</div>
          <div class="fact-card-note">Full estate buyout includes all rooms, cottage, and private staff</div>
        </div>
      </div>

      <div class="arrival-content">
        <div class="arrival-label reveal">The Estate</div>
        <h2 class="arrival-title reveal rd1">A House Opened to a Few</h2>
        <p class="arrival-body reveal rd2">
          The Tea Bungalow is not approached as a hotel. It is a <strong>private residence opened to a small number of guests</strong> — a colonial planter's home built circa 1890 on Galaha Estate, in the misty central highlands of Sri Lanka.
        </p>
        <p class="arrival-body reveal rd2">
          Life here unfolds through a sequence of named rooms, each with its own rhythm, light, and purpose. You arrive beneath the car porch and enter The Morning Room, where early tea is poured and the day begins gently. Through twin arches lies The Evening Salon. At the heart of the house stands The Long Table, seating twelve.
        </p>
        <p class="arrival-body reveal rd3">
          Doors open onto the long rear verandah, both corridor and retreat, which leads toward the covered Tea Pavilion, where meals are prepared in view of the garden. In the evenings, guests find their way to The Planter's Lounge, where a stone fireplace has been lit every evening since the estate was built.
        </p>
        <p class="arrival-body reveal rd3">
          <strong>Six chambers</strong> are positioned throughout the house, each individually named and designed. Beyond the main bungalow, a former estate outbuilding has been converted into the Carriage House Cottage — a fully independent two-bedroom residence within the estate grounds.
        </p>
      </div>
    </div>
  </section>

  <!-- ═══ FLOOR PLAN NARRATIVE ═══ -->
  <section class="floorplan-section">
    <div class="floorplan-header reveal">
      <div class="floorplan-eyebrow">Arrival to Rest</div>
      <h2 class="floorplan-title">The Estate, Room by Room</h2>
      <p class="floorplan-sub">From the car porch to the garden. A walk through the house.</p>
    </div>

    <div class="room-flow">

      <div class="room-item reveal">
        <div class="room-item-num"><span class="room-num-text">Arrival</span></div>
        <div class="room-item-body">
          <div class="room-item-text">
            <div class="room-item-tag">Entry</div>
            <div class="room-item-name">The Car Porch & Morning Room</div>
            <p class="room-item-desc">Guests arrive beneath the original car porch and step into The Morning Room — a light-filled reception space where early tea is poured, the day's plans made, and the house begins to breathe.</p>
            <div class="room-item-features">
              <span class="room-feature-pill">Tea on arrival</span>
              <span class="room-feature-pill">Tall windows</span>
              <span class="room-feature-pill">East light</span>
            </div>
          </div>
          <div class="room-item-arrow">→</div>
        </div>
      </div>

      <div class="room-connector"><span class="room-connector-label">Through twin arches</span></div>

      <div class="room-item reveal rd1">
        <div class="room-item-num"><span class="room-num-text">Living</span></div>
        <div class="room-item-body">
          <div class="room-item-text">
            <div class="room-item-tag">Drawing Room</div>
            <div class="room-item-name">The Evening Salon</div>
            <p class="room-item-desc">An intimate room for conversation, aperitifs, and unhurried evenings. Named for the quality of its late afternoon light — warm, amber, falling through original plantation shutters.</p>
            <div class="room-item-features">
              <span class="room-feature-pill">Plantation shutters</span>
              <span class="room-feature-pill">Aperitif hour</span>
              <span class="room-feature-pill">Candlelit</span>
            </div>
          </div>
          <div class="room-item-arrow">→</div>
        </div>
      </div>

      <div class="room-connector"><span class="room-connector-label">Into the heart of the house</span></div>

      <div class="room-item reveal rd1">
        <div class="room-item-num"><span class="room-num-text">Dining</span></div>
        <div class="room-item-body">
          <div class="room-item-text">
            <div class="room-item-tag">Central Dining</div>
            <div class="room-item-name">The Long Table</div>
            <p class="room-item-desc">Seats twelve. Estate breakfasts are taken here, slow suppers served by candlelight. Doors from The Long Table open directly onto the rear verandah — and, beyond, the tea fields.</p>
            <div class="room-item-features">
              <span class="room-feature-pill">Seats 12</span>
              <span class="room-feature-pill">Estate breakfast</span>
              <span class="room-feature-pill">Opens to verandah</span>
            </div>
          </div>
          <div class="room-item-arrow">→</div>
        </div>
      </div>

      <div class="room-connector"><span class="room-connector-label">Rear double doors</span></div>

      <div class="room-item reveal rd2">
        <div class="room-item-num"><span class="room-num-text">Outdoors</span></div>
        <div class="room-item-body">
          <div class="room-item-text">
            <div class="room-item-tag">The Long Verandah</div>
            <div class="room-item-name">Verandah & Tea Pavilion</div>
            <p class="room-item-desc">The verandah runs the full rear length of the bungalow — corridor, reading room, and mist-watching platform in one. Beyond it, the covered Tea Pavilion hosts live cooking, estate feasts, and lantern-lit garden suppers.</p>
            <div class="room-item-features">
              <span class="room-feature-pill">Full-length verandah</span>
              <span class="room-feature-pill">Live cooking</span>
              <span class="room-feature-pill">Lantern dining</span>
              <span class="room-feature-pill">Tea field views</span>
            </div>
          </div>
          <div class="room-item-arrow">→</div>
        </div>
      </div>

      <div class="room-connector"><span class="room-connector-label">Former estate kitchen</span></div>

      <div class="room-item reveal rd2">
        <div class="room-item-num"><span class="room-num-text">Evening</span></div>
        <div class="room-item-body">
          <div class="room-item-text">
            <div class="room-item-tag">Recreation · Heritage</div>
            <div class="room-item-name">The Planter's Lounge & Billiards Room</div>
            <p class="room-item-desc">Once the estate kitchen, now a room of relaxed play and warm company. An original stone fireplace — lit every evening at 6:30 PM — anchors the space. A billiards table and leather armchairs complete the planter's atmosphere.</p>
            <div class="room-item-features">
              <span class="room-feature-pill">Original fireplace 1890</span>
              <span class="room-feature-pill">Lit 6:30 PM nightly</span>
              <span class="room-feature-pill">Billiards table</span>
              <span class="room-feature-pill">Ceylon arrack</span>
            </div>
          </div>
          <div class="room-item-arrow">→</div>
        </div>
      </div>

    </div>
  </section>

  <!-- ═══ SHARED SPACES ═══ -->
  <section class="spaces-section">
    <div class="spaces-header reveal">
      <div class="spaces-eyebrow">Shared Spaces</div>
      <h2 class="spaces-title">Life on the Estate</h2>
      <p class="spaces-sub">Every corner of the house has a purpose. Every hour of the day, a place to be.</p>
    </div>

    <div class="spaces-grid">
      <div class="space-card reveal">
        <span class="space-card-icon">🔥</span>
        <div class="space-card-tag">Evening Ritual</div>
        <div class="space-card-name">The Fireplace</div>
        <p class="space-card-desc">Lit every evening at 6:30 PM without exception. The original stone fireplace has warmed guests and planters since 1890. Armchairs, Ceylon arrack or estate tea, and the sound of the fire.</p>
        <div class="space-card-detail">Planter's Lounge · Complimentary for all guests · Open until the last guest retires</div>
      </div>

      <div class="space-card reveal rd1">
        <span class="space-card-icon">🍽️</span>
        <div class="space-card-tag">Central Gathering</div>
        <div class="space-card-name">The Long Table</div>
        <p class="space-card-desc">Twelve seats. Morning breakfasts with estate-fresh produce, evening shared suppers. The table is where Pekoe Trail stories get told, where slow afternoons extend into candlelit dinner.</p>
        <div class="space-card-detail">Individual guests share the table · Full estate guests dine privately · Private verandah dining also available</div>
      </div>

      <div class="space-card reveal rd2">
        <span class="space-card-icon">🌿</span>
        <div class="space-card-tag">Morning · Evening</div>
        <div class="space-card-name">The Verandah</div>
        <p class="space-card-desc">The full rear verandah runs the length of the house. At dawn, mist rising over the tea. In the afternoon, a place to read in the cool highland air. At dusk, the light turns gold on the estate below.</p>
        <div class="space-card-detail">Open to all guests throughout the day · Verandah Chamber guests have direct room access</div>
      </div>

      <div class="space-card reveal">
        <span class="space-card-icon">🍵</span>
        <div class="space-card-tag">Cooking · Dining</div>
        <div class="space-card-name">The Tea Pavilion</div>
        <p class="space-card-desc">A covered outdoor kitchen and dining area at the garden's edge. Meals are prepared in full view. Lanterns lit at dusk. The smell of spice and woodsmoke in the cool hill air.</p>
        <div class="space-card-detail">Live cooking demonstrations · Estate feast dining · Available for private suppers</div>
      </div>

      <div class="space-card reveal rd1">
        <span class="space-card-icon">🎱</span>
        <div class="space-card-tag">Play · Leisure</div>
        <div class="space-card-name">The Billiards Room</div>
        <p class="space-card-desc">Tucked in the former estate kitchen. When afternoon rain arrives — as it does in the hill country — the billiards table comes alive. A quiet room, a slow game, and the sound of the rain outside.</p>
        <div class="space-card-detail">Available to all guests · Open afternoons and evenings</div>
      </div>

      <div class="space-card reveal rd2">
        <span class="space-card-icon">☀️</span>
        <div class="space-card-tag">Morning · Afternoon</div>
        <div class="space-card-name">The Morning Room</div>
        <p class="space-card-desc">The first room you enter. East light through tall windows. A table set with tea and the day's trail conditions. The beginning of every morning at the bungalow — unhurried, warm, and quiet.</p>
        <div class="space-card-detail">Tea service from 6:00 AM · Pekoe Trail briefings available · Check-in arrival point</div>
      </div>
    </div>
  </section>

  <!-- ═══ POOL & GARDEN ═══ -->
  <div class="pool-section">
    <div class="pool-visual" role="img" aria-label="The Private Pool at The Tea Bungalow"></div>
    <div class="pool-content reveal">
      <div class="spaces-eyebrow">The Garden</div>
      <h2 class="spaces-title" style="text-align:left; margin-top:12px">The Private Pool</h2>
      <p>Originally conceived as a secluded plunge pool for the Founder's Suite, <strong>the Private Pool now serves all resident guests</strong> while retaining its intimate, garden-framed character.</p>
      <p>The pool sits just beyond the Founder's Suite verandah, surrounded by low tea-border planting, fragrant evening jasmine, and warm lantern lighting after dark. It is not a resort pool. It is a garden retreat — quiet, intimate, and unchanged in atmosphere.</p>
      <p>Natural stone surrounds. Teak loungers, never crowded. Morning swims, afternoon cool-offs, evening reflections under the highland sky.</p>
      <div class="pool-note">
        A larger estate pool is planned in a future phase of development. The current pool is intimate in scale — best suited for quiet use by one or two guests at a time.
      </div>
    </div>
  </div>

  <!-- ═══ HERITAGE TIMELINE ═══ -->
  <section class="heritage-section">
    <div class="heritage-inner">
      <div class="heritage-header reveal">
        <div class="heritage-eyebrow">History</div>
        <h2 class="heritage-title">The Story of This House</h2>
      </div>

      <div class="timeline">

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-year">1867</div>
          <div class="timeline-title">James Taylor Plants the First Ceylon Tea</div>
          <p class="timeline-body">Five kilometres from where you are sitting, Scottish planter James Taylor plants 21 acres of tea on Loolecondera Estate — Field No. 7. It is the first commercial tea plantation in Ceylon. An industry is born.</p>
        </div>

        <div class="timeline-item timeline-highlight">
          <div class="timeline-dot"></div>
          <div class="timeline-year">Circa 1890</div>
          <div class="timeline-title">The Bungalow is Built</div>
          <p class="timeline-body">Galaha Estate constructs this planter's residence to house its British superintendent. The same decade that sees Ceylon Tea exports exceed 20,000 tons annually. This bungalow is a product of tea country's golden age.</p>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-year">1892</div>
          <div class="timeline-title">James Taylor Dies at Loolecondera</div>
          <p class="timeline-body">Taylor spends 40 years at Loolecondera, never leaving. He dies aged 57, buried at Mahaiyawa Cemetery, Kandy. His memorial stands at Loolecondera to this day — passed by every Pekoe Trail Stage 2 hiker.</p>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-year">1976</div>
          <div class="timeline-title">Nationalisation — The JEDB Era</div>
          <p class="timeline-body">The Land Reform laws bring Galaha Estate under the management of the Janatha Estates Development Board. The bungalow becomes part of the state-managed plantation system. The tea keeps growing. The house keeps standing.</p>
        </div>

        <div class="timeline-item">
          <div class="timeline-dot"></div>
          <div class="timeline-year">1990s</div>
          <div class="timeline-title">Return to Private Management</div>
          <p class="timeline-body">Sri Lanka's tea estates are progressively returned to private sector management. The estate and bungalow begin a new chapter.</p>
        </div>

        <div class="timeline-item timeline-highlight">
          <div class="timeline-dot"></div>
          <div class="timeline-year">2026</div>
          <div class="timeline-title">The Tea Bungalow Opens</div>
          <p class="timeline-body">The bungalow is lovingly restored as an intimate heritage stay — part of the Old Ceylon Heritage Collection. The fireplace is lit. The Long Table is set. The first guests arrive. The story continues.</p>
        </div>

      </div>
    </div>
  </section>

  <!-- ═══ ACCESSIBILITY ═══ -->
  <div class="access-strip reveal">
    <div class="access-inner">
      <div class="access-icon">♿</div>
      <div class="access-content">
        <div class="access-title">Accessible by Design</div>
        <p class="access-body">The Tea Bungalow was restored with accessibility as a priority, not an afterthought. Several chambers and all key shared spaces are step-free and fully accessible.</p>
        <div class="access-list">
          <span class="access-pill">Founder's Suite — step-free</span>
          <span class="access-pill">Highlands Suite — step-free</span>
          <span class="access-pill">Carriage House Cottage — fully stepless</span>
          <span class="access-pill">Long Table — level access</span>
          <span class="access-pill">Verandah — level access</span>
          <span class="access-pill">Family wing configuration</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ═══ BOOK CTA ═══ -->
  <section class="book-cta">
    <div class="book-cta-eyebrow reveal">Reserve Your Stay</div>
    <h2 class="book-cta-title reveal rd1">Stay in the House.<br>Walk the Trail.</h2>
    <p class="book-cta-sub reveal rd2">Book an individual chamber or reserve the entire estate. Transfers, meals, and Pekoe Trail logistics included in every package.</p>
    <div class="book-cta-btns reveal rd2">
      <a href="/vD/our-chambers.php" class="btn-gold">Browse Chambers</a>
      <a href="/vD/the-entire-estate.php#enquire" class="btn-outline-green">Reserve the Entire Estate</a>
    </div>
    <p class="book-cta-note reveal rd3">
      Planning a Pekoe Trail hike? <a href="/vD/packages.php">View our hiker packages →</a>
    </p>
  </section>

  <!-- ═══ FOOTER ═══ -->
  <?php include 'layout/footer.php'; ?>


  <script>
    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal, .timeline-item');
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
          io.unobserve(e.target);
        }
      });
    }, {
      threshold: 0.1
    });
    reveals.forEach(el => io.observe(el));
  </script>
</body>

</html>