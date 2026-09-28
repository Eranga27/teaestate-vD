/* ═══════════════════════════════════════════════════════════════════════════
   vE · The Entire Estate. Tabs and the bedroom list work without motion;
   the gates, the day in the house and the rest run through VE.ready.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };
  var clamp = function (v) { return v < 0 ? 0 : v > 1 ? 1 : v; };
  var smooth = function (t) { return t * t * (3 - 2 * t); };

  /* ── Who it's for: tabs (arrow keys move between them); the arch shows each kind of stay ── */
  var parties = q('.vx-parties');
  if (parties) {
    var tabs = qa('[role="tab"]', parties), panels = qa('[role="tabpanel"]', parties), partyImgs = qa('.vx-parties__arch img', parties);
    var select = function (tab, focus) {
      tabs.forEach(function (t) {
        var on = t === tab;
        t.classList.toggle('is-on', on);
        t.setAttribute('aria-selected', on ? 'true' : 'false');
        t.tabIndex = on ? 0 : -1;
      });
      panels.forEach(function (p) {
        var on = p.id === tab.getAttribute('aria-controls');
        p.classList.toggle('is-on', on);
        if (on) partyImgs.forEach(function (img, k) { img.classList.toggle('is-on', k === +p.getAttribute('data-img')); });
      });
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

  /* ── The bedrooms: pointing at a room shows it in the arch ── */
  var roomImgs = qa('.vx-rooms__arch img'), roomRows = qa('.vx-rooms__list li'), roomCount = q('.vx-rooms__count span');
  var showRoom = function (id) {
    var index = 0;
    roomRows.forEach(function (li, k) { var on = li.getAttribute('data-room') === id; li.classList.toggle('is-on', on); if (on) index = k; });
    roomImgs.forEach(function (img) { img.classList.toggle('is-on', img.getAttribute('data-room') === id); });
    if (roomCount) roomCount.textContent = index < 6 ? '0' + (index + 1) : 'CH';
  };
  roomRows.forEach(function (li) { li.addEventListener('pointerenter', function () { showRoom(li.getAttribute('data-room')); }); });

  /* ── The manifesto: one word at a time ── */
  var manifesto = q('.vx-manifesto__text'), words = [];
  if (manifesto) {
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
    })(manifesto);
    words = qa('.w', manifesto);
  }

  if (VE.reduce) return;

  VE.ready(function () {
    /* ── Arrival: the title rises in front of the closed gates… ── */
    gsap.set('.vx-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.vx-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.1)
      .to(['.vx-hero__intro .ve-crumbs', '.vx-hero__intro .ve-kicker', '.vx-hero__hint'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.3)
      .fromTo('.vx-gates', { opacity: 0 }, { opacity: 1, duration: 1.8, ease: 'power2.out' }, 0);

    /* …scrolling swings them open, the camera moves through, the promise appears, and the mist
       rises into the cream page below */
    gsap.set('.vx-hero__fade', { y: 0, yPercent: 100 });
    gsap.timeline({ scrollTrigger: { trigger: '.vx-hero__pin', start: 'top top', end: '+=170%', pin: true, scrub: 1, anticipatePin: 1 } })
      .to('.vx-hero__intro', { opacity: 0, y: -50, ease: 'power1.in', duration: 0.22 }, 0)
      .fromTo('.vx-gate--l', { rotateY: 0 }, { rotateY: 102, ease: 'power2.inOut', duration: 0.55 }, 0.04)
      .fromTo('.vx-gate--r', { rotateY: 0 }, { rotateY: -102, ease: 'power2.inOut', duration: 0.55 }, 0.04)
      .to('.vx-gate', { opacity: 0, ease: 'power1.in', duration: 0.16 }, 0.38)
      .to('.vx-pillar--l', { xPercent: -260, opacity: 0, ease: 'power2.in', duration: 0.3 }, 0.18)
      .to('.vx-pillar--r', { xPercent: 260, opacity: 0, ease: 'power2.in', duration: 0.3 }, 0.18)
      .fromTo('.vx-hero__scene img', { scale: 1.3 }, { scale: 1.04, ease: 'power1.out', duration: 0.85 }, 0)
      .fromTo('.vx-hero__grade', { opacity: 1 }, { opacity: 0.55, duration: 0.7 }, 0.1)
      .fromTo('.vx-hero__promise', { opacity: 0, y: 30 }, { opacity: 1, y: 0, ease: 'power2.out', duration: 0.2 }, 0.48)
      .to('.vx-hero__promise', { opacity: 0, y: -40, ease: 'power1.in', duration: 0.14 }, 0.8)
      .fromTo('.vx-hero__fade', { yPercent: 100 }, { yPercent: 0, ease: 'power1.inOut', duration: 0.3 }, 0.72);

    /* ── The manifesto lights up ── */
    if (words.length) gsap.to(words, { opacity: 1, ease: 'none', stagger: 0.1,
      scrollTrigger: { trigger: manifesto, start: 'top 80%', end: 'bottom 45%', scrub: 0.4 } });
    gsap.from('.vx-manifesto__promise li', { opacity: 0, y: 24, duration: 1, ease: 'expo.out', stagger: 0.08,
      scrollTrigger: { trigger: '.vx-manifesto__promise', start: 'top 85%', once: true } });

    /* ── The bedrooms: the row at the centre of the screen fills the arch ── */
    roomRows.forEach(function (li) {
      ScrollTrigger.create({ trigger: li, start: 'top 55%', end: 'bottom 55%', onToggle: function (self) { if (self.isActive) showRoom(li.getAttribute('data-room')); } });
    });

    /* ── A day in the house: an empty arched doorway on the cream page; the Morning Room opens
          inside it, then each doorway after that moves the clock on, and the page itself turns
          from morning cream to the night green of the evening below ── */
    (function day() {
      var section = q('.vx-day'), pin = q('.vx-day__pin'), header = document.getElementById('veHeader');
      var rooms = qa('.vx-droom'), cards = qa('.vx-dcard'), steps = qa('.vx-day__steps li');
      var hand = q('.vx-clock__hand'), timeEl = q('.vx-clock__time'), ampmEl = q('.vx-clock__ampm');
      if (!pin || !rooms.length) return;
      var n = rooms.length, hours = rooms.map(function (r) { return parseFloat(r.getAttribute('data-hour')); });
      var inner = rooms.map(function (r) { return q('img, svg', r); });
      // The page colour through the day: cream, honey in the afternoon, a sunset, firelight brown, then night green
      var STAGE = [[6.5, [243, 238, 228]], [9.5, [244, 236, 220]], [16, [238, 225, 199]], [17.2, [228, 196, 146]], [18, [112, 72, 42]], [18.5, [52, 40, 28]], [19.4, [27, 30, 22]], [20, [13, 28, 20]], [22.5, [8, 20, 14]]];
      // A light grade over the rooms: clear by day, amber at dusk, blue at night
      var TINT = [[6, 'rgba(0, 0, 0, 0)'], [16, 'rgba(226, 160, 80, .06)'], [18.6, 'rgba(210, 120, 50, .12)'], [20, 'rgba(6, 12, 24, .2)'], [23, 'rgba(4, 8, 18, .28)']];
      var tintAt = function (h) { var t = TINT[0][1]; TINT.forEach(function (row) { if (h >= row[0]) t = row[1]; }); return t; };
      var stageAt = function (h) {
        for (var i = 1; i < STAGE.length; i++) {
          if (h <= STAGE[i][0]) {
            var a = STAGE[i - 1], b = STAGE[i], t = smooth(clamp((h - a[0]) / (b[0] - a[0])));
            return a[1].map(function (v, c) { return Math.round(v + (b[1][c] - v) * t); });
          }
        }
        return STAGE[STAGE.length - 1][1];
      };
      var current = -1, dark = null, opened = null;
      function render(p) {
        var s = p * n; // room k opens while s runs from k + .15 to k + .75
        var open = rooms.map(function (r, k) { return smooth(clamp((s - k - 0.15) / 0.6)); });
        var last = -1; // the latest fully open room
        open.forEach(function (o, k) { if (o >= 1) last = k; });
        rooms.forEach(function (room, k) {
          var o = open[k], el = inner[k];
          if (k === last + 1 && (k === 0 || open[k - 1] >= 1)) { // the doorway ahead, opening
            var top = 30 * (1 - o), side = 34 * (1 - o);
            room.style.visibility = o > 0 ? 'visible' : 'hidden';
            room.style.clipPath = 'inset(' + top.toFixed(2) + '% ' + side.toFixed(2) + '% 0% ' + side.toFixed(2) + '% round 999px 999px 0px 0px)';
            room.style.transform = 'none';
            if (el) el.style.transform = 'scale(' + (1.3 - 0.3 * o).toFixed(4) + ')';
          } else if (k === last) { // the room we're in; it comes towards us as we walk through the next doorway
            var nextO = k + 1 < n ? open[k + 1] : 0;
            room.style.visibility = 'visible';
            room.style.clipPath = 'none';
            room.style.transform = 'scale(' + (1 + 0.24 * nextO).toFixed(4) + ')';
            if (el) el.style.transform = 'none';
          } else {
            room.style.visibility = 'hidden';
          }
        });
        steps.forEach(function (li, k) { li.style.setProperty('--f', open[k].toFixed(3)); });
        // The clock: from the last room's hour towards the next as its doorway opens
        var k2 = Math.min(n - 1, last + 1), h = last < 0 ? hours[0] : hours[last] + (hours[k2] - hours[last]) * (k2 > last ? open[k2] : 0);
        hand.setAttribute('transform', 'rotate(' + ((h - 12) * 15).toFixed(2) + ')');
        var hr = Math.floor(h), mins = Math.floor(((h - hr) * 60) / 5) * 5;
        timeEl.textContent = ((hr % 12) || 12) + ':' + (mins < 10 ? '0' : '') + mins;
        ampmEl.textContent = hr < 12 ? 'AM' : 'PM';
        var rgb = stageAt(h);
        section.style.setProperty('--stage', 'rgb(' + rgb.join(', ') + ')');
        section.style.setProperty('--tint', tintAt(h));
        var isDark = (0.2126 * rgb[0] + 0.7152 * rgb[1] + 0.0722 * rgb[2]) / 255 < 0.42;
        if (isDark !== dark) {
          dark = isDark;
          section.classList.toggle('is-dark', isDark);
          section.setAttribute('data-theme', isDark ? 'dark' : 'light');
          if (header && p > 0 && p < 1) header.setAttribute('data-theme', isDark ? 'dark' : 'light');
        }
        var isOpen = open[0] > 0.5;
        if (isOpen !== opened) { opened = isOpen; section.classList.toggle('is-open', isOpen); }
        var active = 0;
        open.forEach(function (o, k) { if (o >= 0.5) active = k; });
        if (active !== current) {
          current = active;
          cards.forEach(function (c, k) { c.classList.toggle('is-on', k === active); });
        }
      }
      var proxy = { p: 0 };
      render(0);
      gsap.to(proxy, { p: 1, ease: 'none', onUpdate: function () { render(proxy.p); },
        scrollTrigger: { trigger: pin, start: 'top top', end: function () { return '+=' + Math.round(window.innerHeight * 6.4); },
          pin: true, scrub: 1, invalidateOnRefresh: true, anticipatePin: 1 } });
    })();

    /* ── The evening ── */
    gsap.from('.vx-services__list li', { opacity: 0, y: 24, duration: 1, ease: 'expo.out', stagger: 0.06,
      scrollTrigger: { trigger: '.vx-services__list', start: 'top 85%', once: true } });
    gsap.fromTo('.vx-close__bg img', { scale: 1.14 }, { scale: 1, ease: 'none',
      scrollTrigger: { trigger: '.vx-close', start: 'top bottom', end: 'bottom top', scrub: true } });
    gsap.from('.vx-close__offer', { opacity: 0, y: 40, duration: 1.2, ease: 'expo.out',
      scrollTrigger: { trigger: '.vx-close', start: 'top 60%', once: true } });

    /* ── The enquiry that's always there: after the gates, until the close ── */
    var sticky = q('.vx-sticky');
    if (sticky) {
      // refreshPriority -1: measured after the day's pin has added its length, or it would end six screens early
      ScrollTrigger.create({ trigger: '.vx-manifesto', start: 'top 60%', endTrigger: '.vx-close', end: 'top 70%', refreshPriority: -1,
        onToggle: function (self) { sticky.classList.toggle('is-visible', self.isActive); } });
    }

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
