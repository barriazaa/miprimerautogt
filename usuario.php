<?php

//Importar conexion a la base de datos
    require 'miprimerauto/includes/config/database.php';
    $db = conectarDB();


//Crear un email y contraseña
    $email = "correo@correo.com";
    $password = "root";
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

//Query para crear un nuevo usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$passwordHash}')";

    //echo $query;

//Agregarlo a la base de datos
    mysqli_query($db, $query);

?>