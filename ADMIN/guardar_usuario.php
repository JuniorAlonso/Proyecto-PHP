<?php
session_start();
include("../INCLUDES/conexion.php");

// Solo el admin puede guardar usuarios
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

// Recibir datos del formulario
$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar contraseña
$estado = $_POST['estado'];
$rol = $_POST['rol'];

// Insertar en la tabla usuarios
$sql = "INSERT INTO usuarios (usuario, correo, password, estado, rol, creado_en)
        VALUES ('$usuario', '$correo', '$password', '$estado', '$rol', NOW())";

if (mysqli_query($conexion, $sql)) {
    // Redirigir de vuelta a usuarios.php
    header("Location: usuarios.php");
    exit;
} else {
    echo "Error al guardar el usuario: " . mysqli_error($conexion);
}
?>
