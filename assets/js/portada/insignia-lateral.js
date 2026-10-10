/* Coloca la insignia junto a la portada sin intervenir en colores ni textos. */
(() => {
  const hero = document.querySelector('.landing-intro');
  if (!hero || document.querySelector('.insignia-lateral')) return;

  const badge = document.createElement('img');
  badge.className = 'insignia-lateral';
  badge.src = 'insignia.svg';
  badge.alt = 'Insignia escolar';

  if (window.matchMedia('(max-width: 1100px)').matches) {
    badge.classList.add('insignia-lateral-movil');
    hero.querySelector('.landing-intro-copy')?.prepend(badge);
  } else {
    document.body.appendChild(badge);
  }
})();
