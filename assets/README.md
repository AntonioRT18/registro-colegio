# Recursos del sitio

Los recursos de la página están agrupados por alcance y sección:

- `css/global/`: estilos compartidos, como el contraste de texto.
- `css/portada/`: imagen y presentación de la portada.
- `js/global/`: comportamiento compartido en toda la página.
- `js/portada/`: textos, insignia e interacciones propias de la portada.

`index.php` permanece en la raíz como punto de entrada de PHP y carga los
recursos desde estas rutas. Las rutas se mantienen relativas a la raíz del
proyecto para que funcionen al abrirlo desde XAMPP.
