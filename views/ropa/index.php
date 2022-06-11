<main class="contenedor seccion">
    <h1>Administrador de TFG</h1>

    <?php $mensaje = mostrarNotificacion(intval($codeURL));
    if ($mensaje) { ?>
        <p class="alerta exito"> <?php echo cleanCode($mensaje); ?> </p>
    <?php } ?>

    <?php include __DIR__ . '/../navegacion.php'; ?>
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
                        <form method="POST" class="w-100" action="/ropa/eliminar">
                            <input type="hidden" name="id_borrar" value="<?php echo $ropa->Id ?>">
                            <input type="hidden" name="tipo" value="ropa">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="../ropa/actualizar?id=<?php echo $ropa->Id ?>" class="boton-amarillo-block">Actualizar</a>
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
                        <form method="POST" class="w-100" action="marca/eliminar">
                            <input type="hidden" name="id_borrar" value="<?php echo $marca->Id ?>">
                            <input type="hidden" name="tipo" value="marca">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="../marca/actualizar?id=<?php echo $marca->Id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>