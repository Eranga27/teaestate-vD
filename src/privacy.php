<?php
$page = 'privacy';
$meta_title = "Privacy & Guest Data Retention Policy · The Tea Bungalow · Galaha Estate";
$meta_desc = "Privacy policy and guest personal data handling practices for The Tea Bungalow, complying with Sri Lanka's Personal Data Protection Act No. 09 of 2022.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($meta_title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($meta_desc) ?>">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <link rel="canonical" href="https://www.theteabungalow.com/privacy">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">

  <style>
    *, *::before, *::after {
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
      --gold: #C7A85E;
      --gold-light: #dfc080;
      --cream: #F5F1E9;
      --cream-dark: #ede7db;
      --ink: #1a1510;
      --ink-mid: #3d3428;
      --ink-light: #7a6e60;
      --white: #ffffff;
    }
    body {
      font-family: 'EB Garamond', Georgia, serif;
      background: #07130E;
      color: var(--cream);
      line-height: 1.7;
      overflow-x: hidden;
    }
    
    /* Hero Banner */
    .privacy-hero {
      position: relative;
      padding: 150px 24px 70px;
      text-align: center;
      background: radial-gradient(circle at 50% 30%, rgba(30, 77, 43, 0.45) 0%, rgba(7, 19, 14, 0.95) 75%);
      border-bottom: 1px solid rgba(199, 168, 94, 0.2);
    }
    .privacy-kicker {
      font-family: 'Cinzel', serif;
      font-size: 11px;
      letter-spacing: 0.26em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 14px;
    }
    .privacy-title {
      font-family: 'Cinzel', serif;
      font-size: clamp(28px, 4vw, 44px);
      letter-spacing: 0.1em;
      color: var(--cream);
      font-weight: 500;
      margin-bottom: 14px;
    }
    .privacy-subtitle {
      font-size: clamp(16px, 1.8vw, 19px);
      color: rgba(245, 241, 233, 0.8);
      max-width: 680px;
      margin: 0 auto;
      font-style: italic;
    }

    /* Content Container */
    .privacy-container {
      max-width: 860px;
      margin: 0 auto;
      padding: 60px 24px 100px;
    }
    .privacy-card {
      background: rgba(15, 46, 22, 0.4);
      border: 1px solid rgba(199, 168, 94, 0.2);
      border-radius: 8px;
      padding: 36px 32px;
      margin-bottom: 32px;
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
    }
    .privacy-card h2 {
      font-family: 'Cinzel', serif;
      font-size: 18px;
      letter-spacing: 0.14em;
      color: var(--gold);
      text-transform: uppercase;
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .privacy-card h2::after {
      content: '';
      flex: 1;
      height: 1px;
      background: linear-gradient(90deg, rgba(199, 168, 94, 0.4), transparent);
    }
    .privacy-card p {
      margin-bottom: 14px;
      color: rgba(245, 241, 233, 0.9);
      font-size: 16px;
    }
    .privacy-card p:last-child {
      margin-bottom: 0;
    }
    .privacy-card ul {
      list-style: none;
      padding-left: 0;
      margin: 14px 0;
    }
    .privacy-card li {
      position: relative;
      padding-left: 20px;
      margin-bottom: 8px;
      color: rgba(245, 241, 233, 0.88);
      font-size: 15.5px;
    }
    .privacy-card li::before {
      content: '·';
      position: absolute;
      left: 6px;
      top: -2px;
      color: var(--gold);
      font-size: 20px;
      font-weight: bold;
    }
    .compliance-pill {
      display: inline-block;
      background: rgba(199, 168, 94, 0.12);
      border: 1px solid rgba(199, 168, 94, 0.35);
      border-radius: 999px;
      padding: 4px 14px;
      font-family: 'Cinzel', serif;
      font-size: 10px;
      letter-spacing: 0.16em;
      color: var(--gold);
      text-transform: uppercase;
      margin-top: 10px;
    }
    .privacy-contact-box {
      border-left: 2px solid var(--gold);
      padding-left: 18px;
      margin-top: 18px;
      color: rgba(245, 241, 233, 0.85);
    }
    .privacy-contact-box a {
      color: var(--gold-light);
      text-decoration: underline;
      text-underline-offset: 3px;
    }
  </style>
</head>
<body>

<?php include __DIR__ . '/layout/navbar.php'; ?>

<header class="privacy-hero">
  <div class="privacy-kicker">Governance &amp; Guest Trust</div>
  <h1 class="privacy-title">Privacy &amp; Data Retention Policy</h1>
  <p class="privacy-subtitle">Our commitment to safeguarding guest privacy and personal data in accordance with Sri Lanka's Personal Data Protection Act (PDPA No. 09 of 2022).</p>
  <div class="compliance-pill">Effective: September 2026 · Galaha Estate</div>
</header>

<main class="privacy-container">

  <section class="privacy-card">
    <h2>1. Heritage &amp; Privacy Commitment</h2>
    <p>The Tea Bungalow (Circa 1890), situated on Galaha Estate, Sri Lanka, values the trust placed in us by our guests, visitors, and partners. Operating as part of the Old Ceylon Heritage Collection, we treat all personal information with the utmost discretion, confidentiality, and security.</p>
    <p>This policy outlines how we collect, handle, store, and protect your information when you interact with our website, request reservations, or communicate with our estate team.</p>
  </section>

  <section class="privacy-card">
    <h2>2. Statutory Compliance (Sri Lanka PDPA)</h2>
    <p>This policy is formulated in strict compliance with the <strong>Personal Data Protection Act, No. 09 of 2022 of Sri Lanka</strong> (PDPA) and aligns with international data protection standards (including the EU General Data Protection Regulation / GDPR where applicable to international travelers).</p>
    <p>Under the PDPA, you are recognized as a "Data Subject", and The Tea Bungalow operates as the "Data Controller" for all information processed in connection with your stay or enquiry.</p>
  </section>

  <section class="privacy-card">
    <h2>3. Information We Collect</h2>
    <p>We collect only the personal information strictly necessary to fulfill your enquiries and provide tailored hospitality services:</p>
    <ul>
      <li><strong>Enquiry &amp; Reservation Details:</strong> Full name, email address, telephone/WhatsApp contact number, intended dates of stay, number of guests, and chamber preferences.</li>
      <li><strong>Concierge Communications:</strong> Dietary requirements, Pekoe Trail hiking support requests, airport transfer logistics, and bespoke dining preferences communicated via WhatsApp or email.</li>
      <li><strong>Technical &amp; Analytics Data:</strong> Minimal anonymized technical information (such as browser type, approximate country-level location, and page interaction events) gathered via Google Analytics only where explicit consent has been granted.</li>
    </ul>
  </section>

  <section class="privacy-card">
    <h2>4. Payment Security &amp; Card Data</h2>
    <p><strong>Your card data never touches our web servers.</strong> In adherence to Payment Card Industry Data Security Standards (PCI-DSS):</p>
    <ul>
      <li>All electronic payments and deposit transactions are conducted exclusively via hosted payment fields or secure redirects provided by licensed Sri Lankan payment gateways (such as PayHere) and approved acquiring banks.</li>
      <li>The Tea Bungalow does not store, process, or transmit full Primary Account Numbers (PAN), PINs, or CVV security codes.</li>
    </ul>
  </section>

  <section class="privacy-card">
    <h2>5. Data Retention Schedules</h2>
    <p>We retain guest data only for as long as is necessary to satisfy operational, concierge, and statutory legal requirements:</p>
    <ul>
      <li><strong>General Enquiries:</strong> Retained for up to 12 months following initial contact to assist with re-booking requests, after which they are securely purged.</li>
      <li><strong>Completed Guest Stays &amp; Invoices:</strong> Retained for a minimum of 5 years to comply with Sri Lankan Inland Revenue Act requirements and hospitality accounting standards.</li>
      <li><strong>Chairman's Bungalow Waitlist:</strong> Retained until the 2027 opening invitations are dispatched, or until the guest requests removal.</li>
      <li><strong>Analytics Data:</strong> Retained for 14 months within Google Analytics before automated deletion.</li>
    </ul>
  </section>

  <section class="privacy-card">
    <h2>6. Cookies &amp; Tracking Consent</h2>
    <p>Our website utilizes essential cookies to ensure rapid, secure page delivery and remember your privacy choices. Optional analytics cookies (Google Tag Manager / GA4) are deployed solely to understand guest traffic patterns.</p>
    <p>Under our <strong>Consent-First Architecture</strong>, optional analytics cookies remain disabled until you click "Accept All" on our privacy banner. You may adjust your preferences at any time by clearing your browser's local storage.</p>
  </section>

  <section class="privacy-card">
    <h2>7. Guest Rights &amp; Data Subject Requests</h2>
    <p>Under Part II of the Sri Lanka Personal Data Protection Act, you possess the following rights regarding your personal information:</p>
    <ul>
      <li><strong>Right of Access:</strong> You may request a copy of the personal data held about you.</li>
      <li><strong>Right to Rectification:</strong> You may request correction of any inaccurate or incomplete details.</li>
      <li><strong>Right to Erasure ("Right to be Forgotten"):</strong> You may request the deletion of your personal data where retention is no longer mandated by statutory tax or lodging regulations.</li>
      <li><strong>Right to Withdraw Consent:</strong> You may withdraw consent for marketing or concierge communications at any time.</li>
    </ul>
  </section>

  <section class="privacy-card">
    <h2>8. Contact the Estate Data Officer</h2>
    <p>For inquiries regarding this policy, to exercise your data subject rights, or to update your preferences, please contact our estate management team:</p>
    <div class="privacy-contact-box">
      <strong>The Tea Bungalow — Data Officer</strong><br>
      Galaha Estate, Moragolla Road, Kandy 20400, Sri Lanka<br>
      Email: <a href="mailto:stay@theteabungalow.com">stay@theteabungalow.com</a><br>
      Direct Concierge: <a href="tel:+94777874555">+94 (0)777 874 555</a>
    </div>
  </section>

</main>

<?php include __DIR__ . '/layout/footer.php'; ?>

</body>
</html>
