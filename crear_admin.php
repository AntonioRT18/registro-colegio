<?php
// Este instalador debe ejecutarse desde la terminal, nunca desde el navegador.
if (PHP_SAPI !== "cli") {
    http_response_code(404);
    exit("No encontrado.");
}

require_once __DIR__ . "/conexion.php";

$usuario = trim((string) getenv("ADMIN_USER"));
$password = (string) getenv("ADMIN_PASSWORD");

if ($usuario === "" || strlen($usuario) > 100 || strlen($password) < 12) {
    fwrite(STDERR, "Define ADMIN_USER y ADMIN_PASSWORD (mínimo 12 caracteres) en el entorno antes de ejecutar este archivo.\n");
    exit(1);
}

$sql = "INSERT INTO usuarios (usuario, `PASSWORD`) VALUES (:usuario, :password)";
$stmt = $conexion->prepare($sql);
$stmt->execute([
    ":usuario" => $usuario,
    ":password" => password_hash($password, PASSWORD_DEFAULT),
]);

fwrite(STDOUT, "Administrador creado correctamente.\n");
