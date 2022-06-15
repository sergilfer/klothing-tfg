<div class="contenedor-anuncios ">
    <?php foreach ($marcas as $marca) { ?>
        <div class="anuncio">
            <picture>
                <img loading="lazy" src="imagenes_subidas/<?php echo $marca->Imagen; ?>" alt="marca" />
            </picture>
            <div class="contenido-anuncio imagen-header">
                <h3><?php echo $marca->Nombre ?></h3>
                <a href="ropamarca?id=<?php echo $marca->Id;?>" class="boton-amarillo-block">Ver</a>
            </div>
        </div>
    <?php } ?>
</div>