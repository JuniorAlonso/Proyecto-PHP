<?php
$servidor = "colegio.mysql.database.azure.com"; 
$usuario = "junior@colegio"; 
$contrasena = "junior1234."; // Pon aquí la clave que creaste
$db = "colegio";

// Inicializar MySQLi
$conexion = mysqli_init();

// Azure requiere conexiones cifradas por defecto. 
// Si da error de certificado, asegúrate de haber configurado el Firewall en Azure.
$resultado = mysqli_real_connect(
    $conexion, 
    $servidor, 
    $usuario, 
    $contrasena, 
    $db, 
    3306, 
    NULL, 
    MYSQLI_CLIENT_SSL
);

if (!$resultado) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    echo "¡Conexión exitosa a Azure MySQL!";
}
?>