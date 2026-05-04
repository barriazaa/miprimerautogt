<?php
    //Importar conexion
    require 'miprimerauto/includes/config/database.php';
    $db = conectarDB();

    //consultar
    $query = "SELECT * FROM autos LIMIT {$limite}";

    //obtener resultados
    $resultado = mysqli_query($db, $query);

?>
        
        <div class="contenedor-anuncios">
            <?php while($autos = mysqli_fetch_assoc($resultado)): ?>
            <div class="anuncio">

                    <img loading="lazy" src="/imagenes/<?php echo $autos['imagen']; ?>" alt="anuncio">
                

                <div class="contenido-anuncio">
                    <h3><?php echo $autos['auto']; ?></h3>
                    <p><?php echo $autos['descripcion']; ?></p>
                    <p class="precio"><?php echo $autos['precio']; ?></p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="miprimerauto/build/img/icono1mpa.png" alt="icono1mpa">
                            <p><?php echo $autos['puertas']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="miprimerauto/build/img/icono2mpa.png" alt="icono2mpa">
                            <p><?php echo $autos['cilindros']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="miprimerauto/build/img/icono4mpa.png" alt="icono4mpa">
                            <p><?php echo $autos['litros']; ?></p>
                        </li>
                    </ul>

                    <a href="anuncio.php?id=<?php echo $autos['auto_id']; ?>" class="boton boton-amarillo-block">
                        Ver auto
                    </a>
                </div><!-- .contenido-anuncio  -->
            </div><!-- .anuncio -->
            <?php endwhile; ?>
        </div><!-- .contenedor-anuncios -->

<?php
//Cerrar conexion
mysqli_close($db);

?>