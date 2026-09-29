/* ═══════════════════════════════════════════════════════════════════════════
   vE · About the Estate. The quote's word split works without motion; the
   entrance, the story's changing picture, Ceylon tea in numbers and the rest
   run through VE.ready.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };

  /* ── Why we opened: one word at a time ── */
  var quote = q('.ab-why__quote [data-words]'), words = [];
  if (quote) {
    (function walk(node) {
      [].slice.call(node.childNodes).forEach(function (child) {
        if (child.nodeType === 3) {
          var frag = document.createDocumentFragment();
          child.textContent.split(/(\s+)/).forEach(function (part) {
            if (!part) return;
            if (/^\s+$/.test(part)) { frag.appendChild(document.createTextNode(part)); return; }
            var s = document.createElement('span');
            s.className = 'w';
            s.textContent = part;
            frag.appendChild(s);
          });
          child.parentNode.replaceChild(frag, child);
        } else if (child.nodeType === 1) walk(child);
      });
    })(quote);
    words = qa('.w', quote);
  }

  if (VE.reduce) return;

  VE.ready(function () {
    /* ── Where Ceylon tea began: the title rises, the hills open in their arch ── */
    gsap.set('.ab-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.ab-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.1)
      .to(['.ab-hero__text .ve-crumbs', '.ab-hero__text .ve-kicker', '.ab-hero__sub'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.35)
      .fromTo('.ab-hero__arch', { clipPath: 'inset(100% 0% 0% 0% round 999px 999px 0px 0px)' }, { clipPath: 'inset(0% 0% 0% 0% round 999px 999px 0px 0px)', duration: 1.8, ease: 'expo.inOut' }, 0.1)
      .fromTo('.ab-hero__mark', { opacity: 0, x: 60 }, { opacity: 1, x: 0, duration: 2.2 }, 0.4)
      .to('.ab-hero__facts li', { opacity: 1, duration: 1, stagger: 0.1 }, 0.9);
    gsap.to('.ab-hero__arch img', { scale: 1, yPercent: 6, ease: 'none', scrollTrigger: { trigger: '.ab-hero', start: 'top top', end: 'bottom top', scrub: true } });
    gsap.to('.ab-hero__mark', { yPercent: 30, ease: 'none', scrollTrigger: { trigger: '.ab-hero', start: 'top top', end: 'bottom top', scrub: true } });

    /* ── Why we opened lights up ── */
    if (words.length) gsap.to(words, { opacity: 1, ease: 'none', stagger: 0.1,
      scrollTrigger: { trigger: quote, start: 'top 80%', end: 'bottom 45%', scrub: 0.4 } });

    /* ── The story: the arch shows the paragraph you're reading ── */
    var imgs = qa('.ab-story__arch img');
    var showImg = function (i) { imgs.forEach(function (img) { img.classList.toggle('is-on', img.getAttribute('data-for') === String(i)); }); };
    qa('.ab-story__read [data-img]').forEach(function (p) {
      ScrollTrigger.create({ trigger: p, start: 'top 62%', end: 'bottom 62%', onToggle: function (self) { if (self.isActive) showImg(p.getAttribute('data-img')); } });
    });

    /* ── Ceylon tea in numbers: one figure at a time, counting up, over the hills ── */
    (function numbers() {
      var pin = q('.ab-numbers__pin'), facts = qa('.ab-fact'), rail = qa('.ab-rail li');
      if (!pin || !facts.length) return;
      var n = facts.length, current = -1;
      var fmt = function (v) { return Math.round(v).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','); };
      function show(k) {
        if (k === current) return;
        current = k;
        facts.forEach(function (f, i) { f.classList.toggle('is-on', i === k); });
        rail.forEach(function (r, i) { r.classList.toggle('is-on', i === k); r.classList.toggle('is-past', i < k); });
        var num = q('.ab-fact__n', facts[k]), to = num && parseFloat(num.getAttribute('data-to'));
        if (num && to) {
          var c = { v: 0 };
          gsap.killTweensOf(num);
          gsap.to(c, { v: to, duration: to > 100 ? 1.6 : 1, ease: 'power3.out', onUpdate: function () { num.textContent = fmt(c.v); } });
        }
      }
      show(0);
      gsap.timeline({ scrollTrigger: { trigger: pin, start: 'top top', end: function () { return '+=' + Math.round(window.innerHeight * (n - 1) * 0.8); },
        pin: true, scrub: 1, invalidateOnRefresh: true, anticipatePin: 1,
        onUpdate: function (self) { show(Math.min(n - 1, Math.floor(self.progress * n))); } } })
        .fromTo('.ab-numbers__bg img', { scale: 1.12, xPercent: 3 }, { scale: 1, xPercent: -3, ease: 'none', duration: 1 }, 0);
    })();

    gsap.from('.ab-values__list li', { opacity: 0, y: 24, duration: 1, ease: 'expo.out', stagger: 0.07,
      scrollTrigger: { trigger: '.ab-values__list', start: 'top 85%', once: true } });
    gsap.from('.ab-care__list li', { opacity: 0, y: 24, duration: 1, ease: 'expo.out', stagger: 0.07,
      scrollTrigger: { trigger: '.ab-care__list', start: 'top 85%', once: true } });
    gsap.fromTo('.ab-close__bg img', { scale: 1.14 }, { scale: 1, ease: 'none',
      scrollTrigger: { trigger: '.ab-close', start: 'top bottom', end: 'bottom top', scrub: true } });

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
