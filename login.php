<?php
session_start();
include("INCLUDES/conexion.php");

$input = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Consulta: buscar por usuario o correo y solo activos
$sql = "SELECT * FROM usuarios 
        WHERE (usuario = '$input' OR correo = '$input')
        AND estado = 'activo'
        LIMIT 1";

$resultado = mysqli_query($conexion, $sql);

if ($resultado && mysqli_num_rows($resultado) === 1) {

    $usuario = mysqli_fetch_assoc($resultado);

    // ✅ Verificar contraseña usando la columna 'password'
    if (password_verify($contrasena, $usuario['password'])) {

        // Guardar datos en sesión
        $_SESSION['usuario'] = $usuario['usuario'];
        $_SESSION['rol'] = $usuario['rol'];

        // Redireccionar según rol
        if ($usuario['rol'] === 'admin') {
            header("Location: ADMIN/inicio.php");
        } elseif ($usuario['rol'] === 'alumno') {
            header("Location: ALUMNO/inicio.php");
        } elseif ($usuario['rol'] === 'docente') {
            header("Location: DOCENTE/inicio.php");
        }
        exit;
    }
}

// ❌ Error de login
header("Location: index.php?error=1");
exit;
?>
