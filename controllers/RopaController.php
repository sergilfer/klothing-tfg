<?php

namespace Controllers;

use MVC\Router;
use Model\Marca;
use Model\Ropa;
use Intervention\Image\ImageManagerStatic as Image;

class RopaController
{

    public static function index(Router $router)
    {
        $ropas = Ropa::all();
        $marcas = Marca::all();
        $codeURL = $_GET['codeURL'] ?? null;

        $router->render('ropa/index', [
            'ropas' => $ropas,
            'marcas' => $marcas,
            'codeURL' => $codeURL
        ]);
    }

    public static function crear(Router $router)
    {
        $ropa = new Ropa();
        $ropas = Ropa::all();
        $marcas = Marca::all();
        $tallas = array_unique(recorre($ropas, "Talla"));
        $generos = array_unique(recorre($ropas, "Genero"));
        $campos_vacios = Ropa::getVacios();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ropa = new Ropa($_POST);
            $nombre = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['Imagen']['tmp_name']) {
                $image = Image::make($_FILES['Imagen']['tmp_name'])->fit(800, 600);
                $ropa->setImagen($nombre);
            }
            $campos_vacios = $ropa->validar();
            //validar que todos los campos estan completados
            if (empty($campos_vacios)) {
                if (!is_dir(IMAGENES_SUBIDAS)) {
                    mkdir(IMAGENES_SUBIDAS);
                }
                //Guardar la imagen en el servidor
                $image->save(IMAGENES_SUBIDAS . $nombre);
                $ropa->guardar();
            }
        }

        $router->render('ropa/crear', [
            'ropa' => $ropa,
            'marcas' => $marcas,
            'tallas' => $tallas,
            'generos' => $generos,
            'campos_vacios' => $campos_vacios
        ]);
    }

    public function actualizar(Router $router)
    {

        $id = validarId('/admin');
        $ropa = Ropa::getById($id);
        $ropa = Ropa::getById($id);
        $ropas = Ropa::all();
        $marcas = Marca::all();
        $tallas = array_unique(recorre($ropas, "Talla"));
        $generos = array_unique(recorre($ropas, "Genero"));
        $campos_vacios = Ropa::getVacios();

        //Acceder a los datos del formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ropa->sincronize($_POST);
            $campos_vacios = $ropa->validar();
            $nombre = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['Imagen']['tmp_name']) {
                $image = Image::make($_FILES['Imagen']['tmp_name']);
                $ropa->setImagen($nombre);
            }
            if (empty($campos_vacios)) {
                if ($_FILES['Imagen']['tmp_name']) {
                    $image->save(IMAGENES_SUBIDAS . $nombre);
                }
                $ropa->guardar();
            }
        }
        $router->render('ropa/actualizar', [
            'ropa' => $ropa,
            'marcas' => $marcas,
            'tallas' => $tallas,
            'generos' => $generos,
            'campos_vacios' => $campos_vacios
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_borrar'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipo($tipo)) {
                    $ropa = Ropa::getById($id);
                    $ropa->eliminar();
                }
            }
        }
    }
}
