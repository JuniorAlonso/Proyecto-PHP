<?php
include("../INCLUDES/conexion.php");
session_start();

// Verificar que el alumno esté logueado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    header("Location: ../login.php");
    exit;
}

$alumno_id = $_SESSION['id'];

// Procesar envío de reclamo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['descripcion'])) {
    $descripcion = $_POST['descripcion'];

    $stmt = $conexion->prepare("INSERT INTO reclamos (alumno_id, descripcion) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("is", $alumno_id, $descripcion);
        $stmt->execute();
        $stmt->close();
        header("Location: reclamos.php");
        exit;
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
}

// Obtener los reclamos del alumno
$stmt = $conexion->prepare("SELECT id, descripcion, estado, creado_en FROM reclamos WHERE alumno_id=? ORDER BY creado_en DESC");
if ($stmt) {
    $stmt->bind_param("i", $alumno_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    die("Error al preparar la consulta: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Reclamos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
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
                        <a href="inicio.php" >
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
                        <a href="reclamos.php" class="active" >
                            <i class="fa-solid fa-hand-holding-heart"></i>
                            <span>Reclamos</span>
                        </a>
                    </li>
                    <li>
                        <a href="encuestas.php">
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

    <!-- Contenido principal -->
    <div class="container mt-5">
        <h2>Enviar un reclamo</h2>
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <textarea name="descripcion" class="form-control" rows="3" placeholder="Escribe tu reclamo aquí..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <h2>Mis reclamos</h2>
        <?php if ($resultado && $resultado->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $r['id'] ?></td>
                        <td><?= htmlspecialchars($r['descripcion']) ?></td>
                        <td>
                            <?php if ($r['estado'] == 'pendiente'): ?>
                                <span class="badge bg-warning">Pendiente</span>
                            <?php else: ?>
                                <span class="badge bg-success">Resuelto</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $r['creado_en'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No tienes reclamos registrados.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/menu.js"></script>
</body>
</html>
