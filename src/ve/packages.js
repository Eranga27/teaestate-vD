/* ═══════════════════════════════════════════════════════════════════════════
   vE · Packages & Offers. The chooser ↔ chest highlight works without motion;
   the chests' arrival, the section nav, the route (you walk, your bag rides
   ahead) and the rest run through VE.ready. "Your stay" is the shared list
   in ve.js.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };

  /* ── Pointing at a way to come lifts its chest, and the other way round ── */
  var hot = function (key, on) {
    qa('[data-chest="' + key + '"]').forEach(function (el) { el.classList.toggle('is-hot', on); });
  };
  qa('[data-chest]').forEach(function (el) {
    var key = el.getAttribute('data-chest');
    el.addEventListener('pointerenter', function () { hot(key, true); });
    el.addEventListener('pointerleave', function () { hot(key, false); });
    el.addEventListener('focus', function () { hot(key, true); });
    el.addEventListener('blur', function () { hot(key, false); });
  });

  if (VE.reduce) return;

  VE.ready(function () {
    /* ── Arrival: the title rises, the chests are set down one by one, then the offer is stamped ── */
    gsap.set('.pk-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.pk-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.1)
      .to(['.pk-hero__text .ve-crumbs', '.pk-hero__text .ve-kicker', '.pk-hero__sub'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.3)
      .fromTo('.pk-choose li', { opacity: 0, y: 16 }, { opacity: 1, y: 0, duration: 1, stagger: 0.08 }, 0.55)
      .fromTo(['.pk-chest--trail', '.pk-chest--heritage', '.pk-chest--estate'], { opacity: 0, y: -90 }, { opacity: 1, y: 0, duration: 1.1, ease: 'back.out(1.3)', stagger: 0.22 }, 0.25)
      .fromTo('.pk-chest__stencil', { opacity: 0 }, { opacity: 0.82, duration: 0.8, ease: 'power1.out', stagger: 0.22 }, 1)
      .fromTo('.pk-stamp', { opacity: 0, scale: 1.7 }, { opacity: 1, scale: 1, duration: 0.55, ease: 'power4.in', clearProps: 'transform' }, 1.7)
      .to('.pk-hero__facts li', { opacity: 1, duration: 1, stagger: 0.08 }, 1);
    gsap.to('.pk-stack', { yPercent: -8, ease: 'none', scrollTrigger: { trigger: '.pk-hero', start: 'top top', end: 'bottom top', scrub: true } });

    /* ── The section nav: after the chests; dark over the night; tucked under the header when it's out ── */
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
