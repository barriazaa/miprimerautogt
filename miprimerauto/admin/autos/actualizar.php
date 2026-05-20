<?php 
    require '../../includes/funciones.php';
    $auth = estaAutenticado();
        if(!$auth) {
            header ('Location: /');
        }




    //Validar la URL por id valido
    $auto_id = $_GET['auto_id'];
    $auto_id = filter_var($auto_id, FILTER_VALIDATE_INT);

    if(!$auto_id){
        header('Location: ../admin');
    }

//Base de datos
require '../../includes/config/database.php';
 $db = conectarDB();

 //Obtener datos del auto.
 $consulta = "SELECT * FROM autos WHERE auto_id = {$auto_id}";
 $resultado = mysqli_query($db, $consulta);
 $autos = mysqli_fetch_assoc($resultado);
 
 //echo"<pre>";
 //var_dump($autos);
 //echo"</pre>";

 //Consultar para obtener los catálogos
 $resultadoVendedores = mysqli_query($db, "SELECT * FROM vendedores");
 $resultadoModelos = mysqli_query($db, "SELECT m.id, m.nombre as modelo, ma.nombre as marca FROM modelos m INNER JOIN marcas ma ON m.marca_id = ma.id");
 $resultadoTipos = mysqli_query($db, "SELECT * FROM tipos_vehiculo");
 $resultadoCombustibles = mysqli_query($db, "SELECT * FROM combustibles");
 $resultadoTransmisiones = mysqli_query($db, "SELECT * FROM transmisiones");
 $resultadoTracciones = mysqli_query($db, "SELECT * FROM tracciones");
 $resultadoColoresExt = mysqli_query($db, "SELECT * FROM colores");
 $resultadoColoresInt = mysqli_query($db, "SELECT * FROM colores");
 $resultadoEstados = mysqli_query($db, "SELECT * FROM estados_titulo");

 //Arreglo con mensajes de errores
$errores = [];

    $modelo_id = $autos['modelo_id'];
    $tipo_vehiculo_id = $autos['tipo_vehiculo_id'];
    $combustible_id = $autos['combustible_id'];
    $transmision_id = $autos['transmision_id'];
    $traccion_id = $autos['traccion_id'];
    $color_exterior_id = $autos['color_exterior_id'];
    $color_interior_id = $autos['color_interior_id'];
    $estado_titulo_id = $autos['estado_titulo_id'];
    $año = $autos['año'];
    $millaje = $autos['millaje'];
    $precio = $autos['precio'];
    $descripcion = $autos['descripcion'];
    $puertas = $autos['puertas'];
    $cilindros = $autos['cilindros'];
    $litros = $autos['litros'];
    $ingresado = $autos['ingresado'];
    $vendedores_vendedor_id = $autos['vendedores_vendedor_id'];
    $imagen = $autos['imagen'];

