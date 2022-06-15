<?php

namespace Controllers;

use MVC\Router;
use Model\Marca;
use Model\Ropa;
use Intervention\Image\ImageManagerStatic as Image;

class MarcaController
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
        $marca = new Marca();
        $campos_vacios = Marca::getVacios();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = new Marca($_POST);
            
            $nombre = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['Imagen']['tmp_name']) {
                $image = Image::make($_FILES['Imagen']['tmp_name']);
                $marca->setImagen($nombre);
            }
            $campos_vacios = $marca->validar();
            if (empty($campos_vacios)) {
                if (!is_dir(IMAGENES_SUBIDAS)) {
                    mkdir(IMAGENES_SUBIDAS);
                }
                $image->save(IMAGENES_SUBIDAS . $nombre);
                $resultado = $marca->guardar();
                if ($resultado) {
                    header('Location: ../admin?codeURL=1');
                }
            }
        }
        $router->render('marca/crear', [
            'marca' => $marca,
            'campos_vacios' => $campos_vacios
        ]);
    }

    public static function  actualizar(Router $router)
    {
        $id = validarId('/admin');
        $marca = Marca::getById($id);
        $campos_vacios = Marca::getVacios();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca->sincronize($_POST);
            $campos_vacios = $marca->validar();
            $nombre = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['Imagen']['tmp_name']) {
                $image = Image::make($_FILES['Imagen']['tmp_name'])->fit(800, 600);
                $marca->setImagen($nombre);
            }
            if (empty($campos_vacios)) {
                if ($_FILES['Imagen']['tmp_name']) {
                    $image->save(IMAGENES_SUBIDAS . $nombre);
                }
                $resultado = $marca->guardar();
                if ($resultado) {
                    header('Location: ../admin?codeURL=2');
                }
            }
        }

        $router->render('marca/actualizar', [
            'marca' => $marca,
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
                    $marca = Marca::getById($id);
                    $marca->eliminar();
                }
            }
        }
    }
}
