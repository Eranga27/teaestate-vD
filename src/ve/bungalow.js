/* ═══════════════════════════════════════════════════════════════════════════
   vE · The Bungalow. Everything here is motion (without it the plan and the
   rooms simply follow one another): the hero rising into paper, the camera
   walking the plan room by room, and the story's year counter.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE || VE.reduce) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };
  var clamp = function (v) { return v < 0 ? 0 : v > 1 ? 1 : v; };
  var smooth = function (t) { return t * t * (3 - 2 * t); };

  VE.ready(function () {
    /* ── The house: the title rises over the photograph, the title block settles in… ── */
    gsap.set('.bh-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .fromTo('.bh-hero__photo img', { scale: 1.2 }, { scale: 1.08, duration: 3 }, 0)
      .to('.bh-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.2)
      .to(['.bh-hero__text .ve-crumbs', '.bh-hero__text .ve-kicker', '.bh-hero__sub', '.bh-hero__hint'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.4)
      .fromTo('.bh-block', { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 1.3 }, 0.7);

    /* …and scrolling on, paper rises over the photograph: the house becomes its drawing */
    gsap.set('.bh-hero__paper', { y: 0, yPercent: 100 });
    gsap.timeline({ scrollTrigger: { trigger: '.bh-hero', start: 'top top', end: '+=70%', pin: true, scrub: 1, anticipatePin: 1 } })
      .to('.bh-hero__photo', { scale: 1.12, ease: 'none', duration: 1 }, 0)
      .to(['.bh-hero__text', '.bh-block'], { opacity: 0, y: -40, ease: 'power1.in', duration: 0.4, stagger: 0.05 }, 0.1)
      .fromTo('.bh-hero__paper', { yPercent: 100 }, { yPercent: 0, ease: 'power1.inOut', duration: 0.6 }, 0.4);

    /* ── The house on paper: the camera is the plan's viewBox, moving from room to room; each
          stop holds for half its share of the scroll, then glides on to the next ── */
    (function plan() {
      var pin = q('.bh-plan__pin'), sheet = q('.bh-plan__sheet'), svg = q('.bh-plan__svg');
      var steps = qa('.bh-step'), now = q('.bh-plan__now');
      if (!pin || !svg || steps.length < 2) return;
      var views = steps.map(function (s) { return (s.getAttribute('data-view') || '500 350 1000').split(' ').map(Number); });
      var groups = steps.map(function (s) { return (s.getAttribute('data-rooms') || '').split(' ').filter(Boolean); });
      var rooms = qa('[data-room]', svg), labels = qa('[data-for]', svg);
      var n = steps.length, current = -1, aspect = 1;
      var measure = function () { var r = sheet.getBoundingClientRect(); aspect = r.height / Math.max(1, r.width); };
      function show(k) {
        if (k === current) return;
        current = k;
        steps.forEach(function (s, i) { s.classList.toggle('is-on', i === k); });
        var on = groups[k];
        rooms.forEach(function (r) { r.classList.toggle('is-on', on.indexOf(r.getAttribute('data-room')) > -1); });
        labels.forEach(function (l) { l.classList.toggle('is-on', on.indexOf(l.getAttribute('data-for')) > -1); });
        if (now) now.textContent = (k < 10 ? '0' : '') + k;
      }
      function render(p) {
        var s = p * (n - 1), k = Math.min(n - 2, Math.floor(s)), t = smooth(clamp((s - k - 0.5) / 0.5));
        var a = views[k], b = views[k + 1];
        var cx = a[0] + (b[0] - a[0]) * t, cy = a[1] + (b[1] - a[1]) * t;
        var w = a[2] * Math.pow(b[2] / a[2], t);
        // Fit the whole plan at the widest views, whatever the sheet's shape
        var h = w * aspect;
        if (w >= 1000 && h < 720) { h = 720; w = h / aspect; }
        svg.setAttribute('viewBox', (cx - w / 2).toFixed(1) + ' ' + (cy - h / 2).toFixed(1) + ' ' + w.toFixed(1) + ' ' + h.toFixed(1));
        show(t < 0.5 ? k : k + 1);
      }
      var proxy = { p: 0 };
      measure(); render(0);
      gsap.to(proxy, { p: 1, ease: 'none', onUpdate: function () { render(proxy.p); },
        scrollTrigger: { trigger: pin, start: 'top top', end: function () { return '+=' + Math.round(window.innerHeight * (n - 1) * 0.85); },
          pin: true, scrub: 1, invalidateOnRefresh: true, anticipatePin: 1, onRefresh: function () { measure(); render(proxy.p); } } });
      gsap.from('.bh-plan__svg', { opacity: 0, duration: 1.4, ease: 'power2.out', scrollTrigger: { trigger: pin, start: 'top 80%', once: true } });
    })();

    /* ── The story: the big year follows the entry you're reading; a gold line draws down the list ── */
    (function story() {
      var list = q('.bh-story__list'), yearBox = q('.bh-story__year'), items = qa('.bh-story__list li');
      if (!list || !items.length) return;
      gsap.fromTo(list, { '--p': 0 }, { '--p': 1, ease: 'none', scrollTrigger: { trigger: list, start: 'top 60%', end: 'bottom 60%', scrub: true } });
      // One number that rolls: out the top, new text, in from below (a newer change interrupts it)
      var span = yearBox && q('span', yearBox), shown = items[0].getAttribute('data-year'), roll = null;
      var setYear = function (y) {
        if (!span || y === shown) return;
        shown = y;
        if (roll) roll.kill();
        roll = gsap.timeline()
          .to(span, { yPercent: -105, duration: 0.3, ease: 'power2.in' })
          .add(function () { span.textContent = y; })
          .fromTo(span, { yPercent: 105 }, { yPercent: 0, duration: 0.6, ease: 'expo.out' });
      };
      items.forEach(function (li) {
        ScrollTrigger.create({ trigger: li, start: 'top 60%', end: 'bottom 60%',
          onToggle: function (self) { li.classList.toggle('is-on', self.isActive || self.progress === 1); if (self.isActive) setYear(li.getAttribute('data-year')); } });
      });
    })();

    gsap.from('.bh-access__list li', { opacity: 0, y: 20, duration: 1, ease: 'expo.out', stagger: 0.06,
      scrollTrigger: { trigger: '.bh-access__list', start: 'top 85%', once: true } });
    gsap.fromTo('.bh-close__bg img', { scale: 1.14 }, { scale: 1, ease: 'none',
      scrollTrigger: { trigger: '.bh-close', start: 'top bottom', end: 'bottom top', scrub: true } });

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
