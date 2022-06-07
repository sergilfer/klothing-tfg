<?php 
    require 'includes/app.php';
    incluirTemplates('header');
?>
    <main class="contenedor seccion">
        <h1>Comentarios</h1>
    </main>

    <section class="contenedor seccion seccion-inferior">
        <section class="blog">
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/tienda/gucci/camiseta.webp" type="image/webp" />
                        <source srcset="build/img/tienda/gucci/camiseta.jpg" type="image/jpeg" />
                        <img loading="lazy" src="build/img/tienda/gucci/camiseta.jpg" alt="Camiseta Gucci" />
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
                        <source srcset="build/img/tienda/lacoste/camiseta1.webp" type="image/webp" />
                        <source srcset="build/img/tienda/lacoste/camiseta1.jpg" type="image/jpeg" />
                        <img loading="lazy" src="build/img/tienda/lacoste/camiseta1.jpg" alt="Imagen prueba" />
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
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/tienda/lacoste/sudadera1.webp" type="image/webp" />
                        <source srcset="build/img/tienda/lacoste/sudadera1.png" type="image/png" />
                        <img loading="lazy" src="build/img/tienda/lacoste/sudadera1.png" alt="Imagen prueba" />
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
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/tienda/gucci/sudadera.webp" type="image/webp" />
                        <source srcset="build/img/tienda/gucci/sudadera.jpg" type="image/jpeg" />
                        <img loading="lazy" src="build/img/tienda/gucci/sudadera.jpg" alt="Imagen prueba" />
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