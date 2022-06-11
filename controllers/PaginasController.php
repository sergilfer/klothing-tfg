<?php

namespace Controllers;

use MVC\Router;
use Model\Ropa;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{

    public static function index(Router $router)
    {
        $router->render('paginas/index', []);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }

    public static function anuncios(Router $router)
    {

        $propiedades = Ropa::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function detalles(Router $router)
    {

        // Obtener los datos de la propiedad

        $router->render('paginas/propiedad', [
    
        ]);
    }

    public static function marcas(Router $router)
    {

        $router->render('paginas/blog');
    }

    public static function seccion(Router $router)
    {
        $router->render('paginas/entrada');
    }
}
