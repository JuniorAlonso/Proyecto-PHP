<?php
include("../INCLUDES/conexion.php");
session_start();

// Verificar que el admin esté logueado
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Procesar envío de nueva encuesta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['titulo'])) {
    $titulo = $_POST['titulo'];
    mysqli_query($conexion, "INSERT INTO encuestas (titulo) VALUES ('$titulo')");
    header("Location: encuestas.php");
    exit;
}

// Cambiar estado (activar / desactivar)
if (isset($_GET['toggle'])) {
    $id = (int) $_GET['toggle'];
    $encuesta = mysqli_query($conexion, "SELECT estado FROM encuestas WHERE id=$id");
    $row = mysqli_fetch_assoc($encuesta);
    $nuevo_estado = ($row['estado'] == 'activa') ? 'inactiva' : 'activa';
    mysqli_query($conexion, "UPDATE encuestas SET estado='$nuevo_estado' WHERE id=$id");
    header("Location: encuestas.php");
    exit;
}

// Obtener todas las encuestas
$resultado = mysqli_query($conexion, "SELECT * FROM encuestas ORDER BY creado_en DESC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Encuestas | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS -->
    <link rel="stylesheet" href="../CSS/main.css">


</head>

<body>

    <!-- Header -->
    <header>
        <div class="left">
            <div class="brand">
                <h1>PANEL ADMINISTRADOR / COLEGIO <span class="titulo">HIJOS DE DIOS</span></h1>
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

    <div class="container mt-4">
        <h2>Agregar Nueva Encuesta</h2>
        <form method="POST" class="mb-4">
            <textarea name="titulo" class="form-control titulo-ancha" rows="3" placeholder="Título de la encuesta" required></textarea>

            <button type="submit" class="btn btn-primary mt-2">Agregar Encuesta</button>
        </form>



        <h2>Lista de Encuestas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?= $r['id'] ?></td>
                        <td><?= htmlspecialchars($r['titulo']) ?></td>
                        <td>
                            <?php if ($r['estado'] == 'activa'): ?>
                                <span class="badge bg-success">Activa</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactiva</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $r['creado_en'] ?></td>
                        <td>
                            <a href="encuestas.php?toggle=<?= $r['id'] ?>" class="btn btn-sm btn-warning">
                                Cambiar Estado
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="../JS/menu.js"></script>
</body>

</html>