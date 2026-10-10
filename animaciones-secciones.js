(() => {
  const items = document.querySelectorAll('.colegio-card, .colegio-comunidad, .colegio-familias');
  items.forEach((item, index) => {
    item.classList.add('colegio-scroll');
    item.style.transitionDelay = `${Math.min((index % 3) * 100, 200)}ms`;
  });

  if (!('IntersectionObserver' in window)) {
    items.forEach((item) => item.classList.add('is-visible'));
    return;
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add('is-visible');
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.15 });

  items.forEach((item) => observer.observe(item));
})();
