# Registro de estudiantes

Proyecto sencillo en PHP y MySQL para registrar estudiantes y administrarlos desde un panel.

## Para probarlo

1. Inicia Apache y MySQL en XAMPP.
2. En phpMyAdmin, crea la base `estudiantes` e importa `database/schema.sql`.
   Si ya tenías creada la tabla `alumnos`, ejecuta una sola vez `database/add_estado_alumnos.sql` para añadir el estado activo.
3. Si quieres algunos registros de ejemplo, importa también `database/demo_data.sql`.
4. Copia `config.local.php.example` como `config.local.php` y ajusta la conexión.
5. Abre `http://localhost/registro_estudiantes/`.

### Crear el administrador local

Define `ADMIN_USER` y `ADMIN_PASSWORD` en el entorno de la terminal (usa una
contraseña propia de al menos 12 caracteres) y ejecuta `php crear_admin.php`.
El instalador solo funciona desde CLI y guarda la contraseña con `password_hash`.
No uses una contraseña real o personal en capturas ni en archivos del proyecto.

## Sobre la publicación

Este repositorio sirve para compartir el código. GitHub Pages no ejecuta PHP; para publicar una demo en línea hace falta un hosting con PHP y MySQL o MariaDB.

Los registros de `database/demo_data.sql` son inventados. No subas tu archivo `config.local.php`, contraseñas, copias de tu base de datos ni información personal. Antes de publicar, revisa `git status`.

La aplicación está pensada como ejemplo para practicar. No la uses con datos reales sin revisar y reforzar su seguridad.

## Requisitos

- PHP con PDO MySQL
- MySQL o MariaDB

## Base de datos al publicar

Conserva MySQL/MariaDB si el hosting elegido los ofrece; no necesitas cambiar de motor por subir el código a GitHub. GitHub es el repositorio, no el servidor PHP ni el servidor de base de datos. Para producción necesitas un hosting que ejecute PHP y proporcione una base MySQL/MariaDB, o contratar esos servicios por separado.

Configura en el panel del hosting las variables `APP_ENV=production`, `DB_HOST`, `DB_NAME`, `DB_USER` y `DB_PASSWORD`. No uses la cuenta `root` en producción: crea un usuario de base de datos exclusivo para esta aplicación, con los permisos necesarios sobre su base. `conexion.php` prioriza esas variables y oculta los detalles de conexión al visitante.

## Preparar el repositorio para GitHub

Revisa que `config.local.php` y cualquier archivo con credenciales o datos personales no estén en los cambios antes de publicar. El `.gitignore` los excluye para nuevos archivos; si un secreto ya fue agregado al historial, quitarlo del último commit no invalida el secreto: cámbialo en el servidor.

## Agentes de Codex

El directorio `.codex/agents/` incluye un revisor PHP/seguridad y un asesor de base de datos en modo de solo lectura. Úsalos en revisiones independientes; cada agente consume tokens adicionales, así que una tarea corta suele ser más económica con un solo agente.
