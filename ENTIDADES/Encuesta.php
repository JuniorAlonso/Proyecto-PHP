<?php

namespace ENTIDADES;

// Header
class Encuesta
{
    public $id;
    public $pregunta;

    public function __construct($id = null, $pregunta = null)
    {
        $this->id = $id;
        $this->pregunta = $pregunta;
    }
}
