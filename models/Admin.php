<?php

namespace Model;

class Admin extends ActiveRecord {
   
    // Base DE DATOS
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['Id', 'Email', 'Password'];

    public $Id;
    public $Email;
    public $Password;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Email = $args['Email'] ?? '';
        $this->Password = $args['Password'] ?? '';
    }

    public function validar() {
        if(!$this->Email) {
            self::$campos_vacios[] = "El Email del usuario es obligatorio";
        }
        if(!$this->Password) {
            self::$campos_vacios[] = "El Password del usuario es obligatorio";
        }
        return self::$campos_vacios;
    }
}