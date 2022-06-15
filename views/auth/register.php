<main class="contenedor seccion contenido-centrado">
    <h1>Registrar Usuario</h1>

    <?php foreach ($campos_vacios as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/register">
        <fieldset>
            <legend>Rellene los datos</legend>

            <label for="nombre">Nombre</label>
            <input type="nombre" name="Nombre" placeholder="Introduce un nombre" id="nombre" value="<?php echo cleanCode($usuario->Nombre); ?>">

            <label for="apellidos">Apellidos</label>
            <input type="apellidos" name="Apellidos" placeholder="Introduce los apellidos" id="apellidos" value="<?php echo cleanCode($usuario->Apellidos); ?>">

            <label for="telefono">Telefono</label>
            <input type="telefono" name="Telefono" placeholder="Introduce tu telefono" id="telefono" value="<?php echo cleanCode($usuario->Telefono); ?>">

            <label for="email">E-mail</label>
            <input type="email" name="Email" placeholder="Tu Email" id="email" value="<?php echo cleanCode($usuario->Email); ?>">

            <label for="password">Password</label>
            <input type="password" name="Password" placeholder="Tu Password" id="password" value="<?php echo cleanCode($usuario->Password); ?>">
        </fieldset>

        <input type="submit" value="Crear Cuenta" class="boton boton-verde">

    </form>
</main>