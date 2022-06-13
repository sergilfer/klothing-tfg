<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

class LoginController
{
    public static function login(Router $router)
    {

        $campos_vacios = [];



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $campos_vacios = $auth->validar();

            debug($campos_vacios);

            if (empty($campos_vacios)) {

                $resultado = $auth->existeUsuario();


                if (!$resultado) {
                    $campos_vacios = Admin::getVacios();
                } else {

                    $auth->comprobarPassword($resultado);

                    if ($auth->autenticado) {
                        $auth->autenticar();
                    } else {
                        $campos_vacios = Admin::getVacios();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'campos_vacios' => $campos_vacios
        ]);
    }

    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function register(Router $router)
    {
        $admin = new Admin();
        $campos_vacios = Admin::getVacios();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = new Admin($_POST);

            $admin -> registrarUsuario();
        }

        $router -> render ('/auth/register',[
            'admin' => $admin,
            'campos_vacios' => $campos_vacios
        ]);
    }

}
