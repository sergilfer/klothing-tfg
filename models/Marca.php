<?php

namespace Model;

class Marca extends ActiveRecord
{

    protected static $tabla = 'marca';
    protected static $column_db = ['Id', 'Nombre', 'Imagen'];

    public $Id;
    public $Nombre;
    public $Imagen;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? '';
        $this->Imagen = $args['Imagen'] ?? '';
    }

    public function validar()
    {
        if (!$this->Nombre) {
            self::$campos_vacios[] = "Debe añadir un nombre";
        }
        if (!$this->Imagen) {
            self::$campos_vacios[] = "Debe añadir una imagen";
        }
        return self::$campos_vacios;
    }
}
