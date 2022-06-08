<?php

namespace App;

class ropa
{
    protected static $db;
    protected static $column_db = ['Id', 'Nombre', 'Imagen'];

    protected static $campos_vacios = [];

    public $Id;
    public $Nombre;
    public $Imagen;

    public function __construct($args = [])
    {
        $this->Id = $args['id'] ?? null;
        $this->Nombre = $args['nombre'] ?? '';
        $this->Imagen = $args['imagen'] ?? '';
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function insertar()
    {

        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO marca (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        // Resultado de la consulta
        $resultado = self::$db->query($query);

        return $resultado;
    }

    //Identifica los atributos que tenemos en la db para que sea mas facil acceder a ellos
    // Identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (static::$column_db as $columna) {
            if ($columna === 'Id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //subir imagenes
    public function setImagen($imagen)
    {
        if ($imagen) {
            $this->Imagen = $imagen;
        }
    }
    //Comprobacion de campos vacios

    public static function getVacios()
    {
        return self::$campos_vacios;
    }

    public function validar()
    {
        if (!$this->Nombre) {
            self::$campos_vacios[] = "Debes añadir un Nombre";
        }
        if (!$this->Imagen) {
            self::$campos_vacios[] = "Debes añadir una Imagen";
        }
    }

    public static function all()
    {
        $query = "SELECT * FROM marca";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function consultarSQL($query)
    {
        //Consultar la db
        $resultado = self::$db->query($query);
        //Recorrer todas las opciones
        $array = [];

        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::createObject($registro);
        }

        //Liberar memoria
        $resultado->free();

        //Devolver resultados
        return $array;
    }

    protected static function createObject($registro)
    {
        $objeto = new self;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
}
