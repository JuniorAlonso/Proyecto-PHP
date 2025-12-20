<?php
include("../INCLUDES/conexion.php");
session_start();

// Verificar que el alumno esté logueado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    header("Location: ../login.php");
    exit;
}

$alumno_id = $_SESSION['id'];

// Procesar envío de respuesta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['respuesta']) && !empty($_POST['encuesta_id'])) {
    $encuesta_id = (int) $_POST['encuesta_id'];
    $respuesta = $_POST['respuesta'];

    $stmt = $conexion->prepare("INSERT INTO respuestas (alumno_id, encuesta_id, respuesta) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $alumno_id, $encuesta_id, $respuesta);
    $stmt->execute();
    $stmt->close();

    header("Location: encuestas.php");
    exit;
}

// Obtener encuestas activas
$resultado = mysqli_query($conexion, "SELECT * FROM encuestas WHERE estado='activa' ORDER BY creado_en DESC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Encuestas | Alumno</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/main.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="left">
            <div class="brand">
                <h1>COLEGIO <span class="titulo">HIJOS DE DIOS</span></h1>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
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
                        <a href="asistencia.php">
                            <i class="fa-solid fa-list-check"></i>
                            <span>Asistencia</span>
                        </a>
                    </li>
                    <li>
                        <a href="reclamos.php">
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
                        <a href="../salir.php" title="Cerrar Sesión">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Cerrar Sesión</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <div class="container mt-4">
        <h2>Encuestas Disponibles</h2>
        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <?php while ($e = mysqli_fetch_assoc($resultado)): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($e['titulo']) ?></h5>
                        <p class="card-text"><small class="text-muted"><?= $e['creado_en'] ?></small></p>

                        <?php
                        // Verificar si ya respondió el alumno
                        $check = mysqli_query($conexion, "SELECT * FROM respuestas WHERE alumno_id=$alumno_id AND encuesta_id=" . $e['id']);
                        if (mysqli_num_rows($check) > 0):
                            $r = mysqli_fetch_assoc($check);
                            ?>
                            <p class="text-success">Ya respondiste: <?= htmlspecialchars($r['respuesta']) ?></p>
                        <?php else: ?>
                            <form method="POST">
                                <input type="hidden" name="encuesta_id" value="<?= $e['id'] ?>">
                                <textarea name="respuesta" class="form-control textarea-respuesta mb-2"
                                    placeholder="Escribe tu respuesta..." required></textarea>
                                <button type="submit" class="btn btn-primary btn-sm">Enviar Respuesta</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No hay encuestas activas por el momento.</p>
        <?php endif; ?>
    </div>

    <script src="../JS/menu.js"></script>
    <footer>
        <div class="contenedor">
            <p>&copy; 2025 Colegio Hijos de Dios</p>
        </div>
    </footer>
</body>

</html>