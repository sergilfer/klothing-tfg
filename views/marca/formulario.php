<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="Nombre" placeholder="Nombre Marca" value="<?php echo cleanCode( $marca->Nombre ); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" name="Imagen" id="imagen" accept="image/jpeg, image/png">

    <?php if ($marca->Imagen) { ?>
        <img src="../../imagenes_subidas/<?php echo $marca->Imagen ?>" class="imagen-pequeña">
    <?php } ?>

</fieldset>


<div class="alinear-derecha">