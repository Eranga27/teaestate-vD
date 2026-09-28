/* ═══════════════════════════════════════════════════════════════════════════
   vE homepage choreography. Runs through VE.ready (after the preloader).
   Reduced motion: nothing here runs except the poster-only hero.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };

  /* ── Hero film: pick a size, play it while on screen (poster only for reduced motion / Save-Data) ── */
  (function setupVideo() {
    var v = q('.vh-hero__video');
    if (!v) return;
    var conn = navigator.connection || {};
    if (VE.reduce || conn.saveData || /(^|-)2g$/.test(conn.effectiveType || '')) return;
    var small = window.matchMedia('(max-width: 900px)').matches;
    v.src = v.getAttribute(small ? 'data-src-sm' : 'data-src-lg');
    var play = function () { var p = v.play(); if (p && p.catch) p.catch(function () {}); };
    play();
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) play(); else v.pause(); });
      }, { threshold: 0.01 }).observe(v);
    }
  })();

  /* ── Statement: wrap every word (the 1890 ring stays one unit) ── */
  function splitWords(el) {
    var walk = function (node) {
      [].slice.call(node.childNodes).forEach(function (child) {
        if (child.nodeType === 3) {
          var parts = child.textContent.split(/(\s+)/);
          var frag = document.createDocumentFragment();
          parts.forEach(function (p) {
            if (!p) return;
            if (/^\s+$/.test(p)) frag.appendChild(document.createTextNode(p));
            else { var s = document.createElement('span'); s.className = 'w'; s.textContent = p; frag.appendChild(s); }
          });
          child.parentNode.replaceChild(frag, child);
        } else if (child.nodeType === 1 && child.classList.contains('vh-ring')) {
          child.classList.add('w');
        } else if (child.nodeType === 1) walk(child);
      });
    };
    walk(el);
    return qa('.w', el);
  }
  var statement = q('[data-words]');
  var words = statement ? splitWords(statement) : [];

  if (VE.reduce) return;

  VE.ready(function () {
    var mm = gsap.matchMedia();

    /* ── 1. Hero entrance, then the film becomes a framed window as you scroll ── */
    var letters = qa('.vh-hero__title span');
    // y: 0 clears the pixel offset GSAP reads from the CSS start state, so only yPercent moves them
    gsap.set(letters, { y: 0, yPercent: 105 });
    gsap.set('.vh-hero__frame', { clipPath: 'inset(0% 0% 0% 0% round 0px)' });
    var intro = gsap.timeline({ defaults: { ease: 'expo.out' } });
    intro.to(letters, { yPercent: 0, duration: 1.7, stagger: 0.075 }, 0.05)
      .to('.vh-hero__video', { scale: 1, duration: 2.6, ease: 'power2.out' }, 0)
      .to(['.vh-hero__top', '.vh-hero__copy', '.vh-hero__actions'], { opacity: 1, duration: 1.3, stagger: 0.12, ease: 'power2.out' }, 0.55);

    gsap.timeline({
      scrollTrigger: { trigger: '.vh-hero', start: 'top top', end: '+=85%', pin: true, scrub: 0.6, anticipatePin: 1 }
    })
      .to('.vh-hero__frame', { clipPath: 'inset(10% 6% 16% 6% round 6px)', ease: 'none' }, 0)
      .to('.vh-hero__media', { scale: 1.12, ease: 'none' }, 0)
      .to('.vh-hero__title', { yPercent: -38, opacity: 0, ease: 'none' }, 0)
      .to(letters, { x: function (i) { return (i - 2.5) * window.innerWidth * 0.035; }, ease: 'none' }, 0)
      .to('.vh-hero__ui', { opacity: 0, y: -50, ease: 'none' }, 0)
      .to('.vh-hero__grid', { opacity: 0, ease: 'none' }, 0);

    /* ── 2. Statement lights up word by word; the gold ring draws round 1890 ── */
    if (words.length) {
      gsap.to(words, { opacity: 1, ease: 'none', stagger: 0.12,
        scrollTrigger: { trigger: statement, start: 'top 78%', end: 'bottom 48%', scrub: 0.4 } });
      gsap.to('.vh-ring path', { strokeDashoffset: 0, ease: 'none',
        scrollTrigger: { trigger: '.vh-ring', start: 'top 62%', end: 'top 38%', scrub: 0.5 } });
    }

    /* ── 4. Chambers: pinned sideways gallery on desktop (native swipe on phones) ── */
    mm.add('(min-width: 901px)', function () {
      var section = q('.vh-rooms'), track = q('.vh-rooms__track'), viewport = q('.vh-rooms__viewport'), rail = q('.vh-rooms__rail span');
      if (!track) return;
      var distance = function () { return Math.max(0, track.scrollWidth - viewport.clientWidth); };
      var slide = gsap.to(track, {
        x: function () { return -distance(); }, ease: 'none',
        scrollTrigger: {
          trigger: section, start: 'top top', end: function () { return '+=' + distance(); },
          pin: true, scrub: 0.8, invalidateOnRefresh: true, anticipatePin: 1,
          onUpdate: function (self) { if (rail) rail.style.transform = 'scaleX(' + self.progress.toFixed(3) + ')'; }
        }
      });
      qa('.vh-room__media img').forEach(function (img) {
        gsap.fromTo(img, { xPercent: -7 }, { xPercent: 7, ease: 'none',
          scrollTrigger: { trigger: img.closest('.vh-room'), containerAnimation: slide, start: 'left right', end: 'right left', scrub: true } });
      });
    });

    /* ── 5. Pekoe Trail: the route draws down the page and lights each stop ── */
    gsap.to('.vh-route__draw', { strokeDashoffset: 0, ease: 'none',
      scrollTrigger: { trigger: '.vh-route', start: 'top 62%', end: 'bottom 62%', scrub: 0.5 } });
    qa('.vh-stop').forEach(function (stop) {
      ScrollTrigger.create({ trigger: stop, start: 'top 64%',
        onEnter: function () { stop.classList.add('is-active'); }, onLeaveBack: function () { stop.classList.remove('is-active'); } });
    });

    /* ── 6. Numbers count up once ── */
    qa('[data-count]').forEach(function (el) {
      var end = parseInt(el.getAttribute('data-count'), 10);
      var state = { v: end > 1000 ? end - 60 : 0 };
      el.textContent = String(state.v);
      ScrollTrigger.create({ trigger: el, start: 'top 86%', once: true, onEnter: function () {
        gsap.to(state, { v: end, duration: 2.2, ease: 'power3.out', onUpdate: function () { el.textContent = String(Math.round(state.v)); } });
      } });
    });
    gsap.from('.vh-numbers__list > div', { opacity: 0, y: 40, duration: 1.2, ease: 'expo.out', stagger: 0.12,
      scrollTrigger: { trigger: '.vh-numbers__list', start: 'top 85%', once: true } });

    /* ── 7. Experiences: a photo follows the pointer down the list ── */
    var list = q('.vh-exp__list'), float = q('.vh-exp__float');
    if (list && float && VE.finePointer) {
      var img = float.querySelector('img');
      gsap.set(float, { xPercent: -50, yPercent: -50, x: window.innerWidth / 2, y: window.innerHeight / 2 });
      var fx = gsap.quickTo(float, 'x', { duration: 0.7, ease: 'power3' }), fy = gsap.quickTo(float, 'y', { duration: 0.7, ease: 'power3' });
      list.addEventListener('pointermove', function (e) { fx(e.clientX); fy(e.clientY); });
      qa('.vh-exp__row a', list).forEach(function (a) {
        a.addEventListener('pointerenter', function () {
          var src = a.getAttribute('data-img');
          if (src && img.getAttribute('src') !== src) img.src = src;
          float.classList.add('is-on');
        });
      });
      list.addEventListener('pointerleave', function () { float.classList.remove('is-on'); });
      qa('.vh-exp__row a[data-img]', list).forEach(function (a) { var p = new Image(); p.src = a.getAttribute('data-img'); });
    }
    gsap.from('.vh-exp__row', { opacity: 0, y: 30, duration: 1, ease: 'expo.out', stagger: 0.08,
      scrollTrigger: { trigger: '.vh-exp__list', start: 'top 85%', once: true } });

    /* ── 9. Map: coastline, towns, then the road to Galaha ── */
    if (q('.vh-map')) {
      gsap.timeline({ scrollTrigger: { trigger: '.vh-map', start: 'top 78%', once: true } })
        .to('.vh-map__land', { strokeDashoffset: 0, duration: 2.4, ease: 'power2.inOut' })
        .to('.vh-map__land', { fillOpacity: 1, duration: 1.2, ease: 'power1.out' }, 1.5)
        .to('.vh-map__pin--minor', { opacity: 1, duration: 0.6, stagger: 0.18 }, 1.7)
        .to('.vh-map__route', { strokeDashoffset: 0, duration: 1.5, ease: 'power2.inOut' }, 2)
        .to('.vh-map__pin--home', { opacity: 1, duration: 0.7 }, 3.1);
    }

    /* ── 10. Closing: the lounge settles into place ── */
    gsap.fromTo('.vh-close__bg img', { scale: 1.18 }, { scale: 1, ease: 'none',
      scrollTrigger: { trigger: '.vh-close', start: 'top bottom', end: 'bottom bottom', scrub: true } });

    // Triggers were created out of page order (shared reveals first, pins here): sort before measuring
    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
