<?php 

    $registrado = $_GET['registrado'] ?? null;

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

            <tbody>
                <tr>
                    <td>1</td>
                    <td>Mistubishi L200</td>
                    <td>120000</td>
                    <td><img src="../../imagenes/bfeee553282d63644762efbf84b2a3c5.jpg" class="imagen-tabla"></td>
                    <td>4</td>
                    <td>4</td>
                    <td>2.8</td>
                    <td>2026-04-12</td>
                    <td>
                        <a href="#" class="boton boton-rojo-block">Eliminar</a>
                        <a href="#" class="boton boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            </tbody>
        </table> 
    </main>

<?php 
    incluirTemplate('footer');
?>