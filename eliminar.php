<?php
session_start();

if (!isset($_SESSION["usuario"])) {

    header("Location: login.php");
    exit();

}
require_once "conexion.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM alumnos WHERE id = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id" => $id
    ]);
}

header("Location: index.php?mensaje=eliminado");
exit();

?>