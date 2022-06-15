<?php

namespace Model;

class Ropa extends ActiveRecord
{

    protected static $tabla = 'tiendaropa';
    protected static $column_db = ['Id', 'Genero', 'Talla', 'Color', 'Tipo', 'Marca', 'Stock', 'Descripcion', 'Imagen', 'Precio', 'Titulo'];

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
        $this->Id = $args['Id'] ?? null;
        $this->Genero = $args['Genero'] ?? '';
        $this->Talla = $args['Talla'] ?? '';
        $this->Color = $args['Color'] ?? '';
        $this->Tipo = $args['Tipo'] ?? '';
        $this->Marca = $args['Marca'] ?? '';
        $this->Stock = $args['Stock'] ?? '';
        $this->Descripcion = $args['Descripcion'] ?? '';
        $this->Imagen = $args['Imagen'] ?? '';
        $this->Precio = $args['Precio'] ?? '';
        $this->Titulo = $args['Titulo'] ?? '';
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
}
