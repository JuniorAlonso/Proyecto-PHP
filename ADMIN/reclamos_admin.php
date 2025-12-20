<?php
include("../INCLUDES/conexion.php");
session_start();

// Verificar que el admin esté logueado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Cambiar estado del reclamo si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reclamo_id'], $_POST['estado'])) {
    $reclamo_id = $_POST['reclamo_id'];
    $estado = $_POST['estado'];

    $stmt = $conexion->prepare("UPDATE reclamos SET estado=? WHERE id=?");
    if ($stmt) {
        $stmt->bind_param("si", $estado, $reclamo_id);
        $stmt->execute();
        $stmt->close();
        header("Location: reclamos_admin.php");
        exit;
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
}

// Obtener todos los reclamos junto con el nombre del alumno
$sql = "SELECT r.id, r.descripcion, r.estado, r.creado_en, u.usuario
        FROM reclamos r
        INNER JOIN usuarios u ON r.alumno_id = u.id
        ORDER BY r.creado_en DESC";

$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reclamos - Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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
                        <a href="reclamos_admin.php" class="active">
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
                        <a href="../salir.php"><i class="fa-solid fa-right-from-bracket"></i>
                        <span>Cerrar sesión</span>
                            </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <!-- Contenido principal -->
    <div class="container mt-5">
        <h2>Todos los reclamos</h2>
        <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Alumno</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= htmlspecialchars($r['usuario']) ?></td>
                            <td><?= htmlspecialchars($r['descripcion']) ?></td>
                            <td>
                                <?php if ($r['estado'] == 'pendiente'): ?>
                                    <span class="badge bg-warning">Pendiente</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Resuelto</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $r['creado_en'] ?></td>
                            <td>
                                <?php if ($r['estado'] == 'pendiente'): ?>
                                    <form method="POST" style="display:inline">
                                        <input type="hidden" name="reclamo_id" value="<?= $r['id'] ?>">
                                        <input type="hidden" name="estado" value="resuelto">
                                        <button type="submit" class="btn btn-sm btn-success">Marcar como resuelto</button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-secondary" disabled>Resuelto</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay reclamos registrados.</p>
        <?php endif; ?>
    </div>

    <script src="../JS/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <footer>
        <div class="contenedor">
            <p>&copy; 2025 Colegio Hijos de Dios</p>
        </div>
    </footer>
</body>

</html>