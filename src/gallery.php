<!DOCTYPE html>
<html lang="en" class="ve-page">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery · The House, the Estate &amp; the Trail · The Tea Bungalow</title>
  <meta name="description" content="Photographs of The Tea Bungalow: the 1890 planter's house on Galaha Estate, its salons and chambers, the tea fields and the Pekoe Trail, and the estate on film.">

<link rel="icon" type="image/png" href="images/favicon.png">
<meta property="og:type" content="website">
<meta property="og:title" content="Gallery · The Tea Bungalow · Galaha">
<meta property="og:description" content="The 1890 planter's house on Galaha Estate, its salons and chambers, the tea fields and the Pekoe Trail, in pictures.">
<meta property="og:url" content="https://www.theteabungalow.com/gallery">
<meta property="og:image" content="https://www.theteabungalow.com/media/lounge-arches-1600.webp">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Gallery · The Tea Bungalow · Galaha">
<meta name="twitter:description" content="The 1890 planter's house on Galaha Estate, its salons and chambers, the tea fields and the Pekoe Trail, in pictures.">
<link rel="canonical" href="https://www.theteabungalow.com/gallery">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600&family=EB+Garamond:ital,wght@0,400;0,500;1,400;1,500&display=swap">
  <!-- tb:sinhala-font -->
  <link rel="preload" as="image" href="/media/estate-house-1600.webp" fetchpriority="high">
  <link rel="stylesheet" href="/ve/ve.css">
  <link rel="stylesheet" href="/ve/gallery.css">
</head>

