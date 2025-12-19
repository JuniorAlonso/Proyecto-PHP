<?php

namespace ENTIDADES;

// Header
class Reclamo
{
    public $id;
    public $alumno_id;
    public $descripcion;
    public $estado; // 'Pendiente', 'Atendido'
    public $fecha;

    public function __construct($id = null, $alumno_id = null, $descripcion = null, $estado = 'Pendiente', $fecha = null)
    {
        $this->id = $id;
        $this->alumno_id = $alumno_id;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->fecha = $fecha;
    }
}
