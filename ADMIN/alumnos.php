<?php
include("../INCLUDES/conexion.php");

// Consultar alumnos y sus datos académicos
$sql = "SELECT u.id, u.usuario, u.correo, a.grado, a.seccion
        FROM usuarios u
        LEFT JOIN alumnos a ON u.id = a.id_usuario
        WHERE u.rol = 'alumno'
        ORDER BY u.usuario ASC"; // opcional, orden por nombre
$resultado = mysqli_query($conexion, $sql) or die("Error en la consulta: " . mysqli_error($conexion));
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Alumnos | Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a href="alumnos.php" class="active">
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

    <!-- Contenido principal -->
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Alumnos</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Grado</th>
                    <th>Sección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($a = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?= $a['id'] ?></td>
                        <td><?= htmlspecialchars($a['usuario']) ?></td>
                        <td><?= htmlspecialchars($a['correo']) ?></td>
                        <td><?= $a['grado'] ?: '-' ?></td>
                        <td><?= $a['seccion'] ?: '-' ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalEditarAlumno"
                                onclick="editarAlumno(<?= $a['id'] ?>, '<?= $a['grado'] ?>', '<?= $a['seccion'] ?>')">
                                <i class="fa-solid fa-pen"></i> Editar
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para editar grado y sección -->
    <div class="modal fade" id="modalEditarAlumno" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="guardar_alumno.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Grado / Sección</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="alumno_id" id="alumno_id">
                    <div class="mb-3">
                        <label>Grado</label>
                        <select name="grado" id="grado" class="form-select" required>
                            <option value="">Seleccionar grado</option>
                            <option value="3ro">3ro</option>
                            <option value="4to">4to</option>
                            <option value="5to">5to</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Sección</label>
                        <select name="seccion" id="seccion" class="form-select" required>
                            <option value="">Seleccionar sección</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editarAlumno(id, grado, seccion) {
            document.getElementById('alumno_id').value = id;
            document.getElementById('grado').value = grado || '';
            document.getElementById('seccion').value = seccion || '';
        }
    </script>
    <script src="../JS/menu.js"></script>

    <footer>
        <div class="contenedor">
            <p>&copy; 2025 Colegio Hijos de Dios</p>
        </div>
    </footer>
</body>

</html>