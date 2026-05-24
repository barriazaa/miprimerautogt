<?php 
    require '../includes/funciones.php';
    $auth = estaAutenticado();
        if(!$auth) {
            header ('Location: /');
        }

    // Importamos la conexion
    require '../includes/config/database.php';
    $db = conectarDB();
    
    // Consultar las bitácoras, ordenadas por la fecha más reciente primero
    $query = "SELECT * FROM bitacoras ORDER BY fecha DESC";
    $resultadoConsulta = mysqli_query($db, $query);

    // Incluye el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Bitácora de Movimientos</h1>

        <!-- Botón para regresar al panel principal -->
        <a href="/miprimerauto/admin" class="boton boton-verde">Volver</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID Log</th>
                    <th>Acción Realizada</th>
                    <th>ID del Auto Afectado</th>
                    <th>Fecha y Hora</th>
                </tr>
            </thead>

            <tbody>
                <?php while($bitacora = mysqli_fetch_assoc($resultadoConsulta)): ?>
                <tr>
                    <td><?php echo $bitacora['id']; ?></td>
                    <td>
                        <!-- Pintamos el texto dependiendo de la acción para identificarlo más rápido -->
                        <span style="font-weight: bold; color: <?php echo $bitacora['accion'] === 'Eliminado' ? '#dc2626' : ($bitacora['accion'] === 'Actualizado' ? '#ca8a04' : '#16a34a'); ?>;">
                            <?php echo $bitacora['accion']; ?>
                        </span>
                    </td>
                    <td><?php echo $bitacora['auto_id']; ?></td>
                    <td><?php echo $bitacora['fecha']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table> 
    </main>

<?php 
    mysqli_close($db);
    incluirTemplate('footer');
?>