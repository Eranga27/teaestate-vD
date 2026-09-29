/* ═══════════════════════════════════════════════════════════════════════════
   vE · Privacy. The contents list marks the section being read.
═══════════════════════════════════════════════════════════════════════════ */
(function () {
  if (!window.VE || VE.reduce) return;
  VE.ready(function () {
    var links = [].slice.call(document.querySelectorAll('.pv-toc a'));
    links.forEach(function (a) {
      var target = document.querySelector(a.getAttribute('href'));
      if (!target) return;
      ScrollTrigger.create({ trigger: target, start: 'top 40%', end: 'bottom 40%',
        onToggle: function (self) { if (self.isActive) links.forEach(function (l) { l.classList.toggle('is-on', l === a); }); } });
    });
    ScrollTrigger.refresh();
  });
})();
