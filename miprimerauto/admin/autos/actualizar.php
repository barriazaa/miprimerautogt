<?php 
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
 
 echo"<pre>";
 var_dump($autos);
 echo"</pre>";

 //Consultar para obtener los vendedores
 $consulta = "SELECT * FROM vendedores";
 $resultado = mysqli_query($db, $consulta);

 //Arreglo con mensajes de errores
$errores = [];

    $auto = $autos['auto'];
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

    $auto = mysqli_real_escape_string($db, $_POST['auto']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $puertas = mysqli_real_escape_string($db, $_POST['puertas']);
    $cilindros = mysqli_real_escape_string($db, $_POST['cilindros']);
    $litros = mysqli_real_escape_string($db, $_POST['litros']);
    $ingresado = $_POST['ingresado'];
    $vendedores_vendedor_id = mysqli_real_escape_string($db, $_POST['vendedores_vendedor_id']);

    //Asignar files hacia una variable
    $imagen = $_FILES['imagen'];


    if(!$auto){
        $errores[] = "Debes añadir un auto";
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
    if(!$ingresado){
        $errores[] = "Debes añadir la fecha de ingreso";
    }
    if(!$vendedores_vendedor_id){
        $errores[] = "Debes seleccionar un vendedor";
    }
    if(!$imagen['name'] || $imagen['error'] ){
        $errores[] = "La imagen es obligatoria";
    }

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


        //Subida de archivos

        
        //Crear Carpeta
        $carpetaImagenes = '../../../imagenes/';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        //Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        
        //Subir Imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );



        //Insertar en la base de datos
        $query = "INSERT INTO autos (auto, precio, imagen, descripcion, puertas, cilindros, litros,
        ingresado, vendedores_vendedor_id) 
        VALUES ('$auto', '$precio', '$nombreImagen', '$descripcion', '$puertas','$cilindros', '$litros', '$ingresado',
        '$vendedores_vendedor_id')";

        //echo $query;

        $resultado = mysqli_query($db, $query);

        if($resultado){
            //Redireccionar al usuario

            header('Location: /miprimerauto/admin?registrado=1');
        }
    }


}



    require '../../includes/funciones.php';
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

        <form class="formulario" method="POST" action="/miprimerauto/admin/autos/crear.php" enctype ="multipart/form-data">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="auto">Auto:</label>
                <input type="text" id= "auto" name="auto" placeholder="Auto tipo" value="<?php echo $auto; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id= "precio" name="precio" placeholder="Precio del Auto" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id= "imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagen; ?>" class="imagen-small" >

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
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
                    <?php while($vendedor = mysqli_fetch_assoc($resultado) ): ?>
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