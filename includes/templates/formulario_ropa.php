
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
    <input type="text" id="titulo" name="titulo" placeholder="Titulo de la prenda" value="<?php echo cleanCode($ropa->Titulo); ?>">

    <label for="marca">Marca:</label>

    <select name="marca" value="<?php echo $marca; ?>">
        <option value="">-- Seleccion la marca --</option>
        <?php while ($row = mysqli_fetch_assoc($marcas_db)) : ?>
            <option <?php echo $marca === $row['Nombre'] ? 'selected' : ''; ?> value="<?php echo $row['Id']; ?>"> <?php echo $row['Nombre'] ?> </option>
        <?php endwhile; ?>
    </select>


    <label for="precio">Precio:</label>
    <input type="number" step="any" id="precio" name="precio" placeholder="Introduzca precio" value="<?php echo cleanCode($ropa->Precio); ?>">

    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" placeholder="Introduzca stock" value="<?php echo cleanCode($ropa->Stock);  ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="descripcion"><?php echo cleanCode($ropa->Descripcion);  ?> </textarea>

</fieldset>

<fieldset>

    <legend>Informacion Ropa</legend>

    <label for="talla">Tallas:</label>
    <select name="talla" value="<?php echo $talla; ?>">
        <option value="">-- Seleccion una talla --</option>
        <?php while ($row = mysqli_fetch_assoc($talla_db)) : ?>
            <option <?php echo $talla === $row['Talla'] ? 'selected' : ''; ?> value="<?php echo $row['Talla']; ?>"> <?php echo cleanCode($ropa->Talla); ?> </option>
        <?php endwhile; ?>
    </select>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" placeholder="Inserte el color" value="<?php echo cleanCode($ropa->Color);  ?>">

    <label for="color">Tipo:</label>
    <input type="text" id="tipo" name="tipo" placeholder="Inserte el tipo" value="<?php echo cleanCode($ropa->Tipo);  ?>">

</fieldset>

<div class="alinear-derecha">