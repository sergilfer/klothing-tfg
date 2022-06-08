<?php
$db = conectarDB();

$query = "SELECT * FROM marca";

$resultado = realizarConsulta($db, $query);
?>
<div class="contenedor-anuncios ">
    <?php while ($marca = mysqli_fetch_assoc($resultado)) : ?>
        <div class="anuncio">
            <picture>
                <img loading="lazy" src="/klothing-tfg/imagenes_subidas/<?php echo $marca['Imagen']; ?>" alt="marca" />
            </picture>
            <div class="contenido-anuncio imagen-header">
                <h3><?php echo $marca['Nombre'] ?></h3>
                <a href="lacoste.php" class="boton-amarillo-block">Comprar</a>
            </div>
            <!---.contenido anuncio-->
        </div>
        <!---.anuncio-->
    <?php endwhile; ?>
</div>
<!---.contenedor anuncios-->