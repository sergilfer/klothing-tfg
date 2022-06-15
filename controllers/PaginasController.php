<?php

namespace Controllers;

use Model\Ropa;
use MVC\Router;
use Model\Marca;
use PHPMailer\PHPMailer\PHPMailer;
use Classes\Email;

class PaginasController
{

    //Pagina principal
    public static function index(Router $router)
    {
        $router->render('paginas/index', []);
    }

    //Pagina sobre nosotros
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }

    //Pagina de la vista detallada de la ropa cuando vas a comprarla
    public static function anuncio(Router $router)
    {
        $id_anuncio = $_GET['id'];
        if (!$id_anuncio) {
            header('Location: /tfg');
        }
        $ropa = Ropa::getById($id_anuncio);
        $ropas = Ropa::selectByTitle($ropa->Titulo);
        $tallas = array_unique(recorre($ropas, "Talla"));
        $router->render('paginas/anuncio', [
            'ropa' => $ropa,
            'tallas' => $tallas,
            'ropas' => $ropas
        ]);
    }

    public static function detalles(Router $router)
    {

        $router->render('paginas/detalles', []);
    }

    //Pagina donde se muestran todas las marcas que disponemos
    public static function marcas(Router $router)

    {
        $marcas = Marca::all();
        $router->render('paginas/marcas', [
            'marcas' => $marcas
        ]);
    }

    //Paginas de seccion de ropa, ya sea para hombre, mujer o ver todas las ropas que tenemos
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

    //Pagina de contacto
    public static function contacto(Router $router)
    {
        $mensaje = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $relleno = $_POST;
            $mail = new Email();
            $mail -> enviarMailContacto($relleno);
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}