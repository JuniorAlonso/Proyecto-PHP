<?php

namespace ENTIDADES;
// Header
class Asistencia
{
    public $id;
    public $alumno_id;
    public $fecha;
    public $estado; // 'Asistió', 'Faltó', 'Tardanza'

    public function __construct($id = null, $alumno_id = null, $fecha = null, $estado = null)
    {
        $this->id = $id;
        $this->alumno_id = $alumno_id;
        $this->fecha = $fecha;
        $this->estado = $estado;
    }
}
