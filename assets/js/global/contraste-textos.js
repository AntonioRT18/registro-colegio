/* Contraste de texto por superficie para toda la página. */
(() => {
  const selectors = 'h1,h2,h3,h4,h5,h6,p,small,span,a,li,label,button,strong,em,figcaption';

  function colorParts(value) {
    const match = value.match(/rgba?\(([^)]+)\)/i);
    if (!match) return null;
    const values = match[1].split(',').map((part) => Number.parseFloat(part.trim()));
    if (values.length < 3 || values.some(Number.isNaN)) return null;
    return { r: values[0], g: values[1], b: values[2], a: values.length > 3 ? values[3] : 1 };
  }

  function luminance(color) {
    const channels = [color.r, color.g, color.b].map((channel) => {
      const value = channel / 255;
      return value <= .04045 ? value / 12.92 : ((value + .055) / 1.055) ** 2.4;
    });
    return .2126 * channels[0] + .7152 * channels[1] + .0722 * channels[2];
  }

  function surfaceIsLight(element) {
    for (let node = element; node && node !== document.documentElement; node = node.parentElement) {
      const style = getComputedStyle(node);
      const background = colorParts(style.backgroundColor);
      if (background && background.a >= .45) return luminance(background) > .48;
      if (style.backgroundImage && style.backgroundImage !== 'none') {
        const gradientColor = colorParts(style.backgroundImage);
        if (gradientColor) return luminance(gradientColor) > .48;
      }
    }
    return true;
  }

  function apply(element) {
    if (!(element instanceof Element) || !element.matches(selectors)) return;
    const mode = surfaceIsLight(element) ? 'sobre-claro' : 'sobre-oscuro';
    if (element.dataset.contraste !== mode) element.dataset.contraste = mode;
  }

  function scan(root = document) {
    if (root instanceof Element) apply(root);
    root.querySelectorAll?.(selectors).forEach(apply);
  }

  scan();
  new MutationObserver((records) => {
    records.forEach((record) => record.addedNodes.forEach((node) => scan(node)));
  }).observe(document.body, { childList: true, subtree: true });
})();
