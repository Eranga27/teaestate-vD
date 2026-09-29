/* ═══════════════════════════════════════════════════════════════════════════
   vE · Packages & Offers. The hero's panels open without motion too; the
   entrance, the section nav, the route (you walk, we carry the rest) and the
   rest run through VE.ready. "Your stay" is the shared list in ve.js.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };

  /* ── The three stays: the one you point at (or tab to) opens and lists its packages; the first starts open ── */
  var panels = qa('.pk-panel');
  var open = function (panel) { panels.forEach(function (p) { p.classList.toggle('is-open', p === panel); }); };
  panels.forEach(function (p) {
    p.addEventListener('pointerenter', function (e) { if (e.pointerType !== 'touch') open(p); });
    p.addEventListener('focus', function () { open(p); });
  });
  if (panels.length) open(panels[0]);

  if (VE.reduce) return;

  VE.ready(function () {
    /* ── Arrival: the three stays rise into place like curtains, then the title and the offer ── */
    gsap.set('.pk-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .fromTo('.pk-panel', { clipPath: 'inset(100% 0% 0% 0%)' }, { clipPath: 'inset(0% 0% 0% 0%)', duration: 1.6, ease: 'expo.inOut', stagger: 0.14 }, 0)
      .fromTo('.pk-panel__media img', { scale: 1.3 }, { scale: 1.08, duration: 2.4, stagger: 0.14, clearProps: 'transform' }, 0)
      .to('.pk-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.35)
      .to(['.pk-hero__side .ve-crumbs', '.pk-hero__side .ve-kicker', '.pk-hero__sub'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.55)
      .fromTo('.pk-deal', { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 1.2 }, 0.8)
      .to('.pk-hero__facts li', { opacity: 1, duration: 1, stagger: 0.08 }, 1)
      .fromTo('.pk-panel__body', { opacity: 0, y: 30 }, { opacity: 1, y: 0, duration: 1.2, stagger: 0.12 }, 1)
      .set('.pk-panel', { clearProps: 'clipPath' });
    // Scrolling away, the stays drift up behind the next section
    gsap.matchMedia().add('(min-width: 901px)', function () {
      gsap.to('.pk-hero__panels', { yPercent: 8, ease: 'none', scrollTrigger: { trigger: '.pk-hero', start: 'top top', end: 'bottom top', scrub: true } });
    });

    /* ── The section nav: after the hero; dark over the night; tucked under the header when it's out ── */
    var nav = q('.pk-nav'), header = document.getElementById('veHeader');
    if (nav) {
      ScrollTrigger.create({ trigger: '#trail', start: 'top 60%', endTrigger: '.pk-night', end: 'bottom 40%',
        onToggle: function (self) { nav.classList.toggle('is-visible', self.isActive); } });
      ScrollTrigger.create({ trigger: '.pk-night', start: 'top 60px', end: 'bottom top',
        onToggle: function (self) { nav.classList.toggle('is-dark', self.isActive); } });
      var links = qa('[data-nav]', nav);
      links.forEach(function (a) {
        var target = document.getElementById(a.getAttribute('data-nav'));
        if (!target) return;
        ScrollTrigger.create({ trigger: target, start: 'top 45%', end: 'bottom 45%',
          onToggle: function (self) {
            if (!self.isActive) return;
            links.forEach(function (l) { l.classList.toggle('is-on', l === a); });
            // On narrow screens the nav scrolls sideways: keep the current section in view
            var row = a.parentNode;
            if (row.scrollWidth > row.clientWidth) row.scrollTo({ left: a.offsetLeft - 20, behavior: 'smooth' });
          } });
      });
      if (header) {
        var under = function () { nav.classList.toggle('is-under', !header.classList.contains('is-hidden')); };
        new MutationObserver(under).observe(header, { attributes: true, attributeFilter: ['class'] });
        under();
      }
    }

    /* ── The route: you walk the trail while your bag goes ahead by road, and gets there first ── */
    (function journey() {
      var map = q('.pk-journey__map'), trail = q('#pkTrail'), walker = q('.pk-journey__walker'), bag = q('.pk-journey__bag');
      if (!map || !trail || !walker || !bag || getComputedStyle(map).display === 'none') return;
      var len = trail.getTotalLength();
      var clamp = function (v) { return v < 0 ? 0 : v > 1 ? 1 : v; };
      // The bag's legs by road (x along the road at y 212), timed to arrive before the walker does
      var LEGS = [[0.02, 0.2, 60, 440], [0.4, 0.52, 440, 800], [0.72, 0.84, 800, 1140]];
      var bagAt = function (p) {
        var x = 60;
        LEGS.forEach(function (l) { if (p >= l[0]) x = l[2] + (l[3] - l[2]) * clamp((p - l[0]) / (l[1] - l[0])); });
        return x;
      };
      var render = function (p) {
        trail.style.strokeDashoffset = (1 - p).toFixed(4);
        var pt = trail.getPointAtLength(len * p);
        walker.setAttribute('transform', 'translate(' + pt.x.toFixed(1) + ' ' + pt.y.toFixed(1) + ')');
        bag.setAttribute('transform', 'translate(' + bagAt(p).toFixed(1) + ' 212)');
      };
      var proxy = { p: 0 };
      render(0);
      gsap.to(proxy, { p: 1, ease: 'none', onUpdate: function () { render(proxy.p); },
        scrollTrigger: { trigger: map, start: 'top 78%', end: 'bottom 30%', scrub: 1 } });
    })();

    /* ── The whole estate: the house drifts behind the offers ── */
    gsap.fromTo('.pk-estate__bg img', { scale: 1.15 }, { scale: 1, ease: 'none',
      scrollTrigger: { trigger: '.pk-estate', start: 'top bottom', end: 'bottom top', scrub: true } });
    gsap.from('.pk-addon', { opacity: 0, y: 18, duration: 0.9, ease: 'expo.out', stagger: 0.04,
      scrollTrigger: { trigger: '.pk-addons', start: 'top 85%', once: true } });
    gsap.from('.pk-always__grid li', { opacity: 0, y: 24, duration: 1, ease: 'expo.out', stagger: 0.06,
      scrollTrigger: { trigger: '.pk-always__grid', start: 'top 85%', once: true } });

    /* ── "Your stay" pill: from the trail packages until the bespoke close ── */
    var sticky = q('.pk-sticky');
    if (sticky) {
      ScrollTrigger.create({ trigger: '#trail', start: 'top 70%', endTrigger: '.pk-close', end: 'top 75%', refreshPriority: -1,
        onToggle: function (self) { sticky.classList.toggle('is-visible', self.isActive); } });
    }

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
