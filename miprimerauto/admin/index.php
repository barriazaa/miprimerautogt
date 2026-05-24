<?php 
    require '../includes/funciones.php';
    $auth = estaAutenticado();
        if(!$auth) {
            header ('Location: /');
        }


    //Importamos la conexion
    require '../includes/config/database.php';
    $db = conectarDB();

    // Generar Respaldo (Backup)
    if (isset($_GET['accion']) && $_GET['accion'] === 'backup') {
        $tables = array();
        $result = mysqli_query($db, "SHOW TABLES");
        while($row = mysqli_fetch_row($result)){
            $tables[] = $row[0];
        }

        $sqlScript = "-- Respaldo de la Base de Datos MiPrimerAuto\n";
        $sqlScript .= "-- Fecha: " . date('Y-m-d H:i:s') . "\n\n";
        $sqlScript .= "SET FOREIGN_KEY_CHECKS=0;\n\n"; // Evita errores de llaves foraneas al restaurar

        foreach($tables as $table){
            $result = mysqli_query($db, "SELECT * FROM `$table`");
            $numField = mysqli_num_fields($result);

            $sqlScript .= "DROP TABLE IF EXISTS `$table`;\n";
            $row2 = mysqli_fetch_row(mysqli_query($db, "SHOW CREATE TABLE `$table`"));
            $sqlScript .= "\n".$row2[1].";\n\n";

            while($row = mysqli_fetch_row($result)){
                $sqlScript .= "INSERT INTO `$table` VALUES(";
                for($j = 0; $j < $numField; $j++){
                    if (isset($row[$j])) {
                        $escaped = mysqli_real_escape_string($db, $row[$j]);
                        $sqlScript .= '"' . $escaped . '"';
                    } else {
                        $sqlScript .= 'NULL';
                    }
                    if ($j < ($numField-1)) {
                        $sqlScript .= ',';
                    }
                }
                $sqlScript .= ");\n";
            }
            $sqlScript .= "\n";
        }
        
        $sqlScript .= "SET FOREIGN_KEY_CHECKS=1;\n";

        $backup_file_name = 'respaldo_miprimerauto_' . date('Y-m-d_H-i-s') . '.sql';
        header('Content-Type: application/x-sql');
        header('Content-Disposition: attachment; filename=' . $backup_file_name);
        echo $sqlScript;
        exit;
    }
    
    //Escribir el Query
    $query = "SELECT a.*, m.nombre as modelo, ma.nombre as marca FROM autos a LEFT JOIN modelos m ON a.modelo_id = m.id LEFT JOIN marcas ma ON m.marca_id = ma.id";


    //Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);


    //Muestra mensaje condicional
    $registrado = $_GET['registrado'] ?? null;


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $auto_id = $_POST['auto_id'];
        $auto_id = filter_var($auto_id, FILTER_VALIDATE_INT);

        if($auto_id){
            //Obtener el nombre del archivo de imagen antes de borrar el registro
            $query = "SELECT imagen FROM autos WHERE auto_id = {$auto_id}";
            $resultado = mysqli_query($db, $query);
            $auto = mysqli_fetch_assoc($resultado);

            // 1. Iniciar transacción
            mysqli_begin_transaction($db);

            try {
                // 2. Eliminar el auto de la base de datos
                $queryDelete = "DELETE FROM autos WHERE auto_id = {$auto_id}";
                $resultadoDelete = mysqli_query($db, $queryDelete);
                if(!$resultadoDelete) throw new Exception("Error eliminando el auto");

                // 3. Registrar la eliminación en la bitácora
                $queryLog = "INSERT INTO bitacoras (accion, auto_id, fecha) VALUES ('Eliminado', {$auto_id}, NOW())";
                mysqli_query($db, $queryLog);

                // 4. Guardar cambios en la BD (Commit)
                mysqli_commit($db);

                // 5. ¡AQUÍ borramos la imagen real! Solo si la BD hizo Commit con éxito
                unlink('../../imagenes/' . $auto['imagen']);
                header('Location: /miprimerauto/admin?registrado=3');
            } catch (Exception $e) {
                // Si algo falla, revertimos y evitamos perder el auto (Rollback)
                mysqli_rollback($db);
            }
        }
        
    }

    //Incluye un template
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
        <a href="/miprimerauto/admin/index.php?accion=backup" class="boton boton-amarillo">Descargar Respaldo (SQL)</a>
        <a href="/miprimerauto/admin/bitacoras.php" class="boton boton-amarillo">Ver Bitácoras</a>


        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vehículo</th>
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
                    <td><?php echo $auto['marca'] . " " . $auto['modelo'] . " (" . $auto['año'] . ")"; ?></td>
                    <td>Q <?php echo number_format($auto['precio'], 2); ?></td>
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