<?php
include("../includes/sesion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Hijos de Dios</title>
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
                        <a href="#" class="active" title="Inicio">
                            <i class="fa-solid fa-house"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="asistencia.php" title="Lista">
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
    <section class="main-content">
        <div class="container">
            <section class="contenido">
                <h2>Bienvenido, <strong><?php echo $_SESSION['usuario']; ?></strong></h2>
                <p>Desde este portal podrás revisar tu asistencia, realizar reservas, enviar reclamos o sugerencias y
                    participar en encuestas.<br>Revisa el menú lateral para acceder a cada opción.</br>
            </section>
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