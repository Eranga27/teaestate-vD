<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>
<!DOCTYPE html> 

<html lang="en"> 

<head> 

<meta charset="UTF-8"> 

<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

<title>Contact & Enquire · The Tea Bungalow · Galaha Estate</title>

<link rel="icon" type="image/png" href="images/favicon.png">
<meta property="og:type" content="website">
<meta property="og:title" content="Contact & Enquire · The Tea Bungalow · Galaha Estate">
<meta property="og:description" content="Enquire about a stay at The Tea Bungalow — room bookings, Pekoe Trail packages, estate buyouts, or any question about the bungalow.">
<meta property="og:url" content="https://www.theteabungalow.com/contact">
<meta property="og:image" content="https://www.theteabungalow.com/images/heroimg-1.jpeg">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Contact & Enquire · The Tea Bungalow · Galaha Estate">
<meta name="twitter:description" content="Enquire about a stay at The Tea Bungalow — room bookings, Pekoe Trail packages, estate buyouts, or any question about the bungalow.">
<link rel="canonical" href="https://www.theteabungalow.com/contact">
 

<meta name="description" content="Enquire about a stay at The Tea Bungalow — room bookings, Pekoe Trail packages, estate buyouts, or any question about the bungalow."> 

<link rel="preconnect" href="https://fonts.googleapis.com"> 

<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet"> 

<style> 

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;} 

html{scroll-behavior:smooth;} 

:root{ 

  --green:#1E4D2B; --green-pale:#c8dece; --green-ghost:#eaf2ec; --green-deep:#0f2e16; 

  --gold:#C7A85E; --gold-light:#dfc080; --gold-pale:#f5edd4; --gold-deep:#8a6a30; 

  --cream:#F5F1E9; --cream-dark:#ede7db; 

  --ink:#1a1510; --ink-mid:#3d3428; --ink-light:#7a6e60; 

  --mist:#8a9e8f; --white:#ffffff; --shadow:rgba(30,77,43,0.13); 

} 

body{background:var(--cream);font-family:'EB Garamond',Georgia,serif;color:var(--ink);overflow-x:hidden;} 

body::after{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");pointer-events:none;z-index:9999;} 

 

/* NAV */ 

nav{position:fixed;top:0;left:0;right:0;z-index:200;height:72px;padding:0 48px;display:flex;align-items:center;justify-content:space-between;transition:background 0.4s,box-shadow 0.4s;} 

nav.scrolled{background:rgba(245,241,233,0.96);backdrop-filter:blur(12px);box-shadow:0 1px 0 rgba(30,77,43,0.1);} 

.nav-logo{font-family:'Cinzel',serif;font-size:15px;font-weight:600;letter-spacing:0.12em;color:var(--white);text-decoration:none;transition:color 0.3s;} 

nav.scrolled .nav-logo{color:var(--green);} 

.nav-links{display:flex;gap:32px;list-style:none;} 

.nav-links a{font-family:'Cinzel',serif;font-size:11px;letter-spacing:0.16em;text-transform:uppercase;color:rgba(255,255,255,0.8);text-decoration:none;transition:color 0.25s;} 

nav.scrolled .nav-links a{color:var(--ink-mid);} 

.nav-links a:hover,.nav-links .active{color:var(--gold);} 

nav.scrolled .nav-links a:hover{color:var(--green);} 

.nav-cta{font-family:'Cinzel',serif;font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:var(--white);background:var(--green);border:1px solid var(--green);padding:9px 20px;text-decoration:none;transition:background 0.25s;} 

.nav-cta:hover{background:var(--gold);border-color:var(--gold);} 

 

/* HERO */ 

.hero{min-height:70vh;position:relative;overflow:hidden;display:flex;align-items:flex-end;padding:0 10vw 80px; 

  background:linear-gradient(180deg,rgba(10,25,14,0.45) 0%,rgba(10,25,14,0.65) 65%,rgba(10,25,14,0.95) 100%), 

  url('images/house.jpeg') center/cover no-repeat;} 

.hero-texture{position:absolute;inset:0;background-image:repeating-linear-gradient(170deg,transparent 0,transparent 30px,rgba(255,255,255,0.022) 30px,rgba(255,255,255,0.022) 31px);pointer-events:none;} 

.hero-content{position:relative;z-index:2;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:end;} 

.hero-breadcrumb{font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.45em;color:var(--gold);text-transform:uppercase;margin-bottom:24px;opacity:0;animation:fadeUp 0.8s 0.2s ease forwards;text-shadow:0 1px 3px rgba(0,0,0,0.9);} 

.hero-breadcrumb a{color:rgba(199,168,94,0.7);text-decoration:none;} 

.hero-title{font-family:'Cinzel',serif;font-size:clamp(42px,6.5vw,84px);font-weight:700;color:var(--white);line-height:1.0;letter-spacing:0.01em;margin-bottom:18px;opacity:0;animation:fadeUp 0.9s 0.4s ease forwards;text-shadow:0 2px 16px rgba(0,0,0,0.7),0 1px 3px rgba(0,0,0,0.9);} 

.hero-title em{font-style:italic;color:var(--gold-light);font-weight:400;display:block;} 

.hero-sub{font-size:clamp(17px,1.8vw,21px);font-style:italic;color:rgba(255,255,255,0.85);line-height:1.6;max-width:500px;opacity:0;animation:fadeUp 0.9s 0.6s ease forwards;text-shadow:0 1px 8px rgba(0,0,0,0.8);} 

.hero-response{opacity:0;animation:fadeUp 0.9s 0.75s ease forwards;} 

.response-pill{display:inline-flex;align-items:center;gap:10px;padding:14px 20px;background:rgba(199,168,94,0.1);border:1px solid rgba(199,168,94,0.3);margin-bottom:16px;} 

.rp-dot{width:8px;height:8px;border-radius:50%;background:var(--gold);animation:pulse 2s ease-in-out infinite;} 

.rp-text{font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.2em;color:var(--gold);text-transform:uppercase;} 

.hero-channels{display:flex;flex-direction:column;gap:8px;} 

.hero-channel{display:flex;align-items:center;gap:12px;font-size:14px;color:rgba(255,255,255,0.6);} 

.hero-channel strong{color:rgba(255,255,255,0.85);font-weight:500;} 

 

/* MAIN GRID */ 

.contact-main{padding:96px 10vw;background:var(--cream);} 

.contact-grid{display:grid;grid-template-columns:1.1fr 1fr;gap:64px;max-width:1200px;margin:0 auto;} 

 

/* ENQUIRY FORM */ 

.form-section{} 

.form-eyebrow{font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.45em;color:var(--gold);text-transform:uppercase;margin-bottom:16px;} 

.form-title{font-family:'Cinzel',serif;font-size:clamp(24px,3vw,36px);font-weight:600;color:var(--green);line-height:1.1;margin-bottom:32px;} 

 

.enquiry-form{display:flex;flex-direction:column;gap:20px;} 

.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;} 

