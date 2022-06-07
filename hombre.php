<?php
require 'includes/app.php';
incluirTemplates('header');
?>

<section class="seccion contenedor">
    <?php
    $genero = 'Hombre';
    include 'includes/templates/contenedor-hombre.php' ?>
</section>

<?php incluirTemplates('footer'); ?>