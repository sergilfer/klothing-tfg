<?php

require '../../includes/app.php';

use App\ropa;
use Intervention\Image\ImageManagerStatic as Image;

isLogged();

$db = conectarDB();

$ropa = new ropa;

//Consultar para obtener los datos del SELECT 

$consulta_marcas = "SELECT DISTINCT * FROM marca";
$marcas_db = mysqli_query($db, $consulta_marcas);

$consulta_tallas = "SELECT DISTINCT Talla FROM tiendaropa ORDER BY CASE 
WHEN Talla = 'XS' THEN 1 WHEN Talla = 'S' THEN 2 WHEN Talla = 'M' THEN 3 WHEN Talla = 'L' THEN 4
WHEN Talla = 'XL' THEN 5
END";
$talla_db = mysqli_query($db, $consulta_tallas);

$consulta_genero = "SELECT DISTINCT Genero FROM tiendaropa";
$genero_db = mysqli_query($db, $consulta_genero);

$consulta_genero = "SELECT DISTINCT Tipo FROM tiendaropa";
$tipo_db = mysqli_query($db, $consulta_genero);

//creo un array que me indique si quedan campos vacios 
$campos_vacios = ropa::getVacios();

//Acceder a los datos del formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ropa = new ropa($_POST);


    /*Generar un nombre de imagen unico para que no se repitan y no se sobreescriba
    md5 se usa para encriptar y luego uniqid para cambiar el nombre del archivo aun asi uso el 
    rand para que sea mas random todavia y no se consigan 2 nombres de archivos iguales aunque la imagen sea la misma */

    $nombre = md5(uniqid(rand(), true)) . ".jpg";

    //Recorta imagen c
    if ($_FILES['imagen']['tmp_name']) {
        $image = Image::make($_FILES['imagen']['tmp_name'])->resize(800, 600);
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

        $resultado = $ropa->insertar();
        // Mensaje de exito

        if ($resultado) {
            // Redireccionar al usuario.
            header('Location: /tfg/admin?resultado=1');
        }
    }
}

incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <?php foreach ($campos_vacios as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/tfg/admin/propiedades/crear_ropa.php" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_ropa.php'; ?>

        <input type="submit" value="Crear" class="boton boton-verde">
        </div>

    </form>

</main>

<?php
incluirTemplates('footer');
?>