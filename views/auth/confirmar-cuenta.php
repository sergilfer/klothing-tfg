<section class="seccion contenedor contenido-centrado">

    <h1>Confirma tu cuenta</h1>
    <?php if ($confirmado === 0) : ?>
            <div class="alerta error">
                <?php echo cleanCode($mensaje); ?>
            </div>
    <?php elseif ($confirmado === 1): ?>
        <p class="alerta exito"> <?php echo cleanCode($mensaje); ?> </p>
        <?php endif; ?>

</section>