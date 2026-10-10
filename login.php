<?php
session_start();

require_once "conexion.php";
require_once "funciones.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"] ?? "");
    $password = $_POST["password"] ?? "";

    // Alias explícito: evita depender de mayúsculas/minúsculas de PASSWORD en PDO.
    $sql = "SELECT id, usuario, `PASSWORD` AS password_hash FROM usuarios WHERE usuario = :usuario LIMIT 1";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":usuario" => $usuario
    ]);

    $usuarioBD = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuarioBD && password_verify($password, $usuarioBD["password_hash"])) {

        $_SESSION["usuario"] = $usuarioBD["usuario"];

        header("Location: alumnos.php");
        exit();

    } else {

        $error = "Usuario o contraseña incorrectos.";

    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Acceso administrativo</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?v=1">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="mejoras.css?v=2">

</head>

<body>

<div class="login-contenedor">

    <div class="login-card">

        <div class="login-icono">
            🔐
        </div>

        <h1>Acceso administrativo</h1>

        <p class="subtitulo">
            Ingresa para gestionar los estudiantes
        </p>


        <?php if ($error): ?>

            <div class="error-login">

                ❌ <?php echo e($error); ?>

            </div>

        <?php endif; ?>


        <form method="POST">

            <div class="campo">

                <label>Usuario</label>

                <input
                    type="text"
                    name="usuario"
                    class="form-control"
                    placeholder="Ingresa tu usuario"
                    required
                >

            </div>


            <div class="campo">

                <label>Contraseña</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Ingresa tu contraseña"
                    required
                >

            </div>


            <button
                type="submit"
                class="login-boton btn btn-primary"
            >

                🔐 Iniciar sesión

            </button>

        </form>


        <a
            href="index.php"
            class="volver"
        >

            ← Volver al registro

        </a>

    </div>

</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
