<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public function enviarConfirmacion($nombre, $email, $token)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = '';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = ;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('klothing.tfg@gmail.com');

        $mail->addAddress($email);

        $mail->Subject = 'Confirmacion de Cuenta';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $nombre . "</strong> Has creado cuenta en Klothing, confirma presionando en el siguiente enlace";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $token . "'>Confirmar Cuenta</a>";
        $contenido .= "<p>Si no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        $mail->send();
    }

    public function enviarMailContacto($relleno)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'klothing.tfg@gmail.com';
        $mail->Password = 'sbthbghsjmwpysrl';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('klothing.tfg@gmail.com');
        $mail->addAddress($relleno['email']);

        $mail->Subject = 'Tienes un nuevo mail';

        $contenido = '<html>';
        $contenido .= "<p><strong>Has Recibido un email:</strong></p>";
        $contenido .= "<p>Nombre: " . $relleno['nombre'] . "</p>";
        $contenido .= "<p>Mensaje: " . $relleno['mensaje'] . "</p>";
        $contenido .= "<p>Talla: " . $relleno['tallas'] . "</p>";
        $contenido .= "<p>Marca: " . $relleno['marca'] . "</p>";

        if ($relleno['contacto'] === 'telefono') {
            $contenido .= "<p>Eligió ser Contactado por Teléfono:</p>";
            $contenido .= "<p>Su teléfono es: " .  $relleno['telefono'] . " </p>";
            $contenido .= "<p>En la Fecha y hora: " . $relleno['fecha'] . " - " . $relleno['hora']  . " Horas</p>";
        } else {
            $contenido .= "<p>Eligio ser Contactado por Email:</p>";
            $contenido .= "<p>El mail al que le contactaremos sera: " .  $relleno['email'] . " </p>";
        }

        $contenido .= '</html>';

        $mail->Body = $contenido;
        $mail->send();
    }

    public function enviarInstrucciones($nombre, $email, $token)
    {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'klothing.tfg@gmail.com';
        $mail->Password = 'sbthbghsjmwpysrl';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('klothing.tfg@gmail.com');

        $mail->addAddress($email);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=" . $token . "'>Reestablecer Password</a>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        $mail->send();
    }
}
