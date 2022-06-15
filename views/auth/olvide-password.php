<section class="seccion contenedor contenido-centrado">
    <h1>Olvide Password</h1>
    <p>Reestablezca su password escribiendo su email a continuación</p>

    <?php foreach ($campos_vacios as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" action="/olvide" method="POST">
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" name="Email" placeholder="Tu Email" />
        </div>

        <input type="submit" class="boton boton-verde" value="Enviar Instrucciones">
    </form>

    <div class="acciones">
        <a href="/login">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/register">¿Aún no tienes una cuenta? Crear Una</a>
    </div>