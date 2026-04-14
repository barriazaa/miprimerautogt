<?php 
    require 'miprimerauto/includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Auto</h1>

        <picture>
            <source srcset="miprimerauto/build/img/anuncio1mpa.webp" type="image/webp">
            <source srcset="miprimerauto/build/img/anuncio1mpa.jpg" type="image/jpeg">
            <img loading="lazy" src="miprimerauto/build/img/anuncio1mpa.jpeg" alt="imagen anuncio">
        </picture>

        <div class="resumen-auto">
            <p class="precio">Q.xx,xxx.xx</p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="miprimerauto/build/img/icono1mpa.png" alt="icono1mpa">
                            <p>x</p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="miprimerauto/build/img/icono2mpa.png" alt="icono2mpa">
                            <p>x</p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="miprimerauto/build/img/icono4mpa.png" alt="icono4mpa">
                            <p>x</p>
                    </li>
                </ul>

            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Ullam rerum voluptatem delectus libero rem similique illum 
                laborum voluptatum pariatur debitis? Odit inventore, in illum 
                itaque perspiciatis molestiae! Aperiam, autem! Fuga?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Nisi id inventore fuga similique dolor eveniet illo voluptatum 
                ad vitae molestiae iusto, saepe itaque, voluptas est, maxime 
                odio modi! Consequuntur, dolore.
            </p>
                        <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Ullam rerum voluptatem delectus libero rem similique illum 
                laborum voluptatum pariatur debitis? Odit inventore, in illum 
                itaque perspiciatis molestiae! Aperiam, autem! Fuga?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Nisi id inventore fuga similique dolor eveniet illo voluptatum 
                ad vitae molestiae iusto, saepe itaque, voluptas est, maxime 
                odio modi! Consequuntur, dolore.
            </p>
        </div>
    </main>

<?php 
    incluirTemplate('footer');
?>