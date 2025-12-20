<?php
include("../INCLUDES/conexion.php");
session_start();

// Verificar que el admin esté logueado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Validar ID de encuesta
if (!isset($_GET['id'])) {
    header("Location: encuestas.php");
    exit;
}

$encuesta_id = (int) $_GET['id'];

// Obtener título de la encuesta
$encuesta = mysqli_query($conexion, "SELECT titulo FROM encuestas WHERE id = $encuesta_id");
$e = mysqli_fetch_assoc($encuesta);

// Obtener respuestas
$respuestas = mysqli_query($conexion, "
    SELECT u.usuario, r.respuesta, r.creado_en
    FROM respuestas r
    INNER JOIN usuarios u ON r.alumno_id = u.id
    WHERE r.encuesta_id = $encuesta_id
    ORDER BY r.creado_en DESC
");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Respuestas de Encuesta</title>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tu CSS -->
    <link rel="stylesheet" href="../CSS/main.css">
</head>

<body>

    <!-- HEADER -->
    <header>
        <div class="left">
            <div class="brand">
                <h1>PANEL ADMINISTRADOR / COLEGIO <span class="titulo">HIJOS DE DIOS</span></h1>
            </div>
        </div>
    </header>

    <!-- SIDEBAR -->
    <section class="sidebar-section">
        <div class="sidebar" id="sidebar">

            <div class="menu-container">
                <div class="menu" id="menu">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>

            <nav>
                <ul>
                    <li>
                        <a href="inicio.php">
                            <i class="fa-solid fa-house"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="usuarios.php">
                            <i class="fa-solid fa-user-plus"></i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="alumnos.php">
                            <i class="fa-solid fa-users"></i>
                            <span>Alumnos</span>
                        </a>
                    </li>
                    <li>
                        <a href="reclamos_admin.php">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                            <span>Reclamos</span>
                        </a>
                    </li>
                    <li>
                        <a href="encuestas.php" class="active">
                            <i class="fa-solid fa-chart-simple"></i>
                            <span>Encuestas</span>
                        </a>
                    </li>
                    <li>
                        <a href="../salir.php">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </section>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container mt-4 contenido">

        <h2>Respuestas de la Encuesta</h2>
        <h5 class="mb-4 text-muted"><?= htmlspecialchars($e['titulo']) ?></h5>

        <?php if (mysqli_num_rows($respuestas) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Alumno</th>
                            <th>Respuesta</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($r = mysqli_fetch_assoc($respuestas)): ?>
                            <tr>
                                <td><?= htmlspecialchars($r['usuario']) ?></td>
                                <td><?= htmlspecialchars($r['respuesta']) ?></td>
                                <td><?= $r['creado_en'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">Ningún alumno ha respondido esta encuesta.</p>
        <?php endif; ?>

        <a href="encuestas.php" class="btn btn-secondary mt-3">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>

    </div>

    <script src="../JS/menu.js"></script>
    <footer>
        <div class="contenedor">
            <p>&copy; 2025 Colegio Hijos de Dios</p>
        </div>
    </footer>

</body>

</html>