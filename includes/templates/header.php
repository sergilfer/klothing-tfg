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
    <link rel="stylesheet" href="/klothing-tfg/build/css/app.css" />
</head>

<body>
    <header class="header inicio">
        <div class="contenedor contenido-header ">
            <a href="/klothing-tfg/index.php">
                <picture class="imagen-header">
                    <source srcset="/klothing-tfg/build/img/logos/klothing.webp" type="image/webp" />
                    <source srcset="/klothing-tfg/build/img/items/klothing.jpg" type="image/jpeg" />
                    <img loading="lazy" src="/klothing-tfg/build/items/klothing.jpg" alt="anuncio" />
                </picture>
            </a>

            <div class="mobile-menu">
                <picture>
                    <source srcset="/klothing-tfg/build/img/items/menu.webp" type="image/webp" />
                    <source srcset="/klothing-tfg/build/img/items/menu.jpg" type="image/jpeg" />
                    <img loading="lazy" src="/klothing-tfg/build/items/menu.jpg" alt="anuncio" />
                </picture>
            </div>
            <div class="derecha">
                <nav class="navegacion">
                    <a href="/klothing-tfg/nosotros.php">Nosotros</a>
                    <a href="/klothing-tfg/hombre.php?genero=Hombre">Hombre</a>
                    <a href="/klothing-tfg/hombre.php?genero=Mujer">Mujer</a>
                    <a href="/klothing-tfg/marcas.php">Marcas</a>
                    <a href="/klothing-tfg/contacto.php">Contacto</a>
                    <?php if ($auth) : ?>
                        <a href="/klothing-tfg/cerrar-sesion.php">Cerrar Sesión</a>
                    <?php else : ?>
                        <a href="/klothing-tfg/login.php">Iniciar Sesion</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>