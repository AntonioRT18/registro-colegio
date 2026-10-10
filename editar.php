<?php
session_start();

if (!isset($_SESSION["usuario"])) {

    header("Location: login.php");
    exit();

}

require_once "conexion.php";

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $carrera = $_POST["carrera"];

    $sql = "UPDATE alumnos SET
            codigo = :codigo,
            nombre = :nombre,
            apellido = :apellido,
            correo = :correo,
            carrera = :carrera
            WHERE id = :id";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":codigo" => $codigo,
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":correo" => $correo,
        ":carrera" => $carrera,
        ":id" => $id
    ]);

   header("Location: index.php?mensaje=editado");
exit();
}


$sql = "SELECT * FROM alumnos WHERE id = :id";

$stmt = $conexion->prepare($sql);

$stmt->execute([
    ":id" => $id
]);

$alumno = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar estudiante</title>
</head>

<body>

    <h1>Editar estudiante</h1>

    <form action="editar.php?id=<?php echo $id; ?>" method="POST">

        <label>Código:</label>
        <input type="text" name="codigo"
               value="<?php echo $alumno['codigo']; ?>" required>

        <br><br>

        <label>Nombre:</label>
        <input type="text" name="nombre"
               value="<?php echo $alumno['nombre']; ?>" required>

        <br><br>

        <label>Apellido:</label>
        <input type="text" name="apellido"
               value="<?php echo $alumno['apellido']; ?>" required>

        <br><br>

        <label>Correo:</label>
        <input type="email" name="correo"
               value="<?php echo $alumno['correo']; ?>" required>

        <br><br>

        <label>Carrera:</label>
        <input type="text" name="carrera"
               value="<?php echo $alumno['carrera']; ?>" required>

        <br><br>

        <button type="submit">Guardar cambios</button>

    </form>

</body>

</html>