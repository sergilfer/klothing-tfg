<?php

use Model\Ropa;

$genero = $_GET['genero'] ?? null;
if (!$genero) {
    $ropas = Ropa::all();
} else {
    $ropas = Ropa::selectByGender($genero);
}


?>

<h2><?php echo mostrarGenero($genero); ?></h2>


<div class="contenedor-anuncios">

    <?php foreach ($ropas as $ropa) { ?>
        <div class="anuncio">
            <picture>
                <img loading="lazy" src="imagenes_subidas/<?php echo $ropa->Imagen; ?>" alt="anuncio" />
            </picture>
            <div class="contenido-anuncio">
                <h3><?php echo $ropa->Titulo ?></h3>
                <p><?php echo $ropa->Descripcion ?></p>
                <p class="precio"><?php echo $ropa->Precio ?> €</p>
                <a href="anuncios.php?id=<?php echo $ropa->Id; ?>" class="boton-amarillo-block">Comprar</a>
            </div>
            <!---.contenido anuncio-->
        </div>
        <!---.anuncio-->
    <?php } ?>
</div>
<!---.contenedor anuncios-->

<!---Cierro la conexion a la pagina web-->

<?php mysqli_close($db) ?>