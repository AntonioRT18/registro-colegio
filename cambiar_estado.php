<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Método no permitido.");
}

if (
    !isset($_POST["csrf_token"], $_SESSION["csrf_token"])
    || !hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"])
) {
    http_response_code(403);
    exit("Solicitud no válida. Recarga el panel e inténtalo de nuevo.");
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$estado = $_POST["estado"] ?? "";

if (!$id || !in_array($estado, ["activo", "inactivo"], true)) {
    header("Location: alumnos.php");
    exit();
}

require_once "conexion.php";

$stmt = $conexion->prepare("UPDATE alumnos SET estado = :estado WHERE id = :id");
$stmt->execute([
    ":estado" => $estado,
    ":id" => $id,
]);

header("Location: alumnos.php");
exit();
