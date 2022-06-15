<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($campos_vacios as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form  class="formulario" action="/login" method="POST">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="Email" placeholder="Introduce un Email" id="email">

            <label for="password">Password</label>
            <input type="password" name="Password" placeholder="Introduzca su Password" id="password">
        </fieldset>

        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">

        <div class="acciones">
            <a href="/register"> ¿No tienes cuenta? Registrate</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
</main>