<?php

namespace Model;

class ActiveRecord
{

    //Bases de datos
    protected static $db;

    //Variables que las otras clases van a heredar
    protected static $tabla = '';
    protected static $column_db = [];
    protected static $campos_vacios = [];

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function getVacios()
    {
        return static::$campos_vacios;
    }

    public static function setVacios($mensaje)
    {
        static::$campos_vacios[] = $mensaje;
    }

    public function validar()
    {
        static::$campos_vacios = [];
        return static::$campos_vacios;
    }

    public function guardar()
    {
        if (!is_null($this->Id)) {
            //en este caso al tener id estoy actualizando
           $resultado =  $this->actualizar();
           return $resultado;
        } else {
            //en este caso estaria insertando un nuevo registro
            $resultado = $this->insertar();
            return $resultado;
        }
    }

    public function insertar()
    {

        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";


        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return $resultado;
    }


    public function actualizar()
    {
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->Id) . "' ";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    //eliminar registro de la base de datos
    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->Id) . " LIMIT 1";
        $resultado = self::$db->query($query);


        if ($resultado) {
            $this->borrarImagen();
            header('Location: ../admin?codeURL=3');
        }
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
        // Elimina la imagen previa
        if (!is_null($this->Id)) {
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->Imagen = $imagen;
        }
    }

    //borrar imagenes
    public function borrarImagen()
    {
        //Comprobar si existe la imagen
        $existe = file_exists(IMAGENES_SUBIDAS . $this->Imagen);
        if ($existe) {
            unlink(IMAGENES_SUBIDAS . $this->Imagen);
        }
    }


    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function selectColumn($column)
    {
        $query = "SELECT DISTINCT " . "${column}" . " FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        return $resultado;
    }

    //Este metodo lo usare para que me devuelva por distincion de genero y en el caso de que tengan el mismo titulo, que no me los repita para no mostrar resultados repetidos
    public static function selectByGender($genero)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE Genero = " . "'${genero}'" . "GROUP BY Titulo";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Este metodo lo usare para obtener todas las tallas de un titulo, es decir si X ropa tiene 2 tallas obtener los dos resultados
    public static function selectByTitle($titulo)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE Titulo = " . "'${titulo}'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //buscar la ropa por el id 
    public static function getById($id)
    {
        $consulta_id = "SELECT * FROM " . static::$tabla . " WHERE Id = ${id}";
        $resultado = self::consultarSQL($consulta_id);
        return array_shift($resultado);
    }

    public static function where($columna, $valor)
    {
        $consulta_id = "SELECT * FROM " . static::$tabla . " WHERE ${columna} = '${valor}'";
        $resultado = self::consultarSQL($consulta_id);
        return array_shift($resultado);
    }


    public static function consultarSQL($query)
    {
        //Consultar la db
        $resultado = self::$db->query($query);

        //Recorrer todas las opciones
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::createObject($registro);
        }

        //Liberar memoria
        $resultado->free();

        //Devolver resultados
        return $array;
    }
    public function sincronize($arg = [])
    {
        foreach ($arg as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    protected static function createObject($registro)
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    public function registrarUsuario()
    {
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        // Resultado de la consulta
        $resultado = self::$db->query($query);
    }
}
