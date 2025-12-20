<?php
include("../INCLUDES/conexion.php");

if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; 

    $sql = "DELETE FROM usuarios WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        header("Location: usuarios.php?msg=eliminado");
        exit();
    } else {
        echo "Error al eliminar: " . mysqli_error($conexion);
    }
} else {
    header("Location: usuarios.php");
    exit();
}
?>