<?php 

    require 'miprimerauto/includes/funciones.php';

    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="miprimerauto/build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Modi voluptate aliquid rem, molestiae repellendus rerum 
                    quos non facere ipsam cumque neque saepe consequuntur culpa 
                    earum velit voluptas magni. Magnam, praesentium.</p>
            </div>
        
            <div class="icono">
                <img src="miprimerauto/build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Modi voluptate aliquid rem, molestiae repellendus rerum 
                    quos non facere ipsam cumque neque saepe consequuntur culpa 
                    earum velit voluptas magni. Magnam, praesentium.</p>
            </div>
         
            <div class="icono">
                <img src="miprimerauto/build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>A  Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Modi voluptate aliquid rem, molestiae repellendus rerum 
                    quos non facere ipsam cumque neque saepe consequuntur culpa 
                    earum velit voluptas magni. Magnam, praesentium.</p>
            </div>
        </div>
    </main>

    <section class="seccion contenedor">
        <h2>Autos en venta</h2>

        <?php
            $limite = 3;
            include 'miprimerauto/includes/templates/anuncios.php';
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton boton-verde">Ver todos</a>
        </div>
    </section>

<section class="imagen-contacto">
    <h2>Encuentra tu primer auto</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    <a href="contacto.php" class="boton boton-amarillo">Contactanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Ingresos</h3>

        <article class="entreda-blog">
            <div class="imagen">
                <picture>
                    <source srcset="miprimerauto/build/img/blog1mpa.webp" type="image/webp">
                    <source srcset="miprimerauto/build/img/blog1mpa.jpg" type="image/jpeg">
                    <img loading="lazy" src="miprimerauto/build/img/blog1mpa.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Proximo ingreso</h4>
                    <p class="informacion-meta">Escrito el: <span>06/04/2026</span>por: <span>Admin</span> </p>

                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Libero vel ipsa cum. Magnam eos quaerat tenetur voluptatum 
                        iste blanditiis consequatur placeat eveniet voluptatem dolorum 
                        asperiores rem, suscipit cupiditate! Blanditiis, officia!
                    </p>
                </a>
            </div>

        </article>


                <article class="entreda-blog">
            <div class="imagen">
                <picture>
                    <source srcset="miprimerauto/build/img/blog2mpa.webp" type="image/webp">
                     <source srcset="miprimerauto/build/img/blog2mpa.jpg" type="image/jpeg">
                        <img loading="lazy" src="miprimerauto/build/img/blog2mpa.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Proximo ingreso</h4>
                    <p class="informacion-meta">Escrito el: <span>06/04/2026</span>por: <span>Admin</span> </p>

                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Libero vel ipsa cum. Magnam eos quaerat tenetur voluptatum 
                        iste blanditiis consequatur placeat eveniet voluptatem dolorum 
                        asperiores rem, suscipit cupiditate! Blanditiis, officia!
                    </p>
                </a>
            </div>

        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
                Impedit eum vero quia similique qui fugit nemo tempora quisquam 
                explicabo repudiandae ullam, reprehenderit illo laboriosam laudantium. 
                Laboriosam recusandae nihil eos veniam. 
            </blockquote>
            <p>- XX</p>
        </div>
    </section>
</div>

<?php 
    incluirTemplate('footer');
?>