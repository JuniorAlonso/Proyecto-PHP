<?php
include("../INCLUDES/conexion.php");

$alumno_id = (int)$_POST['alumno_id']; // forzar a entero por seguridad
$grado = $_POST['grado'];
$seccion = $_POST['seccion'];

// Actualizar directamente el registro del alumno
$sql = "UPDATE alumnos 
        SET grado='$grado', seccion='$seccion' 
        WHERE id_usuario=$alumno_id";

if (!mysqli_query($conexion, $sql)) {
    die("Error al guardar: " . mysqli_error($conexion));
}

// Redirigir a la página de alumnos
header("Location: alumnos.php");
exit;
?>
