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


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $auto_id = $_POST['auto_id'];
        $auto_id = filter_var($auto_id, FILTER_VALIDATE_INT);

        if($auto_id){
        //Eliminar archivo
            $query = "SELECT imagen FROM autos WHERE auto_id = {$auto_id}";
            $resultado = mysqli_query($db, $query);
            $auto = mysqli_fetch_assoc($resultado);

            unlink('../../imagenes/' . $auto['imagen']);

        //Eliminar el auto
            $query = "DELETE FROM autos WHERE auto_id = {$auto_id}";
            $resultado = mysqli_query($db, $query);
        }

        if($resultado){
            header('Location: /miprimerauto/admin?resultado=3');
        }
        
    }

    //Incluye un template
    require '../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Administrador MiPrimerAuto</h1>
        <?php if(intval( $registrado ) === 1): ?>
                <p class="alerta exito"> Anuncio creado correctamente</p>
        <?php elseif(intval( $registrado ) === 2): ?>
                <p class="alerta exito"> Anuncio actualizado correctamente</p>   
        <?php endif; ?>
        <?php if(intval( $registrado ) === 3): ?>
                <p class="alerta exito"> Anuncio eliminado correctamente</p>   
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
                        <form method="POST" class="w-100">
                            <input type="hidden" name="auto_id" value="<?php echo $auto['auto_id']; ?>">


                            <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                        </form>

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