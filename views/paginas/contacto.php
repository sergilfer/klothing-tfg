<?php 
    require 'includes/app.php';
    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture>
            <source srcset="build/img/tienda/camiseta1.webp" type="image/webp" />
            <source srcset="build/img/tienda/camiseta1.jpg" type="image/jpeg" />
            <img loading="lazy" src="build/img/tienda/camiseta1.jpg" alt="Imagen prueba" />
        </picture>
        <h2>Rellene el formulario</h2>

        <form class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Introduce el nombre" id="nombre">

                <label for="email">E-mail</label>
                <input type="email" placeholder="Introduce el email" id="email">

                <label for="telefono">Telefono</label>
                <input type="tel" placeholder="Introduce el telefono" id="telefono">

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Seleccione la talla que desea consultar</legend>

                <label for="opciones">Tallas</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccion una talla --</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>

                <label for="marca">Marca:</label>
                <input type="text" id="marca" placeholder="Introduce el nombre de la marca">

                <label for="modelo">Modelo</label>
                <input type="text" placeholder="Introduce el modelo" id="modelo">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Seleccione la forma de contacto</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input name="contacto" type="radio" value="telefono" id="telefono">
                    <label for="contactar-email">Email</label>
                    <input name="contacto" type="radio" value="email" id="email">
                </div>
                <p>Elija una hora preferente para ser llamado</p>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">

                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="10:00" max="21:30">
                </div>
            </fieldset>
            
            <div class="alinear-derecha">
            <input type="submit" value="Enviar" class="boton-verde">
            </div>
        </form>
    </main>
    <?php incluirTemplates('footer'); ?>