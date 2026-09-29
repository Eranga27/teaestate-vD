/* ═══════════════════════════════════════════════════════════════════════════
   vE · The Chairman's Bungalow. The drawing draws itself and the scaffolding
   goes up; the rest is reveals. Sending the waitlist is inline in the page.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };

  // Waitlist fields grow with what's typed; a fixed field clears its warning
  var form = q('#waitlist-form');
  if (form) {
    qa('.ch-field input', form).forEach(function (input) {
      var base = +input.getAttribute('size') || 10;
      input.addEventListener('input', function () {
        input.size = Math.max(base, Math.min(36, input.value.length + 1));
        if (input.value.trim()) { (input.closest('.ch-field') || input).classList.remove('is-invalid'); input.setAttribute('aria-invalid', 'false'); }
      });
    });
  }

  if (VE.reduce) return;

  VE.ready(function () {
    gsap.set('.ch-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.ch-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.1)
      .to(['.ch-hero .ve-crumbs', '.ch-hero .ve-kicker', '.ch-hero__side'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.3)
      // The house draws itself, outline first, then its details…
      .to('.ch-hero .ch-elev__draw path', { strokeDashoffset: 0, duration: 3.2, ease: 'power2.inOut' }, 0.4)
      .to('.ch-hero .ch-elev__detail path', { strokeDashoffset: 0, duration: 2.6, ease: 'power2.inOut' }, 1.6)
      // …and the scaffolding goes up over the wing still being restored
      .to('.ch-hero .ch-elev__scaffold', { opacity: 1, duration: 1.4, ease: 'power1.out' }, 3.1)
      .to(['.ch-elev figcaption', '.ch-hero__facts li'], { opacity: 1, duration: 1, stagger: 0.08 }, 2.6);
    gsap.to('.ch-elev__svg', { yPercent: -6, ease: 'none', scrollTrigger: { trigger: '.ch-hero', start: 'top top', end: 'bottom top', scrub: true } });

    gsap.from('.ch-expect__grid li', { opacity: 0, y: 24, duration: 1, ease: 'expo.out', stagger: 0.07, scrollTrigger: { trigger: '.ch-expect__grid', start: 'top 85%', once: true } });
    gsap.from('.ch-house', { opacity: 0, y: 40, duration: 1.2, ease: 'expo.out', stagger: 0.15, scrollTrigger: { trigger: '.ch-pair__grid', start: 'top 80%', once: true } });
    gsap.fromTo('.ch-pair__walk path', { strokeDashoffset: 54 }, { strokeDashoffset: 0, ease: 'none', repeat: -1, duration: 3 });
    gsap.from('.ch-card', { opacity: 0, y: 50, duration: 1.3, ease: 'expo.out', scrollTrigger: { trigger: '.ch-list', start: 'top 70%', once: true } });

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
