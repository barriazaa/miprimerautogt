<?php 

    //Importamos la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    
    //Escribir el Query
    $query = "SELECT * FROM autos";


    //Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);


    //Muestra mensaje condicional
    $registrado = $_GET['registrado'] ?? null;

    //Incluye un template
    require '../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador MiPrimerAuto</h1>
        <?php if(intval( $registrado ) === 1): ?>
                <p class="alerta exito"> Anuncio creado correctamente</p>
        <?php endif; ?>

        <a href="/miprimerauto/admin/autos/crear.php" class="boton boton-verde">Nuevo Auto</a>


        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Auto</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>puertas</th>
                    <th>cilindros</th>
                    <th>litros</th>
                    <th>ingreso</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>  <!--. Mostrar los resultados .-->
                <?php while($auto = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td><?php echo $auto['auto_id']; ?></td>
                    <td><?php echo $auto['auto']; ?></td>
                    <td><?php echo $auto['precio']; ?></td>
                    <td><img src="../../imagenes/<?php echo $auto['imagen']; ?>" class="imagen-tabla"></td>
                    <td><?php echo $auto['puertas']; ?></td>
                    <td><?php echo $auto['cilindros']; ?></td>
                    <td><?php echo $auto['litros']; ?></td>
                    <td><?php echo $auto['ingresado']; ?></td>
                    <td>
                        <a href="#" class="boton boton-rojo-block">Eliminar</a>
                        <a href="../../miprimerauto/admin/autos/actualizar.php?auto_id=<?php echo $auto['auto_id']; ?>" class="boton boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table> 
    </main>

<?php 

        //Cerrar la conexion
        mysqli_close($db);

    incluirTemplate('footer');
?>