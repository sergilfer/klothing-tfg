<?php
$db = conectarDB();

$query = "SELECT * FROM tiendaropa WHERE Genero = 'Hombre'";

$resultado = realizarConsulta($db, $query);
?>

<h2>Seccion Hombre</h2>
<div class="contenedor-anuncios">

    <?php while ($ropa = mysqli_fetch_assoc($resultado)) : ?>
        <div class="anuncio">
            <picture>
                <img loading="lazy" src="imagenes_subidas/<?php echo $ropa['Imagen']; ?>" alt="anuncio" />
            </picture>
            <div class="contenido-anuncio">
                <h3><?php echo $ropa['Titulo'] ?></h3>
                <p><?php echo $ropa['Descripcion'] ?></p>
                <p class="precio"><?php echo $ropa['Precio'] ?> €</p>
                <a href="anuncios.php?id=<?php echo $ropa['Id']; ?>" class="boton-amarillo-block">Comprar</a>
            </div>
            <!---.contenido anuncio-->
        </div>
        <!---.anuncio-->
    <?php endwhile; ?>
</div>
<!---.contenedor anuncios-->

<!---Cierro la conexion a la pagina web-->

<?php mysqli_close($db) ?>