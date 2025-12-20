<?php
session_start();
include("../INCLUDES/conexion.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Consulta de usuarios
$sql = "SELECT id, usuario, rol, estado, creado_en FROM usuarios";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Usuarios | Panel Admin</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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
                        <a href="usuarios.php" class="active">
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

    <div class="container mt-4">
        <h2 class="mb-4">
            <i class="fa-solid fa-users"></i> Gestión de Usuarios
        </h2>

        <!-- Botón nuevo usuario -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalUsuario">
            <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
        </button>

        <!-- Tabla usuarios -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Creado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1; // Inicializamos el contador
                        while ($u = mysqli_fetch_assoc($resultado)) {
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $u['usuario'] ?></td>
                                <td>
                                    <?php
                                    $color = '';
                                    if ($u['rol'] == 'admin')
                                        $color = 'bg-danger';
                                    elseif ($u['rol'] == 'docente')
                                        $color = 'bg-warning';
                                    elseif ($u['rol'] == 'alumno')
                                        $color = 'bg-info';
                                    ?>
                                    <span class="badge <?= $color ?>"><?= $u['rol'] ?></span>
                                </td>
                                <td>
                                    <span class="badge <?= ($u['estado'] == 'activo') ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= ucfirst($u['estado']) ?>
                                    </span>
                                </td>
                                <td><?= $u['creado_en'] ?></td>
                                <td>
                                    <a href="eliminar_usuario.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalUsuario" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="guardar_usuario.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Usuario</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Correo</label>
                        <input type="text" name="correo" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Estado</label>
                        <select name="estado" class="form-select">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Rol</label>
                        <select name="rol" class="form-select">
                            <option value="admin">Admin</option>
                            <option value="docente">Docente</option>
                            <option value="alumno">Alumno</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../JS/menu.js"></script>

    <footer>
        <div class="contenedor">
            <p>&copy; 2025 Colegio Hijos de Dios</p>
        </div>
    </footer>
</body>

</html>