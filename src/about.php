<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>About & Heritage · The Tea Bungalow · Galaha Estate</title>

<link rel="icon" type="image/png" href="images/favicon.png">
<meta property="og:type" content="website">
<meta property="og:title" content="About · The Tea Bungalow · Galaha Estate">
<meta property="og:description" content="Learn the history of The Tea Bungalow — a working Ceylonese tea estate bungalow circa 1890, now welcoming guests to Galaha, Kandy.">
<meta property="og:url" content="https://www.theteabungalow.com/about">
<meta property="og:image" content="https://www.theteabungalow.com/images/house.jpeg">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="About · The Tea Bungalow · Galaha Estate">
<meta name="twitter:description" content="Learn the history of The Tea Bungalow — a working Ceylonese tea estate bungalow circa 1890, now welcoming guests to Galaha, Kandy.">
<link rel="canonical" href="https://www.theteabungalow.com/about">


  <meta name="description" content="The story of The Tea Bungalow and the Old Ceylon Heritage Collection — heritage, mission, and the history of Galaha Estate from 1867 to today.">

  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">

  <style>
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
      --green-deep: #0f2e16;

      --green-pale: #c8dece;
      --green-ghost: #eaf2ec;

      --gold: #C7A85E;
      --gold-light: #dfc080;
      --gold-pale: #f5edd4;
      --gold-deep: #8a6a30;

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



    /* NAV */

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

    .nav-links a:hover,
    .nav-links .active {
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
      color: var(--white);
      background: var(--green);
      border: 1px solid var(--green);
      padding: 9px 20px;
      text-decoration: none;
      transition: background 0.25s;
    }

    .nav-cta:hover {
      background: var(--gold);
      border-color: var(--gold);
    }



    /* HERO */

    .hero {
      min-height: 85vh;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;

      background: linear-gradient(180deg, rgba(10, 25, 14, 0.45) 0%, rgba(15, 46, 22, 0.65) 65%, rgba(10, 25, 14, 0.95) 100%),
        url('images/house.jpeg') center/cover no-repeat;
    }

    .hero-texture {
      position: absolute;
      inset: 0;
      background-image: repeating-linear-gradient(170deg, transparent 0, transparent 30px, rgba(255, 255, 255, 0.022) 30px, rgba(255, 255, 255, 0.022) 31px);
      pointer-events: none;
    }

    .hero-inner {
      position: relative;
      z-index: 2;
      padding: 100px 10vw 80px;
      width: 100%;
      display: grid;
      grid-template-columns: 1.2fr 1fr;
      gap: 64px;
      align-items: center;
    }

    .hero-breadcrumb {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 24px;
      opacity: 0;
      animation: fadeUp 0.8s 0.2s ease forwards;
    }

    .hero-breadcrumb a {
      color: rgba(199, 168, 94, 0.5);
      text-decoration: none;
    }

    .hero-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(42px, 6.5vw, 84px);
      font-weight: 700;
      color: var(--white);
      line-height: 1.0;
      letter-spacing: 0.01em;
      margin-bottom: 20px;
      opacity: 0;
      animation: fadeUp 0.9s 0.4s ease forwards;
    }

    .hero-title em {
      font-style: italic;
      color: var(--gold-light);
      font-weight: 400;
      display: block;
    }

    .hero-tagline {
      font-size: clamp(17px, 1.8vw, 22px);
      font-style: italic;
      color: rgba(255, 255, 255, 0.72);
      line-height: 1.6;
      max-width: 500px;
      opacity: 0;
      animation: fadeUp 0.9s 0.6s ease forwards;
    }

    .hero-right {
      opacity: 0;
      animation: fadeUp 0.9s 0.7s ease forwards;
    }

    .hero-year-block {
      border: 1px solid rgba(199, 168, 94, 0.35);
      padding: 36px 40px;
      text-align: center;
    }

    .hyb-year {
      font-family: 'Cinzel', serif;
      font-size: 56px;
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
    }

    .hyb-label {
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.35em;
      color: rgba(255, 255, 255, 0.5);
      text-transform: uppercase;
      margin: 8px 0 16px;
    }

    .hyb-rule {
      width: 40px;
      height: 1px;
      background: rgba(199, 168, 94, 0.4);
      margin: 0 auto 16px;
    }

    .hyb-sub {
      font-size: 14px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.55);
      line-height: 1.6;
    }



    /* MISSION STATEMENT */

    .mission {
      background: var(--green);
      padding: 96px 10vw;
      text-align: center;
    }

    .mission-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.5em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 28px;
    }

    .mission-text {
      font-family: 'EB Garamond', serif;
      font-size: clamp(22px, 3vw, 38px);
      font-style: italic;
      color: rgba(255, 255, 255, 0.88);
      line-height: 1.45;
      max-width: 900px;
      margin: 0 auto;
    }

    .mission-text em {
      font-style: normal;
      color: var(--gold-light);
    }

    .mission-rule {
      width: 60px;
      height: 1px;
      background: var(--gold);
      margin: 40px auto 0;
    }



    /* OUR STORY */

    .story-section {
      padding: 120px 10vw;
      background: var(--cream);
    }

    .story-inner {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      gap: 80px;
      align-items: start;
      max-width: 1200px;
      margin: 0 auto;
    }

    .story-sidebar {
      position: sticky;
      top: 140px;
    }

    .story-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.45em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 16px;
    }

    .story-heading {
      font-family: 'Cinzel', serif;
      font-size: clamp(26px, 3vw, 40px);
      font-weight: 600;
      color: var(--green);
      line-height: 1.1;
      margin-bottom: 20px;
    }

    .story-rule {
      width: 40px;
      height: 1px;
      background: var(--gold);
      margin-bottom: 24px;
    }

    .story-pillars {
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    .story-pillar {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 14px 0;
      border-bottom: 1px solid var(--green-pale);
    }

    .story-pillar:first-child {
      border-top: 1px solid var(--green-pale);
    }

    .story-pillar-icon {
      font-size: 18px;
      flex-shrink: 0;
    }

    .story-pillar-text {
      font-size: 14px;
      color: var(--ink-mid);
      line-height: 1.4;
    }

    .story-pillar-text strong {
      color: var(--green);
      font-weight: 600;
    }

    .story-body p {
      font-size: clamp(17px, 1.7vw, 20px);
      line-height: 1.8;
      color: var(--ink-mid);
      margin-bottom: 24px;
    }

    .story-body p:first-child::first-letter {
      font-family: 'Cinzel', serif;
      font-size: 64px;
      font-weight: 700;
      color: var(--green);
      float: left;
      line-height: 0.85;
      margin-right: 8px;
      margin-top: 8px;
    }

    .story-body blockquote {
      border-left: 3px solid var(--gold);
      padding: 16px 0 16px 28px;
      margin: 32px 0;
    }

    .story-body blockquote p {
      font-size: clamp(18px, 1.9vw, 22px);
      font-style: italic;
      color: var(--green);
      margin: 0;
    }



    /* THE COLLECTION */

    .collection-section {
      background: var(--ink);
      padding: 120px 10vw;
      position: relative;
      overflow: hidden;
    }

    .collection-section::before {
      content: 'COLLECTION';
      position: absolute;
      right: -3vw;
      top: 50%;
      transform: translateY(-50%);
      font-family: 'Cinzel', serif;
      font-size: clamp(80px, 12vw, 200px);
      font-weight: 700;
      color: rgba(199, 168, 94, 0.025);
      letter-spacing: 0.1em;
      white-space: nowrap;
      pointer-events: none;
      line-height: 0.8;
    }

    .coll-header {
      text-align: center;
      margin-bottom: 72px;
      position: relative;
      z-index: 1;
    }

    .coll-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.5em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 18px;
    }

    .coll-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 3.5vw, 46px);
      font-weight: 600;
      color: var(--white);
      line-height: 1.1;
      margin-bottom: 18px;
    }

    .coll-sub {
      font-size: 18px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.55);
      line-height: 1.65;
      max-width: 620px;
      margin: 0 auto;
    }

    .coll-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2px;
      max-width: 1200px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .coll-card {
      padding: 40px 32px;
      border-top: 2px solid rgba(199, 168, 94, 0.3);
      transition: border-color 0.3s, background 0.3s;
      cursor: default;
    }

    .coll-card:hover {
      border-top-color: var(--gold);
      background: rgba(255, 255, 255, 0.03);
    }

    .coll-card.active-prop {
      border-top-color: var(--gold);
      background: rgba(199, 168, 94, 0.06);
    }

    .coll-status {
      display: inline-block;
      font-family: 'Cinzel', serif;
      font-size: 9px;
      letter-spacing: 0.25em;
      text-transform: uppercase;
      padding: 4px 12px;
      margin-bottom: 16px;
    }

    .status-open {
      background: rgba(30, 132, 73, 0.2);
      color: #5dd58c;
    }

    .status-coming {
      background: rgba(199, 168, 94, 0.15);
      color: var(--gold);
    }

    .status-future {
      background: rgba(255, 255, 255, 0.06);
      color: rgba(255, 255, 255, 0.4);
    }

    .coll-name {
      font-family: 'Cinzel', serif;
      font-size: 20px;
      font-weight: 600;
      color: var(--white);
      margin-bottom: 10px;
      line-height: 1.2;
    }

    .coll-location {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.2em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 14px;
    }

    .coll-desc {
      font-size: 14.5px;
      font-style: italic;
      color: rgba(255, 255, 255, 0.6);
      line-height: 1.65;
      margin-bottom: 20px;
    }

    .coll-link {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--gold);
      text-decoration: none;
      border-bottom: 1px solid rgba(199, 168, 94, 0.3);
      padding-bottom: 2px;
    }

    .coll-link:hover {
      border-color: var(--gold);
    }

    .coll-link-muted {
      color: rgba(255, 255, 255, 0.35);
      border-bottom-color: rgba(255, 255, 255, 0.15);
      cursor: default;
    }



    /* HERITAGE TIMELINE */

    .history-section {
      padding: 120px 0;
      background: var(--cream-dark);
    }

    .history-inner {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 10vw;
    }

    .hist-header {
      text-align: center;
      margin-bottom: 72px;
    }

    .hist-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.5em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 18px;
    }

    .hist-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 3.5vw, 46px);
      font-weight: 600;
      color: var(--green);
      line-height: 1.1;
    }



    .timeline {
      position: relative;
      max-width: 900px;
      margin: 0 auto;
    }

    .timeline::before {
      content: '';
      position: absolute;
      left: 50%;
      top: 0;
      bottom: 0;
      width: 1px;
      background: linear-gradient(to bottom, transparent, var(--gold) 8%, var(--gold) 92%, transparent);
      transform: translateX(-50%);
    }

    .tl-item {
      display: grid;
      grid-template-columns: 1fr 48px 1fr;
      gap: 0;
      margin-bottom: 48px;
      align-items: start;
    }

    .tl-item:nth-child(odd) .tl-left {
      text-align: right;
      padding-right: 40px;
    }

    .tl-item:nth-child(odd) .tl-right {
      padding-left: 40px;
    }

    .tl-item:nth-child(even) .tl-left {
      padding-right: 40px;
    }

    .tl-item:nth-child(even) .tl-right {
      padding-left: 40px;
    }

    .tl-dot {
      width: 14px;
      height: 14px;
      border-radius: 50%;
      background: var(--gold);
      border: 3px solid var(--cream-dark);
      margin: 5px auto 0;
      position: relative;
      z-index: 1;
      box-shadow: 0 0 0 4px rgba(199, 168, 94, 0.2);
    }

    .tl-dot.highlight {
      width: 18px;
      height: 18px;
      background: var(--green);
      box-shadow: 0 0 0 6px rgba(30, 77, 43, 0.2);
    }

    .tl-year {
      font-family: 'Cinzel', serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--gold);
      line-height: 1;
      margin-bottom: 6px;
    }

    .tl-event {
      font-size: 15px;
      line-height: 1.65;
      color: var(--ink-mid);
      font-style: italic;
    }

    .tl-event strong {
      color: var(--green);
      font-style: normal;
    }



    /* VALUES */

    .values-section {
      padding: 120px 10vw;
      background: var(--cream);
    }

    .values-header {
      text-align: center;
      margin-bottom: 64px;
    }

    .val-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.5em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 18px;
    }

    .val-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 3.5vw, 46px);
      font-weight: 600;
      color: var(--green);
      line-height: 1.1;
      margin-bottom: 18px;
    }

    .val-sub {
      font-size: 18px;
      font-style: italic;
      color: var(--ink-light);
      line-height: 1.65;
      max-width: 580px;
      margin: 0 auto;
    }

    .values-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .val-card {
      background: var(--white);
      padding: 40px 32px;
      border-bottom: 3px solid transparent;
      transition: border-color 0.25s, transform 0.25s, box-shadow 0.25s;
    }

    .val-card:hover {
      border-bottom-color: var(--gold);
      transform: translateY(-3px);
      box-shadow: 0 12px 32px var(--shadow);
    }

    .val-icon {
      font-size: 28px;
      margin-bottom: 18px;
      display: block;
    }

    .val-name {
      font-family: 'Cinzel', serif;
      font-size: 16px;
      font-weight: 600;
      color: var(--green);
      letter-spacing: 0.04em;
      margin-bottom: 12px;
    }

    .val-text {
      font-size: 14.5px;
      font-style: italic;
      color: var(--ink-light);
      line-height: 1.65;
    }



    /* SUSTAINABILITY */

    .sustain-section {
      background: var(--green);
      padding: 80px 10vw;
    }

    .sustain-inner {
      display: grid;
      grid-template-columns: 1fr 2fr;
      gap: 64px;
      align-items: center;
      max-width: 1100px;
      margin: 0 auto;
    }

    .sus-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.5em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 18px;
    }

    .sus-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(26px, 3vw, 40px);
      font-weight: 600;
      color: var(--white);
      line-height: 1.1;
    }

    .sus-list {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .sus-item {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      font-size: 15px;
      color: rgba(255, 255, 255, 0.75);
      line-height: 1.6;
    }

    .sus-item-icon {
      font-size: 18px;
      flex-shrink: 0;
      margin-top: 1px;
    }



    /* CTA */

    .cta-section {
      padding: 96px 10vw;
      background: var(--cream-dark);
      text-align: center;
    }

    .cta-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.5em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 18px;
      display: inline-flex;
      align-items: center;
      gap: 14px;
    }

    .cta-eyebrow::before,
    .cta-eyebrow::after {
      content: '';
      width: 32px;
      height: 1px;
      background: var(--gold);
    }

    .cta-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 3.5vw, 46px);
      font-weight: 600;
      color: var(--green);
      line-height: 1.1;
      margin-bottom: 20px;
    }

    .cta-title em {
      font-style: italic;
      color: var(--gold-deep);
      font-weight: 400;
    }

    .cta-body {
      font-size: 18px;
      font-style: italic;
      color: var(--ink-light);
      line-height: 1.7;
      max-width: 520px;
      margin: 0 auto 36px;
    }

    .cta-btns {
      display: flex;
      gap: 14px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .btn-green {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      background: var(--green);
      color: var(--white);
      padding: 16px 32px;
      text-decoration: none;
      border: 1px solid var(--green);
      transition: background 0.25s, color 0.25s, transform 0.2s;
      display: inline-block;
    }

    .btn-green:hover {
      background: var(--gold);
      border-color: var(--gold);
      color: var(--ink);
      transform: translateY(-2px);
    }

    .btn-ghost {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      background: transparent;
      color: var(--green);
      padding: 16px 28px;
      text-decoration: none;
      border: 1px solid var(--green-pale);
      transition: border-color 0.25s, color 0.25s, transform 0.2s;
      display: inline-block;
    }

    .btn-ghost:hover {
      border-color: var(--green);
      color: var(--green);
      transform: translateY(-2px);
    }



    /* FOOTER */

    footer {
      background: #0d0a07 ;
      padding: 72px 10vw 40px;
    }

    .footer-top {
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr 1fr;
      gap: 48px;
      padding-bottom: 56px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
      margin-bottom: 32px;
    }

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
      color: rgba(255, 255, 255, 0.3);
      line-height: 1.5;
      margin-bottom: 20px;
    }

    .footer-contact {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.4);
      margin-bottom: 6px;
    }

    .footer-contact a {
      color: var(--gold);
      text-decoration: none;
    }

    .footer-col-title {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.35em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 20px;
    }

    .footer-links {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .footer-links a {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.45);
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer-links a:hover {
      color: var(--white);
    }

    .footer-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 16px;
    }

    .footer-copy {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.18);
      font-style: italic;
    }

    .footer-collection {
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.3em;
      color: var(--gold);
      opacity: 0.55;
      text-transform: uppercase;
    }



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

    .reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .d1 {
      transition-delay: 0.1s;
    }

    .d2 {
      transition-delay: 0.2s;
    }

    .d3 {
      transition-delay: 0.3s;
    }



    @media(max-width:1100px) {

      .hero-inner,
      .story-inner,
      .sustain-inner {
        grid-template-columns: 1fr;
        gap: 40px;
      }

      .story-sidebar {
        position: static;
      }

      .coll-grid {
        grid-template-columns: 1fr 1fr;
      }

      .values-grid {
        grid-template-columns: 1fr 1fr;
      }

      .footer-top {
        grid-template-columns: 1fr 1fr;
      }

    }

    @media(max-width:768px) {

      nav {
        padding: 0 24px;
      }

      .nav-links {
        display: none;
      }

      .timeline::before {
        left: 20px;
      }

      .tl-item {
        grid-template-columns: 32px 1fr;
        row-gap: 4px;
      }

      .tl-item .tl-left {
        display: none;
      }

      .tl-item .tl-right {
        padding-left: 20px;
      }

      .tl-dot {
        margin: 5px 0 0;
      }

      .coll-grid,
      .values-grid {
        grid-template-columns: 1fr;
      }

      .footer-top {
        grid-template-columns: 1fr;
      }

    }
  </style>

