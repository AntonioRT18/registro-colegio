-- Mejora consultas frecuentes cuando la tabla alumnos crece.
-- Ejecutar una sola vez desde phpMyAdmin, en la base de datos estudiantes.
-- El índice de código acelera búsquedas y validaciones de duplicados;
-- el índice compuesto ayuda al filtro por estado con orden por id.
ALTER TABLE alumnos
  ADD INDEX idx_alumnos_codigo (codigo),
  ADD INDEX idx_alumnos_estado_id (estado, id);