//Ejecuta el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";
    //exit;

    $modelo_id = mysqli_real_escape_string($db, $_POST['modelo_id']);
    $tipo_vehiculo_id = mysqli_real_escape_string($db, $_POST['tipo_vehiculo_id']);
    $combustible_id = mysqli_real_escape_string($db, $_POST['combustible_id']);
    $transmision_id = mysqli_real_escape_string($db, $_POST['transmision_id']);
    $traccion_id = mysqli_real_escape_string($db, $_POST['traccion_id']);
    $color_exterior_id = mysqli_real_escape_string($db, $_POST['color_exterior_id']);
    $color_interior_id = mysqli_real_escape_string($db, $_POST['color_interior_id']);
    $estado_titulo_id = mysqli_real_escape_string($db, $_POST['estado_titulo_id']);
    $año = mysqli_real_escape_string($db, $_POST['año']);
    $millaje = mysqli_real_escape_string($db, $_POST['millaje']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $puertas = mysqli_real_escape_string($db, $_POST['puertas']);
    $cilindros = mysqli_real_escape_string($db, $_POST['cilindros']);
    $litros = mysqli_real_escape_string($db, $_POST['litros']);
    $ingresado = $_POST['ingresado'];
    $vendedores_vendedor_id = mysqli_real_escape_string($db, $_POST['vendedores_vendedor_id']);

    //Asignar files hacia una variable
    $imagen = $_FILES['imagen'];


    if(!$modelo_id){
        $errores[] = "Debes seleccionar un modelo";
    }
    if(!$año){
        $errores[] = "Debes añadir el año";
    }
    if(!$precio){
        $errores[] = "Debes añadir un precio";
    }
    if(strlen( $descripcion ) < 50){
        $errores[] = "La descripcion debe tener al menos 50 caracteres";
    }
    if(!$puertas){
        $errores[] = "Debes añadir el número de puertas";
    }
    if(!$cilindros){
        $errores[] = "Debes añadir el número de cilindros";
    }
    if(!$litros){
        $errores[] = "Debes añadir el número de litros";
    }
    //if(!$ingresado){
    //    //$errores[] = "Debes añadir la fecha de ingreso";
    //}
    if(!$vendedores_vendedor_id){
        $errores[] = "Debes seleccionar un vendedor";
    }
    //if(!$imagen['name'] || $imagen['error'] ){
    //    $errores[] = "La imagen es obligatoria";
    //}


    //Validar por tamaño
    $medida = 1000 * 1000;
    if($imagen['size'] > $medida){
        $errores[] = "La imagen es muy pesada";
    }

    //echo "<pre>";
    //var_dump($errores);
    //echo "</pre>";
 
    //Revisar que el arreglo de errores este vacio

    if(empty($errores)){

            //Crear Carpeta
        $carpetaImagenes = '../../../imagenes/';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }
        $nombreImagen = '';

        //Subida de archivos
        if($imagen['name']){
            //Eliminar la imagen previa
            unlink($carpetaImagenes . $autos['imagen']);
                    
        //Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
        //Subir Imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
        }else {
            $nombreImagen = $autos['imagen'];
        }
            

        //imagen = '{$nombreImagen}'
        //ingresado = {$ingresado}
        //Actualizar en la base de datos
        $query = "UPDATE autos SET modelo_id = '{$modelo_id}', tipo_vehiculo_id = '{$tipo_vehiculo_id}', combustible_id = '{$combustible_id}', transmision_id = '{$transmision_id}', traccion_id = '{$traccion_id}', color_exterior_id = '{$color_exterior_id}', color_interior_id = '{$color_interior_id}', estado_titulo_id = '{$estado_titulo_id}', año = '{$año}', millaje = '{$millaje}', precio = {$precio}, imagen = '{$nombreImagen}', 
        descripcion = '{$descripcion}', puertas = {$puertas}, cilindros = {$cilindros}, 
        litros = {$litros}, vendedores_vendedor_id = {$vendedores_vendedor_id} 
        WHERE auto_id = {$auto_id}";

        //$query = "INSERT INTO autos (auto, precio, imagen, descripcion, puertas, cilindros, litros,
        //ingresado, vendedores_vendedor_id) 
        //VALUES ('$auto', '$precio', '$nombreImagen', '$descripcion', '$puertas','$cilindros', '$litros', '$ingresado',
        //'$vendedores_vendedor_id')";

        //echo $query;


        $resultado = mysqli_query($db, $query);

        if($resultado){
            //Redireccionar al usuario

            header('Location: /miprimerauto/admin?registrado=2');
        }
    }


}



    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar Auto</h1>

        <a href="/miprimerauto/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype ="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="modelo_id">Modelo:</label>
                <select name="modelo_id" id="modelo_id">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultadoModelos)): ?>
                        <option <?php echo $modelo_id == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['marca'] . " - " . $row['modelo']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="año">Año:</label>
                <input type="number" id="año" name="año" placeholder="Ej: 2020" min="1900" max="<?php echo date('Y') + 1; ?>" value="<?php echo $año; ?>">

                <label for="millaje">Millaje:</label>
                <input type="number" id="millaje" name="millaje" placeholder="Ej: 50000" min="0" value="<?php echo $millaje; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id= "precio" name="precio" placeholder="Precio del Auto" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id= "imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagen; ?>" class="imagen-small" >

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Especificaciones Técnicas y Visuales</legend>

                <label for="tipo_vehiculo_id">Tipo de Vehículo:</label>
                <select name="tipo_vehiculo_id" id="tipo_vehiculo_id">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultadoTipos)): ?>
                        <option <?php echo $tipo_vehiculo_id == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="combustible_id">Combustible:</label>
                <select name="combustible_id" id="combustible_id">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultadoCombustibles)): ?>
                        <option <?php echo $combustible_id == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="transmision_id">Transmisión:</label>
                <select name="transmision_id" id="transmision_id">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultadoTransmisiones)): ?>
                        <option <?php echo $transmision_id == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="traccion_id">Tracción:</label>
                <select name="traccion_id" id="traccion_id">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultadoTracciones)): ?>
                        <option <?php echo $traccion_id == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="color_exterior_id">Color Exterior:</label>
                <select name="color_exterior_id" id="color_exterior_id">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultadoColoresExt)): ?>
                        <option <?php echo $color_exterior_id == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="color_interior_id">Color Interior:</label>
                <select name="color_interior_id" id="color_interior_id">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultadoColoresInt)): ?>
                        <option <?php echo $color_interior_id == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="estado_titulo_id">Estado del Título:</label>
                <select name="estado_titulo_id" id="estado_titulo_id">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultadoEstados)): ?>
                        <option <?php echo $estado_titulo_id == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <fieldset>
                <legend>Informacion del Auto</legend>

                <label for="puertas">Puertas:</label>
                <input type="number" id= "puertas" name="puertas" placeholder="Ej: 4" min="1" max="10"
                 value="<?php echo $puertas; ?>">

                <label for="cilindros">Cilindros:</label>
                <input type="number" id= "cilindros" name="cilindros" placeholder="Ej: 4" min="1" max="12" 
                 value="<?php echo $cilindros; ?>">

                <label for="litros">Litros:</label>
                <input type="number" id= "litros" name="litros" placeholder="Ej: 4" min="1" max="20" step="0.1" 
                 value="<?php echo $litros; ?>">

                <label for="ingresado">Ingreso:</label>
                <input type="date" id= "ingresado" name="ingresado" placeholder="Ej: 01-01-2026" 
                 value="<?php echo $ingresado; ?>">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedores_vendedor_id">
                    <option value="">--Seleccione--</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultadoVendedores) ): ?>
                        <option  <?php echo $vendedores_vendedor_id === $vendedor['vendedor_id'] ? 'selected' : ''; ?>  value="<?php echo $vendedor['vendedor_id']; ?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?> </option>

                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Auto" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>