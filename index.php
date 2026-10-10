<?php
require_once "conexion.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Estudiantes</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css?v=1">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="mejoras.css?v=2">
    <link rel="stylesheet" href="inicio.css?v=4">

<link rel="stylesheet" href="portada-visual.css?v=2">
<link rel="stylesheet" href="institucion.css?v=3">
<link rel="stylesheet" href="tema-azul.css?v=2">
<link rel="stylesheet" href="insignia-lateral.css?v=6">
<link rel="stylesheet" href="pie-colegio.css?v=1">
<link rel="stylesheet" href="tema-claro.css?v=3">
<link rel="stylesheet" href="assets/css/portada/portada-foto.css?v=6">
<link rel="stylesheet" href="assets/css/portada/portada-ajustes.css?v=10">
<link rel="stylesheet" href="assets/css/global/contraste-textos.css?v=3">
</head>

<body>

<nav class="navbar navbar-expand-lg landing-nav">
    <div class="container">
        <a class="navbar-brand landing-brand" href="#inicio">Registro Académico</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Abrir menú">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link landing-register-link" href="#registro" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="registro">Registro</a></li>
                <li class="nav-item"><a class="nav-link landing-admin-link" href="login.php">Acceso administrador</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="contenedor">

    <header class="encabezado" id="inicio">

        <h1>🎓 Registro de Estudiantes</h1>

        <p>
            Formulario de registro académico
        </p>

    </header>

    <?php if (($_GET['mensaje'] ?? '') === 'codigo_invalido'): ?>
        <div class="alert alert-danger" role="alert">
            El código debe tener entre 7 y 10 números. Revisa el dato e inténtalo de nuevo.
        </div>
    <?php endif; ?>

    <section class="landing-intro" aria-labelledby="titulo-intro">
        <div class="landing-intro-copy">
            <p class="landing-eyebrow">Gestión académica</p>
            <h2 id="titulo-intro">La información de tus alumnos, en un solo lugar.</h2>
            <p>Registra los datos principales y consulta los registros desde un panel administrativo sencillo.</p>
            <a class="btn landing-cta" href="#registro" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="registro">Registrar un alumno <span aria-hidden="true">→</span></a>
        </div>
        <div class="landing-preview" aria-hidden="true">
            <div class="preview-top"><span></span><span></span><span></span><b>Panel académico</b></div>
            <div class="preview-title">Alumnos registrados</div>
            <div class="preview-row"><i>A</i><span><b>Ana Ejemplo</b><small>Ingeniería de Sistemas</small></span><em>Activo</em></div>
            <div class="preview-row"><i>M</i><span><b>Mateo Muestra</b><small>Administración</small></span><em>Activo</em></div>
            <div class="preview-row"><i>S</i><span><b>Sofía Prueba</b><small>Diseño</small></span><em>Activo</em></div>
            <p class="preview-note">Vista ilustrativa · datos de ejemplo</p>
        </div>
    </section>

    <section class="landing-about" id="nosotros" aria-labelledby="titulo-sistema">
        <div class="landing-section-heading">
            <p class="landing-eyebrow">El sistema</p>
            <h2 id="titulo-sistema">Una herramienta sencilla para organizar registros</h2>
            <p>Un proyecto académico pensado para mantener la información clara y fácil de consultar.</p>
        </div>
        <div class="landing-values">
            <article class="value-card">
                <span class="value-number">01</span>
                <h3>Misión</h3>
                <p>Facilitar el registro y la consulta de la información básica de cada alumno.</p>
            </article>
            <article class="value-card">
                <span class="value-number">02</span>
                <h3>Visión</h3>
                <p>Ser una base práctica para aprender a construir sistemas de gestión académica.</p>
            </article>
            <article class="value-card">
                <span class="value-number">03</span>
                <h3>Valores</h3>
                <p>Orden, claridad y cuidado en el manejo de la información.</p>
            </article>
        </div>
    </section>


    <?php

    if (isset($_GET['mensaje'])) {

        if ($_GET['mensaje'] == 'registrado') {

            echo '
            <div class="mensaje exito">
                ✅ Estudiante registrado correctamente.
            </div>
            ';

        }

    }

    ?>


    <section class="tarjeta collapse" id="registro">

        <h2>📝 Registrar nuevo estudiante</h2>

        <form action="guardar.php" method="POST">

            <div class="formulario">

                <div>

                    <label>Código</label>

                    <input
                        type="text"
                        name="codigo"
                        class="form-control"
                        inputmode="numeric"
                        pattern="[0-9]{7,10}"
                        minlength="7"
                        maxlength="10"
                        title="Escribe un código de 7 a 10 números"
                        required
                    >

                </div>


                <div>

                    <label>Nombre</label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        required
                    >

                </div>


                <div>

                    <label>Apellido</label>

                    <input
                        type="text"
                        name="apellido"
                        class="form-control"
                        required
                    >

                </div>


                <div>

                    <label>Correo</label>

                    <input
                        type="email"
                        name="correo"
                        class="form-control"
                        required
                    >

                </div>


                <div class="campo-completo">

                    <label>Carrera</label>

                    <input
                        type="text"
                        name="carrera"
                        class="form-control"
                        required
                    >

                </div>

            </div>


            <button
                class="boton-principal btn btn-primary"
                type="submit"
            >

                ➕ Registrar estudiante

            </button>

        </form>

    </section>


    <div class="acceso-admin">

        <p>¿Eres administrador?</p>

        <a href="login.php">

            🔐 Acceso administrativo

        </a>

    </div>


    <footer>

        <p>
            Sistema de Gestión de Estudiantes
            | PHP + PDO + MySQL
        </p>

    </footer>

