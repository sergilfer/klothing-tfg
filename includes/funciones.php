<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('IMAGENES_SUBIDAS', $_SERVER['DOCUMENT_ROOT'] . '/imagenes_subidas/');

function incluirTemplates(string $nombre)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function isLogged()
{
    session_start();
    if (!$_SESSION['logueado']) {
        header('Location: /klothing-tfg/index.php');
    }
}

function debug($arg)
{
    echo "<pre>";
    var_dump($arg);
    echo "</pre>";
    exit;
}

function cleanCode($html): string
{
    $code = htmlspecialchars($html);
    return $code;
}

function recorre($objetos, $consulta)
{
    $row = [];
    foreach ($objetos as $objeto) {
        $row[] = $objeto->$consulta;
    }
    return $row;
}

function validarTipo($tipo)
{
    $tipos = ['ropa', 'marca'];
    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = "Creado correctamente";
            break;
        case 2:
            $mensaje = "Actualizado correctamente";
            break;
        case 3:
            $mensaje = "Borrado correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function mostrarGenero($genero)
{
    $titulo = 'Ver todos';
    if ($genero === "Hombre") {
        $titulo = "Seccion Hombre";
    } else if ($genero === "Mujer") {
        $titulo = "Seccion Mujer";
    }
    return $titulo;
}

function validarId(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header("Location: ${url}");
    }
    return $id;
}

function nombreRandom(){
    $nombres = [1 =>'Tommy', 2=> 'Vans',3 =>'Nike'];
    $numero = rand(1,3);
    echo $nombres[$numero];
}