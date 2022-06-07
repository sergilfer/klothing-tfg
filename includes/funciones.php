<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('IMAGENES_SUBIDAS', __DIR__ . '../imagenes_subidas/');

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

function cleanCode($html) : string{
    $code = htmlspecialchars($html);
    return $code;
}
