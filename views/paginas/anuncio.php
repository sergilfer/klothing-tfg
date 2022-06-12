<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $ropa->Titulo; ?></h1>
    <div class="contenido-ropa">
        <picture>
            <img loading="lazy" src="imagenes_subidas/<?php echo $ropa->Imagen; ?>" alt="anuncio" />
        </picture>
        <div class="resumen-ropa">
            <div class="precio-tallas">
                <p class="precio">Precio <?php echo $ropa->Precio; ?>$</p>
                <form class="formulario" method="POST" enctype="multipart/form-data">
                    <label for="talla"></label>
                    <select name="Talla">
                        <option selected value="">-- Seleccion una talla --</option>
                        <?php foreach ($tallas as $talla) : ?>
                            <option <?php echo $ropa->Talla === $talla ? 'selected' : ''; ?> value="<?php echo cleanCode($talla); ?>">
                                <?php echo ($talla); ?> </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="alinear-derecha">
                        <input type="submit" value="Comprar" class="boton boton-verde">
                    </div>
                </form>
            </div>
            <p><span>Descripción:</span> <?php echo $ropa->Descripcion; ?></p>


        </div>
    </div>

</main>