.form-group{display:flex;flex-direction:column;gap:6px;} 

.form-group.full{grid-column:1/-1;} 

.form-label{font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.22em;color:var(--green);text-transform:uppercase;} 

.form-label span{color:var(--gold);} 

.form-input,.form-select,.form-textarea{ 

  font-family:'EB Garamond',Georgia,serif;font-size:16px;color:var(--ink); 

  background:var(--white);border:1px solid var(--green-pale); 

  padding:12px 16px;outline:none;width:100%; 

  transition:border-color 0.25s,box-shadow 0.25s; 

  appearance:none; 

} 

.form-input:focus,.form-select:focus,.form-textarea:focus{ 

  border-color:var(--green); 

  box-shadow:0 0 0 3px rgba(30,77,43,0.08); 

} 

.form-textarea{min-height:120px;resize:vertical;line-height:1.6;} 

.form-select{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%231E4D2B' stroke-width='1.5' fill='none'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 16px center;padding-right:40px;cursor:pointer;} 

 

.form-note{font-size:13px;font-style:italic;color:var(--mist);} 

.form-submit{ 

  font-family:'Cinzel',serif;font-size:12px;letter-spacing:0.22em;text-transform:uppercase; 

  background:var(--green);color:var(--white);padding:18px 40px; 

  border:none;cursor:pointer; 

  transition:background 0.25s,transform 0.2s; 

  align-self:flex-start; 

} 

.form-submit:hover{background:var(--gold);color:var(--ink);transform:translateY(-2px);} 

 

/* Success state */ 

.form-success{ 

  display:none;padding:32px 28px;background:var(--green-ghost); 

  border:1px solid var(--green-pale);border-left:4px solid var(--green); 

} 

.fs-icon{font-size:28px;margin-bottom:12px;} 

.fs-title{font-family:'Cinzel',serif;font-size:16px;color:var(--green);margin-bottom:8px;} 

.fs-body{font-size:15px;font-style:italic;color:var(--ink-light);line-height:1.65;} 

 

/* CONTACT INFO SIDEBAR */ 

.contact-sidebar{display:flex;flex-direction:column;gap:0;} 

 

.contact-block{padding:32px 0;border-bottom:1px solid var(--green-pale);} 

.contact-block:first-child{padding-top:0;} 

.contact-block:last-child{border-bottom:none;} 

.cb-eyebrow{font-family:'Cinzel',serif;font-size:9px;letter-spacing:0.4em;color:var(--gold);text-transform:uppercase;margin-bottom:14px;} 

.cb-name{font-family:'Cinzel',serif;font-size:15px;color:var(--green);letter-spacing:0.04em;margin-bottom:6px;font-weight:600;} 

.cb-value{font-size:15px;color:var(--ink-mid);line-height:1.5;margin-bottom:4px;} 

.cb-value a{color:var(--green);text-decoration:none;} 

.cb-value a:hover{color:var(--gold);} 

.cb-sub{font-size:13px;font-style:italic;color:var(--mist);} 

 

/* WhatsApp block — special styling */ 

.wa-block{ 

  background:var(--green);padding:28px 24px; 

  display:flex;align-items:center;gap:16px; 

  transition:background 0.25s;cursor:pointer;text-decoration:none; 

} 

.wa-block:hover{background:var(--gold);} 

.wa-icon{font-size:28px;flex-shrink:0;} 

.wa-info{} 

.wa-label{font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.25em;color:var(--gold);text-transform:uppercase;margin-bottom:4px;} 

.wa-block:hover .wa-label{color:var(--ink);} 

.wa-number{font-family:'Cinzel',serif;font-size:18px;color:var(--white);font-weight:600;} 

.wa-block:hover .wa-number{color:var(--ink);} 

.wa-sub{font-size:12px;font-style:italic;color:rgba(255,255,255,0.65);} 

.wa-block:hover .wa-sub{color:rgba(26,21,16,0.7);} 

 

/* Response times */ 

.response-table{display:flex;flex-direction:column;gap:0;margin-top:4px;} 

.rt-row{display:flex;align-items:center;gap:14px;padding:12px 0;border-bottom:1px solid var(--green-pale);} 

.rt-row:last-child{border-bottom:none;} 

.rt-channel{font-family:'Cinzel',serif;font-size:11px;color:var(--ink-mid);font-weight:600;flex:1;} 

.rt-time{font-family:'Cinzel',serif;font-size:11px;color:var(--green);letter-spacing:0.04em;white-space:nowrap;} 

.rt-dot{width:8px;height:8px;border-radius:50%;background:var(--green-pale);flex-shrink:0;} 

.rt-dot.fast{background:#1e8449;} 

.rt-dot.medium{background:var(--gold-deep);} 

 

/* LOCATION MAP SECTION */ 

.location-section{padding:96px 10vw;background:var(--cream-dark);} 

.location-inner{display:grid;grid-template-columns:1fr 1.4fr;gap:64px;align-items:start;max-width:1200px;margin:0 auto;} 

.loc-eyebrow{font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.45em;color:var(--gold);text-transform:uppercase;margin-bottom:16px;} 

.loc-title{font-family:'Cinzel',serif;font-size:clamp(24px,3vw,38px);font-weight:600;color:var(--green);line-height:1.1;margin-bottom:20px;} 

.loc-body{font-size:17px;line-height:1.75;color:var(--ink-mid);margin-bottom:28px;} 

.loc-address{padding:20px 24px;background:var(--white);border-left:3px solid var(--gold);margin-bottom:20px;} 

.loc-address p{font-size:14.5px;color:var(--ink-mid);line-height:1.7;} 

.loc-address strong{display:block;font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.2em;color:var(--green);text-transform:uppercase;margin-bottom:6px;} 

.loc-how{display:flex;flex-direction:column;gap:0;} 

.loc-how-item{display:flex;align-items:flex-start;gap:14px;padding:14px 0;border-bottom:1px solid var(--green-pale);} 

.loc-how-item:first-child{border-top:1px solid var(--green-pale);} 

.loc-how-icon{font-size:16px;flex-shrink:0;margin-top:2px;} 

.loc-how-info{} 

.loc-how-name{font-family:'Cinzel',serif;font-size:12px;color:var(--green);font-weight:600;letter-spacing:0.04em;margin-bottom:3px;} 

.loc-how-detail{font-size:13px;font-style:italic;color:var(--ink-light);line-height:1.5;} 

 

/* Map placeholder */ 

.map-ph{ 

  background:var(--green);aspect-ratio:4/3; 

  position:relative;overflow:hidden; 

  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px; 

} 

.map-ph::before{content:'';position:absolute;inset:0;background-image:repeating-linear-gradient(90deg,transparent 0,transparent 39px,rgba(199,168,94,0.04) 40px),repeating-linear-gradient(0deg,transparent 0,transparent 39px,rgba(199,168,94,0.04) 40px);} 

.map-pin-dot{width:16px;height:16px;border-radius:50%;background:var(--gold);box-shadow:0 0 0 8px rgba(199,168,94,0.2);animation:pinPulse 2s ease-in-out infinite;position:relative;z-index:1;} 

.map-pin-label{font-family:'Cinzel',serif;font-size:11px;letter-spacing:0.2em;color:rgba(255,255,255,0.7);text-transform:uppercase;text-align:center;position:relative;z-index:1;} 

.map-ph-note{font-size:12px;font-style:italic;color:rgba(255,255,255,0.35);position:relative;z-index:1;} 

.map-replace-note{position:absolute;bottom:16px;left:50%;transform:translateX(-50%);font-family:'Cinzel',serif;font-size:9px;letter-spacing:0.25em;color:rgba(255,255,255,0.25);text-transform:uppercase;white-space:nowrap;} 

 

/* FAQ MINI */ 

.faq-strip{padding:80px 10vw;background:var(--cream);} 

.faq-inner{max-width:900px;margin:0 auto;} 

.faq-eyebrow{font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.45em;color:var(--gold);text-transform:uppercase;margin-bottom:14px;text-align:center;} 

.faq-title{font-family:'Cinzel',serif;font-size:clamp(24px,3vw,36px);font-weight:600;color:var(--green);margin-bottom:40px;text-align:center;} 

.faq-item{border-bottom:1px solid var(--green-pale);cursor:pointer;} 

.faq-item:first-child{border-top:1px solid var(--green-pale);} 

.faq-q{display:flex;align-items:center;justify-content:space-between;padding:22px 0;gap:20px;} 

.faq-q-text{font-family:'Cinzel',serif;font-size:14px;color:var(--green);letter-spacing:0.04em;line-height:1.4;font-weight:600;} 

.faq-toggle{width:30px;height:30px;border:1px solid var(--green-pale);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--green);flex-shrink:0;transition:background 0.2s,transform 0.3s;} 

.faq-item.open .faq-toggle{background:var(--gold);color:var(--ink);border-color:var(--gold);transform:rotate(45deg);} 

.faq-a{max-height:0;overflow:hidden;transition:max-height 0.4s ease,padding 0.4s ease;} 

.faq-item.open .faq-a{max-height:400px;padding-bottom:22px;} 

.faq-a p{font-size:15.5px;line-height:1.75;color:var(--ink-mid);font-style:italic;} 

 

/* FOOTER */ 

footer{background:#0d0a07;padding:72px 10vw 40px;} 

.footer-top{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:48px;padding-bottom:56px;border-bottom:1px solid rgba(255,255,255,0.06);margin-bottom:32px;} 

.footer-logo{font-family:'Cinzel',serif;font-size:18px;font-weight:600;color:var(--white);letter-spacing:0.08em;margin-bottom:8px;} 

.footer-tagline{font-size:14px;font-style:italic;color:rgba(255,255,255,0.3);line-height:1.5;margin-bottom:20px;} 

.footer-contact-f{font-size:13px;color:rgba(255,255,255,0.4);margin-bottom:6px;} 

.footer-contact-f a{color:var(--gold);text-decoration:none;} 

.footer-col-title{font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.35em;color:var(--gold);text-transform:uppercase;margin-bottom:20px;} 

.footer-links{list-style:none;display:flex;flex-direction:column;gap:10px;} 

.footer-links a{font-size:14px;color:rgba(255,255,255,0.45);text-decoration:none;transition:color 0.2s;} 

.footer-links a:hover{color:var(--white);} 

.footer-bottom{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;} 

.footer-copy{font-size:12px;color:rgba(255,255,255,0.18);font-style:italic;} 

.footer-collection{font-family:'Cinzel',serif;font-size:10px;letter-spacing:0.3em;color:var(--gold);opacity:0.55;text-transform:uppercase;} 

 

@keyframes fadeUp{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}} 

@keyframes pulse{0%,100%{box-shadow:0 0 0 4px rgba(199,168,94,0.3);}50%{box-shadow:0 0 0 10px rgba(199,168,94,0.1);}} 

@keyframes pinPulse{0%,100%{box-shadow:0 0 0 8px rgba(199,168,94,0.2);}50%{box-shadow:0 0 0 16px rgba(199,168,94,0.05);}} 

.reveal{opacity:0;transform:translateY(24px);transition:opacity 0.7s ease,transform 0.7s ease;} 

.reveal.visible{opacity:1;transform:translateY(0);} 

.d1{transition-delay:0.1s;} .d2{transition-delay:0.2s;} 

 

@media(max-width:1100px){ 

  .hero-content,.contact-grid,.location-inner{grid-template-columns:1fr;gap:40px;} 

  .footer-top{grid-template-columns:1fr 1fr;} 

} 

@media(max-width:768px){ 

  nav{padding:0 24px;} 

  .nav-links{display:none;} 

  .form-row{grid-template-columns:1fr;} 

  .footer-top{grid-template-columns:1fr;} 

} 

</style> 

</head> 

<body> 

 

<?php include 'layout/navbar.php'; ?> 

 

<!-- HERO --> 

<section class="hero"> 

  <div class="hero-texture"></div> 

  <div class="hero-content"> 

    <div> 

      <div class="hero-breadcrumb"><a href="/vD/home.php">Home</a> &nbsp;/&nbsp; Contact &amp; Enquire</div> 

      <h1 class="hero-title">Get in<br><em>Touch</em></h1> 

      <p class="hero-sub">Enquire about a room, a package, the Pekoe Trail, or anything about the estate. We respond to every message personally.</p> 

    </div> 

    <div class="hero-response"> 

      <div class="response-pill"> 

        <div class="rp-dot"></div> 

        <div class="rp-text">We respond within 24 hours</div> 

      </div> 

      <div class="hero-channels"> 

        <div class="hero-channel"><span>📧</span><span>Email: <strong><a href="mailto:stay@theteabungalow.com" style="color:inherit;">stay@theteabungalow.com</a></strong></span></div> 

        <div class="hero-channel"><span>💬</span><span>WhatsApp / Call: <strong><a href="tel:+94777874555" style="color:inherit;">+94 (0)777 874 555</a></strong></span></div> 

        <div class="hero-channel"><span>📞</span><span>UK line: <strong><a href="tel:+447532100900" style="color:inherit;">+44 7532 100 900</a></strong></span></div> 

        <div class="hero-channel"><span>🌿</span><span>Introductory offer: <strong>Double BB from $75</strong></span></div> 

      </div> 

    </div> 

  </div> 

</section> 

 

<!-- MAIN GRID --> 

<div id="form" class="contact-main"> 

  <div class="contact-grid"> 

 

    <!-- FORM --> 

    <div class="form-section reveal"> 

      <div class="form-eyebrow">Enquiry Form</div> 

      <h2 class="form-title">Tell Us About Your Stay</h2> 

 

      <form class="enquiry-form" id="enquiry-form" novalidate> 

        <!-- CSRF & honeypot (anti-bot) --> 
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>"> 
        <div style="display:none" aria-hidden="true"><label>Leave this blank <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div> 

        <div class="form-row"> 

          <div class="form-group"> 

            <label class="form-label" for="first">First Name <span>*</span></label> 

            <input class="form-input" type="text" id="first" name="first" placeholder="Your first name" required> 

          </div> 

          <div class="form-group"> 

            <label class="form-label" for="last">Last Name <span>*</span></label> 

            <input class="form-input" type="text" id="last" name="last" placeholder="Your last name" required> 

          </div> 

        </div> 

 

        <div class="form-row"> 

          <div class="form-group"> 

            <label class="form-label" for="email">Email Address <span>*</span></label> 

            <input class="form-input" type="email" id="email" name="email" placeholder="your.email@example.com" required> 

          </div> 

          <div class="form-group"> 

            <label class="form-label" for="phone">Phone / WhatsApp</label> 

            <input class="form-input" type="tel" id="phone" name="phone" placeholder="+44 or +94..."> 

          </div> 

        </div> 

 

        <div class="form-group full"> 

          <label class="form-label" for="enquiry-type">What Are You Enquiring About? <span>*</span></label> 

          <select class="form-select" id="enquiry-type" name="enquiry-type" required> 

            <option value="" disabled selected>Choose an enquiry type</option> 

            <option value="room">Individual Room / Chamber</option> 

            <option value="pekoe">Pekoe Trail Package</option> 

            <option value="buyout">Estate Buyout (Entire Bungalow)</option> 

            <option value="celebration">Private Celebration / Anniversary</option> 

            <option value="family">Family Stay</option> 

            <option value="tiffin">Planter's Tiffin Lunch (Day Visit)</option> 

            <option value="group">Group Booking (6+ people)</option> 

            <option value="experience">Experiences Only</option> 

            <option value="other">General Question</option> 

          </select> 

        </div> 

 

        <div class="form-row"> 

          <div class="form-group"> 

            <label class="form-label" for="arrival">Preferred Arrival Date</label> 

            <input class="form-input" type="date" id="arrival" name="arrival"> 

          </div> 

          <div class="form-group"> 

            <label class="form-label" for="departure">Preferred Departure Date</label> 

            <input class="form-input" type="date" id="departure" name="departure"> 

          </div> 

        </div> 

 

        <div class="form-row"> 

          <div class="form-group"> 

            <label class="form-label" for="adults">Number of Adults</label> 

            <select class="form-select" id="adults" name="adults"> 

              <option value="">Select</option> 

              <option>1</option><option>2</option><option>3</option><option>4</option> 

              <option>5</option><option>6</option><option>7</option><option>8+</option> 

            </select> 

          </div> 

          <div class="form-group"> 

            <label class="form-label" for="children">Children (if any)</label> 

            <select class="form-select" id="children" name="children"> 

              <option value="">None</option> 

              <option>1</option><option>2</option><option>3</option><option>4+</option> 

            </select> 

          </div> 

        </div> 

 

        <div class="form-group full"> 

          <label class="form-label" for="pekoe-stages">Pekoe Trail Stages (if applicable)</label> 

          <select class="form-select" id="pekoe-stages" name="pekoe-stages"> 

            <option value="">Not hiking / not applicable</option> 

            <option>Stage 1 only</option> 

            <option>Stage 1 &amp; 2</option> 

            <option>Stage 2 &amp; 3</option> 

            <option>Stages 1, 2 &amp; 3</option> 

            <option>Just the Tiffin Lunch</option> 

            <option>Not sure yet</option> 

          </select> 

        </div> 

 

        <div class="form-group full"> 

          <label class="form-label" for="message">Your Message <span>*</span></label> 

          <textarea class="form-textarea" id="message" name="message" placeholder="Tell us anything relevant — dietary requirements, accessibility needs, special occasions, hiking fitness, or just say hello." required></textarea> 

        </div> 

 

        <div class="form-group full"> 

          <label class="form-label" for="how">How Did You Find Us?</label> 

          <select class="form-select" id="how" name="how"> 

            <option value="" disabled selected>Select if you'd like to share</option> 

            <option>Google Search</option> 

            <option>Pekoe Trail website</option> 

            <option>Booking.com</option> 

            <option>Instagram</option> 

            <option>Word of mouth / friend</option> 

            <option>Travel agent / tour operator</option> 

            <option>Other</option> 

          </select> 

        </div> 

 

        <div class="form-note">Fields marked <span style="color:var(--gold)">*</span> are required. We read every enquiry personally and respond within 24 hours.</div> 

 

        <button type="submit" class="form-submit">Send Enquiry →</button> 

      </form> 

 

      <div class="form-success" id="form-success"> 

        <div class="fs-icon">🍃</div> 

        <div class="fs-title">Enquiry Received</div> 

        <p class="fs-body">Thank you — we've received your message and will respond within 24 hours. If your enquiry is urgent, please WhatsApp us directly on +94 (0)777 874 555.</p> 

      </div> 

    </div> 

 

    <!-- SIDEBAR --> 

    <div class="contact-sidebar reveal d1"> 

 

      <!-- WhatsApp --> 

      <a href="https://wa.me/94777874555" class="wa-block" target="_blank" rel="noopener"> 

        <div class="wa-icon">💬</div> 

        <div class="wa-info"> 

          <div class="wa-label">WhatsApp — Fastest Response</div> 

          <div class="wa-number">+94 (0)777 874 555</div> 

          <div class="wa-sub">Sri Lanka number · Typically replied within a few hours</div> 

        </div> 

      </a> 

 

      <div class="contact-block"> 

        <div class="cb-eyebrow">Direct Contact</div> 

        <div class="cb-name">Email</div> 

        <div class="cb-value"><a href="mailto:stay@theteabungalow.com">stay@theteabungalow.com</a></div> 

        <div class="cb-sub">Best for detailed enquiries and package proposals</div> 

      </div> 

 

      <div class="contact-block"> 

        <div class="cb-eyebrow">International Lines</div> 

        <div class="cb-name">Sri Lanka</div> 

        <div class="cb-value"><a href="tel:+94777874555">+94 (0)777 874 555</a></div> 

        <div class="cb-sub">Local Sri Lanka number</div> 

        <div class="cb-name" style="margin-top:14px;">United Kingdom</div> 

        <div class="cb-value"><a href="tel:+447532100900">+44 7532 100 900</a></div> 

        <div class="cb-sub">UK enquiries line</div> 

      </div> 

 

      <div class="contact-block"> 

        <div class="cb-eyebrow">The Estate Address</div> 

        <div class="cb-value">The Tea Bungalow (Circa 1890)</div> 

        <div class="cb-value">Galaha Estate, Moragolla Road</div> 

        <div class="cb-value">Kandy 20400, Sri Lanka</div> 

        <div class="cb-sub" style="margin-top:8px;">We collect guests from Kandy or Peradeniya Station — no need to navigate independently.</div> 

      </div> 

 

      <div class="contact-block"> 

        <div class="cb-eyebrow">Response Times</div> 

        <div class="response-table"> 

          <div class="rt-row"><div class="rt-dot fast"></div><div class="rt-channel">WhatsApp</div><div class="rt-time">2–4 hours</div></div> 

          <div class="rt-row"><div class="rt-dot fast"></div><div class="rt-channel">Enquiry Form</div><div class="rt-time">Within 24 hours</div></div> 

          <div class="rt-row"><div class="rt-dot medium"></div><div class="rt-channel">Email Direct</div><div class="rt-time">Within 24 hours</div></div> 

          <div class="rt-row"><div class="rt-dot medium"></div><div class="rt-channel">Booking.com Inbox</div><div class="rt-time">Within 48 hours</div></div> 

        </div> 

      </div> 

 

      <div class="contact-block"> 

        <div class="cb-eyebrow">Useful Links</div> 

        <div class="cb-value"><a href="/vD/packages.php">View all packages &amp; pricing →</a></div> 

        <div class="cb-value"><a href="/vD/pekoe-trail.php">Pekoe Trail information →</a></div> 

        <div class="cb-value"><a href="/vD/our-chambers.php">Browse all chambers →</a></div> 

        <div class="cb-value"><a href="/vD/the-entire-estate.php">Estate buyout enquiry →</a></div> 

      </div> 

 

    </div> 

  </div> 

</div> 

 

<!-- LOCATION --> 

<section class="location-section" id="location"> 

  <div class="location-inner"> 

    <div class="reveal"> 

      <div class="loc-eyebrow">Getting Here</div> 

      <h2 class="loc-title">Find Us in the Hills</h2> 

      <p class="loc-body">Galaha Estate sits in Sri Lanka's central highlands, approximately 45 minutes from Kandy city. We provide transfers from Kandy, Peradeniya Railway Station, and — for Pekoe Trail guests — all stage start and end points.</p> 

 

      <div class="loc-address"> 

        <strong>Postal Address</strong> 

        <p>The Tea Bungalow (Circa 1890)<br>Galaha Estate, Moragolla Road<br>Kandy 20400, Sri Lanka</p> 

      </div> 

 

      <div class="loc-how"> 

        <div class="loc-how-item"> 

          <div class="loc-how-icon">🚂</div> 

          <div class="loc-how-info"> 

            <div class="loc-how-name">By Train</div> 

            <div class="loc-how-detail">Arrive at Peradeniya or Kandy Railway Station. We arrange a private transfer (~45 minutes). WhatsApp us from the platform and we'll be there.</div> 

          </div> 

        </div> 

        <div class="loc-how-item"> 

          <div class="loc-how-icon">✈️</div> 

          <div class="loc-how-info"> 

            <div class="loc-how-name">From Colombo Airport</div> 

            <div class="loc-how-detail">Bandaranaike International Airport to the estate is approximately 3.5–4 hours by private car. Transfer can be arranged on request.</div> 

          </div> 

        </div> 

        <div class="loc-how-item"> 

          <div class="loc-how-icon">🏙️</div> 

          <div class="loc-how-info"> 

            <div class="loc-how-name">From Kandy City</div> 

            <div class="loc-how-detail">The bungalow is approximately 45 minutes from Kandy city centre by car or tuk-tuk along the Galaha Road.</div> 

          </div> 

        </div> 

        <div class="loc-how-item"> 

          <div class="loc-how-icon">🥾</div> 

          <div class="loc-how-info"> 

            <div class="loc-how-name">From the Pekoe Trail</div> 

            <div class="loc-how-detail">Stage 1 ends at Galaha Post Office, a 5-minute drive from the bungalow. We collect all Pekoe Trail guests at the trail end — no need to navigate independently.</div> 

          </div> 

        </div> 

      </div> 

    </div> 

 

    <div class="map-ph reveal d1" id="location-map">
  <iframe
    title="Map to The Tea Bungalow, Galaha Estate"
    src="https://www.google.com/maps?q=The%20Tea%20Bungalow%2C%20Moragolla%20Road%2C%20Galaha%2C%20Sri%20Lanka&output=embed"
    width="100%" height="100%" style="border:0; min-height:420px;" loading="lazy"
    referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
</div> 

  </div> 

</section> 

 

<!-- FAQ --> 

<section class="faq-strip"> 

  <div class="faq-inner"> 

    <div class="faq-eyebrow reveal">Before You Enquire</div> 

    <h2 class="faq-title reveal">Quick Answers</h2> 

 

    <div class="faq-item reveal"> 

      <div class="faq-q"><div class="faq-q-text">Can I book directly rather than through Booking.com?</div><div class="faq-toggle">+</div></div> 

      <div class="faq-a"><p>Yes — and we actively encourage it. Direct bookings receive priority responses, our best rates, and a complimentary packed lunch for Stage 2 or a welcome experience add-on. Use the form above, email, or WhatsApp.</p></div> 

    </div> 

    <div class="faq-item reveal"> 

      <div class="faq-q"><div class="faq-q-text">What's the fastest way to check availability?</div><div class="faq-toggle">+</div></div> 

      <div class="faq-a"><p>WhatsApp us directly on +94 (0)777 874 555. Send your dates, party size, and what you're looking for — we'll respond within a few hours with availability and current rates.</p></div> 

    </div> 

    <div class="faq-item reveal"> 

      <div class="faq-q"><div class="faq-q-text">Do you cater for dietary requirements?</div><div class="faq-toggle">+</div></div> 

      <div class="faq-a"><p>Yes. Vegetarian, vegan, gluten-free, and specific allergies are all accommodated with advance notice. Please mention any requirements in your enquiry and the kitchen will prepare accordingly.</p></div> 

    </div> 

    <div class="faq-item reveal"> 

      <div class="faq-q"><div class="faq-q-text">I'm a travel agent or tour operator — who should I contact?</div><div class="faq-toggle">+</div></div> 

      <div class="faq-a"><p>Email us at stay@theteabungalow.com and mention you're enquiring for trade. We have a trade rate sheet and commission structure for tour operators and DMCs. We're happy to provide detailed property information and a downloadable one-sheet for your brochure.</p></div> 

    </div> 

    <div class="faq-item reveal"> 

      <div class="faq-q"><div class="faq-q-text">Is there parking at the estate?</div><div class="faq-toggle">+</div></div> 

      <div class="faq-a"><p>Yes — there is secure parking for guests arriving by car under the estate's car porch and in the grounds. For Pekoe Trail hikers, leaving your car at the estate while hiking is perfectly fine.</p></div> 

    </div> 

  </div> 

</section> 

 

<?php include 'layout/footer.php'; ?> 

 

<script> 

const nav = document.getElementById('nav'); 

window.addEventListener('scroll', () => { nav.classList.toggle('scrolled', window.scrollY > 60); }); 

 

const reveals = document.querySelectorAll('.reveal'); 

const obs = new IntersectionObserver(entries => { 

  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); } }); 

}, { threshold: 0.08 }); 

