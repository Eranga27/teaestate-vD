/* ═══════════════════════════════════════════════════════════════════════════
   vE · Pekoe Trail page. The calendar's "now" marker and the hero contours
   work without motion; scroll choreography runs through VE.ready.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };

  /* ── When to walk: mark this month ── */
  var nowMonth = q('.vt-months li[data-m="' + new Date().getMonth() + '"]');
  if (nowMonth) nowMonth.classList.add('is-now');

  /* ── Hero: seeded contour rings over the forest (the same hand as the homepage map) ── */
  (function contours() {
    var g = q('.vt-hero__topo g');
    if (!g) return;
    var seed = 18670412;
    var rnd = function () { seed = (seed * 16807) % 2147483647; return seed / 2147483647; };
    var f = function (n) { return Math.round(n * 10) / 10; };
    var ring = function (pts) {
      var n = pts.length, d = 'M' + f(pts[0][0]) + ' ' + f(pts[0][1]);
      for (var i = 0; i < n; i++) {
        var p0 = pts[(i - 1 + n) % n], p1 = pts[i], p2 = pts[(i + 1) % n], p3 = pts[(i + 2) % n];
        d += 'C' + f(p1[0] + (p2[0] - p0[0]) / 6) + ' ' + f(p1[1] + (p2[1] - p0[1]) / 6) + ' ' +
          f(p2[0] - (p3[0] - p1[0]) / 6) + ' ' + f(p2[1] - (p3[1] - p1[1]) / 6) + ' ' + f(p2[0]) + ' ' + f(p2[1]);
      }
      return d + 'Z';
    };
    var html = '';
    [[640, 150, 230, 10], [760, 520, 170, 7], [470, 360, 120, 5]].forEach(function (c) {
      var harm = [2, 3, 4, 5].map(function (k) { return [k, rnd() * 0.18 / (k * 0.6), rnd() * Math.PI * 2]; });
      for (var i = 1; i <= c[3]; i++) {
        var r0 = c[2] * (i / c[3]) * (0.9 + rnd() * 0.15), pts = [];
        for (var j = 0; j < 30; j++) {
          var th = j / 30 * Math.PI * 2, r = r0;
          harm.forEach(function (h) { r *= 1 + h[1] * Math.sin(h[0] * th + h[2] + i * 0.2); });
          pts.push([c[0] + r * Math.cos(th), c[1] + r * Math.sin(th) * 0.9]);
        }
        html += '<path pathLength="1"' + (i % 3 === 0 ? ' class="is-major"' : '') + ' d="' + ring(pts) + '"/>';
      }
    });
    g.innerHTML = html;
  })();

  /* ── The promise: one word at a time ── */
  var promise = q('.vt-promise__quote'), words = [];
  if (promise) {
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
    })(promise);
    words = qa('.w', promise);
  }

  if (VE.reduce) return;

  VE.ready(function () {
    var mm = gsap.matchMedia();

    /* ── Hero: title rises, contour lines survey the hills ── */
    gsap.set('.vt-hero__line > *', { y: 0, yPercent: 110 });
    var topo = qa('.vt-hero__topo path');
    gsap.set(topo, { strokeDasharray: 1, strokeDashoffset: 1 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.vt-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0)
      .to(['.vt-hero .ve-crumbs', '.vt-hero__kicker', '.vt-hero__lede', '.vt-hero__cta'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.3)
      .fromTo('.vt-hero__stats > div', { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 1.1, stagger: 0.1 }, 0.6)
      .to(topo, { strokeDashoffset: 0, duration: 3.2, ease: 'power2.inOut', stagger: 0.035 }, 0.2);
    gsap.to('.vt-hero__bg img', { scale: 1.12, yPercent: 6, ease: 'none',
      scrollTrigger: { trigger: '.vt-hero', start: 'top top', end: 'bottom top', scrub: true } });

    /* ── Your position: the line draws through the stops ── */
    var list = q('.vt-line__stops');
    if (list) {
      var line = { d: 0 };
      gsap.to(line, { d: 1, ease: 'none', onUpdate: function () { list.style.setProperty('--drawn', line.d.toFixed(3)); },
        scrollTrigger: { trigger: list, start: 'top 78%', end: 'bottom 60%', scrub: 0.6 } });
      gsap.fromTo('.vt-stop', { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: 1, ease: 'expo.out', stagger: 0.14,
        scrollTrigger: { trigger: list, start: 'top 75%', once: true } });
    }

    /* ── Stages: each card settles back as the next one slides over it ── */
    mm.add('(min-width: 901px)', function () {
      var cards = qa('.vt-stage');
      cards.forEach(function (card, i) {
        var img = q('.vt-stage__media img', card);
        gsap.fromTo(img, { scale: 1.15 }, { scale: 1, ease: 'none', scrollTrigger: { trigger: card, start: 'top bottom', end: 'top 30%', scrub: true } });
        if (i === cards.length - 1) return;
        // Explicit start: GSAP can't interpolate from filter: none (it would start from brightness 0)
        gsap.fromTo(card, { scale: 1, filter: 'brightness(1)' }, { scale: 0.93, filter: 'brightness(0.55)', ease: 'none',
          scrollTrigger: { trigger: cards[i + 1], start: 'top bottom', end: 'top 25%', scrub: true } });
      });
    });

    /* ── A day on the trail: scroll moves the clock; the sun, sky, stars and the bungalow's lights follow ── */
    (function day() {
      var pin = q('.vt-day__pin'), sky = q('.vt-day__sky');
      var steps = qa('.vt-dstep'), ticks = qa('.vt-day__ticks i');
      if (!pin || !steps.length) return;
      var sun = q('.vt-day__sun'), moon = q('.vt-day__moon');
      var dayEl = q('.vt-day__day'), timeEl = q('.vt-day__time'), ampmEl = q('.vt-day__ampm');
      var hours = steps.map(function (s) { return parseFloat(s.getAttribute('data-hour')); }); // hours since Day 1 midnight
      // Sky by hour of day: [hour, top colour, horizon colour]
      var SKY = [[0, '#060d14', '#101c22'], [5, '#0b1a24', '#2c2a3a'], [6.3, '#1d3444', '#d99a6c'], [8, '#3d6a74', '#d8cfa8'],
        [12, '#4f808a', '#e6dcb0'], [15.5, '#3f6468', '#e2b877'], [18.2, '#233447', '#cf7d52'], [19.3, '#0d1826', '#3a3040'],
        [21, '#060d14', '#121d26'], [24, '#060d14', '#101c22']];
      var hex = function (h) { return [parseInt(h.slice(1, 3), 16), parseInt(h.slice(3, 5), 16), parseInt(h.slice(5, 7), 16)]; };
      var mix = function (a, b, t) {
        var x = hex(a), y = hex(b);
        return 'rgb(' + [0, 1, 2].map(function (k) { return Math.round(x[k] + (y[k] - x[k]) * t); }).join(',') + ')';
      };
      var skyAt = function (h) {
        for (var i = 1; i < SKY.length; i++) {
          if (h <= SKY[i][0]) { var a = SKY[i - 1], b = SKY[i], t = (h - a[0]) / (b[0] - a[0]); return [mix(a[1], b[1], t), mix(a[2], b[2], t)]; }
        }
        return [SKY[0][1], SKY[0][2]];
      };
      var clamp = function (v) { return v < 0 ? 0 : v > 1 ? 1 : v; };
      var smooth = function (t) { return t * t * (3 - 2 * t); };
      var arc = function (t) { var a = Math.PI * (1 - clamp(t)); return 'translate(' + (500 + 440 * Math.cos(a)).toFixed(1) + ' ' + (500 - 440 * Math.sin(a)).toFixed(1) + ')'; };
      var current = -1;

      function render(p) {
        var n = hours.length, s = p * (n - 1), i = Math.min(n - 2, Math.floor(s)), f = s - i;
        if (p >= 1) { i = n - 2; f = 1; }
        // Each step holds for a moment, then time runs forward to the next
        var g = smooth(clamp((f - 0.3) / 0.4));
        var h = hours[i] + (hours[i + 1] - hours[i]) * g;
        var hod = h % 24;
        var active = f < 0.5 ? i : i + 1;
        if (active !== current) {
          current = active;
          steps.forEach(function (el, k) { el.classList.toggle('is-on', k === active); });
          ticks.forEach(function (el, k) { el.classList.toggle('is-on', k === active); });
        }
        var night = hod < 5.6 || hod > 19.2 ? 1 : hod < 6.6 ? 1 - (hod - 5.6) : hod > 18.2 ? hod - 18.2 : 0;
        var c = skyAt(hod);
        sky.style.setProperty('--sky-top', c[0]);
        sky.style.setProperty('--sky-bottom', c[1]);
        sky.style.setProperty('--night', clamp(night).toFixed(3));
        sun.setAttribute('transform', arc((hod - 6) / 12.5));
        sun.style.opacity = (1 - clamp(night)).toFixed(3);
        moon.setAttribute('transform', arc((hod >= 18.5 ? hod - 18.5 : hod + 5.5) / 11.5));
        moon.style.opacity = clamp(night).toFixed(3);
        var hr = Math.floor(hod), mins = Math.floor(((hod - hr) * 60) / 5) * 5;
        dayEl.textContent = 'Day ' + (Math.floor(h / 24) + 1);
        timeEl.textContent = ((hr % 12) || 12) + ':' + (mins < 10 ? '0' : '') + mins;
        ampmEl.textContent = hr < 12 ? 'AM' : 'PM';
      }

      var proxy = { p: 0 };
      render(0);
      gsap.to(proxy, { p: 1, ease: 'none', onUpdate: function () { render(proxy.p); },
        scrollTrigger: { trigger: pin, start: 'top top', end: function () { return '+=' + Math.round(window.innerHeight * 4.2); },
          pin: true, scrub: 1, invalidateOnRefresh: true, anticipatePin: 1 } });
    })();

    /* ── The promise lights up word by word ── */
    if (words.length) gsap.to(words, { opacity: 1, ease: 'none', stagger: 0.1,
      scrollTrigger: { trigger: promise, start: 'top 82%', end: 'bottom 52%', scrub: 0.4 } });

    /* ── Logistics, months, the plan ── */
    gsap.from('.vt-care__grid li', { opacity: 0, y: 30, duration: 1, ease: 'expo.out', stagger: 0.06,
      scrollTrigger: { trigger: '.vt-care__grid', start: 'top 82%', once: true } });
    gsap.fromTo('.vt-months li', { scaleY: 0.2, opacity: 0 }, { scaleY: 1, opacity: 1, duration: 1.1, ease: 'expo.out', stagger: 0.05,
      scrollTrigger: { trigger: '.vt-months', start: 'top 82%', once: true } });
    gsap.fromTo('.vt-plan__bg img', { scale: 1.15 }, { scale: 1, ease: 'none',
      scrollTrigger: { trigger: '.vt-plan', start: 'top bottom', end: 'bottom top', scrub: true } });

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