</head>

<body>


  <?php $page = basename($_SERVER['PHP_SELF'], '.php'); ?>

  <?php include 'layout/navbar.php'; ?>



  <!-- HERO -->

  <section class="hero">

    <div class="hero-texture"></div>

    <div class="hero-inner">

      <div>

        <div class="hero-breadcrumb"><a href="/vD/home.php">Home</a> &nbsp;/&nbsp; About &amp; Heritage</div>

        <h1 class="hero-title">The Story<br>of This<br><em>House</em></h1>

        <p class="hero-tagline">Where Ceylon Tea was born. How a colonial bungalow outlasted empires, nationalisation and neglect. And why it stands open today.</p>

      </div>

      <div class="hero-right">

        <div class="hero-year-block">

          <div class="hyb-year">1890</div>

          <div class="hyb-label">Year Established</div>

          <div class="hyb-rule"></div>

          <div class="hyb-sub">Built during the golden era of Ceylon Tea, on the estate in the region that started it all.</div>

        </div>

      </div>

    </div>

  </section>



  <!-- MISSION -->

  <section class="mission">

    <div class="mission-eyebrow reveal">Why We Opened</div>

    <p class="mission-text reveal">"The houses that witnessed Ceylon Tea's birth are <em>disappearing</em>. We believe they should be lived in, not preserved behind glass — and that the best way to keep them alive is to open the door."</p>

    <div class="mission-rule"></div>

  </section>



  <!-- OUR STORY -->

  <section class="story-section">

    <div class="story-inner">

      <aside class="story-sidebar reveal">

        <div class="story-eyebrow">Galaha Estate</div>

        <h2 class="story-heading">A Bungalow Built in Tea's Golden Age</h2>

        <div class="story-rule"></div>

        <div class="story-pillars">

          <div class="story-pillar">
            <div class="story-pillar-icon">🌿</div>
            <div class="story-pillar-text"><strong>1867</strong> — James Taylor plants Ceylon's first commercial tea at Loolecondera, 5km away</div>
          </div>

          <div class="story-pillar">
            <div class="story-pillar-icon">🏛️</div>
            <div class="story-pillar-text"><strong>1890</strong> — This bungalow is built as a planter's residence on Galaha Estate</div>
          </div>

          <div class="story-pillar">
            <div class="story-pillar-icon">🌾</div>
            <div class="story-pillar-text"><strong>1976</strong> — JEDB nationalises Ceylon's plantations; Galaha Estate enters state management</div>
          </div>

          <div class="story-pillar">
            <div class="story-pillar-icon">🔑</div>
            <div class="story-pillar-text"><strong>Today</strong> — Lovingly restored as a boutique heritage stay for a small number of guests</div>
          </div>

        </div>

      </aside>



      <div class="story-body reveal d1">

        <p>There is a building near the town of Galaha, in the central highlands of Sri Lanka, that has stood since the 1890s. It was built as a planter's residence — not a grand colonial manor, but a well-made working home for the man who ran the estate. Wide verandahs to catch the upland air. A long dining table for household staff and guests. Rooms that let in the morning light.</p>



        <p>The estate it sits on is part of the Galaha region — and the Galaha region is where Ceylon Tea began. In 1867, just up the road at Loolecondera Estate, a 32-year-old Scotsman named James Taylor planted the island's first 21 acres of commercial tea. By 1873, the first exports reached London. By the time this bungalow was built two decades later, Ceylon Tea had replaced the coffee industry entirely, and these hills had become the centre of a billion-dollar trade.</p>



        <blockquote>
          <p>The planters who lived here watched an industry they had helped build from this very verandah.</p>
        </blockquote>



        <p>The bungalow survived the transition from private estate to state management. In 1976, Sri Lanka's Land Reform laws brought the Janatha Estates Development Board into being — and Galaha Estate, like hundreds of others, was nationalised. The JEDB era lasted until the early 1990s, when estates were returned to private management. The bungalow stood through it all.</p>



        <p>What you find today is a house that has been carefully restored — not stripped and renovated, but attended to. The original teak floors. The proportions of a colonial residence. The stone fireplace in the Planter's Lounge, unchanged since the 1890s. The long rear verandah from which the mist over the tea fields looks exactly as it would have looked to the first superintendent who stood there.</p>



        <p>We opened the bungalow as a boutique heritage stay because we believe the best way to preserve a house is to live in it — to fill it with guests, light the fire, pour the tea, and let it do what it was built to do. A house is not a museum. It is a home opened to people.</p>

      </div>

    </div>

  </section>



  <!-- THE COLLECTION -->

  <section class="collection-section">

    <div class="coll-header reveal">

      <div class="coll-eyebrow">The Portfolio</div>

      <h2 class="coll-title">Old Ceylon Heritage Collection</h2>

      <p class="coll-sub">A scalable national heritage hospitality portfolio — beginning in Galaha, expanding across Sri Lanka's most historically significant estates and residences.</p>

    </div>

    <div class="coll-grid">

      <div class="coll-card active-prop reveal">

        <span class="coll-status status-open">Now Open</span>

        <div class="coll-name">The Tea Bungalow</div>

        <div class="coll-location">Galaha Estate · Kandy District</div>

        <p class="coll-desc">A restored 1890s colonial planter's residence at the junction of Pekoe Trail Stages 1 and 2 — the founding property of the collection.</p>

        <a href="/vD/home.php" class="coll-link">Visit the Property →</a>

      </div>

      <div class="coll-card reveal d1">

        <span class="coll-status status-open">Now Available</span>

        <div class="coll-name">Hantana Cottage</div>

        <div class="coll-location">Hantana · Kandy</div>

        <p class="coll-desc">A 3-bedroom cottage in Hantana, operating as the Kandy pre-hike base for Pekoe Trail guests and as an independent retreat while the Chairman's Bungalow is prepared.</p>

        <a href="/vD/contact.php#enquiry-form" class="coll-link">Available to Book →</a>

      </div>

      <div class="coll-card reveal d2">

        <span class="coll-status status-coming">Opening 2027</span>

        <div class="coll-name">The Chairman's Bungalow</div>

        <div class="coll-location">Hantana Estate · Kandy</div>

        <p class="coll-desc">A colonial-era plantation bungalow on Hantana Estate — currently being restored to receive guests in 2027. Join the early access list for preview rates.</p>

        <a href="/vD/chairmans-bungalow-2027.php#waitlist" class="coll-link">Join Waitlist →</a>

      </div>

    </div>

  </section>



  <!-- HISTORY TIMELINE -->

  <section class="history-section">

    <div class="history-inner">

      <div class="hist-header reveal">

        <div class="hist-eyebrow">A History of Place</div>

        <h2 class="hist-title">Galaha, Ceylon Tea &amp; This Bungalow</h2>

      </div>

      <div class="timeline">

        <div class="tl-item reveal">

          <div class="tl-left">
            <div class="tl-year">1852</div>
            <div class="tl-event">James Taylor arrives in Ceylon, aged 17, and is posted to <strong>Loolecondera Estate</strong> in the Galaha region — then a coffee plantation.</div>
          </div>

          <div class="tl-dot"></div>

          <div class="tl-right"></div>

        </div>

        <div class="tl-item reveal">

          <div class="tl-left"></div>

          <div class="tl-dot"></div>

          <div class="tl-right">
            <div class="tl-year">1867</div>
            <div class="tl-event">Taylor plants <strong>21 acres of commercial tea</strong> at Loolecondera — Ceylon's first. The crop that would replace coffee and transform the island has begun.</div>
          </div>

        </div>

        <div class="tl-item reveal">

          <div class="tl-left">
            <div class="tl-year">1873</div>
            <div class="tl-event">First export of Ceylon Tea — just <strong>23 pounds</strong> — reaches London. A global industry has found its origin in these Galaha hills.</div>
          </div>

          <div class="tl-dot"></div>

          <div class="tl-right"></div>

        </div>

        <div class="tl-item reveal">

          <div class="tl-left"></div>

          <div class="tl-dot highlight"></div>

          <div class="tl-right">
            <div class="tl-year">c.1890</div>
            <div class="tl-event"><strong>This bungalow is built</strong> on Galaha Estate as a colonial planter's residence. Tea exports exceed 20,000 tons annually. The house enters its first century.</div>
          </div>

        </div>

        <div class="tl-item reveal">

          <div class="tl-left">
            <div class="tl-year">1892</div>
            <div class="tl-event">James Taylor dies, aged 57, at <strong>Loolecondera</strong>. He is buried at Mahaiyawa Cemetery in Kandy. A memorial stands at his estate to this day, 5km from this bungalow.</div>
          </div>

          <div class="tl-dot"></div>

          <div class="tl-right"></div>

        </div>

        <div class="tl-item reveal">

          <div class="tl-left"></div>

          <div class="tl-dot"></div>

          <div class="tl-right">
            <div class="tl-year">1976</div>
            <div class="tl-event">Sri Lanka's Land Reform laws establish the <strong>Janatha Estates Development Board (JEDB)</strong>. Galaha Estate is nationalised and enters state management.</div>
          </div>

        </div>

        <div class="tl-item reveal">

          <div class="tl-left">
            <div class="tl-year">1990s</div>
            <div class="tl-event">The JEDB era ends. Sri Lanka's plantation estates are <strong>returned to private sector management</strong>. The bungalow continues to stand.</div>
          </div>

          <div class="tl-dot"></div>

          <div class="tl-right"></div>

        </div>

        <div class="tl-item reveal">

          <div class="tl-left"></div>

          <div class="tl-dot highlight"></div>

          <div class="tl-right">
            <div class="tl-year">Today</div>
            <div class="tl-event">The bungalow is <strong>lovingly restored</strong> as a boutique heritage stay — the founding property of the Old Ceylon Heritage Collection. The fire is lit at six-thirty.</div>
          </div>

        </div>

      </div>

    </div>

  </section>



  <!-- VALUES -->

  <section class="values-section">

    <div class="values-header reveal">

      <div class="val-eyebrow">What We Believe</div>

      <h2 class="val-title">How We Approach This</h2>

      <p class="val-sub">The principles behind every decision about the estate, the guests, and the collection.</p>

    </div>

    <div class="values-grid">

      <div class="val-card reveal">

        <span class="val-icon">🏛️</span>

        <div class="val-name">Authenticity Over Renovation</div>

        <p class="val-text">We restore, we don't reinvent. Original teak floors stay. Period proportions are preserved. The house is the point — not what we've done to it.</p>

      </div>

      <div class="val-card reveal d1">

        <span class="val-icon">🤝</span>

        <div class="val-name">Owner-Hosted Hospitality</div>

        <p class="val-text">A house opened to guests, not a hotel managed by a corporation. Personal hosting, genuine attention, and the warmth of a private home.</p>

      </div>

      <div class="val-card reveal d2">

        <span class="val-icon">🌿</span>

        <div class="val-name">The Working Estate</div>

        <p class="val-text">Galaha Estate still grows tea. The pluckers are still in the fields. We are a guest house on a working plantation — that context is the experience, not window dressing.</p>

      </div>

      <div class="val-card reveal">

        <span class="val-icon">🧭</span>

        <div class="val-name">The Pekoe Trail as Partnership</div>

        <p class="val-text">We support the trail, not just profit from it. We work with the official Pekoe Trail Organisation, facilitate trail passes, and aim to be a genuine base that enriches the hiking experience.</p>

      </div>

      <div class="val-card reveal d1">

        <span class="val-icon">📖</span>

        <div class="val-name">History Told Honestly</div>

        <p class="val-text">The colonial era is not romanticised uncritically. The JEDB era is part of our history too. We tell the full story — James Taylor, the planters, the plantation workers, and the state.</p>

      </div>

      <div class="val-card reveal d2">

        <span class="val-icon">🌱</span>

        <div class="val-name">Measured Growth</div>

        <p class="val-text">We are not building a hotel chain. The Chairman's Bungalow opens in 2027. Future properties in the collection are chosen for heritage significance, not volume. Slow, considered, lasting.</p>

      </div>

    </div>

  </section>



  <!-- SUSTAINABILITY -->

  <section class="sustain-section">

    <div class="sustain-inner">

      <div class="reveal">

        <div class="sus-eyebrow">Sustainability</div>

        <h2 class="sus-title">A House on a Working Estate</h2>

      </div>

      <div class="sus-list reveal d1">

        <div class="sus-item">
          <div class="sus-item-icon">🌾</div>We source produce from local farms and estate gardens wherever possible — reducing supply chains and supporting Galaha's agricultural community.
        </div>

        <div class="sus-item">
          <div class="sus-item-icon">💧</div>Filtered water refill stations throughout the estate — guests are encouraged to bring and reuse bottles rather than purchase single-use plastic.
        </div>

        <div class="sus-item">
          <div class="sus-item-icon">🔋</div>Energy efficiency is an active priority — LED lighting, solar water heating, and minimal operational waste form part of our ongoing improvement plan.
        </div>

        <div class="sus-item">
          <div class="sus-item-icon">👩‍🌾</div>We employ local staff, train locally, and pay at or above the local hospitality wage. The estate's relationship with its community predates us by 130 years.
        </div>

        <div class="sus-item">
          <div class="sus-item-icon">🥾</div>We support the official Pekoe Trail organisation — facilitating trail passes, promoting responsible hiking, and participating in trail conservation where we can.
        </div>

      </div>

    </div>

  </section>



  <!-- CTA -->

  <section class="cta-section">

    <div class="cta-eyebrow reveal">Come and See</div>

    <h2 class="cta-title reveal">A House is Understood <em>By Staying In It</em></h2>

    <p class="cta-body reveal">No history page, no photograph, no description does what a night at the bungalow does. Enquire about your stay and experience the rest yourself.</p>

    <div class="cta-btns reveal">

      <a href="/vD/contact.php#enquiry-form" class="btn-green">Enquire About a Stay</a>

      <a href="/vD/our-chambers.php" class="btn-ghost">Browse Chambers</a>

    </div>

  </section>



  <?php include 'layout/footer.php'; ?>



  <script>
    const nav = document.getElementById('nav');

    window.addEventListener('scroll', () => {
      nav.classList.toggle('scrolled', window.scrollY > 60);
    });

    const reveals = document.querySelectorAll('.reveal');

    const obs = new IntersectionObserver(entries => {

      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
          obs.unobserve(e.target);
        }
      });

    }, {
      threshold: 0.08
    });

    reveals.forEach(el => obs.observe(el));
  </script>

</body>

</html>