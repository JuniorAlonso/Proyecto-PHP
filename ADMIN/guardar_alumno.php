<?php
include("../INCLUDES/conexion.php");

// Verificamos que los datos existan para evitar errores de "undefined index"
if (isset($_POST['alumno_id']) && isset($_POST['grado']) && isset($_POST['seccion'])) {
    
    $alumno_id = (int)$_POST['alumno_id']; 
    $grado = mysqli_real_escape_index($conexion, $_POST['grado']);
    $seccion = mysqli_real_escape_index($conexion, $_POST['seccion']);

    /* Explicación de la consulta:
       1. Intenta insertar el id_usuario, grado y seccion.
       2. Si el id_usuario ya existe (porque es PRIMARY KEY o UNIQUE), 
          ejecuta la parte de UPDATE en su lugar.
    */
    $sql = "INSERT INTO alumnos (id_usuario, grado, seccion) 
            VALUES ($alumno_id, '$grado', '$seccion')
            ON DUPLICATE KEY UPDATE grado = '$grado', seccion = '$seccion'";

    if (mysqli_query($conexion, $sql)) {
        // Redirigir con éxito
        header("Location: alumnos.php?status=success");
        exit;
    } else {
        die("Error al procesar: " . mysqli_error($conexion));
    }
} else {
    header("Location: alumnos.php");
    exit;
}

// Función auxiliar para limpiar strings (opcional pero recomendada)
function mysqli_real_escape_index($con, $data) {
    return mysqli_real_escape_string($con, $data);
}
?>