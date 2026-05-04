<?php 
    require 'miprimerauto/includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">

        <h2>Autos en venta</h2>
        
        <?php
            $limite = 10;
            include 'miprimerauto/includes/templates/anuncios.php';
        ?>

    </main>

<?php 
    incluirTemplate('footer');
?>