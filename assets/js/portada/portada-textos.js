/* Prepara las clases de la portada sin alterar estilos de otras secciones. */
(() => {
  const clean = (value) => (value || '').normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
  const hero = document.querySelector('.landing-intro');
  if (!hero) return;

  const title = hero.querySelector('#titulo-intro');
  const copy = hero.querySelector('.landing-intro-copy');
  const eyebrow = copy?.querySelector('.landing-eyebrow');
  const description = copy?.querySelector(':scope > p:not(.landing-eyebrow)');
  if (title) title.classList.add('portada-titulo');
  if (eyebrow) eyebrow.classList.add('portada-etiqueta');
  if (description) description.classList.add('portada-descripcion');
  hero.classList.add('portada-con-foto');

  // La franja con la foto queda inmediatamente bajo el nav y solo envuelve el hero.
  let photoSection = hero.parentElement?.classList.contains('portada-fondo-campus') ? hero.parentElement : null;
  if (!photoSection) {
    photoSection = document.createElement('section');
    photoSection.className = 'portada-fondo-campus';
    photoSection.setAttribute('aria-label', 'Imagen de portada del colegio');
    hero.parentNode?.insertBefore(photoSection, hero);
    photoSection.append(hero);
  }

  const addPhoto = (source) => {
    if (!source || photoSection.querySelector('.portada-foto-layer')) return;
    const image = document.createElement('img');
    image.className = 'portada-foto-layer';
    image.alt = '';
    image.setAttribute('aria-hidden', 'true');
    image.src = source.replace(/^data:application\/octet-stream;/, 'data:image/png;');
    photoSection.prepend(image);
  };

  fetch('assets/css/portada/portada-foto.css?v=7')
    .then((response) => response.ok ? response.text() : Promise.reject())
    .then((css) => {
      const match = css.match(/url\(["']?(data:[^"')]+)["']?\)/);
      if (match) addPhoto(match[1]);
    })
    .catch(() => {});

  document.querySelectorAll('.landing-about, .colegio-extra, .colegio-comunidad, .colegio-familias, main article').forEach((section) => {
    const heading = section.querySelector(':scope > h2, :scope > h3, :scope > h4, :scope > div > h2, :scope > div > h3, :scope > div > h4');
    const headingText = clean(heading?.textContent);
    const sectionText = clean(section.textContent);
    if (headingText.includes('mision')) section.classList.add('seccion-mision');
    else if (headingText.includes('vision')) section.classList.add('seccion-vision');
    else if (headingText.includes('valores')) section.classList.add('seccion-valores');
    else if (headingText.includes('comunidad') || sectionText.includes('aprender, convivir y crecer juntos')) section.classList.add('seccion-comunidad');
    else if (headingText.includes('sistema') || headingText.includes('herramienta')) section.classList.add('seccion-sistema');
    if (heading) heading.classList.add('seccion-titulo');
    section.querySelectorAll(':scope > p, :scope > div > p').forEach((paragraph) => paragraph.classList.add('seccion-descripcion'));
  });
})();
