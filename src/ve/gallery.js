/* ═══════════════════════════════════════════════════════════════════════════
   vE · Gallery. The filters, the viewer and the film work without motion;
   the step back from one photograph into the wall, and the tiles arriving,
   run through VE.ready.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };
  var root = document.documentElement;

  /* ── Filters: show one kind of photograph, or all of them ── */
  var tiles = qa('.gl-tile'), chips = qa('.gl-chip');
  chips.forEach(function (chip) {
    chip.addEventListener('click', function () {
      var f = chip.getAttribute('data-filter');
      chips.forEach(function (c) { var on = c === chip; c.classList.toggle('is-on', on); c.setAttribute('aria-pressed', on ? 'true' : 'false'); });
      tiles.forEach(function (t) { t.classList.toggle('is-hidden', f !== 'all' && t.getAttribute('data-cat') !== f); });
      if (window.ScrollTrigger) ScrollTrigger.refresh();
    });
  });

  /* ── The viewer: one photograph at a time; arrows, Escape and swipes; focus comes back to the tile ── */
  var box = q('.gl-box'), img = q('.gl-box__img'), title = q('.gl-box__title'), sub = q('.gl-box__sub'), count = q('.gl-box__count');
  var list = [], at = 0, opener = null;
  var visibleLinks = function () { return qa('.gl-tile:not(.is-hidden) .gl-tile__link'); };
  function show(i, turn) {
    at = (i + list.length) % list.length;
    var a = list[at], go = function () {
      img.src = a.getAttribute('href');
      img.alt = (q('img', a) || {}).alt || '';
      title.textContent = a.getAttribute('data-title') || '';
      sub.textContent = a.getAttribute('data-sub') || '';
      count.textContent = (at + 1) + ' / ' + list.length;
      box.classList.remove('is-turning');
    };
    if (turn) { box.classList.add('is-turning'); setTimeout(go, 180); } else go();
    // Warm the next picture
    var next = list[(at + 1) % list.length];
    if (next) { var pre = new Image(); pre.src = next.getAttribute('href'); }
  }
  function open(a) {
    list = visibleLinks();
    opener = a;
    box.hidden = false;
    root.classList.add('gl-box-open');
    if (VE.lenis) VE.lenis.stop();
    show(list.indexOf(a));
    q('.gl-box__close', box).focus();
  }
  function close() {
    box.hidden = true;
    root.classList.remove('gl-box-open');
    if (VE.lenis) VE.lenis.start();
    img.removeAttribute('src');
    if (opener) opener.focus();
  }
  if (box) {
    document.addEventListener('click', function (e) {
      var a = e.target.closest('.gl-tile__link');
      if (!a) return;
      e.preventDefault();
      open(a);
    });
    q('.gl-box__close', box).addEventListener('click', close);
    q('.gl-box__nav--prev', box).addEventListener('click', function () { show(at - 1, true); });
    q('.gl-box__nav--next', box).addEventListener('click', function () { show(at + 1, true); });
    box.addEventListener('click', function (e) { if (e.target === box) close(); });
    document.addEventListener('keydown', function (e) {
      if (box.hidden) return;
      if (e.key === 'Escape') close();
      else if (e.key === 'ArrowRight') show(at + 1, true);
      else if (e.key === 'ArrowLeft') show(at - 1, true);
      else if (e.key === 'Tab') { // keep focus inside the viewer
        var f = qa('button', box), first = f[0], last = f[f.length - 1];
        if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
        else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
      }
    });
    var sx = null;
    box.addEventListener('pointerdown', function (e) { sx = e.clientX; });
    box.addEventListener('pointerup', function (e) {
      if (sx === null) return;
      var dx = e.clientX - sx; sx = null;
      if (Math.abs(dx) > 50) show(at + (dx < 0 ? 1 : -1), true);
    });
  }

  /* ── The film: plays when it's on screen (not on Save-Data or reduced motion, where the button starts it) ── */
  var film = q('.gl-film'), video = q('.gl-film__video'), play = q('.gl-film__play');
  if (film && video) {
    var saveData = !!(navigator.connection && navigator.connection.saveData);
    var start = function () { var p = video.play(); film.classList.add('is-playing'); if (p && p.catch) p.catch(function () { film.classList.remove('is-playing'); }); };
    if (play) play.addEventListener('click', start);
    video.addEventListener('pause', function () { film.classList.remove('is-playing'); });
    video.addEventListener('play', function () { film.classList.add('is-playing'); });
    if (!VE.reduce && !saveData && 'IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        entries.forEach(function (en) { if (en.isIntersecting) start(); else video.pause(); });
      }, { threshold: 0.35 }).observe(video);
    }
  }

  if (VE.reduce) return;

  VE.ready(function () {
    /* ── One photograph, then many: the wall starts scaled so the house fills the screen ── */
    var mosaic = q('.gl-mosaic');
    var startScale = function () {
      var r = mosaic.getBoundingClientRect(), s = gsap.getProperty(mosaic, 'scale') || 1;
      var tw = r.width / s / 3, th = r.height / s / 3;
      return Math.max(window.innerWidth / tw, window.innerHeight / th) * 1.03;
    };
    gsap.set(mosaic, { xPercent: -50, yPercent: -50, x: 0, y: 0, scale: startScale() });
    gsap.set('.gl-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.gl-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.15)
      .to(['.gl-hero__text .ve-crumbs', '.gl-hero__text .ve-kicker', '.gl-hero__hint'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.35);
    gsap.timeline({ scrollTrigger: { trigger: '.gl-hero__pin', start: 'top top', end: '+=120%', pin: true, scrub: 1, anticipatePin: 1, invalidateOnRefresh: true } })
      .to('.gl-hero__hint', { opacity: 0, duration: 0.1 }, 0)
      .fromTo(mosaic, { scale: function () { return startScale(); } }, { scale: 1, ease: 'power2.inOut', duration: 0.85 }, 0)
      .to('.gl-hero__text', { y: -30, opacity: 0, ease: 'power1.in', duration: 0.25 }, 0.75)
      .to('.gl-hero__shade', { opacity: 0.5, duration: 0.5 }, 0.3);

    /* ── The tiles arrive a few at a time ── */
    ScrollTrigger.batch('.gl-tile', { start: 'top 92%', once: true, onEnter: function (batch) {
      batch.forEach(function (t, i) { setTimeout(function () { t.classList.add('is-in'); }, i * 90); });
    } });

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
