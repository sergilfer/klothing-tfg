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
    <link rel="stylesheet" href="../build/css/app.css" />
</head>

<body>
    <header class="header inicio">
        <div class="contenedor contenido-header ">
            <a href="/">
                <picture class="imagen-header">
                    <source srcset="../build/img/logos/klothing.webp" type="image/webp" />
                    <source srcset="../build/img/items/klothing.jpg" type="image/jpeg" />
                    <img loading="lazy" src="../build/items/klothing.jpg" alt="anuncio" />
                </picture>
            </a>

            <div class="mobile-menu">
                <picture>
                    <source srcset="../build/img/items/menu.webp" type="image/webp" />
                    <source srcset="../build/img/items/menu.jpg" type="image/jpeg" />
                    <img loading="lazy" src="../build/items/menu.jpg" alt="anuncio" />
                </picture>
            </div>
            <div class="derecha">
                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/seccion?genero=Hombre">Hombre</a>
                    <a href="/seccion?genero=Mujer">Mujer</a>
                    <a href="/seccion">Ver todas</a>
                    <a href="/marcas">Marcas</a>
                    <a href="/contacto">Contacto</a>

                    <?php if ($auth) : ?>
                        <a href="/logout">Cerrar Sesión</a>
                    <?php else : ?>
                        <a href="/login">Iniciar Sesion</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>


<?php echo $contenido; ?>



    <footer class="footer seccion">

        <div class="contenedor contenedor-footer">
        <p class="copy">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>
    <!--FIN FOOTER-->
    <script src="../build/js/bundle.min.js"></script>
</body>
</html>