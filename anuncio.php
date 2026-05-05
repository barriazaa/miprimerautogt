<?php 

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /');
    }

    //Importar conexion
    require 'miprimerauto/includes/config/database.php';
    $db = conectarDB();

    //consultar
    $query = "SELECT * FROM autos WHERE auto_id = {$id}";

    //obtener resultados
    $resultado = mysqli_query($db, $query);

    if(!$resultado->num_rows) {
        header('Location: /');
    }

    $auto = mysqli_fetch_assoc($resultado);

    require 'miprimerauto/includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $auto['auto']; ?></h1>

            <img loading="lazy" src="/imagenes/<?php echo $auto['imagen']; ?>" alt="imagen anuncio">

        <div class="resumen-auto">
            <p class="precio"><?php echo $auto['precio']; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="miprimerauto/build/img/icono1mpa.png" alt="icono1mpa">
                            <p><?php echo $auto['puertas']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="miprimerauto/build/img/icono2mpa.png" alt="icono2mpa">
                            <p><?php echo $auto['cilindros']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="miprimerauto/build/img/icono4mpa.png" alt="icono4mpa">
                            <p><?php echo $auto['litros']; ?></p>
                    </li>
                </ul>
            <?php echo $auto['descripcion']; ?>
        </div>
    </main>

<?php 
    mysqli_close($db);

    incluirTemplate('footer');
?>