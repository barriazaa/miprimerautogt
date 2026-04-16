<?php 
//Base de datos

require '../../includes/config/database.php';
 $db = conectarDB();

 //Arreglo con mensajes de errores
$errores = [];

    $auto = '';
    $precio = '';
    $descripcion = '';
    $puertas = '';
    $cilindros = '';
    $litros = '';
    $ingresado = '';
    $vendedores_vendedor_id = '';

//Ejecuta el codigo despues de que el usuario envia el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";

    $auto = $_POST['auto'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $puertas = $_POST['puertas'];
    $cilindros = $_POST['cilindros'];
    $litros = $_POST['litros'];
    $ingresado = $_POST['ingresado'];
    $vendedores_vendedor_id = $_POST['vendedores_vendedor_id'];

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

    //echo "<pre>";
    //var_dump($errores);
    //echo "</pre>";
 

    //Revisar que el arreglo de errores este vacio

    if(empty($errores)){

        //Insertar en la base de datos
        $query = "INSERT INTO autos (auto, precio, descripcion, puertas, cilindros, litros,
        ingresado, vendedores_vendedor_id) 
        VALUES ('$auto', '$precio', '$descripcion', '$puertas','$cilindros', '$litros', '$ingresado',
        '$vendedores_vendedor_id')";

        //echo $query;

        $resultado = mysqli_query($db, $query);

        if($resultado){
            echo "Auto creado correctamente";
        }
    }


}



    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/miprimerauto/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/miprimerauto/admin/autos/crear.php">
            <fieldset>
                <legend>Informacion General</legend>

                <label for="auto">Auto:</label>
                <input type="text" id= "auto" name="auto" placeholder="Auto tipo" value="<?php echo $auto; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id= "precio" name="precio" placeholder="Precio del Auto" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id= "imagen" accept="image/jpeg, image/png">

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
                    <option value="1">Bryan</option>
                    <option value="2">Basualdo</option>
                </select>
            </fieldset>

            <input type="submit" value="Crear Auto" class="boton boton-verde">

        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>