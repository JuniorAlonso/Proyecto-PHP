<?php
include("../INCLUDES/sesion.php");
include("../INCLUDES/conexion.php");

if ($_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Consultas
$totalAlumnos = mysqli_fetch_row(
    mysqli_query($conexion, "SELECT COUNT(*) FROM alumnos")
)[0];

$reclamosPendientes = mysqli_fetch_row(
    mysqli_query($conexion, "SELECT COUNT(*) FROM reclamos WHERE estado = 'pendiente'")
)[0];

$encuestasActivas = mysqli_fetch_row(
    mysqli_query($conexion, "SELECT COUNT(*) FROM encuestas WHERE estado = 'activa'")
)[0];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <!-- Menu hamburguesa -->
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
                        <a href="inicio.php" class="active">
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
                        <a href="encuestas.php">
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

    <section class="main-content">
        <div class="container">
            <section class="contenido">
                <h2>Bienvenido, <strong><?php echo $_SESSION['usuario']; ?></strong></h2>
                <p>
                    Desde este panel podrás administrar los usuarios del sistema,
                    registrar y consultar alumnos, revisar reclamos y gestionar encuestas
                    de la institución educativa.
                </p>
            </section>

            <div class="cards">
                <!-- Cards resumen -->
                <div class="admin-card resumen-card">
                    <i class="fa-solid fa-users"></i>
                    <h3><?php echo $totalAlumnos; ?></h3>
                    <span>Alumnos registrados</span>
                </div>

                <div class="admin-card resumen-card">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <h3><?php echo $reclamosPendientes; ?></h3>
                    <span>Reclamos pendientes</span>
                </div>

                <div class="admin-card resumen-card">
                    <i class="fa-solid fa-chart-simple"></i>
                    <h3><?php echo $encuestasActivas; ?></h3>
                    <span>Encuestas activas</span>
                </div>

                <!-- Card avisos -->
                <div class="admin-card avisos-card">
                    <h3>Avisos del sistema</h3>
                    <ul>
                        <li>Revisa los reclamos pendientes.</li>
                        <li>Verifica encuestas activas antes de cerrarlas.</li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="../JS/menu.js"></script>
    </section>

    <footer>
        <div class="contenedor">
            <p>&copy; 2025 Colegio Hijos de Dios</p>
        </div>
    </footer>
</body>

</html>