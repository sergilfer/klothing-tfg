<?php
require '../../includes/app.php';

use App\Ropa;
use App\Marca;
use Intervention\Image\ImageManagerStatic as Image;

isLogged();

//con esto me aseguro que al cambiar la url, no me pongan un string en la variable id
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /klothing-tfg/admin');
}

//Consultar para obtener los datos del SELECT 
$ropa = Ropa::getById($id);

$ropas = Ropa::all();
$marcas = Marca::all();
$tallas = array_unique(recorre($ropas, "Talla"));
$generos = array_unique(recorre($ropas, "Genero"));

//creo un array que me indique si quedan campos vacios 
$campos_vacios = Ropa::getVacios();

//Acceder a los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // $args = $_POST['ropa'];

    $ropa->sincronize($_POST);



    $campos_vacios = $ropa->validar();

    $nombre = md5(uniqid(rand(), true)) . ".jpg";

    if ($_FILES['Imagen']['tmp_name']) {
        $image = Image::make($_FILES['Imagen']['tmp_name'])->fit(800, 600);
        $ropa->setImagen($nombre);
    }

    //validar que todos los campos estan completados
    if (empty($campos_vacios)) {
        if ($_FILES['Imagen']['tmp_name']) {
            $image->save(IMAGENES_SUBIDAS . $nombre);
        }
        $ropa->guardar();
    }
}

incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Ropa</h1>

    <?php foreach ($campos_vacios as $vacios) : ?>
        <div class="alerta error">
            <?php echo $vacios; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_ropa.php'; ?>

        <input type="submit" value="Actualizar" class="boton boton-verde">
        </div>

    </form>

</main>

<?php
incluirTemplates('footer');
?>