<?php

namespace Controllers;

use Model\Ropa;
use MVC\Router;
use Model\Marca;
use PHPMailer\PHPMailer\PHPMailer;

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
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'klothing.tfg@gmail.com';
            $mail->Password = 'sbthbghsjmwpysrl';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            //Configurar el contenido del email
            $mail->setFrom('klothing.tfg@gmail.com', $relleno['nombre']); //quien envia el mail
            $mail->addAddress($relleno['email']); //quien lo recibe
            $mail->Subject = 'Tienes un nuevo Email';

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p><strong>Has Recibido un email:</strong></p>";
            $contenido .= "<p>Nombre: " . $relleno['nombre'] . "</p>";
            $contenido .= "<p>Mensaje: " . $relleno['mensaje'] . "</p>";
            $contenido .= "<p>Talla: " . $relleno['tallas'] . "</p>";
            $contenido .= "<p>Marca: " . $relleno['marca'] . "</p>";
            
            if($relleno['contacto'] === 'telefono') {
                $contenido .= "<p>Eligió ser Contactado por Teléfono:</p>";
                $contenido .= "<p>Su teléfono es: " .  $relleno['telefono'] ." </p>";
                $contenido .= "<p>En la Fecha y hora: " . $relleno['fecha'] . " - " . $relleno['hora']  . " Horas</p>";
            } else {
                $contenido .= "<p>Eligio ser Contactado por Email:</p>";
                $contenido .= "<p>El mail al que le contactaremos sera: " .  $relleno['email'] ." </p>";
            }
            
            $contenido .='</html>';

            $mail->Body = $contenido;

            if ($mail->send()) {
                $mensaje =  "Mensaje enviado correctamente";
            } else {
                $mensaje =  "No se pudo enviar el mensaje";
            }
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}
