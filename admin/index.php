<?php
require '../includes/app.php';
use App\ropa;

isLogged();

//metodo para obtener todas las prendas de ropa
$todas_ropa = ropa::all();


//esta linea lee la URL y saca la parte de resultado para ver que valor se le ha pasado, en el caso de tener un valor al añadir/borrar/actualizar 
$codeURL = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_borrar'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        $borrarImagen = "SELECT Imagen FROM tiendaropa WHERE id = ${id}";

        $resultadoBorrarImagen = realizarConsulta($db, $borrarImagen);
        $imagenBorrar = mysqli_fetch_assoc($resultadoBorrarImagen);

        //Primero borro la imagen de mi servidor
        unlink('../imagenes_subidas/' . $imagenBorrar['Imagen']);

        //Ahora borro el registro
        $query = "DELETE FROM tiendaropa WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            header('Location: /klothing-tfg/admin?codeURL=3');
        }
    }
}
//incluye el header
incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de TFG</h1>



    <?php if (intval($codeURL) === 1) : ?>
        <p class="alerta exito">Los datos han sido introducidos correctamente en la base de datos</p>
    <?php elseif (intval($codeURL) === 2) : ?>
        <p class="alerta exito">Los datos han sido actualizado correctamente</p>
    <?php elseif (intval($codeURL) === 3) : ?>
        <p class="alerta exito">Se ha eliminado correctamente la ropa</p>
    <?php endif; ?>

    <div class="crear">
        <h3>Crear Elementos</h3>
        <div class="bt-crear">
            <a href="../admin/propiedades/crear_ropa.php" class="boton boton-verde">Crear Ropa</a>
            <a href="../admin/propiedades/crear_marca.php" class="boton boton-verde">Crear Marca</a>
        </div>
    </div>

    <h2>Lista de Ropa</h2>
    <table class="listado-ropa">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Color</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Talla</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>
            <tr>
                <?php foreach ($todas_ropa as $ropa) : ?>
                    <td> <?php echo $ropa->Id ?></td>
                    <td><?php echo $ropa->Tipo ?></td>
                    <td> <?php echo $ropa->Color ?> </td>
                    <td> <?php echo $ropa->Titulo ?></td>
                    <td> <img src="../imagenes_subidas/<?php echo $ropa->Imagen; ?>" class="imagen-tabla"> </td>
                    <td> <?php echo $ropa->Marca ?></td>
                    <td> <?php echo $ropa->Precio ?> $</td>
                    <td> <?php echo $ropa->Talla ?></td>
                    <td><?php echo $ropa->Stock ?> </td>

                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id_borrar" value="<?php echo $ropa->Id ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="../admin/propiedades/actualizar_ropa.php?id=<?php echo $ropa->Id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>



</main>

<?php
mysqli_close($db); //Cerrar la db
incluirTemplates('footer');
?>