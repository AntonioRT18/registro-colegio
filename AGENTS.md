# Guía del proyecto

- Proyecto PHP + PDO + MySQL/MariaDB para registro y administración de estudiantes.
- Lee primero solo los archivos implicados; usa esta guía para evitar volver a explorar el proyecto completo.
- Mantén SQL parametrizado y escapa toda salida HTML dinámica con `e()` de `funciones.php`.
- No guardes credenciales en el código ni en Git. La configuración local está en `config.local.php` (ignorado); producción usa variables de entorno.
- Mantén el idioma de interfaz en español y los estilos en CSS separados.
- Usa agentes especializados solo para tareas independientes que se beneficien de una revisión paralela; devuelven resúmenes breves y concretos.
- Antes de terminar, revisa los archivos modificados y comunica las verificaciones realizadas. No ejecutes pruebas salvo que el usuario las solicite.
