/* ═══════════════════════════════════════════════════════════════════════════
   vE · Contact. The letter's helpers (the trail line, the signature, dates,
   the guest's "Your stay" list) and the time in Galaha work without motion;
   the entrance runs through VE.ready. Sending the letter is inline in
   contact.php.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };
  var form = q('#enquiry-form');

  /* ── The time in Galaha, and a greeting to match ── */
  var now = q('.ct-now__text');
  function tick() {
    if (!now) return;
    try {
      var parts = new Intl.DateTimeFormat('en-GB', { timeZone: 'Asia/Colombo', hour: 'numeric', minute: '2-digit', hour12: false }).formatToParts(new Date());
      var h = +parts.find(function (p) { return p.type === 'hour'; }).value, m = parts.find(function (p) { return p.type === 'minute'; }).value;
      var greet = h >= 5 && h < 12 ? 'Good morning from Galaha' : h >= 12 && h < 17 ? 'Good afternoon from Galaha' : h >= 17 && h < 22 ? 'Good evening from Galaha' : 'Night-time in Galaha';
      now.textContent = greet + ': it’s ' + ((h % 12) || 12) + ':' + m + (h < 12 ? ' AM' : ' PM') + ' here. We reply within 24 hours.';
    } catch (e) { /* keep the static line */ }
  }
  tick(); setInterval(tick, 30000);

  if (form) {
    /* ── The trail line appears for trail enquiries ── */
    var type = form.elements['enquiry-type'], trail = q('.ct-line--trail', form);
    var syncTrail = function () { if (trail) trail.hidden = ['pekoe', 'tiffin', 'group'].indexOf(type.value) < 0; };
    if (type) { type.addEventListener('change', syncTrail); syncTrail(); }

    /* ── The letter signs itself as you write your name ── */
    var sign = q('.ct-letter__name', form), first = form.elements.first, last = form.elements.last;
    var syncSign = function () { if (sign) sign.textContent = [first.value.trim(), last.value.trim()].filter(Boolean).join(' '); };
    [first, last].forEach(function (f) { if (f) f.addEventListener('input', syncSign); });

    /* ── Fields grow with what's typed; a fixed field clears its warning ── */
    qa('.ct-field input[type="text"], .ct-field input[type="email"], .ct-field input[type="tel"]', form).forEach(function (input) {
      var base = +input.getAttribute('size') || 12;
      var grow = function () { input.size = Math.max(base, Math.min(40, input.value.length + 1)); };
      input.addEventListener('input', grow);
    });
    qa('[required]', form).forEach(function (f) {
      f.addEventListener('input', function () { if (f.value.trim()) { (f.closest('.ct-field') || f).classList.remove('is-invalid'); f.setAttribute('aria-invalid', 'false'); } });
    });

    /* ── Dates: not in the past, and leaving after arriving ── */
    var today = new Date().toISOString().split('T')[0], arrival = form.elements.arrival, departure = form.elements.departure;
    if (arrival && departure) {
      arrival.min = today; departure.min = today;
      arrival.addEventListener('change', function () { departure.min = arrival.value || today; if (departure.value && departure.value < arrival.value) departure.value = ''; });
    }

    /* ── Anything already on the guest's "Your stay" list (Experiences, Packages) can go with the letter ── */
    var stay = q('.ct-stay', form);
    var list = [];
    try { list = JSON.parse(localStorage.getItem('tb_stay') || '[]'); } catch (e) { list = []; }
    if (stay && Array.isArray(list) && list.length) {
      q('.ct-stay__list', stay).textContent = list.filter(function (x) { return typeof x === 'string'; }).join(', ');
      stay.hidden = false;
    }
  }

  if (VE.reduce) return;

  VE.ready(function () {
    gsap.set('.ct-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.ct-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.1)
      .to(['.ct-hero__text .ve-crumbs', '.ct-hero__text .ve-kicker', '.ct-hero__sub', '.ct-now'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.3)
      .fromTo('.ct-ways li', { opacity: 0, x: 40 }, { opacity: 1, x: 0, duration: 1.2, stagger: 0.1 }, 0.45);
    gsap.from('.ct-paper', { y: 60, opacity: 0, duration: 1.4, ease: 'expo.out', scrollTrigger: { trigger: '.ct-write', start: 'top 80%', once: true } });
    gsap.from('.ct-paper__seal', { scale: 1.8, rotate: -30, opacity: 0, duration: 0.7, ease: 'back.out(2)', delay: 0.5, scrollTrigger: { trigger: '.ct-write', start: 'top 70%', once: true } });
    gsap.from('.ct-card', { opacity: 0, y: 30, duration: 1, ease: 'expo.out', stagger: 0.1, scrollTrigger: { trigger: '.ct-side', start: 'top 85%', once: true } });
    gsap.from('.ct-routes li', { opacity: 0, y: 20, duration: 1, ease: 'expo.out', stagger: 0.08, scrollTrigger: { trigger: '.ct-routes', start: 'top 85%', once: true } });

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
