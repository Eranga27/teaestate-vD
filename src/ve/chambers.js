/* ═══════════════════════════════════════════════════════════════════════════
   vE · Our Chambers. The key rack and the room finder work without motion;
   everything scroll-driven runs through VE.ready (after the preloader/segue).
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };

  /* ── Key rack: pointing at a key looks into its room ── */
  var bgs = qa('.vc-hero__bgs img');
  var showRoom = function (key) { bgs.forEach(function (img) { img.classList.toggle('is-on', img.getAttribute('data-bg') === key); }); };
  qa('.vc-key a').forEach(function (a) {
    var key = a.getAttribute('data-key');
    a.addEventListener('pointerenter', function () { showRoom(key); });
    a.addEventListener('focus', function () { showRoom(key); });
    a.addEventListener('blur', function () { showRoom('default'); });
  });
  var rack = q('.vc-rack');
  if (rack) rack.addEventListener('pointerleave', function () { showRoom('default'); });

  /* ── Finder: who's coming → which rooms suit, in words and on the row of arches ── */
  var chips = qa('[data-find]'), cards = qa('.vc-finder__rooms li'), result = q('.vc-finder__result');
  var LEADS = {
    all: 'All seven rooms, from the Founder’s Suite to the Carriage House Cottage.',
    couples: 'For a couple',
    families: 'For a family',
    stepfree: 'Step-free throughout',
    hikers: 'For Pekoe Trail hikers',
    solo: 'Travelling solo',
    cottage: 'A cottage of your own'
  };
  var EXTRA = {
    families: ' Or book the Highlands Suite and the Pekoe Room together as the family wing, for 6–8 guests.',
    hikers: ' Stage 2 of the trail starts a short walk from the gate.',
    cottage: ' Two bedrooms, a living room, dining area and kitchen, all stepless.'
  };
  var listNames = function (names) {
    if (names.length < 2) return names.join('');
    return names.slice(0, -1).join(', ') + ' and ' + names[names.length - 1];
  };
  var find = function (tag) {
    var matched = [];
    cards.forEach(function (li) {
      var hit = tag === 'all' || (' ' + li.getAttribute('data-tags') + ' ').indexOf(' ' + tag + ' ') > -1;
      li.classList.toggle('is-out', !hit);
      li.classList.toggle('is-match', hit && tag !== 'all');
      if (hit) matched.push('<b>' + li.querySelector('b').innerHTML + '</b>');
    });
    chips.forEach(function (c) {
      var on = c.getAttribute('data-find') === tag;
      c.classList.toggle('is-on', on);
      c.setAttribute('aria-pressed', on ? 'true' : 'false');
    });
    if (result) result.innerHTML = tag === 'all' ? LEADS.all : LEADS[tag] + ': ' + listNames(matched) + '.' + (EXTRA[tag] || '');
  };
  chips.forEach(function (c) { c.addEventListener('click', function () { find(c.getAttribute('data-find')); }); });

  if (VE.reduce) return;

  VE.ready(function () {
    /* ── Hero: the title rises, then the keys are hung one by one ── */
    // y: 0 clears the pixel offset GSAP reads from the CSS start state, so only yPercent moves them
    gsap.set('.vc-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.vc-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0)
      .to(['.vc-hero .ve-crumbs', '.vc-hero__lede'], { opacity: 1, duration: 1.2, stagger: 0.1 }, 0.35)
      .fromTo('.vc-key', { opacity: 0, y: -90, rotate: function (i) { return i % 2 ? 10 : -10; } },
        { opacity: 1, y: 0, rotate: 0, duration: 1.7, ease: 'elastic.out(1, 0.5)', stagger: 0.08 }, 0.45)
      .to('.vc-hero__hint', { opacity: 1, duration: 1 }, 1.4);

    /* ── Rooms: each arched doorway opens as you arrive; the photo drifts inside it ── */
    qa('.vc-room').forEach(function (room) {
      var arch = q('.vc-arch', room), img = q('.vc-arch img', room), num = q('.vc-room__num', room);
      gsap.fromTo(arch, { clipPath: 'inset(36% 24% 0% 24% round 999px 999px 0px 0px)' },
        { clipPath: 'inset(0% 0% 0% 0% round 999px 999px 0px 0px)', ease: 'none',
          scrollTrigger: { trigger: room, start: 'top 88%', end: 'top 25%', scrub: 0.6 } });
      gsap.fromTo(img, { yPercent: -5, scale: 1.16 }, { yPercent: 5, scale: 1.02, ease: 'none',
        scrollTrigger: { trigger: room, start: 'top bottom', end: 'bottom top', scrub: true } });
      if (num) gsap.fromTo(num, { yPercent: 35, opacity: 0 }, { yPercent: 0, opacity: 1, ease: 'none',
        scrollTrigger: { trigger: room, start: 'top 80%', end: 'top 30%', scrub: 0.6 } });
      gsap.from(qa('.vc-room__body > *', room), { opacity: 0, y: 34, duration: 1.1, ease: 'expo.out', stagger: 0.06,
        scrollTrigger: { trigger: room, start: 'top 62%', once: true } });
    });

    /* ── Where am I: side index on desktop, a pill on phones ── */
    var index = q('.vc-index'), now = q('.vc-now'), links = qa('.vc-index a');
    var nowNum = q('.vc-now__num'), nowName = q('.vc-now__name');
    var rooms = qa('.vc-room');
    ScrollTrigger.create({ trigger: '.vc-rooms', start: 'top 55%', end: 'bottom 45%', onToggle: function (self) {
      if (index) index.classList.toggle('is-visible', self.isActive);
      if (now) now.classList.toggle('is-visible', self.isActive);
    } });
    rooms.forEach(function (room, i) {
      ScrollTrigger.create({ trigger: room, start: 'top 50%', end: 'bottom 50%', onToggle: function (self) {
        if (!self.isActive) return;
        var id = room.getAttribute('data-room');
        links.forEach(function (a) { a.classList.toggle('is-on', a.getAttribute('data-for') === id); });
        if (nowNum) nowNum.textContent = (i < 6 ? '0' + (i + 1) : 'CH') + ' / 07';
        if (nowName) nowName.textContent = q('.vc-room__name', room).textContent;
      } });
    });

    /* ── The family wing draws itself: two arches and the door between them ── */
    var wing = gsap.timeline({ scrollTrigger: { trigger: '.vc-wing', start: 'top 65%', once: true } });
    wing.to('.vc-wing__arch', { strokeDashoffset: 0, duration: 1.6, ease: 'power2.inOut', stagger: 0.2 })
      .to('.vc-wing__floor', { strokeDashoffset: 0, duration: 1.2, ease: 'power2.inOut' }, 0.3)
      .from('.vc-wing__door', { opacity: 0, scaleY: 0.2, transformOrigin: '50% 100%', duration: 0.9, ease: 'expo.out' }, 1)
      .to('.vc-wing__link', { strokeDashoffset: 0, duration: 0.8, ease: 'power2.out' }, 1.2)
      .from('.vc-wing__plan text', { opacity: 0, y: 8, duration: 0.8, stagger: 0.08, ease: 'power2.out' }, 1.3);

    /* ── The whole house settles into view ── */
    gsap.fromTo('.vc-whole__bg img', { scale: 1.16 }, { scale: 1, ease: 'none',
      scrollTrigger: { trigger: '.vc-whole', start: 'top bottom', end: 'bottom top', scrub: true } });

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
