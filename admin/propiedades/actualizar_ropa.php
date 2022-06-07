<?php

require '../../includes/app.php';


isLogged();

$db = conectarDB();

//con esto me aseguro que al cambiar la url, no me pongan un string en la variable id
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

//Consultar para obtener los datos del SELECT 

$consulta_id = "SELECT * FROM tiendaropa WHERE id = ${id}";
$resultado_id = realizarConsulta($db, $consulta_id);
$prenda = mysqli_fetch_assoc($resultado_id); // en esta variable ya tendria todos los datos de mi id 

$consulta_marcas = "SELECT DISTINCT * FROM marca";
$marcas_db = realizarConsulta($db, $consulta_marcas);

$consulta_tallas = "SELECT DISTINCT Talla FROM tiendaropa ORDER BY CASE 
WHEN Talla = 'XS' THEN 1 WHEN Talla = 'S' THEN 2 WHEN Talla = 'M' THEN 3 WHEN Talla = 'L' THEN 4
WHEN Talla = 'XL' THEN 5
END";
$talla_db = realizarConsulta($db, $consulta_tallas);

$consulta_genero = "SELECT DISTINCT Genero FROM tiendaropa";
$genero_db = realizarConsulta($db, $consulta_genero);

$consulta_genero = "SELECT DISTINCT Tipo FROM tiendaropa";
$tipo_db = realizarConsulta($db, $consulta_genero);

//creo un array que me indique si quedan campos vacios 
$campos_vacios = [];

//creo los campos vacios como variables globales para guardar su ultima informacion para que en el caso de no guardar algun valor, no tener que escribirlo de nuevo 
$genero = $prenda['Genero'];
$titulo = $prenda['Titulo'];
$marca = $prenda['Marca'];
$precio = $prenda['Precio'];
$descripcion = $prenda['Descripcion'];
$talla = $prenda['Talla'];
$color = $prenda['Color'];
$tipo = $prenda['Tipo'];
$imagenPrenda = $prenda['Imagen'];
$stock = $prenda['Stock'];

//Acceder a los datos del formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $genero = mysqli_real_escape_string($db, $_POST['genero']);
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $marca = mysqli_real_escape_string($db, $_POST['marca']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $talla = mysqli_real_escape_string($db, $_POST['talla']);
    $color = mysqli_real_escape_string($db, $_POST['color']);
    $tipo = mysqli_real_escape_string($db, $_POST['tipo']);
    $stock = mysqli_real_escape_string($db, $_POST['stock']);

    $imagen = $_FILES['imagen'];

    if (!$genero) {
        $campos_vacios[] = "Debes añadir un Genero";
    }
    if (!$titulo) {
        $campos_vacios[] = "Debes añadir un titulo";
    }
    if (!$marca) {
        $campos_vacios[] = "Debes seleccionar una marca";
    }
    if (!$precio) {
        $campos_vacios[] = "Debes añadir un precio";
    }
    if (!$descripcion) {
        $campos_vacios[] = "La descripcion es un campo obligatorio que debe constar de más de 50 caracteres";
    }
    if (!$talla) {
        $campos_vacios[] = "Debes seleccionar una talla";
    }
    if (!$color) {
        $campos_vacios[] = "Debes añadir un modelo";
    }
    if (!$tipo) {
        $campos_vacios[] = "Debes seleccionar un tipo de ropa";
    }

    if (!$stock) {
        $campos_vacios[] = "Debe introducir un stock";
    }

    $medida = 1000 * 1000;
    if ($imagen['size'] > $medida) {
        $errores[] = 'La Imagen es muy pesada';
    }


    //validar que todos los campos estan completados
    if (empty($campos_vacios)) {


        //Carpeta para subir archivos
        $path = '../../imagenes_subidas/';

        //Compruebo si existe el directorio para no crear repetidos
        if (!is_dir($path)) {
            mkdir($path);
        }

        $nombre = '';

        //en el caso de que haya una imagen existente, borro la que ya esta, para cambiarla por una nueva
        if ($imagen['name']) {
            unlink($path . $prenda['Imagen']);

            $nombre = md5(uniqid(rand(), true)) . ".jpg";

            //(imagen en memoria, direccion de la carpeta . nombre del archivo)
            if (!empty($imagen['tmp_name'])) {
                move_uploaded_file($imagen['tmp_name'], $path . $nombre);
            }
        } else {
            //en el caso en el que no suba una imagen nueva, se guarda el nombre de mi imagen anterior
            $nombre = $prenda['Imagen'];
        }
        /*
    Generar un nombre de imagen unico para que no se repitan y no se sobreescriba
    md5 se usa para encriptar y luego uniqid para cambiar el nombre del archivo aun asi uso el 
    rand para que sea mas random todavia y no se consigan 2 nombres de archivos iguales aunque la imagen sea la misma
   */


        //Insertar los datos en la db
        $query = " UPDATE tiendaropa SET Id = '$id', Genero = '$genero', Talla = '$talla', Color = '$color', Tipo = '$tipo', Marca = '$marca', Stock = $stock , Descripcion = '$descripcion', Imagen = '$nombre', 
        Precio = '$precio', Titulo = '$titulo' WHERE id = ${id}";

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header('Location: /klothing-tfg/admin?codeURL=2');
        }
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

        <fieldset>
            <legend>Informacion General</legend>

            <legend>Genero:</legend>
            <select name="genero" value="<?php echo $genero; ?>">
                <option value="">-- Seleccion un genero --</option>
                <?php while ($row = mysqli_fetch_assoc($genero_db)) : ?>
                    <option <?php echo $genero === $row['Genero'] ? 'selected' : ''; ?> value="<?php echo $row['Genero']; ?>"> <?php echo $row['Genero'] ?> </option>
                <?php endwhile; ?>
            </select>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo de la prenda" value="<?php echo $titulo; ?>">

            <label for="marca">Marca:</label>
            <select name="marca" value="<?php echo $marca; ?>">
                <option value="">-- Seleccion la marca --</option>
                <?php while ($row = mysqli_fetch_assoc($marcas_db)) : ?>
                    <option <?php echo $marca === $row['Id'] ? 'selected' : ''; ?> value="<?php echo $row['Id']; ?>"> <?php echo $row['Nombre'] ?> </option>
                <?php endwhile; ?>
            </select>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" placeholder="Introduzca stock" value="<?php echo $stock; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Introduzca precio" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="../../imagenes_subidas/<?php echo $imagenPrenda ?>" class="imagen-actualizar">

            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion"> <?php echo $descripcion; ?> </textarea>

        </fieldset>

        <fieldset>

            <legend>Informacion Ropa</legend>

            <label for="talla">Tallas:</label>
            <select name="talla" value="<?php echo $talla; ?>">
                <option value="">-- Seleccion una talla --</option>
                <?php while ($row = mysqli_fetch_assoc($talla_db)) : ?>
                    <option <?php echo $talla === $row['Talla'] ? 'selected' : ''; ?> value="<?php echo $row['Talla']; ?>"> <?php echo $row['Talla'] ?> </option>
                <?php endwhile; ?>
            </select>

            <label for="color">Color:</label>
            <input type="text" id="color" name="color" placeholder="Inserte el color" value="<?php echo $color; ?>">

            <label for="color">Tipo:</label>
            <input type="text" id="tipo" name="tipo" placeholder="Inserte el tipo" value="<?php echo $tipo; ?>">

        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Actualizar" class="boton boton-verde">
        </div>

    </form>

</main>

<?php
incluirTemplates('footer');
?>