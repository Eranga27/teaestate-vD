/* ═══════════════════════════════════════════════════════════════════════════
   vE · The Entire Estate. The party tabs and the clock face work without
   motion; everything scroll-driven runs through VE.ready.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };
  var clamp = function (v) { return v < 0 ? 0 : v > 1 ? 1 : v; };
  var smooth = function (t) { return t * t * (3 - 2 * t); };
  var SVG = 'http://www.w3.org/2000/svg';

  /* ── Who the estate welcomes: tabs (arrow keys move between them) ── */
  var parties = q('.vx-parties');
  if (parties) {
    var tabs = qa('[role="tab"]', parties), panels = qa('[role="tabpanel"]', parties);
    var select = function (tab, focus) {
      tabs.forEach(function (t) {
        var on = t === tab;
        t.classList.toggle('is-on', on);
        t.setAttribute('aria-selected', on ? 'true' : 'false');
        t.tabIndex = on ? 0 : -1;
      });
      panels.forEach(function (p) { p.classList.toggle('is-on', p.id === tab.getAttribute('aria-controls')); });
      if (focus) tab.focus();
    };
    tabs.forEach(function (t, i) {
      t.addEventListener('click', function () { select(t); });
      t.addEventListener('keydown', function (e) {
        if (e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') return;
        e.preventDefault();
        select(tabs[(i + (e.key === 'ArrowRight' ? 1 : tabs.length - 1)) % tabs.length], true);
      });
    });
    parties.classList.add('is-tabbed');
  }

  /* ── The moonstone clock: hour ticks and a mark for each moment of the day ── */
  var dial = q('.vx-dial svg');
  var dayHours = qa('.vx-dstep').map(function (s) { return parseFloat(s.getAttribute('data-hour')); });
  var marks = [];
  if (dial) {
    var ticks = q('.vx-dial__ticks', dial), marksG = q('.vx-dial__marks', dial);
    for (var h = 0; h < 24; h++) {
      var line = document.createElementNS(SVG, 'line');
      var major = h % 6 === 0;
      line.setAttribute('x1', 0); line.setAttribute('x2', 0);
      line.setAttribute('y1', major ? -226 : -238); line.setAttribute('y2', -250);
      line.setAttribute('transform', 'rotate(' + ((h - 12) * 15) + ')');
      if (major) line.setAttribute('class', 'is-major');
      ticks.appendChild(line);
    }
    dayHours.forEach(function (hr) {
      var a = (hr - 12) * 15 * Math.PI / 180, c = document.createElementNS(SVG, 'circle');
      c.setAttribute('cx', (250 * Math.sin(a)).toFixed(1));
      c.setAttribute('cy', (-250 * Math.cos(a)).toFixed(1));
      c.setAttribute('r', 8);
      marksG.appendChild(c);
      marks.push(c);
    });
  }

  if (VE.reduce) return;

  VE.ready(function () {
    /* ── Hero: the title rises in front of the closed gates… ── */
    gsap.set('.vx-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.vx-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.1)
      .to(['.vx-hero__intro .ve-crumbs', '.vx-hero__intro .ve-kicker', '.vx-hero__lede', '.vx-hero__hint'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.3)
      .fromTo('.vx-gates', { opacity: 0 }, { opacity: 1, duration: 1.6, ease: 'power2.out' }, 0);

    /* …then scrolling swings them open into the estate, and the promise appears */
    gsap.timeline({ scrollTrigger: { trigger: '.vx-hero__pin', start: 'top top', end: '+=160%', pin: true, scrub: 1, anticipatePin: 1 } })
      .to('.vx-hero__intro', { opacity: 0, y: -60, ease: 'power1.in', duration: 0.25 }, 0)
      .fromTo('.vx-gate--l', { rotateY: 0 }, { rotateY: 104, ease: 'power2.inOut', duration: 0.6 }, 0.05)
      .fromTo('.vx-gate--r', { rotateY: 0 }, { rotateY: -104, ease: 'power2.inOut', duration: 0.6 }, 0.05)
      .to('.vx-pillar--l', { xPercent: -220, opacity: 0, ease: 'power2.in', duration: 0.4 }, 0.3)
      .to('.vx-pillar--r', { xPercent: 220, opacity: 0, ease: 'power2.in', duration: 0.4 }, 0.3)
      .fromTo('.vx-hero__scene img', { scale: 1.32 }, { scale: 1.02, ease: 'power1.out', duration: 0.9 }, 0)
      .to('.vx-gate', { opacity: 0, ease: 'power1.in', duration: 0.2 }, 0.5)
      .fromTo('.vx-hero__promise', { opacity: 0, y: 40 }, { opacity: 1, y: 0, ease: 'power2.out', duration: 0.25 }, 0.62)
      .to({}, { duration: 0.15 });

    /* ── The numbers count up ── */
    qa('.vx-count [data-count]').forEach(function (el) {
      var end = parseInt(el.getAttribute('data-count'), 10), state = { v: 0 };
      el.textContent = '0';
      ScrollTrigger.create({ trigger: el, start: 'top 88%', once: true, onEnter: function () {
        gsap.to(state, { v: end, duration: 1.8, ease: 'power3.out', onUpdate: function () { el.textContent = String(Math.round(state.v)); } });
      } });
    });

    /* ── The ledger writes itself, line by line ── */
    qa('.vx-ledger__page').forEach(function (page) {
      // The negative left inset keeps each entry's number (in the margin, outside the row) visible
      gsap.fromTo(qa('.vx-ledger__rows li', page), { opacity: 0, clipPath: 'inset(0% 100% 0% -60px)' },
        { opacity: 1, clipPath: 'inset(0% 0% 0% -60px)', duration: 0.9, ease: 'power2.out', stagger: 0.11,
          scrollTrigger: { trigger: page, start: 'top 72%', once: true } });
    });

    /* ── The walk-through: each room opens through a doorway as you walk into it ── */
    (function walk() {
      var pin = q('.vx-walk__pin'), rooms = qa('.vx-walk__room'), cards = qa('.vx-wcard'), steps = qa('.vx-walk__steps li');
      if (!pin || rooms.length < 2) return;
      var n = rooms.length, current = -1;
      var imgs = rooms.map(function (r) { return q('img, svg', r); });
      function render(p) {
        var s = p * (n - 1), i = Math.min(n - 2, Math.floor(s)), f = s - i;
        if (p >= 1) { i = n - 2; f = 1; }
        var e = smooth(clamp((f - 0.2) / 0.6)); // hold on each room, then walk through the next doorway
        rooms.forEach(function (room, k) {
          if (k <= i) { // rooms passed: fully open; the one we're leaving grows as we walk through it
            room.style.visibility = 'visible';
            room.style.clipPath = 'inset(0% 0% 0% 0% round 0px 0px 0px 0px)';
            room.style.transform = k === i ? 'scale(' + (1 + 0.28 * e).toFixed(4) + ')' : 'scale(1.28)';
          } else if (k === i + 1) { // the doorway ahead, opening
            var top = 38 * (1 - e), side = 40 * (1 - e), r = e > 0.98 ? 0 : 999;
            room.style.visibility = 'visible';
            room.style.transform = 'none';
            room.style.clipPath = 'inset(' + top.toFixed(2) + '% ' + side.toFixed(2) + '% 0% ' + side.toFixed(2) + '% round ' + r + 'px ' + r + 'px 0px 0px)';
            if (imgs[k]) imgs[k].style.transform = 'scale(' + (1.3 - 0.3 * e).toFixed(4) + ')';
          } else {
            room.style.visibility = 'hidden';
          }
        });
        var active = f < 0.55 ? i : i + 1;
        if (active !== current) {
          current = active;
          cards.forEach(function (c, k) { c.classList.toggle('is-on', k === active); });
          steps.forEach(function (c, k) { c.classList.toggle('is-on', k === active); });
        }
      }
      var proxy = { p: 0 };
      render(0);
      gsap.to(proxy, { p: 1, ease: 'none', onUpdate: function () { render(proxy.p); },
        scrollTrigger: { trigger: pin, start: 'top top', end: function () { return '+=' + Math.round(window.innerHeight * 5.4); },
          pin: true, scrub: 1, invalidateOnRefresh: true, anticipatePin: 1 } });
    })();

    /* ── Services and parties arrive ── */
    gsap.from('.vx-services__grid li', { opacity: 0, y: 30, duration: 1, ease: 'expo.out', stagger: 0.07,
      scrollTrigger: { trigger: '.vx-services__grid', start: 'top 82%', once: true } });

    /* ── A day at the estate: the hand sweeps round the moonstone clock ── */
    (function day() {
      var pin = q('.vx-day__pin'), steps = qa('.vx-dstep'), hand = q('.vx-dial__hand');
      var timeEl = q('.vx-dial__time span'), ampmEl = q('.vx-dial__time em');
      if (!pin || !hand || !steps.length) return;
      var n = dayHours.length, current = -1;
      function render(p) {
        var s = p * (n - 1), i = Math.min(n - 2, Math.floor(s)), f = s - i;
        if (p >= 1) { i = n - 2; f = 1; }
        var g = smooth(clamp((f - 0.3) / 0.4));
        var h = dayHours[i] + (dayHours[i + 1] - dayHours[i]) * g;
        hand.setAttribute('transform', 'rotate(' + ((h - 12) * 15).toFixed(2) + ')');
        var hr = Math.floor(h), mins = Math.floor(((h - hr) * 60) / 5) * 5;
        timeEl.textContent = ((hr % 12) || 12) + ':' + (mins < 10 ? '0' : '') + mins;
        ampmEl.textContent = hr < 12 ? 'AM' : 'PM';
        var active = f < 0.5 ? i : i + 1;
        if (active !== current) {
          current = active;
          steps.forEach(function (el, k) { el.classList.toggle('is-on', k === active); });
          marks.forEach(function (el, k) { el.classList.toggle('is-on', k <= active); });
        }
      }
      var proxy = { p: 0 };
      render(0);
      gsap.to(proxy, { p: 1, ease: 'none', onUpdate: function () { render(proxy.p); },
        scrollTrigger: { trigger: pin, start: 'top top', end: function () { return '+=' + Math.round(window.innerHeight * 3.4); },
          pin: true, scrub: 1, invalidateOnRefresh: true, anticipatePin: 1 } });
    })();

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
