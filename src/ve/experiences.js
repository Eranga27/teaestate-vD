/* ═══════════════════════════════════════════════════════════════════════════
   vE · Experiences. The promise's word split works without motion; the pour,
   the tasting table, the dive into the last cup and the fire run through
   VE.ready. "Your stay" (every Add button) is the shared shortlist in ve.js.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE) return;
  var q = function (s, el) { return (el || document).querySelector(s); };
  var qa = function (s, el) { return [].slice.call((el || document).querySelectorAll(s)); };

  /* ── The promise: one word at a time ── */
  var promise = q('.xp-promise__text'), words = [];
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
    var header = document.getElementById('veHeader');

    /* ── The first cup: the title rises, the cup is set down… ── */
    gsap.set('.xp-hero__line > *', { y: 0, yPercent: 110 });
    gsap.timeline({ defaults: { ease: 'expo.out' } })
      .to('.xp-hero__line > *', { yPercent: 0, duration: 1.5, stagger: 0.12 }, 0.1)
      .to(['.xp-hero__text .ve-crumbs', '.xp-hero__text .ve-kicker', '.xp-hero__sub', '.xp-hero__hint'], { opacity: 1, duration: 1.2, stagger: 0.08 }, 0.3)
      .fromTo('.xp-cup', { opacity: 0, scale: 0.9, rotate: -24 }, { opacity: 1, scale: 1, rotate: 0, duration: 2.2, ease: 'expo.out' }, 0);

    /* …and scrolling pours it: the tea spreads from the centre, ripples, steeps from pale to amber
       while the saucer turns, and steam rises once it's full */
    gsap.timeline({ scrollTrigger: { trigger: '.xp-hero__pin', start: 'top top', end: '+=110%', pin: true, scrub: 1, anticipatePin: 1 } })
      .to('.xp-hero__hint', { opacity: 0, duration: 0.1 }, 0)
      .fromTo('.xp-cup', { '--fill': '0%' }, { '--fill': '50%', ease: 'power1.inOut', duration: 0.55 }, 0.02)
      .fromTo('.xp-cup__ripples', { opacity: 0 }, { opacity: 1, duration: 0.08 }, 0.02)
      .to('.xp-cup__ripples', { opacity: 0, duration: 0.14 }, 0.5)
      .fromTo('.xp-cup', { '--tea': 'rgb(230, 201, 140)', '--steep': 0.45 }, { '--tea': 'rgb(158, 90, 26)', '--steep': 0.8, ease: 'none', duration: 0.75 }, 0.1)
      .fromTo('.xp-cup__liquor img', { '--swirl': '0deg' }, { '--swirl': '50deg', ease: 'none', duration: 1 }, 0)
      .fromTo('.xp-cup__art', { rotate: 0 }, { rotate: -14, ease: 'none', duration: 1, transformOrigin: '50% 50%' }, 0)
      .fromTo('.xp-cup__steam', { opacity: 0 }, { opacity: 1, duration: 0.25 }, 0.55)
      .to('.xp-hero__text', { y: -40, opacity: 0.25, ease: 'power1.in', duration: 0.25 }, 0.75);

    /* ── The promise lights up; the key follows ── */
    if (words.length) gsap.to(words, { opacity: 1, ease: 'none', stagger: 0.1,
      scrollTrigger: { trigger: promise, start: 'top 80%', end: 'bottom 45%', scrub: 0.4 } });
    gsap.from('.xp-promise__key li', { opacity: 0, y: 24, duration: 1, ease: 'expo.out', stagger: 0.1,
      scrollTrigger: { trigger: '.xp-promise__key', start: 'top 85%', once: true } });

    /* ── The tasting table. Desktop: a pinned pour along the bench, dawn to night, ending in a dive
          into the darkest cup that becomes the evening. Phones and tablets: the cups down the page. ── */
    var mm = gsap.matchMedia();
    mm.add('(min-width: 900px)', function () {
      var section = q('.xp-table'), pin = q('.xp-table__pin'), track = q('.xp-table__track'), bar = q('.xp-table__bar');
      var items = qa('.xp-item'), last = items[items.length - 1], dive = q('.xp-table__dive');
      if (!last) return;
      var liq = q('.xp-item__liquor', last), size = 100, cover = 30, dark = false;
      var dist = function () { return Math.max(0, track.scrollWidth - window.innerWidth); };
      // Put the dive circle over the last cup's tea as it will sit when the track stops
      function placeDive() {
        var pr = pin.getBoundingClientRect(), lr = liq.getBoundingClientRect(), x = gsap.getProperty(track, 'x') || 0;
        var cx = lr.left + lr.width / 2 - pr.left - x - dist(), cy = lr.top + lr.height / 2 - pr.top;
        size = lr.width;
        var far = Math.max(Math.hypot(cx, cy), Math.hypot(pr.width - cx, cy), Math.hypot(cx, pr.height - cy), Math.hypot(pr.width - cx, pr.height - cy));
        cover = (far * 2) / size + 0.2;
        gsap.set(dive, { width: size, height: size, left: cx - size / 2, top: cy - size / 2, '--liq': getComputedStyle(last).getPropertyValue('--liq').trim() || '#2c1208' });
        var src = q('img', liq), img = q('img', dive);
        if (src && img && img.getAttribute('src') !== (src.currentSrc || src.src)) img.src = src.currentSrc || src.src;
      }
      var tl = gsap.timeline({ scrollTrigger: { trigger: pin, start: 'top top', end: function () { return '+=' + Math.round(dist() * 1.3 + window.innerHeight * 0.4); },
        pin: true, scrub: 1, invalidateOnRefresh: true, anticipatePin: 1, onRefresh: placeDive,
        onUpdate: function (self) {
          var isDark = self.progress > 0.9;
          if (isDark === dark) return;
          dark = isDark;
          section.setAttribute('data-theme', isDark ? 'dark' : 'light');
          if (header) header.setAttribute('data-theme', isDark ? 'dark' : 'light');
        } } });
      tl.to(track, { x: function () { return -dist(); }, ease: 'none', duration: 1 }, 0)
        .fromTo(bar, { '--p': 0 }, { '--p': 1, ease: 'none', duration: 1 }, 0)
        .fromTo(dive, { autoAlpha: 0, scale: 1 }, { autoAlpha: 1, duration: 0.02 }, 1)
        .to(dive, { scale: function () { return cover; }, ease: 'power2.in', duration: 0.36 }, 1)
        .fromTo('.xp-table__dive-tea', { opacity: 0.72 }, { opacity: 1, ease: 'none', duration: 0.12 }, 1)
        .fromTo('.xp-table__dive-dark', { opacity: 0 }, { opacity: 1, ease: 'power1.in', duration: 0.2 }, 1.14);
      placeDive();
      return function () { section.setAttribute('data-theme', 'light'); };
    });

    /* ── The fire is lit at six-thirty: the room appears from the hearth outwards. Pinned beside the
          words on larger screens; on phones it lights up above them as the section scrolls past ── */
    (function fire() {
      var section = q('.xp-fire'), room = q('.xp-fire__room');
      if (!section || !room) return;
      var lit = false;
      var onUpdate = function (self) {
        var on = self.progress > 0.08;
        if (on !== lit) { lit = on; section.classList.toggle('is-lit', on); }
      };
      var light = function (tl) {
        return tl.fromTo(room, { '--r': 0 }, { '--r': 100, ease: 'power2.in', duration: 0.8 }, 0.05)
          .fromTo('.xp-fire__glow', { opacity: 0 }, { opacity: 0.9, ease: 'power1.out', duration: 0.3 }, 0.05);
      };
      var fm = gsap.matchMedia();
      fm.add('(min-width: 761px)', function () {
        light(gsap.timeline({ scrollTrigger: { trigger: '.xp-fire__pin', start: 'top top', end: '+=100%', pin: true, scrub: 1, anticipatePin: 1, onUpdate: onUpdate } }));
      });
      fm.add('(max-width: 760px)', function () {
        light(gsap.timeline({ scrollTrigger: { trigger: section, start: 'top 75%', end: 'top -10%', scrub: 1, onUpdate: onUpdate } }));
      });
      gsap.from(['.xp-fire__copy .ve-kicker', '.xp-fire__title', '.xp-fire__body', '.xp-fire__facts'], { opacity: 0, y: 30, duration: 1.3, ease: 'expo.out', stagger: 0.1,
        scrollTrigger: { trigger: '.xp-fire__copy', start: 'top 70%', once: true } });
    })();

    /* ── Small touches ── */
    gsap.from('.xp-touch', { opacity: 0, y: 28, duration: 1, ease: 'expo.out', stagger: 0.06,
      scrollTrigger: { trigger: '.xp-touches__grid', start: 'top 85%', once: true } });
    gsap.from('.xp-stay', { opacity: 0, y: 40, duration: 1.2, ease: 'expo.out',
      scrollTrigger: { trigger: '.xp-close', start: 'top 65%', once: true } });

    /* ── "Your stay" pill: from the tasting table until the arrange section ── */
    var sticky = q('.xp-sticky');
    if (sticky) {
      // refreshPriority -1: measured after the pins above have added their length
      ScrollTrigger.create({ trigger: '.xp-table', start: 'top 70%', endTrigger: '.xp-close', end: 'top 75%', refreshPriority: -1,
        onToggle: function (self) { sticky.classList.toggle('is-visible', self.isActive); } });
    }

    ScrollTrigger.sort();
    ScrollTrigger.refresh();
  });
})();
