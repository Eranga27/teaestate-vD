/* ═══════════════════════════════════════════════════════════════════════════
   vE runtime (shared by every vE page)
   Lenis smooth scroll + GSAP ScrollTrigger, header, menu, cursor, moonstone
   progress, reveals, the "Your stay" shortlist. Pages add their own timelines through VE.ready(fn).
   Reduced motion: no smooth scroll, no pins, everything in its final state.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  var root = document.documentElement;
  var mq = function (q) { try { return window.matchMedia(q).matches; } catch (e) { return false; } };
  var reduce = mq('(prefers-reduced-motion: reduce)');
  var finePointer = mq('(hover: hover) and (pointer: fine)');
  var hasGsap = !!(window.gsap && window.ScrollTrigger);

  root.classList.add('ve-js');
  if (!reduce && hasGsap) root.classList.add('ve-motion');

  var VE = window.VE = { reduce: reduce || !hasGsap, finePointer: finePointer, lenis: null, _ready: [], _booted: false };

  /* Page code registers here; runs once the intro has finished (or immediately if there is none) */
  VE.ready = function (fn) { if (VE._booted) fn(VE); else VE._ready.push(fn); };

  // Something may cover the page on arrival: the preloader (first visit) or the segue curtain
  // (from another page). Each fires tb:<cover>-reveal as it opens and tb:<cover>-done once gone.
  var introCover = function () {
    if (document.getElementById('tb-preloader')) return 'preloader';
    if (document.documentElement.classList.contains('tb-segue-in')) return 'segue';
    return null;
  };
  function whenIntroDone(cb, event) {
    var cover = introCover();
    if (!cover) return cb();
    var fired = false;
    var go = function () { if (!fired) { fired = true; cb(); } };
    if (event !== 'done') document.addEventListener('tb:' + cover + '-reveal', go, { once: true });
    document.addEventListener('tb:' + cover + '-done', go, { once: true });
  }

  /* ── Smooth scroll ──────────────────────────────────────────────────── */
  if (hasGsap) gsap.registerPlugin(ScrollTrigger);
  if (!VE.reduce && window.Lenis) {
    var lenis = new Lenis({ lerp: 0.085, smoothWheel: true, wheelMultiplier: 0.95, touchMultiplier: 1.4 });
    VE.lenis = lenis;
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add(function (time) { lenis.raf(time * 1000); });
    gsap.ticker.lagSmoothing(0);
    if (introCover()) lenis.stop();
    // Pin spacers change the document height after Lenis measured it
    ScrollTrigger.addEventListener('refresh', function () { lenis.resize(); });
  }

  VE.scrollTo = function (target, opts) {
    if (VE.lenis) VE.lenis.scrollTo(target, Object.assign({ duration: 1.4, easing: function (t) { return 1 - Math.pow(1 - t, 4); } }, opts || {}));
    else {
      var el = typeof target === 'string' ? document.querySelector(target) : target;
      if (typeof target === 'number') window.scrollTo(0, target);
      else if (el) el.scrollIntoView({ behavior: reduce ? 'auto' : 'smooth' });
    }
  };

  // In-page anchors go through the smooth scroller
  document.addEventListener('click', function (e) {
    var a = e.target.closest && e.target.closest('a[href^="#"]');
    if (!a || a.getAttribute('href') === '#' || a.classList.contains('tb-reserve-trigger')) return;
    var target = document.querySelector(a.getAttribute('href'));
    if (!target) return;
    e.preventDefault();
    VE.scrollTo(target, { offset: -10 });
  });

  /* ── Header: solid after the hero, hides on scroll down, theme follows the section under it ── */
  var header = document.getElementById('veHeader');
  function setupHeader() {
    if (!header) return;
    var lastY = window.scrollY, hideTimer = null;
    var onScroll = function (y) {
      var solid = y > window.innerHeight * 0.6;
      header.classList.toggle('is-solid', solid);
      var goingDown = y > lastY + 4, goingUp = y < lastY - 4;
      if (goingDown && y > window.innerHeight && !root.classList.contains('ve-menu-open')) header.classList.add('is-hidden');
      else if (goingUp || y < window.innerHeight) header.classList.remove('is-hidden');
      lastY = y;
    };
    if (VE.lenis) VE.lenis.on('scroll', function (l) { onScroll(l.scroll); });
    else window.addEventListener('scroll', function () { onScroll(window.scrollY); }, { passive: true });
    onScroll(window.scrollY);

    // Light/dark from whichever section sits under the header
    var sections = [].slice.call(document.querySelectorAll('[data-theme]')).filter(function (s) { return s !== header; });
    if (!hasGsap) return;
    sections.forEach(function (s) {
      ScrollTrigger.create({
        trigger: s, start: 'top ' + (header.offsetHeight / 2), end: 'bottom ' + (header.offsetHeight / 2),
        onToggle: function (self) { if (self.isActive) header.setAttribute('data-theme', s.getAttribute('data-theme')); }
      });
    });
  }

  /* ── Menu overlay ───────────────────────────────────────────────────── */
  function setupMenu() {
    var btn = document.getElementById('veMenuBtn'), menu = document.getElementById('veMenu');
    if (!btn || !menu) return;
    var visual = menu.querySelector('.ve-menu__visual'), img = visual && visual.querySelector('img');
    var links = [].slice.call(menu.querySelectorAll('.ve-menu__nav a'));
    links.forEach(function (a, i) { [].forEach.call(a.children, function (c) { c.style.transitionDelay = (0.25 + i * 0.045) + 's'; }); });
    var open = function (state) {
      root.classList.toggle('ve-menu-open', state);
      btn.setAttribute('aria-expanded', String(state));
      menu.setAttribute('aria-hidden', String(!state));
      if (VE.lenis) state ? VE.lenis.stop() : VE.lenis.start();
      if (state) setTimeout(function () { links[0] && links[0].focus({ preventScroll: true }); }, 400);
    };
    btn.addEventListener('click', function () { open(!root.classList.contains('ve-menu-open')); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && root.classList.contains('ve-menu-open')) { open(false); btn.focus(); } });
    links.forEach(function (a) {
      a.addEventListener('click', function () { open(false); });
      a.addEventListener('mouseenter', function () {
        var src = a.getAttribute('data-img');
        if (!img || !src || img.getAttribute('src') === src) return;
        visual.classList.add('is-swapping');
        setTimeout(function () { img.src = src; img.onload = function () { visual.classList.remove('is-swapping'); }; }, 180);
      });
    });
    // Preload the menu photos once the page is idle
    var preload = function () { links.forEach(function (a) { var i = new Image(); i.src = a.getAttribute('data-img'); }); };
    if (window.requestIdleCallback) window.requestIdleCallback(preload, { timeout: 5000 }); else setTimeout(preload, 3000);
  }

  /* ── Cursor + magnetic buttons (mouse / trackpad only) ──────────────── */
  function setupCursor() {
    var cursor = document.querySelector('.ve-cursor');
    if (!cursor || !finePointer || !hasGsap) return;
    root.classList.add('ve-cursor-on');
    var ring = cursor.querySelector('.ve-cursor__ring'), dot = cursor.querySelector('.ve-cursor__dot'), label = cursor.querySelector('.ve-cursor__label');
    var ringX = gsap.quickTo(ring, 'x', { duration: 0.45, ease: 'power3' }), ringY = gsap.quickTo(ring, 'y', { duration: 0.45, ease: 'power3' });
    var dotX = gsap.quickTo(dot, 'x', { duration: 0.08 }), dotY = gsap.quickTo(dot, 'y', { duration: 0.08 });
    gsap.set([ring, dot], { x: -100, y: -100 });
    window.addEventListener('pointermove', function (e) { ringX(e.clientX); ringY(e.clientY); dotX(e.clientX); dotY(e.clientY); cursor.classList.remove('is-hidden'); }, { passive: true });
    document.addEventListener('pointerleave', function () { cursor.classList.add('is-hidden'); });
    window.addEventListener('pointerdown', function () { cursor.classList.add('is-down'); });
    window.addEventListener('pointerup', function () { cursor.classList.remove('is-down'); });
    document.addEventListener('pointerover', function (e) {
      var t = e.target.closest ? e.target : null;
      if (!t) return;
      var labelled = t.closest('[data-cursor]');
      if (labelled && !t.closest('#tb-reserve-modal')) {
        label.textContent = labelled.getAttribute('data-cursor');
        cursor.classList.add('is-label'); cursor.classList.remove('is-link');
        return;
      }
      cursor.classList.remove('is-label');
      cursor.classList.toggle('is-link', !!t.closest('a, button, [role="button"], select, label'));
    });

    [].forEach.call(document.querySelectorAll('[data-magnetic]'), function (el) {
      var mx = gsap.quickTo(el, 'x', { duration: 0.6, ease: 'power3' }), my = gsap.quickTo(el, 'y', { duration: 0.6, ease: 'power3' });
      el.addEventListener('pointermove', function (e) {
        var r = el.getBoundingClientRect();
        mx((e.clientX - (r.left + r.width / 2)) * 0.28); my((e.clientY - (r.top + r.height / 2)) * 0.34);
      });
      el.addEventListener('pointerleave', function () { mx(0); my(0); });
    });
  }

  /* ── Moonstone scroll progress ──────────────────────────────────────── */
  function setupMoon() {
    var moon = document.getElementById('veMoon');
    if (!moon) return;
    var rings = [].slice.call(moon.querySelectorAll('.ve-moon__fill path'));
    var update = function (y) {
      var max = document.documentElement.scrollHeight - window.innerHeight;
      var p = max > 0 ? Math.min(1, Math.max(0, y / max)) : 0;
      rings.forEach(function (r, i) {
        var local = Math.min(1, Math.max(0, p * rings.length - i)); // outer ring first, inward
        r.style.strokeDashoffset = String(1 - local);
      });
      // Shown once past the hero; tucked away at the very end so it never covers the footer links
      moon.classList.toggle('is-visible', y > window.innerHeight * 0.8 && y < max - 160);
    };
    if (VE.lenis) VE.lenis.on('scroll', function (l) { update(l.scroll); });
    else window.addEventListener('scroll', function () { update(window.scrollY); }, { passive: true });
    update(window.scrollY);
    moon.addEventListener('click', function () { VE.scrollTo(0, { duration: 2 }); });
  }

  /* ── Split text into masked lines (for data-split headings) ─────────── */
  VE.splitLines = function (el) {
    if (el.getAttribute('data-split-done')) return el.querySelectorAll('.ve-line-mask > span');
    var html = el.innerHTML.split(/<br\s*\/?>/i);
    el.innerHTML = html.map(function (line) { return '<span class="ve-line-mask"><span>' + line + '</span></span>'; }).join('');
    el.setAttribute('data-split-done', '1');
    return el.querySelectorAll('.ve-line-mask > span');
  };

  /* ── Generic scroll reveals ─────────────────────────────────────────── */
  function setupReveals() {
    [].forEach.call(document.querySelectorAll('[data-split]'), function (el) { VE.splitLines(el); });
    if (VE.reduce) return;
    [].forEach.call(document.querySelectorAll('[data-split]'), function (el) {
      gsap.to(el.querySelectorAll('.ve-line-mask > span'), { yPercent: 0, y: 0, duration: 1.2, ease: 'expo.out', stagger: 0.09,
        scrollTrigger: { trigger: el, start: 'top 88%', once: true } });
    });
    gsap.utils.toArray('[data-reveal="up"]').forEach(function (el) {
      gsap.to(el, { opacity: 1, y: 0, duration: 1.1, ease: 'expo.out', delay: parseFloat(el.getAttribute('data-delay') || 0),
        scrollTrigger: { trigger: el, start: 'top 90%', once: true } });
    });
    gsap.utils.toArray('[data-reveal="fade"]').forEach(function (el) {
      gsap.to(el, { opacity: 1, duration: 1.4, ease: 'power2.out', delay: parseFloat(el.getAttribute('data-delay') || 0),
        scrollTrigger: { trigger: el, start: 'top 90%', once: true } });
    });
    gsap.utils.toArray('[data-reveal="curtain"]').forEach(function (el) {
      var media = el.querySelector('img, video');
      var tl = gsap.timeline({ scrollTrigger: { trigger: el, start: 'top 85%', once: true } });
      tl.to(el, { clipPath: 'inset(0% 0 0 0)', duration: 1.4, ease: 'expo.inOut' });
      if (media) tl.to(media, { scale: 1, duration: 1.8, ease: 'expo.out' }, 0.1);
    });
    // Gentle parallax on marked media
    gsap.utils.toArray('[data-parallax]').forEach(function (el) {
      var amt = parseFloat(el.getAttribute('data-parallax')) || 12;
      gsap.fromTo(el, { yPercent: -amt }, { yPercent: amt, ease: 'none', scrollTrigger: { trigger: el.parentElement, start: 'top bottom', end: 'bottom top', scrub: true } });
    });
  }

  /* ── Your stay: a shortlist that follows the guest between pages ────────
     Any [data-add="Name"] button toggles an item (label in [data-add-label], texts from data-label-off /
     data-label-on). [data-stay] panels list them ([data-stay-list], [data-stay-count], [data-stay-noun]);
     [data-stay-enquire] carries them into the enquiry modal as data-experiences="A|B"; [data-stay-wa]
     gets a prefilled WhatsApp link; [data-stay-pill] shows the count. Kept in localStorage. */
  function setupStay() {
    var adds = [].slice.call(document.querySelectorAll('[data-add]'));
    if (!adds.length && !document.querySelector('[data-stay]')) return;
    var KEY = 'tb_stay', WORDS = ['No', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve'];
    var WA = 'https://wa.me/94777874555?text=';
    var chosen = [];
    try {
      var old = localStorage.getItem('tb_exp_stay'); // the Experiences page's first version
      if (old && !localStorage.getItem(KEY)) { localStorage.setItem(KEY, old); localStorage.removeItem('tb_exp_stay'); }
      chosen = JSON.parse(localStorage.getItem(KEY) || '[]');
    } catch (e) { chosen = []; }
    chosen = (Array.isArray(chosen) ? chosen : []).filter(function (n, i, all) { return typeof n === 'string' && n && all.indexOf(n) === i; }).slice(0, 40);
    var all = function (sel) { return [].slice.call(document.querySelectorAll(sel)); };
    var save = function () { try { localStorage.setItem(KEY, JSON.stringify(chosen)); } catch (e) {} };

    function render() {
      var n = chosen.length;
      adds.forEach(function (b) {
        var on = chosen.indexOf(b.getAttribute('data-add')) > -1, label = b.querySelector('[data-add-label]');
        b.setAttribute('aria-pressed', on ? 'true' : 'false');
        if (label) label.textContent = on ? (b.getAttribute('data-label-on') || 'Added') : (b.getAttribute('data-label-off') || 'Add');
      });
      all('[data-stay]').forEach(function (panel) {
        panel.classList.toggle('has-items', n > 0);
        var list = panel.querySelector('[data-stay-list]'), count = panel.querySelector('[data-stay-count]'), noun = panel.querySelector('[data-stay-noun]');
        if (list) {
          list.innerHTML = '';
          chosen.forEach(function (name) {
            var li = document.createElement('li'), span = document.createElement('span'), rm = document.createElement('button');
            span.textContent = name;
            rm.type = 'button'; rm.className = 'stay-remove'; rm.setAttribute('data-remove', name);
            rm.setAttribute('aria-label', 'Remove ' + name); rm.innerHTML = '&times;';
            li.appendChild(span); li.appendChild(rm); list.appendChild(li);
          });
        }
        if (count) count.textContent = WORDS[n] || String(n);
        if (noun) noun.textContent = n === 1 ? (noun.getAttribute('data-one') || 'item') : (noun.getAttribute('data-many') || 'items');
      });
      all('[data-stay-enquire]').forEach(function (btn) {
        btn.setAttribute('data-experiences', chosen.join('|'));
        var label = btn.querySelector('span');
        if (label) label.textContent = n ? 'Enquire with ' + (n === 1 ? 'this' : 'these') : (btn.getAttribute('data-empty-label') || label.textContent);
      });
      all('[data-stay-wa]').forEach(function (a) {
        a.href = WA + encodeURIComponent(n
          ? 'Hello, I’d like to arrange these during a stay at The Tea Bungalow: ' + chosen.join(', ') + '.'
          : 'Hello, I’d like to ask about a stay at The Tea Bungalow.');
      });
      all('[data-stay-pill]').forEach(function (pill) {
        var text = pill.querySelector('[data-stay-pill-text]'), count = pill.querySelector('[data-stay-pill-count]');
        if (text) text.textContent = n ? 'Your stay' : (text.getAttribute('data-empty-text') || text.textContent);
        if (count) { count.hidden = !n; count.textContent = n + ' chosen'; }
        // Without motion no scroll trigger shows the pill: it appears once something is chosen
        if (VE.reduce) pill.classList.toggle('is-visible', n > 0);
      });
    }
    function toggle(name) {
      var i = chosen.indexOf(name), adding = i < 0;
      if (adding) chosen.push(name); else chosen.splice(i, 1);
      save(); render();
      all('[data-stay-pill]').forEach(function (pill) { pill.classList.remove('is-bumped'); void pill.offsetWidth; pill.classList.add('is-bumped'); });
      window.dataLayer = window.dataLayer || [];
      window.dataLayer.push({ event: 'stay_shortlist', item: name, action: adding ? 'add' : 'remove', count: chosen.length, page: location.pathname });
    }
    document.addEventListener('click', function (e) {
      var add = e.target.closest('[data-add]'), rm = e.target.closest('[data-remove]'), pill = e.target.closest('[data-stay-pill]');
      if (add) toggle(add.getAttribute('data-add'));
      else if (rm) toggle(rm.getAttribute('data-remove'));
      else if (pill) {
        var target = document.getElementById(pill.getAttribute('aria-controls'));
        if (target) VE.scrollTo(target);
      }
    });
    // Another tab changed the list
    window.addEventListener('storage', function (e) {
      if (e.key !== KEY) return;
      try { chosen = JSON.parse(e.newValue || '[]') || []; } catch (err) { chosen = []; }
      render();
    });
    VE.stay = { list: function () { return chosen.slice(); }, toggle: toggle };
    render();
  }

  /* ── Boot ───────────────────────────────────────────────────────────── */
  function boot() {
    // Each feature is independent: one failing must not take the others (or the page) down
    [setupMenu, setupCursor, setupMoon, setupHeader, setupReveals, setupStay].forEach(function (setup) {
      try { setup(); } catch (e) { console.error('[vE] ' + setup.name + ' failed', e); }
    });
    // Scrolling waits until the preloader has fully gone (the page is still locked while it opens)
    whenIntroDone(function () {
      if (VE.lenis) VE.lenis.start();
      if (hasGsap) ScrollTrigger.refresh();
    }, 'done');
    whenIntroDone(function () {
      VE._booted = true;
      VE._ready.splice(0).forEach(function (fn) { try { fn(VE); } catch (e) { console.error(e); } });
      if (hasGsap) {
        ScrollTrigger.refresh();
        if (document.fonts && document.fonts.ready) document.fonts.ready.then(function () { ScrollTrigger.refresh(); });
        window.addEventListener('load', function () { ScrollTrigger.refresh(); });
      }
    });
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot); else boot();
})();
