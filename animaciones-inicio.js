(() => {
  const keys = ['misión', 'mision', 'visión', 'vision', 'valores'];
  const headings = document.querySelectorAll('h1, h2, h3, h4');
  const cards = new Set();

  headings.forEach((heading) => {
    const label = (heading.textContent || '').trim().toLocaleLowerCase('es');
    if (!keys.some((key) => label.includes(key))) return;
    const card = heading.closest('.card, article, .mvv-card, .valor-card') || heading.parentElement;
    if (card) cards.add(card);
  });

  const items = [...cards];
  items.forEach((item, index) => {
    item.classList.add('mvv-reveal');
    item.style.transitionDelay = `${Math.min(index * 120, 240)}ms`;
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
  }, { threshold: 0.16 });

  items.forEach((item) => observer.observe(item));
})();
