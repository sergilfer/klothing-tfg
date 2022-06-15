<?php

namespace Model;

class Usuarios extends ActiveRecord
{
    protected static $tabla = 'usuarios_token';
    protected static $column_db = ['Id', 'Nombre', 'Apellidos', 'Email', 'Telefono', 'Admin', 'Confirmado', 'Token', 'Password'];

    public $Id;
    public $Nombre;
    public $Apellidos;
    public $Email;
    public $Telefono;
    public $Admin;
    public $Confirmado;
    public $Token;
    public $Password;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? '';
        $this->Apellidos = $args['Apellidos'] ?? '';
        $this->Email = $args['Email'] ?? '';
        $this->Telefono = $args['Telefono'] ?? '';
        $this->Admin = $args['Admin'] ?? '0';
        $this->Confirmado = $args['Confirmado'] ?? '0';
        $this->Token = $args['Token'] ?? '';
        $this->Password = $args['Password'] ?? '';
    }

    public function validar()
    {
        if (!$this->Nombre) {
            self::$campos_vacios[] = "Debes añadir un Nombre";
        }
        if (!$this->Apellidos) {
            self::$campos_vacios[] = "Debes añadir un Apellido";
        }
        if (!$this->Telefono) {
            self::$campos_vacios[] = "Debes añadir un Telefono";
        }

        if (!$this->Password) {
            self::$campos_vacios[] = "Debes añadir una Contraseña";
        }

        if (strlen($this->Password) < 6) {
            self::$campos_vacios[] = "El password debe tener al menos 6 caracteres";
        }
        return self::$campos_vacios;
    }

    public function validarLogin()
    {
        if (!$this->Email) {
            self::$campos_vacios[] = "Debes añadir un Email";
        }
        if (!$this->Password) {
            self::$campos_vacios[] = "Debes añadir una Contraseña";
        }
        return self::$campos_vacios;
    }

    public function validarEmail()
    {
        if (!$this->Email) {
            self::$campos_vacios[] = 'El email es Obligatorio';
        }
        return self::$campos_vacios;
    }

    public function validarPassword()
    {
        if (!$this->Password) {
            self::$campos_vacios[] = 'El Password es obligatorio';
        }

        if (strlen($this->Password) < 6) {
            self::$campos_vacios[] = 'El Password debe tener al menos 6 caracteres';
        }
        return self::$campos_vacios;
    }

    public function existeUsuario()
    {
        // Revisar si el usuario existe.
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->Email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            self::$campos_vacios[] = 'El Usuario ya esta registrado';
        }
        return $resultado;
    }

    public function hashPassword()
    {
        $this->Password = password_hash($this->Password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        $this->Token = uniqid();
    }

    public function comprobarPassword($password)
    {
        $resultado = password_verify($password,  $this->Password);
        if (!$resultado || !$this->Confirmado) {
            self::$campos_vacios[] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
        } else {
            return true;
        }
    }
}