reveals.forEach(el => obs.observe(el)); 

 

document.querySelectorAll('.faq-item').forEach(item => { 

  item.querySelector('.faq-q').addEventListener('click', () => item.classList.toggle('open')); 

}); 

 

// Enquiry form — server-side submission via fetch() 

document.getElementById('enquiry-form').addEventListener('submit', async function(e) { 

  e.preventDefault(); 

  // Client-side required-field highlight 
  const required = this.querySelectorAll('[required]'); 
  let valid = true; 
  required.forEach(field => { 
    field.style.borderColor = ''; 
    if (!field.value.trim()) { field.style.borderColor = '#c0392b'; valid = false; } 
  }); 
  if (!valid) return; 

  const btn = this.querySelector('.form-submit'); 
  const origText = btn.textContent; 
  btn.disabled = true; 
  btn.textContent = 'Sending…'; 

  try { 
    const res  = await fetch('submit_enquiry.php', { 
      method: 'POST', 
      body:   new FormData(this), 
    }); 
    const data = await res.json(); 
    if (data.ok) { 
      this.style.display = 'none'; 
      document.getElementById('form-success').style.display = 'block'; 
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push({ event: 'enquiry_submitted' });
    } else { 
      alert('There was an issue: ' + data.message); 
      btn.disabled = false; 
      btn.textContent = origText; 
    } 
  } catch (err) { 
    alert('Network error. Please try again or contact us via WhatsApp.'); 
    btn.disabled = false; 
    btn.textContent = origText; 
  } 

}); 

 

// Set min date for arrival/departure 

const today = new Date().toISOString().split('T')[0]; 

document.getElementById('arrival').min = today; 

document.getElementById('departure').min = today; 

document.getElementById('arrival').addEventListener('change', function() { 

  document.getElementById('departure').min = this.value; 

}); 

</script> 

</body> 

</html> 