<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Primer Auto GT</title>
    <link rel="stylesheet" href="/miprimerauto/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio  ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/miprimerauto/build/img/logomiprimerauto.svg" alt="Logotipo de Mi Primer Auto GT">
                </a>

                <div class="mobile-menu">
                    <img src="/miprimerauto/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/miprimerauto/build/img/dark-mode.svg">
                        <nav class="navegacion mostrar">
                            <a href="nosotros.php">Nosotros</a>
                            <a href="anuncios.php">Anuncios</a>
                            <a href="blog.php">Blog</a>
                            <a href="contacto.php">Contacto</a>
                        </nav>

                </div>
                
            </div> <!-- .barra -->

        </div>
    </header>