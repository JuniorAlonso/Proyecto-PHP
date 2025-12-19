<?php

namespace ENTIDADES;

// Header
class Usuario
{
    public $id;
    public $usuario;
    public $correo;
    public $password;
    public $rol; // 'admin', 'docente', 'alumno'
    public $estado; // 'activo', 'inactivo'
    public $creado_en;

    public function __construct($id = null, $usuario = null, $correo = null, $password = null, $rol = null, $estado = 'activo', $creado_en = null)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->correo = $correo;
        $this->password = $password;
        $this->rol = $rol;
        $this->estado = $estado;
        $this->creado_en = $creado_en;
    }
}
