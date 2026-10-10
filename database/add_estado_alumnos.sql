-- Ejecuta una sola vez en la base estudiantes si la tabla alumnos ya existe.
ALTER TABLE alumnos
    ADD COLUMN estado ENUM('activo', 'inactivo') NOT NULL DEFAULT 'activo';
