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
    $query = "SELECT a.*, m.nombre as modelo, ma.nombre as marca, c.nombre as combustible, tr.nombre as transmision, trac.nombre as traccion, ce.nombre as color_exterior, ci.nombre as color_interior, et.nombre as estado_titulo, tv.nombre as tipo_vehiculo FROM autos a LEFT JOIN modelos m ON a.modelo_id = m.id LEFT JOIN marcas ma ON m.marca_id = ma.id LEFT JOIN combustibles c ON a.combustible_id = c.id LEFT JOIN transmisiones tr ON a.transmision_id = tr.id LEFT JOIN tracciones trac ON a.traccion_id = trac.id LEFT JOIN colores ce ON a.color_exterior_id = ce.id LEFT JOIN colores ci ON a.color_interior_id = ci.id LEFT JOIN estados_titulo et ON a.estado_titulo_id = et.id LEFT JOIN tipos_vehiculo tv ON a.tipo_vehiculo_id = tv.id WHERE a.auto_id = {$id}";

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
        <h1><?php echo $auto['marca'] . " " . $auto['modelo'] . " (" . $auto['año'] . ")"; ?></h1>

            <img loading="lazy" src="/imagenes/<?php echo $auto['imagen']; ?>" alt="imagen anuncio">

        <div class="resumen-auto">
            <p class="precio" style="color: #71b100; font-weight: 900;">Precio: Q <?php echo number_format($auto['precio'], 2); ?></p>
                
            <style>
                .grid-especificaciones {
                    list-style: none; padding: 0; margin: 0; 
                    display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.5rem;
                }
                .grid-especificaciones li {
                    background: #ffffff; padding: 1.5rem; border-radius: 0.8rem; 
                    box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-align: center; 
                    border-bottom: 3px solid #e08709; transition: transform 0.3s ease;
                }
                .grid-especificaciones li:hover {
                    transform: translateY(-5px);
                }
                .grid-especificaciones strong {
                    display: block; color: #6b7280; font-size: 1.4rem; text-transform: uppercase;
                }
                .grid-especificaciones span {
                    display: block; color: #111827; font-size: 1.8rem; font-weight: bold; margin-top: 0.5rem;
                }
                @media (min-width: 992px) { /* Se aplica solo en pantallas grandes */
                    .detalles-layout {
                        display: grid;
                        grid-template-columns: 1fr 1.2fr; /* Columnas: especificaciones y descripción */
                        gap: 4rem; /* Espacio entre las columnas */
                        align-items: start; /* Alinea las cajas arriba */
                    }
                    .detalles-layout > div {
                        margin: 0 !important; /* Quita los márgenes verticales para que el grid los controle */
                    }
                }
            </style>
            <div class="detalles-layout">
                <div class="especificaciones" style="background-color: #f8f9fa; padding: 3rem; border-radius: 1rem; margin: 3rem 0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <h3 style="text-align: center; color: #333; text-transform: uppercase; letter-spacing: 1px; margin-top: 0; margin-bottom: 2rem;">Especificaciones</h3>
                    <ul class="grid-especificaciones">
                        <li><strong>Tipo</strong><span><?php echo $auto['tipo_vehiculo']; ?></span></li>
                        <li><strong>Combustible</strong><span><?php echo $auto['combustible']; ?></span></li>
                        <li><strong>Transmisión</strong><span><?php echo $auto['transmision']; ?></span></li>
                        <li><strong>Tracción</strong><span><?php echo $auto['traccion']; ?></span></li>
                        <li><strong>Motor</strong><span><?php echo $auto['cilindros']; ?> Cil / <?php echo $auto['litros']; ?> L</span></li>
                        <li><strong>Millaje</strong><span><?php echo number_format($auto['millaje']); ?> mi</span></li>
                        <li><strong>Puertas</strong><span><?php echo $auto['puertas']; ?></span></li>
                        <li><strong>Color Ext.</strong><span><?php echo $auto['color_exterior']; ?></span></li>
                        <li><strong>Color Int.</strong><span><?php echo $auto['color_interior']; ?></span></li>
                        <li><strong>Título</strong><span><?php echo $auto['estado_titulo']; ?></span></li>
                    </ul>
                </div>
    
                <div class="descripcion-auto" style="background-color: #f8f9fa; padding: 3rem; border-radius: 1rem; margin-bottom: 3rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    <h3 style="text-align: center; color: #333; text-transform: uppercase; letter-spacing: 1px; margin-top: 0; margin-bottom: 2rem;">Descripción del Vehículo</h3>
                    <p style="line-height: 1.8; color: #4b5563; font-size: 1.6rem; text-align: justify; margin: 0;"><?php echo nl2br($auto['descripcion']); ?></p>
                </div>
            </div>
        </div>
    </main>

<?php 
    mysqli_close($db);

    incluirTemplate('footer');
?>