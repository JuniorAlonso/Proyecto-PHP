<?php

namespace ENTIDADES;

// Header
class Reserva
{
    public $id;
    public $alumno_id;
    public $tipo;
    public $fecha;
    public $estado; // 'Pendiente', 'Aprobado', 'Cancelado'

    public function __construct($id = null, $alumno_id = null, $tipo = null, $fecha = null, $estado = 'Pendiente')
    {
        $this->id = $id;
        $this->alumno_id = $alumno_id;
        $this->tipo = $tipo;
        $this->fecha = $fecha;
        $this->estado = $estado;
    }
}
