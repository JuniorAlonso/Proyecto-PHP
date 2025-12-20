<?php
include("../INCLUDES/conexion.php");

if (isset($_POST['alumno_id']) && isset($_POST['grado']) && isset($_POST['seccion'])) {
    
    $alumno_id = (int)$_POST['alumno_id']; 
    $grado = mysqli_real_escape_index($conexion, $_POST['grado']);
    $seccion = mysqli_real_escape_index($conexion, $_POST['seccion']);

    $sql = "INSERT INTO alumnos (id_usuario, grado, seccion) 
            VALUES ($alumno_id, '$grado', '$seccion')
            ON DUPLICATE KEY UPDATE grado = '$grado', seccion = '$seccion'";

    if (mysqli_query($conexion, $sql)) {
        header("Location: alumnos.php?status=success");
        exit;
    } else {
        die("Error al procesar: " . mysqli_error($conexion));
    }
} else {
    header("Location: alumnos.php");
    exit;
}

function mysqli_real_escape_index($con, $data) {
    return mysqli_real_escape_string($con, $data);
}
?>