<?php
$servidor = "colegio.mysql.database.azure.com"; 
$usuario = "junior"; 
$contrasena = "junior1234."; // tu contraseña real
$db = "colegio";
$puerto = 3306;

// Inicializar MySQLi
$conexion = mysqli_init();

// Configurar SSL obligatorio
mysqli_ssl_set($conexion, NULL, NULL, NULL, NULL, NULL);

// Conectar
$resultado = mysqli_real_connect(
    $conexion, 
    $servidor, 
    $usuario, 
    $contrasena, 
    $db, 
    $puerto, 
    NULL, 
    MYSQLI_CLIENT_SSL
);

if (!$resultado) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