</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const registro = document.getElementById("registro");
    if (registro) {
        registro.addEventListener("shown.bs.collapse", function () {
            registro.scrollIntoView({ behavior: "smooth", block: "start" });
        });
        if (new URLSearchParams(window.location.search).get("mensaje") === "codigo_invalido") {
            bootstrap.Collapse.getOrCreateInstance(registro, { toggle: false }).show();
        }
    }
});
</script>
<script src="animaciones-inicio.js?v=1" defer></script>
<section class="colegio-extra" aria-labelledby="propuesta-titulo">
  <span class="colegio-kicker">Una comunidad que acompaña</span>
  <h2 class="colegio-heading" id="propuesta-titulo">Aprender, convivir y crecer juntos</h2>
  <p class="colegio-lead">La experiencia escolar se construye cada día con curiosidad, respeto y el compromiso compartido entre estudiantes, familias y educadores.</p>

  <div class="colegio-grid">
    <article class="colegio-card">
      <span class="colegio-icon" aria-hidden="true">✦</span>
      <h3>Aprendizaje con propósito</h3>
      <p>Un espacio para hacer preguntas, descubrir nuevas ideas y desarrollar habilidades para la vida.</p>
    </article>
    <article class="colegio-card">
      <span class="colegio-icon" aria-hidden="true">◎</span>
      <h3>Acompañamiento cercano</h3>
      <p>El progreso de cada estudiante importa. La comunicación y el apoyo fortalecen su camino escolar.</p>
    </article>
    <article class="colegio-card">
      <span class="colegio-icon" aria-hidden="true">◇</span>
      <h3>Convivencia y respeto</h3>
      <p>Promovemos la empatía, la responsabilidad y el sentido de comunidad en la vida cotidiana.</p>
    </article>
  </div>

  <section class="colegio-comunidad" aria-labelledby="comunidad-titulo">
    <div>
      <span class="colegio-kicker" style="color:#b9e7d8">Nuestra comunidad</span>
      <h2 id="comunidad-titulo">Cada estudiante tiene una historia que merece crecer</h2>
      <p>Creemos en una educación que une conocimientos y valores. Las familias son parte esencial de este recorrido y el diálogo nos ayuda a avanzar en equipo.</p>
    </div>
    <img class="colegio-sello" src="./insignia.svg" alt="Insignia escolar: aprender, crecer y avanzar">
  </section>

  <section class="colegio-familias" aria-labelledby="familias-titulo">
    <div>
      <h2 id="familias-titulo">¿Eres parte de nuestra comunidad?</h2>
      <p>Consulta el registro de estudiantes o ingresa al espacio administrativo.</p>
    </div>
    <div class="colegio-actions">
      <a class="btn btn-primary" href="#registro" data-bs-toggle="collapse" data-bs-target="#registro" aria-controls="registro">Registro de estudiantes</a>
      <a class="btn btn-outline-secondary" href="login.php">Acceso administrador</a>
    </div>
  </section>
</section>
<script src="animaciones-secciones.js?v=1" defer></script>
<script src="assets/js/portada/insignia-lateral.js?v=12" defer></script>
<script src="assets/js/portada/portada-textos.js?v=9" defer></script>
<script src="assets/js/global/contraste-textos.js?v=2" defer></script>
<footer class="site-footer">
  <div class="site-footer__main">
    <div>
      <a class="site-footer__brand" href="./">
        <img src="./insignia.svg" alt="">
        <span>Registro Académico</span>
      </a>
      <p class="site-footer__description">Una plataforma de demostración para organizar la información estudiantil.</p>
    </div>
    <nav class="site-footer__links" aria-label="Enlaces del sitio">
      <a href="#sistema">El sistema</a>
      <a href="#registro">Registro de estudiantes</a>
      <a href="login.php">Acceso administrador</a>
    </nav>
  </div>
  <div class="site-footer__bottom">
    <span>&copy; <?= date('Y') ?> Registro Académico</span>
    <span>Proyecto educativo de demostración</span>
  </div>
</footer>
</body>

</html>
