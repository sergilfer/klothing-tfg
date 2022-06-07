<?php
//compruebo si la sesion esta arrancada ya en otra parte, sino, la inicio
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['logueado'] ?? null;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TFG</title>
    <link rel="stylesheet" href="/tfg/build/css/app.css" />
</head>

<body>
    <header class="header inicio">
        <div class="contenedor contenido-header">
            <a href="/tfg/index.php">
                <h1 class="title">MODAMS</h1>
            </a>

            <div class="mobile-menu">
                <picture>
                    <source srcset="/tfg/build/img/items/menu.webp" type="image/webp" />
                    <source srcset="/tfg/build/img/items/menu.jpg" type="image/jpeg" />
                    <img loading="lazy" src="/tfg/build/items/menu.jpg" alt="anuncio" />
                </picture>
            </div>
            <div class="derecha">
                <nav class="navegacion">
                    <a href="/tfg/nosotros.php">Nosotros</a>
                    <a href="/tfg/hombre.php">Hombre</a>
                    <a href="/tfg/mujer.php">Mujer</a>
                    <a href="/tfg/marcas.php">Marcas</a>
                    <a href="/tfg/contacto.php">Contacto</a>
                    <?php if ($auth) : ?>
                        <a href="cerrar-sesion.php">Cerrar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>