<?php

namespace Controllers;

use MVC\Router;
use Model\Ropa;
use Model\Marca;
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

    public static function anuncio(Router $router)
    {
        $id_anuncio = $_GET['id'];

        if (!$id_anuncio) {
            header('Location: /tfg');
        }

        $ropa = Ropa::getById($id_anuncio);

        $ropas = Ropa::selectByTitle($ropa->Titulo);
        $tallas = array_unique(recorre($ropas, "Talla"));
        $router->render('paginas/anuncio',[
            'ropa' => $ropa,
            'tallas' => $tallas,
            'ropas' => $ropas
        ]);
    }

    public static function detalles(Router $router)
    {

        // Obtener los datos de la propiedad

        $router->render('paginas/detalles', []);
    }

    public static function marcas(Router $router)

    {
        $marcas = Marca::all();
        $router->render('paginas/marcas', [
            'marcas' => $marcas
        ]);
    }

    public static function seccion(Router $router)
    {
        $genero = $_GET['genero'] ?? null;
        if (!$genero) {
            $ropas = Ropa::all();
        } else {
            $ropas = Ropa::selectByGender($genero);
        }
        $router->render('paginas/seccion', [
            'ropas' => $ropas,
            'genero' => $genero
        ]);
    }
}
