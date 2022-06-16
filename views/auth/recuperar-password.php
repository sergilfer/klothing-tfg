<section class="seccion contenedor contenido-centrado">

<h1>Recuperar Password</h1>
<p>Coloca tu nuevo password a continuación</p>

<?php foreach ($campos_vacios as $error) : ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>

    <?php endforeach; ?>

    <?php if ($error) return; ?>
    <form class="formulario" method="POST">
        <div class="campo">
            <label for="password">Password</label>
            <input type="password" id="password" name="Password" placeholder="Tu Nuevo Password" />
        </div>
        <input type="submit" class="boton boton-verde" value="Guardar Nuevo Password">

    </form>

    <div class="acciones">
        <a href="/login">¿Ya tienes cuenta? Iniciar Sesión</a>
        <a href="/crear-cuenta">¿Aún no tienes cuenta? Obtener una</a>
    </div>
</section>