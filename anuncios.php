<?php
require 'includes/app.php';
$id_anuncio = $_GET['id'];

if (!$id_anuncio) {
    header('Location: /tfg');
}
$db = conectarDB();

$talla = '';
$talla = mysqli_real_escape_string($db, $_POST['talla']);


$query = "SELECT * FROM tiendaropa WHERE Id = ${id_anuncio}";
$resultado = realizarConsulta($db, $query);

if ($resultado->num_rows === 0) {
    header('Location: /tfg');
}

$ropa = mysqli_fetch_assoc($resultado);


incluirTemplates('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $ropa['Titulo']; ?></h1>



    <div class="contenido-ropa">
        <picture>
            <img loading="lazy" src="imagenes_subidas/<?php echo $ropa['Imagen']; ?>" alt="anuncio" />
        </picture>

        <div class="resumen-ropa">


            <div class="precio-tallas">

                <p class="precio">Precio <?php echo $ropa['Precio']; ?>$</p>
                <form class="formulario" method="POST" enctype="multipart/form-data">
                    <label for="talla"></label>
                    <select name="talla" value="<?php echo $talla; ?>">
                        <option value="">-- Seleccion una talla --</option>
                        <?php while ($row = mysqli_fetch_assoc($talla_db)) : ?>
                            <option <?php echo $talla === $row['Talla'] ? 'selected' : ''; ?> value="<?php echo $ropa['Talla']; ?>"> <?php echo $ropa['Talla'] ?> </option>
                        <?php endwhile; ?>

                    </select>

                    <div class="alinear-derecha">
                        <input type="submit" value="Comprar" class="boton boton-verde">
                    </div>
                </form>
            </div>
            <p><span>Descripción:</span> <?php echo $ropa['Descripcion']; ?></p>


        </div>
    </div>

</main>

<section class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Comentarios</h3>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/tienda/camiseta1.webp" type="image/webp" />
                    <source srcset="build/img/tienda/camiseta1.jpg" type="image/jpeg" />
                    <img loading="lazy" src="build/img/tienda/camiseta1.jpg" alt="Imagen prueba" />
                </picture>
            </div>

            <div class="texto-blog">
                <a href="anuncios.php">
                    <h4>Calidad excelente</h4>
                    <p>
                        Escrito el: <span>10/12/2021</span> por: <span>Juan Lopez</span>
                    </p>
                    <p>Muy rapido y muy buena calidad</p>
                </a>
            </div>
        </article>
    </section>
</section>
<?php incluirTemplates('footer'); ?>