<?php

namespace App;

class ropa
{
    protected static $db;
    protected static $column_db = ['Id', 'Genero', 'Talla', 'Color', 'Tipo', 'Marca', 'Stock', 'Descripcion', 'Imagen', 'Precio', 'Titulo'];

    protected static $campos_vacios = [];

    public $Id;
    public $Genero;
    public $Talla;
    public $Color;
    public $Tipo;
    public $Marca;
    public $Stock;
    public $Descripcion;
    public $Imagen;
    public $Precio;
    public $Titulo;

    public function __construct($args = [])
    {
        $this->Id = $args['id'] ?? null;
        $this->Genero = $args['genero'] ?? '';
        $this->Talla = $args['talla'] ?? '';
        $this->Color = $args['color'] ?? '';
        $this->Tipo = $args['tipo'] ?? '';
        $this->Marca = $args['marca'] ?? '';
        $this->Stock = $args['stock'] ?? '';
        $this->Descripcion = $args['descripcion'] ?? '';
        $this->Imagen = $args['imagen'] ?? '';
        $this->Precio = $args['precio'] ?? '';
        $this->Titulo = $args['titulo'] ?? '';
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function insertar()
    {

        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO tiendaropa (";
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
        if (!$this->Genero) {
            self::$campos_vacios[] = "Debes añadir un Genero";
        }
        if (!$this->Titulo) {
            self::$campos_vacios[] = "Debes añadir un titulo";
        }
        if (!$this->Marca) {
            self::$campos_vacios[] = "Debes seleccionar una marca";
        }
        if (!$this->Precio) {
            self::$campos_vacios[] = "Debes añadir un precio";
        }
        if (!$this->Descripcion) {
            self::$campos_vacios[] = "La descripcion es un campo obligatorio que debe constar de más de 50 caracteres";
        }
        if (!$this->Talla) {
            self::$campos_vacios[] = "Debes seleccionar una talla";
        }
        if (!$this->Color) {
            self::$campos_vacios[] = "Debes añadir un modelo";
        }
        if (!$this->Tipo) {
            self::$campos_vacios[] = "Debes seleccionar un tipo de ropa";
        }
        if (!$this->Stock) {
            self::$campos_vacios[] = "Debe introducir un stock";
        }
        if (!$this->Imagen) {
            self::$campos_vacios[] = "Debe introducir una Imagen";
        }
        return self::$campos_vacios;
    }

    //listar todaas las propiedades 

    public static function all()
    {
        $query = "SELECT * FROM tiendaropa";
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
