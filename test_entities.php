<?php

// Header
require_once 'ENTIDADES/Usuario.php';
require_once 'ENTIDADES/Alumno.php';
require_once 'ENTIDADES/Asistencia.php';
require_once 'ENTIDADES/Reclamo.php';
require_once 'ENTIDADES/Reserva.php';
require_once 'ENTIDADES/Encuesta.php';
require_once 'ENTIDADES/RespuestaEncuesta.php';

use ENTIDADES\Usuario;
use ENTIDADES\Alumno;
use ENTIDADES\Asistencia;
use ENTIDADES\Reclamo;
use ENTIDADES\Reserva;
use ENTIDADES\Encuesta;
use ENTIDADES\RespuestaEncuesta;

try {
    $usuario = new Usuario(1, 'testuser', 'test@mail.com', 'pass', 'admin');
    $alumno = new Alumno(1, 1, '5to', 'A');
    $asistencia = new Asistencia(1, 1, '2023-10-27', 'Asistió');
    $reclamo = new Reclamo(1, 1, 'Test reclamo');
    $reserva = new Reserva(1, 1, 'Libro', '2023-10-27');
    $encuesta = new Encuesta(1, 'Pregunta 1');
    $respuesta = new RespuestaEncuesta(1, 1, 1, 'Respuesta 1');

    echo "All entities instantiated successfully.\n";
    echo "Usuario: " . $usuario->usuario . "\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
