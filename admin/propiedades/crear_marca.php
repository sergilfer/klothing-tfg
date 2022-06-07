<?php

require '../../includes/app.php';


isLogged();

$db = conectarDB();


//creo un array que me indique si quedan campos vacios 
$campos_vacios = [];

//creo los campos vacios como variables globales para guardar su ultima informacion para que en el caso de no guardar algun valor, no tener que escribirlo de nuevo 
$nombreMarca = '';

//Acceder a los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreMarca = mysqli_real_escape_string($db, $_POST['nombreMarca']);
    $imagen = $_FILES['imagen'];

    if (!$nombreMarca) {
        $campos_vacios[] = "Debes seleccionar un nombre para la marca";
    }
    if (!$imagen['name'] || $imagen['error']) {
        $campos_vacios[] = "Debe seleccionar una imagen";
    }
}

//validar que todos los campos estan completados
if (empty($campos_vacios)) {


    //Carpeta para subir archivos
    $path = '../../imagenes_subidas/';

    //Compruebo si existe el directorio para no crear repetidos
    if (!is_dir($path)) {
        mkdir($path);
    }

    /*
    Generar un nombre de imagen unico para que no se repitan y no se sobreescriba
    md5 se usa para encriptar y luego uniqid para cambiar el nombre del archivo aun asi uso el 
    rand para que sea mas random todavia y no se consigan 2 nombres de archivos iguales aunque la imagen sea la misma
    */
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    //Subir la imagen a la db
    //(imagen en memoria, direccion de la carpeta . nombre del archivo)
    if (!empty($imagen['tmp_name'])) {
        move_uploaded_file($imagen['tmp_name'], $path . $nombreImagen);
    }



    //Insertar los datos en la db
    $query = " INSERT INTO marca (Id, Nombre, Imagen) VALUES ('7' , '$nombreMarca', '$nombreImagen') ";
    $resultado = mysqli_query($db, $query);

    if ($resultado) {
        header('Location: /tfg/admin?codeURL=4');
    }
}

incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Crear Marca</h1>

    <?php foreach ($campos_vacios as $vacios) : ?>
        <div class="alerta error">
            <?php echo $vacios; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" action="/tfg/admin/propiedades/crear_marca.php" enctype="multipart/form-data">

        <fieldset>
            <legend>Informacion General</legend>

            <label for="nombreMarca">Nombre:</label>
            <input type="text" id="nombreMarca" name="nombreMarca" placeholder="Nombre de la marca" value="<?php echo $nombreMarca; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

        </fieldset>


        <div class="alinear-derecha">
            <input type="submit" value="Crear" class="boton boton-verde">
        </div>
    </form>

</main>

<?php
incluirTemplates('footer');
?>