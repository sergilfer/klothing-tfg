    <div class="contenedor-anuncios">

        <?php foreach ($ropas as $ropa) { ?>
            <div class="anuncio">
                <picture>
                    <img loading="lazy" src="imagenes_subidas/<?php echo $ropa->Imagen; ?>" alt="anuncio" />
                </picture>
                <div class="contenido-anuncio">
                    <h3><?php echo $ropa->Titulo ?></h3>
                    <p class="precio"><?php echo $ropa->Precio ?> €</p>
                    <a href="anuncio?id=<?php echo $ropa->Id; ?>" class="boton-amarillo-block">Comprar</a>
                </div>
                <!---.contenido anuncio-->
            </div>
            <!---.anuncio-->
        <?php } ?>
    </div>
