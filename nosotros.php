<?php 
    require 'miprimerauto/includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Conoce sobre nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="miprimerauto/build/img/nosotrosmpa1.webp" type="image/webp">
                    <source srcset="miprimerauto/build/img/nosotrosmpa1.PNG" type="image/PNG">
                    <img loading="lazy" src="miprimerauto/build/img/nosotrosmpa1.PNG" alt="Sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    xx años de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Possimus nobis, a corrupti mollitia quidem assumenda. Iste 
                    consequatur esse necessitatibus commodi minus voluptatibus 
                    id error officiis iusto assumenda doloremque, earum quibusdam.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam 
                    umque laborum fuga neque non doloribus? Quae, impedit id quisquam 
                    maiores dolorum consequuntur nam nesciunt cum voluptas a, 
                    quam saepe soluta.
                </p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero, 
                    nulla explicabo. Libero a, molestias impedit repudiandae voluptatum 
                    ratione quasi distinctio consequuntur omnis nostrum eius delectus, 
                    ab praesentium nesciunt, quis similique?
                </p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
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
    </section>

<?php 
    incluirTemplate('footer');
?>