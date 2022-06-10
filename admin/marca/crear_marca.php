<?php

require '../../includes/app.php';

use App\Marca;
use Intervention\Image\ImageManagerStatic as Image;

isLogged();

$campos_vacios = Marca::getVacios();
$marca = new Marca;

//Acceder a los datos del formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = new Marca($_POST);


    $nombre = md5(uniqid(rand(), true)) . ".jpg";

    if ($_FILES['Imagen']['tmp_name']) {
        $image = Image::make($_FILES['Imagen']['tmp_name'])->fit(800, 600);
        $marca->setImagen($nombre);
    }


    $campos_vacios = $marca->validar();

    //validar que todos los campos estan completados
    if (empty($campos_vacios)) {

        if (!is_dir(IMAGENES_SUBIDAS)) {
            mkdir(IMAGENES_SUBIDAS);
        }

        //Guardar la imagen en el servidor
        $image->save(IMAGENES_SUBIDAS . $nombre);

        $marca->guardar();
    }
}
incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Crear Marca</h1>
    <a href="/klothing-tfg/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($campos_vacios as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/klothing-tfg/admin/marca/crear_marca.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario-marca.php'; ?>
        <input type="submit" value="Crear" class="boton boton-verde">
        </div>
    </form>

</main>

<?php
incluirTemplates('footer');
?>