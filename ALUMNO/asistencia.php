<?php
include("../INCLUDES/conexion.php");
session_start();

// Verificar que el alumno esté logueado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'alumno') {
    header("Location: ../login.php");
    exit;
}

$alumno_id = $_SESSION['id'];

// Obtener asistencia del alumno
$sql = "SELECT fecha, estado, hora_registro 
        FROM asistencia 
        WHERE alumno_id = $alumno_id
        ORDER BY fecha DESC";

$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Asistencia | Alumno</title>
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
                        <a href="asistencia.php" class="active">
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

    <h1 class="text-center mt-3">Asistencia del Alumno</h1>

    <div class="container mt-4 asistencia-container">
        <div class="card">
            <div class="card-body">

                <table class="table table-bordered table-hover text-center tabla-asistencia">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($resultado) > 0): ?>
                            <?php while ($a = mysqli_fetch_assoc($resultado)): ?>
                                <tr>
                                    <td><?= $a['fecha'] ?></td>
                                    <td>
                                        <?php if ($a['estado'] == 'Presente'): ?>
                                            <span class="badge bg-success">Presente</span>
                                        <?php elseif ($a['estado'] == 'Tarde'): ?>
                                            <span class="badge bg-warning text-dark">Tarde</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Falta</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $a['hora_registro'] ?? '-' ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No hay registros de asistencia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="../JS/menu.js"></script>
    <footer>
        <div class="contenedor">
            <p>&copy; 2025 Colegio Hijos de Dios</p>
        </div>
    </footer>

</body>

</html>