<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($campos_vacios as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <?php include __DIR__ . '/formulario.php'; ?>
    <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    
    <a href="/register" class="boton boton-verde">Registrar nueva cuenta</a>
</main>