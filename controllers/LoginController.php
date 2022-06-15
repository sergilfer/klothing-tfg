<?php

namespace Controllers;

use MVC\Router;
use Model\Usuarios;
use Classes\Email;

class LoginController
{
    public static function login(Router $router)
    {
        $admin = new Usuarios($_POST);
        $campos_vacios = $admin->validarLogin();


        if (empty($campos_vacios)) {
            //Compruebo que existe el usuario
            $usuario = Usuarios::where('email', $admin->Email);
            if ($usuario) {
                //Verifico el password
                if ($usuario->comprobarPassword($admin->Password)) {
                    session_start();
                    $_SESSION['id'] = $usuario->Id;
                    $_SESSION['nombre'] = $usuario->Nombre . " " . $usuario->Apellidos;
                    $_SESSION['email'] = $usuario->Email;
                    $_SESSION['login'] = true;

                    // Redireccionamiento
                    if ($usuario->Admin === "1") {
                        $_SESSION['admin'] = $usuario->Admin ?? null;
                        header('Location: /admin');
                    } else {
                        header('Location: /');
                    }
                }
            } else {
                Usuarios::setVacios('Usuario no encontrado');
            }
        }

        $campos_vacios = Usuarios::getVacios();
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
        $usuario = new Usuarios();
        $campos_vacios = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronize($_POST);
            $campos_vacios = $usuario->validar();

            if (empty($campos_vacios)) {
                //Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if ($resultado->num_rows) {
                    $campos_vacios = Usuarios::getVacios();
                } else {
                    //Hash password
                    $usuario->hashPassword();
                    $usuario->crearToken();

                    $email = new Email();
                    $nombre = $usuario->Nombre;
                    $mail = $usuario->Email;
                    $token = $usuario->Token;
                    $email->enviarConfirmacion($nombre, $mail, $token);

                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }
        $router->render('auth/register', [
            'campos_vacios' => $campos_vacios,
            'usuario' => $usuario
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje', []);
    }

    public static function confirmar(Router $router)
    {
        $confirmado = 0;
        $mensaje = "No se ha podido confirmar su token";
        $campos_vacios = [];
        $token = cleanCode($_GET['token']);
        $usuario = Usuarios::where('Token', $token);

        if (empty($usuario)) {
            //Mostrar mensaje de error
            Usuarios::setVacios('Token no valido');
        } else {
            //Modificar el confirmado
            $usuario->Confirmado = "1";
            $confirmado = 1;
            $usuario->Token = '' ?? null;
            $usuario->guardar();
            $mensaje = "Cuenta confirmada correctamente";
        }

        $campos_vacios = Usuarios::getVacios();

        $router->render('auth/confirmar-cuenta', [
            'campos_vacios' => $campos_vacios,
            'mensaje' => $mensaje,
            'confirmado' => $confirmado
        ]);
    }

    public static function olvide(Router $router)
    {

        $campos_vacios = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = new Usuarios($_POST);
            $campos_vacios = $admin->validarEmail();

            if (empty($campos_vacios)) {
                $usuario = Usuarios::where('Email', $admin->Email);

                if ($usuario && $usuario->Confirmado === "1") {

                    // Generar un token
                    $usuario->crearToken();
                    $usuario->guardar();

                    //  Enviar el email
                    $email = new Email();
                    $email->enviarInstrucciones($usuario->Nombre, $usuario->Email, $usuario->Token);

                    // Alerta de exito
                    Usuarios::setVacios('Revisa tu email');
                } else {
                    Usuarios::setVacios('El Usuario no existe o no esta confirmado');
                }
            }
        }

        $campos_vacios = Usuarios::getVacios();

        $router->render('auth/olvide-password', [
            'campos_vacios' => $campos_vacios
        ]);
    }


    public static function recuperar(Router $router)
    {
        $campos_vacios = [];
        $error = false;
        $token = cleanCode($_GET['token']);

        // Buscar usuario por su token
        $usuario = Usuarios::where('Token', $token);

        if (empty($usuario)) {
            Usuarios::setVacios('Token No Válido');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer el nuevo password y guardarlo

            $admin = new Usuarios($_POST);
            $campos_vacios = $admin->validarPassword();

            if (empty($campos_vacios)) {
                $usuario->Password = '' ?? null;

                $usuario->Password = $admin->Password;
                $usuario->hashPassword();
                $usuario->Token = '' ?? null;

                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('Location: /');
                }
            }
        }

        $campos_vacios = Usuarios::getVacios();
        $router->render('auth/recuperar-password', [
            'campos_vacios' => $campos_vacios,
            'error' => $error
        ]);
    }
}
