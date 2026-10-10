<?php

require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $codigo = trim($_POST["codigo"] ?? "");
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $carrera = $_POST["carrera"];

    if (!preg_match('/^[0-9]{7,10}$/', $codigo)) {
        header("Location: index.php?mensaje=codigo_invalido#registro");
        exit();
    }

    $sql = "INSERT INTO alumnos (codigo, nombre, apellido, correo, carrera)
            VALUES (:codigo, :nombre, :apellido, :correo, :carrera)";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":codigo" => $codigo,
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":correo" => $correo,
        ":carrera" => $carrera
    ]);

header("Location: index.php?mensaje=registrado");
exit();
}
?>
