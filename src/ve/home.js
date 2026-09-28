/* ═══════════════════════════════════════════════════════════════════════════
   vE homepage choreography. Runs through VE.ready (after the preloader).
   Reduced motion: nothing here runs except the poster-only hero.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };

  /* ── Hero film: landscape 1080p, or the portrait cut on upright screens; plays while on screen
        (reduced motion / Save-Data keep the poster, which home.css shows as the background) ── */
  (function setupVideo() {
    var v = q('.vh-hero__video');
    if (!v) return;
    var conn = navigator.connection || {};
    if (VE.reduce || conn.saveData || /(^|-)2g$/.test(conn.effectiveType || '')) return;
    var upright = window.matchMedia('(max-aspect-ratio: 1/1)').matches;
    v.poster = v.getAttribute(upright ? 'data-poster-sm' : 'data-poster-lg');
    v.src = v.getAttribute(upright ? 'data-src-sm' : 'data-src-lg');
    var play = function () { var p = v.play(); if (p && p.catch) p.catch(function () {}); };
    play();
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        entries.forEach(function (e) { if (e.isIntersecting) play(); else v.pause(); });
      }, { threshold: 0.01 }).observe(v);
    }
  })();

  /* ── Statement: wrap every word (the 1890 ring stays one unit) ── */
  function splitWords(el) {
    var walk = function (node) {
      [].slice.call(node.childNodes).forEach(function (child) {
        if (child.nodeType === 3) {
          var parts = child.textContent.split(/(\s+)/);
          var frag = document.createDocumentFragment();
          parts.forEach(function (p) {
            if (!p) return;
            if (/^\s+$/.test(p)) frag.appendChild(document.createTextNode(p));
            else { var s = document.createElement('span'); s.className = 'w'; s.textContent = p; frag.appendChild(s); }
          });
          child.parentNode.replaceChild(frag, child);
        } else if (child.nodeType === 1 && child.classList.contains('vh-ring')) {
          child.classList.add('w');
        } else if (child.nodeType === 1) walk(child);
      });
    };
    walk(el);
    return qa('.w', el);
  }
  var statement = q('[data-words]');
  var words = statement ? splitWords(statement) : [];

  /* ── Chart contours: seeded rings over the hill country (decorative; shown without motion too).
        Built here rather than in the page because they'd add ~45 KB of markup. ── */
  (function contours() {
    var g = q('.vh-chart__topo');
    if (!g) return;
    var seed = 20261890;
    var rnd = function () { seed = (seed * 16807) % 2147483647; return seed / 2147483647; };
    var f = function (n) { return Math.round(n * 10) / 10; };
    var ring = function (pts) { // closed Catmull-Rom through the points
      var n = pts.length, d = 'M' + f(pts[0][0]) + ' ' + f(pts[0][1]);
      for (var i = 0; i < n; i++) {
        var p0 = pts[(i - 1 + n) % n], p1 = pts[i], p2 = pts[(i + 1) % n], p3 = pts[(i + 2) % n];
        d += 'C' + f(p1[0] + (p2[0] - p0[0]) / 6) + ' ' + f(p1[1] + (p2[1] - p0[1]) / 6) + ' ' +
          f(p2[0] - (p3[0] - p1[0]) / 6) + ' ' + f(p2[1] - (p3[1] - p1[1]) / 6) + ' ' + f(p2[0]) + ' ' + f(p2[1]);
      }
      return d + 'Z';
    };
    // [x, y, outer radius, rings] in chart units: Hanthana, Galaha's hills, Knuckles, the central massif, Adam's Peak
    var CENTRES = [[142.3, 285.6, 7, 6], [151.5, 293.5, 6, 5], [161, 266, 15, 8], [157, 311, 24, 11], [131, 331, 12, 7], [146, 300, 9, 5]];
    var html = '';
    CENTRES.forEach(function (c) {
      var harm = [2, 3, 4, 5].map(function (k) { return [k, rnd() * 0.16 / (k * 0.6), rnd() * Math.PI * 2]; });
      for (var i = 1; i <= c[3]; i++) {
        var r0 = c[2] * (i / c[3]) * (0.9 + rnd() * 0.15), pts = [];
        for (var j = 0; j < 30; j++) {
          var th = j / 30 * Math.PI * 2, r = r0;
          harm.forEach(function (h) { r *= 1 + h[1] * Math.sin(h[0] * th + h[2] + i * 0.18); });
          pts.push([c[0] + r * Math.cos(th), c[1] + r * Math.sin(th) * 1.05]);
        }
        html += '<path' + (i % 3 === 0 ? ' class="is-major"' : '') + ' d="' + ring(pts) + '"/>';
      }
    });
    g.innerHTML = html;
  })();

  if (VE.reduce) return;

  VE.ready(function () {
    var mm = gsap.matchMedia();

    /* ── 1. Hero entrance, then the film becomes a framed window as you scroll ── */
    var letters = qa('.vh-hero__title span');
    // y: 0 clears the pixel offset GSAP reads from the CSS start state, so only yPercent moves them
    gsap.set(letters, { y: 0, yPercent: 105 });
    gsap.set('.vh-hero__frame', { clipPath: 'inset(0% 0% 0% 0% round 0px)' });
    var intro = gsap.timeline({ defaults: { ease: 'expo.out' } });
    intro.to(letters, { yPercent: 0, duration: 1.7, stagger: 0.075 }, 0.05)
      .to('.vh-hero__video', { scale: 1, duration: 2.6, ease: 'power2.out' }, 0)
      .to(['.vh-hero__top', '.vh-hero__copy', '.vh-hero__actions'], { opacity: 1, duration: 1.3, stagger: 0.12, ease: 'power2.out' }, 0.55);

    gsap.timeline({
      scrollTrigger: { trigger: '.vh-hero', start: 'top top', end: '+=85%', pin: true, scrub: 0.6, anticipatePin: 1 }
    })
      .to('.vh-hero__frame', { clipPath: 'inset(10% 6% 16% 6% round 6px)', ease: 'none' }, 0)
      .to('.vh-hero__media', { scale: 1.12, ease: 'none' }, 0)
      .to('.vh-hero__title', { yPercent: -38, opacity: 0, ease: 'none' }, 0)
      .to(letters, { x: function (i) { return (i - 2.5) * window.innerWidth * 0.035; }, ease: 'none' }, 0)
      .to('.vh-hero__ui', { opacity: 0, y: -50, ease: 'none' }, 0)
      .to('.vh-hero__grid', { opacity: 0, ease: 'none' }, 0);

    /* ── 2. Statement lights up word by word; the gold ring draws round 1890 ── */
    if (words.length) {
      gsap.to(words, { opacity: 1, ease: 'none', stagger: 0.12,
        scrollTrigger: { trigger: statement, start: 'top 78%', end: 'bottom 48%', scrub: 0.4 } });
      gsap.to('.vh-ring path', { strokeDashoffset: 0, ease: 'none',
        scrollTrigger: { trigger: '.vh-ring', start: 'top 62%', end: 'top 38%', scrub: 0.5 } });
    }

    /* ── 4. Chambers: pinned sideways gallery on desktop (native swipe on phones) ── */
    mm.add('(min-width: 901px)', function () {
      var section = q('.vh-rooms'), track = q('.vh-rooms__track'), viewport = q('.vh-rooms__viewport'), rail = q('.vh-rooms__rail span');
      if (!track) return;
      var distance = function () { return Math.max(0, track.scrollWidth - viewport.clientWidth); };
      var slide = gsap.to(track, {
        x: function () { return -distance(); }, ease: 'none',
        scrollTrigger: {
          trigger: section, start: 'top top', end: function () { return '+=' + distance(); },
          pin: true, scrub: 0.8, invalidateOnRefresh: true, anticipatePin: 1,
          onUpdate: function (self) { if (rail) rail.style.transform = 'scaleX(' + self.progress.toFixed(3) + ')'; }
        }
      });
      qa('.vh-room__media img').forEach(function (img) {
        gsap.fromTo(img, { xPercent: -7 }, { xPercent: 7, ease: 'none',
          scrollTrigger: { trigger: img.closest('.vh-room'), containerAnimation: slide, start: 'left right', end: 'right left', scrub: true } });
      });
    });

    /* ── 5. Pekoe Trail: the section pins and the walker crosses tea country. The land pans under it
          (three ridges at three speeds), the km count runs, and the heading line, stage card and
          background change as each stop is reached, with a pause at the bungalow. ── */
    (function trail() {
      var pinEl = q('.vh-trail__pin'), path = q('.vh-walk__trail');
      if (!pinEl || !path) return;
      var back = q('.vh-walk__layer--back'), mid = q('.vh-walk__layer--mid'), front = q('.vh-walk__layer--front');
      var walker = q('.vh-walk__walker'), km = q('.vh-trail__km');
      var bars = qa('.vh-trail__bar i'), stages = qa('.vh-tstage'), scenes = qa('.vh-trail__scene');
      var lines = qa('.vh-trail__line'), stops = qa('.vh-walk__stop');
      var total = path.getTotalLength();
      // Each stop's share of the way along the trail (found by its x in the 3600-unit drawing)
      var at = [240, 1250, 2350, 3380].map(function (x) {
        var lo = 0, hi = total;
        for (var i = 0; i < 26; i++) { var m = (lo + hi) / 2; if (path.getPointAtLength(m).x < x) lo = m; else hi = m; }
        return lo / total;
      });
      at[0] = 0; at[3] = 1;
      // Scroll progress -> distance walked, holding at the bungalow ("Sleep here.") and at Loolecondera
      var KEYS = [[0, 0], [0.05, 0], [0.36, at[1]], [0.5, at[1]], [0.8, at[2]], [0.85, at[2]], [1, 1]];
      var along = function (p) {
        for (var i = 1; i < KEYS.length; i++) {
          if (p <= KEYS[i][0]) { var a = KEYS[i - 1], b = KEYS[i]; return a[1] + (b[1] - a[1]) * ((p - a[0]) / ((b[0] - a[0]) || 1)); }
        }
        return 1;
      };
      var KM = [0, 12.84, 27.54, 42.5]; // stage lengths from the trail copy: 12.84, 14.7, about 15 km
      var EPS = 0.003;
      var width = 0, view = 0, current = -1;
      var measure = function () { width = front.offsetWidth; view = pinEl.clientWidth; };
      var toggle = function (list, i) { list.forEach(function (el, j) { el.classList.toggle('is-on', j === i); }); };

      function render(p) {
        var t = along(p);
        path.style.strokeDashoffset = String(1 - t);
        var pan = t * Math.max(0, width - view);
        front.style.transform = 'translate3d(' + (-pan).toFixed(1) + 'px,0,0)';
        mid.style.transform = 'translate3d(' + (-pan * 0.72).toFixed(1) + 'px,0,0)';
        back.style.transform = 'translate3d(' + (-pan * 0.45).toFixed(1) + 'px,0,0)';
        var pt = path.getPointAtLength(t * total), s = width / 3600;
        walker.style.transform = 'translate3d(' + (pt.x * s).toFixed(1) + 'px,' + (pt.y * s).toFixed(1) + 'px,0)';

        var leg = t < at[1] ? 0 : t < at[2] ? 1 : 2;
        var f = Math.min(1, Math.max(0, (t - at[leg]) / (at[leg + 1] - at[leg])));
        km.textContent = (KM[leg] + (KM[leg + 1] - KM[leg]) * f).toFixed(1);
        bars.forEach(function (b, i) { b.style.setProperty('--f', i < leg ? 1 : i === leg ? f.toFixed(3) : 0); });

        // 0 walking Stage 1 · 1 at the bungalow · 2 walking Stage 2 · 3 Stage 3 onwards
        var stage = t < at[1] - EPS ? 0 : t <= at[1] + EPS ? 1 : t < at[2] - EPS ? 2 : 3;
        if (stage !== current) {
          current = stage;
          toggle(stages, stage);
          toggle(scenes, stage);
          toggle(lines, Math.min(stage, 2));
          stops[1].classList.toggle('is-here', stage === 1);
        }
        stops.forEach(function (st, i) { st.classList.toggle('is-reached', t >= at[i] - EPS); });
      }

      var proxy = { p: 0 };
      measure();
      render(0);
      gsap.to(proxy, {
        p: 1, ease: 'none', onUpdate: function () { render(proxy.p); },
        scrollTrigger: {
          trigger: pinEl, start: 'top top', end: function () { return '+=' + Math.round(window.innerHeight * 3.2); },
          pin: true, scrub: 1, invalidateOnRefresh: true, anticipatePin: 1,
          onRefresh: function () { measure(); render(proxy.p); }
        }
      });
    })();

    /* ── 6. Numbers count up once ── */
    qa('[data-count]').forEach(function (el) {
      var end = parseInt(el.getAttribute('data-count'), 10);
      var state = { v: end > 1000 ? end - 60 : 0 };
      el.textContent = String(state.v);
      ScrollTrigger.create({ trigger: el, start: 'top 86%', once: true, onEnter: function () {
        gsap.to(state, { v: end, duration: 2.2, ease: 'power3.out', onUpdate: function () { el.textContent = String(Math.round(state.v)); } });
      } });
    });
    gsap.from('.vh-numbers__list > div', { opacity: 0, y: 40, duration: 1.2, ease: 'expo.out', stagger: 0.12,
      scrollTrigger: { trigger: '.vh-numbers__list', start: 'top 85%', once: true } });

    /* ── 7. Experiences: a photo follows the pointer down the list ── */
    var list = q('.vh-exp__list'), float = q('.vh-exp__float');
    if (list && float && VE.finePointer) {
      var img = float.querySelector('img');
      gsap.set(float, { xPercent: -50, yPercent: -50, x: window.innerWidth / 2, y: window.innerHeight / 2 });
      var fx = gsap.quickTo(float, 'x', { duration: 0.7, ease: 'power3' }), fy = gsap.quickTo(float, 'y', { duration: 0.7, ease: 'power3' });
      list.addEventListener('pointermove', function (e) { fx(e.clientX); fy(e.clientY); });
      qa('.vh-exp__row a', list).forEach(function (a) {
        a.addEventListener('pointerenter', function () {
          var src = a.getAttribute('data-img');
          if (src && img.getAttribute('src') !== src) img.src = src;
          float.classList.add('is-on');
        });
      });
      list.addEventListener('pointerleave', function () { float.classList.remove('is-on'); });
      qa('.vh-exp__row a[data-img]', list).forEach(function (a) { var p = new Image(); p.src = a.getAttribute('data-img'); });
    }
    gsap.from('.vh-exp__row', { opacity: 0, y: 30, duration: 1, ease: 'expo.out', stagger: 0.08,
      scrollTrigger: { trigger: '.vh-exp__list', start: 'top 85%', once: true } });

    /* ── 9. Getting here: the coast draws, the road runs in from the airport as a travelling light,
          then the camera (the SVG viewBox) flies into the hills round Galaha. Labels stay screen-sized;
          the scale bar, coordinates and compass follow the camera; the travel list lights up in step. ── */
    (function chart() {
      var frame = q('.vh-chart__frame'), svg = q('.vh-chart__svg');
      if (!frame || !svg) return;
      var coast = q('.vh-chart__coast'), land = q('.vh-chart__land'), road = q('.vh-chart__road'), roadBed = q('.vh-chart__road-bed'), comet = q('.vh-chart__comet');
      var grat = q('.vh-chart__grat'), fine = q('.vh-chart__grat--fine'), topo = q('.vh-chart__topo');
      var marks = qa('.vh-chart__k').map(function (g) { return { g: g, x: g.getAttribute('data-x'), y: g.getAttribute('data-y') }; });
      var pins = {};
      qa('.vh-chart__pin').forEach(function (g) { pins[g.getAttribute('data-pin')] = g; });
      var seas = qa('.vh-chart__seas'), coarse = qa('.vh-chart__coarse'), fineLabels = qa('.vh-chart__fine');
      var coords = q('.vh-chart__coords'), bar = q('.vh-chart__scale i'), barText = q('.vh-chart__scale b');
      var compass = q('.vh-chart__compass'), here = q('.vh-chart__here');
      var items = qa('.vh-where__list li[data-at]');
      var roadLen = road.getTotalLength();

      var W0 = 352, H0 = 440, C0 = [160, 220];   // the whole island
      var W1 = 30, C1 = [146, 290];               // the hills between Peradeniya, Kandy, Galaha and Loolecondera
      var PIN_AT = { air: [0.16, 0.22], colombo: [0.18, 0.24], peradeniya: [0.6, 0.66], kandy: [0.63, 0.69], galaha: [0.68, 0.74], loolecondera: [0.74, 0.8] };
      var NICE = [1, 2, 5, 10, 20, 50, 100];
      var seg = function (p, a, b) { var v = (p - a) / (b - a); return v < 0 ? 0 : v > 1 ? 1 : v; };
      var ease = function (t) { return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2; };
      var fw = 1;
      var measure = function () { fw = frame.clientWidth || 1; };
      var fade = function (list, v) { list.forEach(function (el) { el.style.opacity = v.toFixed(3); }); };

      function render(p) {
        // Camera: geometric zoom; the target glides from where it sits on screen to the centre
        var z = ease(seg(p, 0.42, 0.8));
        var w = W0 * Math.pow(W1 / W0, z), h = w * H0 / W0;
        var keep = (w / W0) * (1 - z);
        var cx = C1[0] - (C1[0] - C0[0]) * keep, cy = C1[1] - (C1[1] - C0[1]) * keep;
        svg.setAttribute('viewBox', (cx - w / 2).toFixed(3) + ' ' + (cy - h / 2).toFixed(3) + ' ' + w.toFixed(3) + ' ' + h.toFixed(3));
        var k = 1.6 * w / fw; // chart units per 1.6 screen pixels: labels and pins keep their size
        marks.forEach(function (o) { o.g.setAttribute('transform', 'translate(' + o.x + ' ' + o.y + ') scale(' + k.toFixed(4) + ')'); });

        // Line widths in chart units, so they stay the same on screen through the zoom
        var px = w / fw;
        coast.style.strokeWidth = (1.2 * px).toFixed(4);
        road.style.strokeWidth = (2 * px).toFixed(4);
        roadBed.style.strokeWidth = (3.5 * px).toFixed(4);
        coast.style.strokeDashoffset = String(1 - ease(seg(p, 0, 0.2)));
        land.style.fillOpacity = seg(p, 0.1, 0.26).toFixed(3);
        roadBed.style.opacity = seg(p, 0.14, 0.3).toFixed(3);
        grat.style.opacity = (seg(p, 0.02, 0.16) * (1 - 0.5 * z)).toFixed(3);
        fine.style.opacity = seg(p, 0.62, 0.8).toFixed(3);
        fade(seas.concat(coarse), seg(p, 0.08, 0.2) * (1 - seg(p, 0.44, 0.58)));
        fade(fineLabels, seg(p, 0.64, 0.8));
        topo.style.opacity = (0.3 * seg(p, 0.14, 0.26) + 0.7 * seg(p, 0.45, 0.75)).toFixed(3);

        var r = ease(seg(p, 0.22, 0.72));
        road.style.strokeDashoffset = String(1 - r);
        var pt = road.getPointAtLength(r * roadLen);
        comet.setAttribute('cx', pt.x.toFixed(2));
        comet.setAttribute('cy', pt.y.toFixed(2));
        comet.setAttribute('r', (1.8 * k).toFixed(3));
        comet.style.opacity = r > 0.001 && r < 0.999 ? '1' : '0';

        var leaving = 1 - seg(p, 0.46, 0.56); // the airport and Colombo drop away as the camera heads inland
        Object.keys(PIN_AT).forEach(function (key) {
          var o = seg(p, PIN_AT[key][0], PIN_AT[key][1]) * (key === 'air' || key === 'colombo' ? leaving : 1);
          if (pins[key]) pins[key].style.opacity = o.toFixed(3);
        });

        // Readouts: the camera's centre, a scale bar in round kilometres, the compass turning with the flight
        var lat = 10.0049 - cy / 104, lon = 79.2473 + cx / 103.6;
        coords.textContent = lat.toFixed(2) + '° N · ' + lon.toFixed(2) + '° E';
        var pxPerKm = fw / w / 1.066, d = NICE[NICE.length - 1];
        for (var i = 0; i < NICE.length; i++) { if (NICE[i] * pxPerKm >= 46) { d = NICE[i]; break; } }
        bar.style.width = Math.round(d * pxPerKm) + 'px';
        barText.textContent = d + ' km';
        compass.style.transform = 'rotate(' + (-40 + p * 130).toFixed(1) + 'deg)';
        here.classList.toggle('is-on', p > 0.8);
        items.forEach(function (li) { li.classList.toggle('is-lit', p >= parseFloat(li.getAttribute('data-at'))); });
      }

      var proxy = { p: 0 };
      measure();
      render(0);
      var update = function () { render(proxy.p); };
      var refresh = function () { measure(); render(proxy.p); };
      // Desktop: the section pins for two screens. Phones: it plays as the chart scrolls through.
      mm.add('(min-width: 901px)', function () {
        gsap.to(proxy, { p: 1, ease: 'none', onUpdate: update, scrollTrigger: {
          trigger: '.vh-where__pin', start: 'top top', end: function () { return '+=' + Math.round(window.innerHeight * 2); },
          pin: true, scrub: 1, invalidateOnRefresh: true, anticipatePin: 1, onRefresh: refresh } });
      });
      mm.add('(max-width: 900px)', function () {
        gsap.to(proxy, { p: 1, ease: 'none', onUpdate: update, scrollTrigger: {
          trigger: frame, start: 'top 70%', end: 'bottom 10%', scrub: 1, invalidateOnRefresh: true, onRefresh: refresh } });
      });
    })();

    /* ── 10. Closing: the lounge settles into place ── */
    gsap.fromTo('.vh-close__bg img', { scale: 1.18 }, { scale: 1, ease: 'none',
      scrollTrigger: { trigger: '.vh-close', start: 'top bottom', end: 'bottom bottom', scrub: true } });

    // Triggers were created out of page order (shared reveals first, pins here): sort before measuring
    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
