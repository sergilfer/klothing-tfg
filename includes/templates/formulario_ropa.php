<fieldset>
    <legend>Informacion General</legend>

    <label for="genero">Genero:</label>
    <select name="Genero" id="genero" value="<?php echo $genero; ?>">
        <option value="">-- Seleccione el genero --</option>
        <?php foreach ($generos as $genero) : ?>
            <option <?php echo $ropa->Genero === $genero ? 'selected' : ''; ?> value="<?php echo cleanCode($genero); ?>">
                <?php echo ($genero); ?> </option>
        <?php endforeach; ?>
    </select>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="Titulo" placeholder="Titulo Ropa" value="<?php echo cleanCode( $ropa->Titulo ); ?>">
    
    <label for="marca">Marca:</label>
    <select name="Marca" id="marca">
        <option value="">-- Seleccion la marca --</option>

        <?php foreach ($marcas as $marca) : ?>
            <option <?php echo $ropa->Marca === $marca->Id ? 'selected' : ''; ?> value="<?php echo cleanCode($marca->Id); ?>"> <?php echo cleanCode($marca->Nombre); ?></option>
        <?php endforeach; ?>
    </select>


    <label for="precio">Precio:</label>
    <input type="number" step="any" id="precio" name="Precio" min="1" placeholder="Introduzca precio" value="<?php echo cleanCode($ropa->Precio); ?>">

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="Stock" placeholder="Introduzca stock" value="<?php echo cleanCode($ropa->Stock);  ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" name="Imagen" id="imagen" accept="image/jpeg, image/png" >

    <?php if($ropa->Imagen) { ?>
        <img src="../../imagenes_subidas/<?php echo $ropa->Imagen ?>" class="imagen-pequeña">
    <?php } ?>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="Descripcion"><?php echo cleanCode($ropa->Descripcion); ?></textarea>

</fieldset>

<fieldset>

    <legend>Informacion Ropa</legend>

    <label for="talla">Tallas:</label>
    <select name="Talla" value="<?php echo $talla; ?>">
        <option value="">-- Seleccion una talla --</option>
        <?php foreach ($tallas as $talla) : ?>
            <option <?php echo $ropa->Talla === $talla ? 'selected' : ''; ?> value="<?php echo cleanCode($talla); ?>">
                <?php echo ($talla); ?> </option>
        <?php endforeach; ?>
    </select>

    <label for="color">Color:</label>
    <input type="text" id="color" name="Color" placeholder="Inserte el color" value="<?php echo cleanCode($ropa->Color);  ?>">

    <label for="color">Tipo:</label>
    <input type="text" id="tipo" name="Tipo" placeholder="Inserte el tipo" value="<?php echo cleanCode($ropa->Tipo);  ?>">

</fieldset>

<div class="alinear-derecha">