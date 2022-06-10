<?php

require '../../includes/app.php';

use App\Marca;
use App\Ropa;
use Intervention\Image\ImageManagerStatic as Image;

isLogged();

$ropa = new Ropa;

$ropas = Ropa::all();
$marcas = Marca::all();

$tallas = array_unique(recorre($ropas, "Talla"));

$generos = array_unique(recorre($ropas, "Genero"));


/*$consulta_tallas = "SELECT DISTINCT Talla FROM tiendaropa ORDER BY CASE 
WHEN Talla = 'XS' THEN 1 WHEN Talla = 'S' THEN 2 WHEN Talla = 'M' THEN 3 WHEN Talla = 'L' THEN 4
WHEN Talla = 'XL' THEN 5
END";*/


//creo un array que me indique si quedan campos vacios 
$campos_vacios = Ropa::getVacios();

//Acceder a los datos del formulario

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

incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Crear Ropa</h1>

    <?php foreach ($campos_vacios as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/klothing-tfg/admin/ropa/crear_ropa.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_ropa.php'; ?>

        <input type="submit" value="Crear" class="boton boton-verde">
        </div>

    </form>

</main>

<?php
incluirTemplates('footer');
?>