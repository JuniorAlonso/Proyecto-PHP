<?php

namespace ENTIDADES;

// Header
class Alumno
{
    public $id;
    public $usuario_id;
    public $grado;
    public $seccion;

    public function __construct($id = null, $usuario_id = null, $grado = null, $seccion = null)
    {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->grado = $grado;
        $this->seccion = $seccion;
    }
}
