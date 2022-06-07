<?php 
    require 'includes/app.php';
    incluirTemplates('header');
?>
    <div class="video">
        <div class="overlay">
            <div class="contenedor contenido-video">
                <h2>LACOSTE</h2>
                <p>Nueva Coleccion</p>
            </div>
        </div>
        <video autoplay muted loop>
            <source src="build/img/tienda/video2.webm" type="video/webm" />
        </video>
    </div>
    <!--FIN VIDEO-->

    <section class="seccion contenedor">
        <h2>HOMBRE</h2>
        <div class="contenedor-anuncios">
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/tienda/camiseta1.webp" type="image/webp" />
                    <source srcset="build/img/tienda/camiseta1.jpg" type="image/jpeg" />
                    <img loading="lazy" src="build/img/tienda/camiseta1.jpg" alt="anuncio" />
                </picture>
                <div class="contenido-anuncio">
                    <h3>Camiseta Lacoste</h3>
                    <p class="precio">600$</p>
                    <a href="anuncios.php" class="boton-amarillo-block">Comprar</a>
                </div>
            </div>

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/tienda/chandal1.webp" type="image/webp" />
                    <source srcset="build/img/tienda/chandal1.jpg" type="image/jpeg" />
                    <img loading="lazy" src="build/img/tienda/chandal1.jpg" alt="anuncio" />
                </picture>
                <div class="contenido-anuncio">
                    <h3>Chandal Lacoste</h3>
                    <p class="precio">600$</p>
                    <a href="anuncios.php" class="boton-amarillo-block">Comprar</a>
                </div>
            </div>

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/tienda/sudadera1.webp" type="image/webp" />
                    <source srcset="build/img/tienda/sudadera1.jpg" type="image/jpeg" />
                    <img loading="lazy" src="build/img/tienda/sudadera1.jpg" alt="anuncio" />
                </picture>
                <div class="contenido-anuncio">
                    <h3>Sudadera Lacoste</h3>
                    <p class="precio">600$</p>

                    <a href="anuncios.php" class="boton-amarillo-block">Comprar</a>
                </div>
                <!---.contenido anuncio-->
            </div>
            <!---.anuncio-->
        </div>
        <!---.contenedor anuncios-->
        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver todas</a>
        </div>
    </section>
    <!--fin de la seccion HOMBRES-->

    <section class="seccion contenedor">
        <h2>MUJER</h2>
        <div class="contenedor-anuncios">
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/tienda/camiseta1.webp" type="image/webp" />
                    <source srcset="build/img/tienda/camiseta1.jpg" type="image/jpeg" />
                    <img loading="lazy" src="build/img/tienda/camiseta1.jpg" alt="anuncio" />
                </picture>
                <div class="contenido-anuncio">
                    <h3>Camiseta Lacoste</h3>
                    <p class="precio">600$</p>
                    <a href="anuncios.php" class="boton-amarillo-block">Comprar</a>
                </div>
            </div>

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/tienda/chandal1.webp" type="image/webp" />
                    <source srcset="build/img/tienda/chandal1.jpg" type="image/jpeg" />
                    <img loading="lazy" src="build/img/tienda/chandal1.jpg" alt="anuncio" />
                </picture>
                <div class="contenido-anuncio">
                    <h3>Chandal Lacoste</h3>
                    <p class="precio">600$</p>
                    <a href="anuncios.php" class="boton-amarillo-block">Comprar</a>
                </div>
            </div>

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/tienda/sudadera1.webp" type="image/webp" />
                    <source srcset="build/img/tienda/sudadera1.jpg" type="image/jpeg" />
                    <img loading="lazy" src="build/img/tienda/sudadera1.jpg" alt="anuncio" />
                </picture>
                <div class="contenido-anuncio">
                    <h3>Sudadera Lacoste</h3>
                    <p class="precio">600$</p>

                    <a href="anuncios.php" class="boton-amarillo-block">Comprar</a>
                </div>
                <!---.contenido anuncio-->
            </div>
            <!---.anuncio-->
        </div>
        <!---.contenedor anuncios-->
        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver todas</a>
        </div>
    </section>
    <!--fin de la seccion MUJERES-->

    <section class="imagen-contacto">
        <h2>Si no encuentras una talla contacta con nosotros</h2>
        <p>Rellena el formulario de contacto y dinos tu consulta</p>
        <a href="contacto.php" class="boton-amarillo">Contactanos</a>
    </section>
    <!--FIN CONTACTA PARA LA TALLA-->

    <section class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Comentarios</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/tienda/sudadera1.webp" type="image/webp" />
                        <source srcset="build/img/tienda/sudadera1.jpg" type="image/jpeg" />
                        <img loading="lazy" src="build/img/tienda/sudadera1.jpg" alt="Imagen prueba" />
                    </picture>
                </div>

                <div class="texto-blog">
                    <a href="anuncios.php">
                        <h4>Muy recomendable</h4>
                        <p>Escrito el: <span>04/10/2022</span> por: <span>Admin</span></p>
                        <p>Camiseta muy bonita, muy buena calidad</p>
                    </a>
                </div>
            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/tienda/camiseta1.webp" type="image/webp" />
                        <source srcset="build/img/tienda/camiseta1.jpg" type="image/jpeg" />
                        <img loading="lazy" src="build/img/tienda/camiseta1.jpg" alt="Imagen prueba" />
                    </picture>
                </div>

                <div class="texto-blog">
                    <a href="anuncios.php">
                        <h4>Calidad excelente</h4>
                        <p>
                            Escrito el: <span>10/12/2021</span> por: <span>Juan Lopez</span>
                        </p>
                        <p>Muy rapido y muy buena calidad</p>
                    </a>
                </div>
            </article>
        </section>
    </section>
    <!--FIN SECCION COMENTARIOS-->
    
    <?php incluirTemplates('footer'); ?>