<body class="ve ve-gl">

  <!-- Shared: consent banner, reservation drawer, analytics hooks (legacy header stripped by the build on vE pages) -->
  <?php include 'layout/navbar.php'; ?>
  <?php include 'layout/ve/header.html'; ?>

  <main id="main">

    <!-- ═══ 1. ONE PHOTOGRAPH, THEN MANY: scrolling pulls back from the house into a wall of pictures ═══ -->
    <section class="gl-hero" data-theme="dark" aria-labelledby="glTitle">
      <div class="gl-hero__pin">
        <div class="gl-mosaic" aria-hidden="true">
          <figure><img src="/media/lounge-arches-900.webp" alt="" decoding="async"></figure>
          <figure><img src="/media/trail-tea-960.webp" alt="" decoding="async"></figure>
          <figure><img src="/media/chamber-founders-900.webp" alt="" decoding="async"></figure>
          <figure><img src="/media/lounge-fireplace-900.webp" alt="" decoding="async"></figure>
          <figure class="gl-mosaic__center"><img src="/media/estate-house-1600.webp" alt="" decoding="async" fetchpriority="high"></figure>
          <figure><img src="/media/lounge-windows-900.webp" alt="" decoding="async"></figure>
          <figure><img src="/media/chamber-carriage-900.webp" alt="" decoding="async"></figure>
          <figure><img src="/media/trail-highlands-920.webp" alt="" decoding="async"></figure>
          <figure><img src="/media/lounge-main-900.webp" alt="" decoding="async"></figure>
        </div>
        <div class="gl-hero__shade" aria-hidden="true"></div>
        <div class="ve-wrap gl-hero__text">
          <nav class="ve-crumbs" aria-label="Breadcrumb"><a href="/">Home</a><span aria-hidden="true">/</span><span>Gallery</span></nav>
          <p class="ve-label ve-kicker">In pictures <span class="ve-si" lang="si">ඡායාරූප</span></p>
          <h1 class="gl-hero__title" id="glTitle"><span class="gl-hero__line"><span>The house,</span></span><span class="gl-hero__line"><em>in pictures.</em></span></h1>
          <p class="gl-hero__hint ve-label" aria-hidden="true"><span class="gl-hero__hint-line"></span>Scroll to step back</p>
        </div>
      </div>
    </section>

    <!-- ═══ 2. THE PHOTOGRAPHS ═══ -->
    <section class="gl-wall" id="photos" data-theme="dark" aria-labelledby="wallTitle">
      <div class="ve-wrap">
        <div class="gl-wall__head">
          <div>
            <p class="ve-label ve-kicker">The collection</p>
            <h2 class="ve-h2" id="wallTitle" data-split><!-- tb:gallery-count --> photographs, <em>one house.</em></h2>
          </div>
          <div class="gl-filters" role="group" aria-label="Show photographs of"><!-- tb:gallery-filters --></div>
        </div>
        <ul class="gl-grid">
          <!-- tb:gallery -->
        </ul>
        <p class="gl-wall__note">Tap any photograph to see it larger. Use the arrow keys, or swipe, to move between them.</p>
      </div>
    </section>

    <!-- ═══ 3. ON FILM ═══ -->
    <section class="gl-film" id="film" data-theme="dark" aria-labelledby="filmTitle">
      <div class="ve-wrap gl-film__head">
        <p class="ve-label ve-kicker">Moving pictures</p>
        <h2 class="ve-h2" id="filmTitle" data-split>The estate, <em>on film.</em></h2>
      </div>
      <figure class="gl-film__frame">
        <video class="gl-film__video" muted loop playsinline preload="none" poster="/media/hero-estate-poster.webp" aria-label="The Tea Bungalow and Galaha Estate on film">
          <source src="/media/hero-estate-1080.mp4" type="video/mp4">
        </video>
        <button type="button" class="gl-film__play" aria-label="Play the film"><span aria-hidden="true"></span></button>
        <figcaption>The bungalow on its hillside, the tea around it and the ridges beyond: Galaha Estate, Kandy District.</figcaption>
      </figure>
    </section>

    <!-- ═══ 4. SEE IT FOR YOURSELF ═══ -->
    <section class="gl-close" id="enquire" data-theme="dark" aria-labelledby="closeTitle">
      <div class="ve-wrap gl-close__inner">
        <p class="ve-label ve-kicker">See it for yourself</p>
        <h2 class="gl-close__title" id="closeTitle" data-split>Photographs only go <em>so far.</em></h2>
        <p class="ve-lede" data-reveal="up">The mist, the fire at six-thirty, the smell of tea on the verandah: the rest has to be seen in person.</p>
        <div class="gl-close__cta">
          <button type="button" class="ve-btn ve-btn--gold tb-reserve-trigger" data-source="gallery_enquiry_cta" data-magnetic><span>Enquire about a stay</span></button>
          <a class="ve-btn" href="/our-chambers"><span>Browse the chambers</span></a>
        </div>
      </div>
    </section>

    <!-- ═══ NEXT CHAPTER ═════════════════════════════════════════════════ -->
    <a class="ve-next" href="/contact" data-theme="dark" data-cursor="Enter">
      <span class="ve-next__bg" aria-hidden="true"><img src="/media/estate-house-1600.webp" srcset="/media/estate-house-900.webp 900w, /media/estate-house-1600.webp 1600w" sizes="100vw" alt="" loading="lazy" decoding="async"></span>
      <span class="ve-next__label ve-label">Next chapter</span>
      <span class="ve-next__title">Contact</span>
      <span class="ve-next__sub">How to find us, and how to reach the estate team.</span>
      <span class="ve-next__go" aria-hidden="true">&rarr;</span>
    </a>

  </main>

  <!-- The viewer: one photograph at a time -->
  <div class="gl-box" role="dialog" aria-modal="true" aria-label="Photograph viewer" hidden>
    <button type="button" class="gl-box__close" aria-label="Close the viewer"><span aria-hidden="true">&times;</span></button>
    <button type="button" class="gl-box__nav gl-box__nav--prev" aria-label="Previous photograph"><span aria-hidden="true">&larr;</span></button>
    <figure class="gl-box__figure">
      <img class="gl-box__img" alt="">
      <figcaption><span class="gl-box__count"></span><b class="gl-box__title"></b><em class="gl-box__sub"></em></figcaption>
    </figure>
    <button type="button" class="gl-box__nav gl-box__nav--next" aria-label="Next photograph"><span aria-hidden="true">&rarr;</span></button>
  </div>

  <?php include 'layout/ve/footer.html'; ?>

  <script src="/js/vendor/gsap.min.js" defer></script>
  <script src="/js/vendor/ScrollTrigger.min.js" defer></script>
  <script src="/js/vendor/lenis.min.js" defer></script>
  <script src="/ve/ve.js" defer></script>
  <script src="/ve/gallery.js" defer></script>
</body>

</html>
