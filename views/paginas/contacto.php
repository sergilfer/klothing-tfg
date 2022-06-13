    <main class="contenedor seccion">

    <?php if ($mensaje){ ?>
        <p class="alerta exito"><?php echo $mensaje ?></p>
        <?php } ?>
        <picture>
            <source srcset="build/img/items/Contactoweb.webp" type="image/webp" />
            <source srcset="build/img/items/Contactoweb.jpg" type="image/jpeg" />
            <img loading="lazy" src="build/img/items/Contactoweb.jpg" alt="Imagen prueba" />
        </picture>
        <h2>Rellene el formulario</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Introduce el nombre" id="nombre" name="nombre" required>

                <label for="email">E-mail</label>
                <input type="email" placeholder="Introduce el email" id="email" name="email" require>

                <label for="telefono">Telefono</label>
                <input type="tel" placeholder="Introduce el telefono" id="telefono" name="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="mensaje" require></textarea>
            </fieldset>

            <fieldset>
                <legend>Seleccione la talla que desea consultar</legend>

                <label for="opciones">Tallas</label>
                <select id="opciones" name="tallas" require>
                    <option value="" disabled selected>-- Seleccion una talla --</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XL">XXL</option>
                </select>

                <label for="marca">Marca:</label>
                <input type="text" id="marca" placeholder="Introduce el nombre de la marca" name="marca" require>
            </fieldset>

            <fieldset>
                <legend>Formas de contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <div id="contacto">

                </div>


            </fieldset>

            <div class="alinear-derecha">
                <input type="submit" value="Enviar" class="boton-verde">
            </div>
        </form>
    </main>