<?php

namespace ENTIDADES;

// Header
class RespuestaEncuesta
{
    public $id;
    public $encuesta_id;
    public $alumno_id;
    public $respuesta;

    public function __construct($id = null, $encuesta_id = null, $alumno_id = null, $respuesta = null)
    {
        $this->id = $id;
        $this->encuesta_id = $encuesta_id;
        $this->alumno_id = $alumno_id;
        $this->respuesta = $respuesta;
    }
}
