<?php
require '../includes/app.php';

use App\Ropa;
use App\Marca;

isLogged();

//metodo para obtener todas las prendas de ropa
$ropas = Ropa::all();
$marcas = Marca::all();



//esta linea lee la URL y saca la parte de resultado para ver que valor se le ha pasado, en el caso de tener un valor al añadir/borrar/actualizar 
$codeURL = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_borrar'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        $tipo = $_POST['tipo'];
        if (validarTipo($tipo)) {
            if ($tipo === 'ropa') {
                $ropa = Ropa::getById($id);
                $ropa->eliminar();
            } else if ($tipo === 'marca') {
                $marca = Marca::getById($id);
                $marca->eliminar();
            }
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
            <a href="../admin/ropa/crear_ropa.php" class="boton boton-verde">Crear Ropa</a>
            <a href="../admin/marca/crear_marca.php" class="boton boton-verde">Crear Marca</a>
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
                <?php foreach ($ropas as $ropa) : ?>
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
                            <input type="hidden" name="tipo" value="ropa">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="../admin/ropa/actualizar_ropa.php?id=<?php echo $ropa->Id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Listado de Marcas</h2>
    <table class="listado-ropa">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>


            </tr>

        </thead>

        <tbody>
            <tr>
                <?php foreach ($marcas as $marca) : ?>
                    <td> <?php echo $marca->Id ?></td>
                    <td><?php echo $marca->Nombre ?></td>
                    <td> <img src="../imagenes_subidas/<?php echo $marca->Imagen; ?>" class="imagen-tabla"> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id_borrar" value="<?php echo $marca->Id ?>">
                            <input type="hidden" name="tipo" value="marca">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="../admin/marca/actualizar_marca.php?id=<?php echo $marca->Id ?>" class="boton-amarillo-block">Actualizar</a>
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