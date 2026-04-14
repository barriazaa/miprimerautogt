<?php

require 'miprimerauto/includes/app.php';

function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/{$nombre}.php";
}