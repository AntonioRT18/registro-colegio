<?php

$entorno = getenv("APP_ENV") ?: "local";
$configuracion = [
    "host" => "localhost",
    "database" => "estudiantes",
    "username" => "root",
    "password" => "",
];

// Permite configurar XAMPP sin subir credenciales al repositorio.
$archivoLocal = __DIR__ . "/config.local.php";
if (is_file($archivoLocal)) {
    $configuracion = array_merge($configuracion, require $archivoLocal);
}

// En producción las variables del servidor tienen prioridad.
$variables = [
    "host" => "DB_HOST",
    "database" => "DB_NAME",
    "username" => "DB_USER",
    "password" => "DB_PASSWORD",
];
foreach ($variables as $clave => $variable) {
    $valor = getenv($variable);
    if ($valor !== false) {
        $configuracion[$clave] = $valor;
    }
}

if ($entorno === "production") {
    foreach ($variables as $variable) {
        if (getenv($variable) === false || getenv($variable) === "") {
            error_log("Falta configurar " . $variable . " en producción.");
            http_response_code(500);
            exit("Error de configuración del servidor.");
        }
    }
}

try {
    $dsn = "mysql:host=" . $configuracion["host"]
        . ";dbname=" . $configuracion["database"] . ";charset=utf8mb4";

    $conexion = new PDO($dsn, $configuracion["username"], $configuracion["password"], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $error) {
    error_log("Error de conexión a la base de datos: " . $error->getMessage());
    http_response_code(500);
    exit("No fue posible conectar con la base de datos.");
}
