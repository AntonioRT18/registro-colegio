<?php

session_start();

if (!isset($_SESSION["usuario"])) {

    header("Location: login.php");
    exit();

}

if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

require_once "conexion.php";
require_once "funciones.php";
require_once "funciones.php";

$buscar = $_GET["buscar"] ?? "";

if ($buscar != "") {

    $sql = "SELECT * FROM alumnos
            WHERE nombre LIKE :buscar
            OR apellido LIKE :buscar
            OR codigo LIKE :buscar
            OR correo LIKE :buscar
            OR carrera LIKE :buscar
            ORDER BY id DESC";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":buscar" => "%" . $buscar . "%"
    ]);

} else {

    $sql = "SELECT * FROM alumnos ORDER BY id DESC";

    $stmt = $conexion->prepare($sql);

    $stmt->execute();
}

$alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = count($alumnos);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel Administrativo</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css?v=1">
    <link rel="stylesheet" href="panel.css">
    <link rel="stylesheet" href="mejoras.css?v=2">

</head>

<body>

<div class="panel">

    <!-- BARRA SUPERIOR -->

    <header class="barra">

        <div>

            <h1>🎓 Sistema de Estudiantes</h1>

            <p>Panel administrativo</p>

        </div>

        <div class="usuario">

            👤 <?php echo e($_SESSION["usuario"]); ?>

            <a href="cerrar_sesion.php">
                🚪 Salir
            </a>

        </div>

    </header>


    <!-- CONTENIDO -->

    <main>

        <div class="bienvenida">

            <h2>Dashboard</h2>

            <p>
                Gestiona los estudiantes registrados en el sistema.
            </p>

        </div>


        <!-- ESTADÍSTICAS -->

        <section class="estadisticas">

            <div class="estadistica">

                <span>👨‍🎓</span>

                <div>

                    <h3><?php echo $total; ?></h3>

                    <p>Estudiantes</p>

                </div>

            </div>


            <div class="estadistica">

                <span>💻</span>

                <div>

                    <h3>CRUD</h3>

                    <p>Sistema completo</p>

                </div>

            </div>


            <div class="estadistica">

                <span>🗄️</span>

                <div>

                    <h3>MySQL</h3>

                    <p>Base de datos</p>

                </div>

            </div>

        </section>


        <!-- BUSCADOR -->

        <section class="buscador">

            <h2>🔎 Buscar estudiante</h2>

            <form method="GET">

                <input
                    type="text"
                    name="buscar"
                    class="form-control"
                    placeholder="Buscar por nombre, apellido o código..."
                    value="<?php echo e($_GET['buscar'] ?? ''); ?>"
                >

                <button type="submit">
                    🔎 Buscar
                </button>

            </form>

        </section>


        <!-- LISTA -->

        <section class="lista">

            <div class="titulo-lista">

                <div>

                    <h2>👥 Estudiantes registrados</h2>

                   <p>
    <?php

    if ($total == 1) {

        echo "1 estudiante encontrado";

    } else {

        echo $total . " estudiantes encontrados";

    }

    ?>
</p>

                </div>

            </div>


            <div class="estudiantes">

                <?php foreach ($alumnos as $alumno): ?>

                    <article class="estudiante">

                        <div class="avatar">

                            <?php echo strtoupper(substr($alumno["nombre"], 0, 1)); ?>

                        </div>


                        <div class="informacion">

                            <h3>

                                <?php
                                echo e(
                                    $alumno["nombre"] . " " . $alumno["apellido"]
                                );
                                ?>

                            </h3>


                            <?php $activo = ($alumno["estado"] ?? "activo") === "activo"; ?>
                            <p class="estado-alumno <?php echo $activo ? "estado-activo" : "estado-inactivo"; ?>">
                                <?php echo $activo ? "Activo" : "Desactivado"; ?>
                            </p>

                            <p class="carrera">

                                🎓
                                <?php echo e($alumno["carrera"]); ?>

                            </p>


                            <p>

                                📧
                                <?php echo e($alumno["correo"]); ?>

                            </p>


                            <p>

                                🆔 Código:
                                <strong>
                                    <?php echo e($alumno["codigo"]); ?>
                                </strong>

                            </p>

                        </div>


                        <div class="acciones">

                            <form method="POST" action="cambiar_estado.php" class="form-estado">
                                <input type="hidden" name="id" value="<?php echo (int) $alumno["id"]; ?>">
                                <input type="hidden" name="csrf_token" value="<?php echo e($_SESSION["csrf_token"]); ?>">
                                <input type="hidden" name="estado" value="<?php echo $activo ? "inactivo" : "activo"; ?>">
                                <button class="cambiar-estado" type="submit">
                                    <?php echo $activo ? "Desactivar" : "Activar"; ?>
                                </button>
                            </form>

                            <a
                                class="editar"
                                href="editar.php?id=<?php echo $alumno["id"]; ?>"
                            >
                                ✏️ Editar
                            </a>


                            <a
                                class="eliminar"
                                href="eliminar.php?id=<?php echo $alumno["id"]; ?>"
                                onclick="return confirm('⚠️ ¿Estás seguro de que deseas eliminar este estudiante?');"
                            >
                                🗑️ Eliminar
                            </a>

                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

        </section>

    </main>


    <footer>

        Sistema de Gestión de Estudiantes

        <br>

        PHP • PDO • MySQL

    </footer>

</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
