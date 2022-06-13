<main class="contenedor seccion contenido-centrado">
    <h1>Registrar Usuario</h1>

    <?php foreach ($campos_vacios as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <?php include __DIR__ . '/formulario.php'; ?>

    <input type="submit" value="Registrarse" class="boton boton-verde">
    
    </form>
</main>