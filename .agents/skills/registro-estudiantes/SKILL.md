---
name: registro-estudiantes
description: Cambios breves y seguros en el sistema PHP de registro de estudiantes.
---

# Registro de estudiantes

Usa esta guía al modificar este proyecto para evitar volver a descubrir su estructura y convenciones.

- Aplicación PHP sencilla con PDO y MySQL; conexión compartida en `conexion.php`.
- Archivos principales: `index.php` (registro público), `guardar.php` (alta), `login.php` (acceso), `alumnos.php` (panel y búsqueda), `editar.php` y `eliminar.php` (CRUD).
- Usa consultas preparadas para valores SQL. Para imprimir datos dinámicos en HTML, incluye `funciones.php` y usa `e($valor)`.
- Conserva la interfaz en español y los estilos separados en CSS.
- Al iniciar una tarea, lee solo los archivos implicados y este resumen; evita repetir exploraciones generales.
- Al terminar, resume los archivos tocados y cualquier verificación ejecutada. No ejecutes pruebas salvo que el usuario las pida.
