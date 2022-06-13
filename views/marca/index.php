<main class="contenedor seccion">
    <h1>Administrador de Marcas</h1>
    <?php 
        $mensaje = mostrarNotificacion( intval( $resultado) );
        if($mensaje) { ?>
            <p class="alerta exito"><?php echo cleanCode($mensaje); ?></p>
        <?php } 
    ?>

    <?php include __DIR__ . '/../navegacion.php'; ?>
</main>