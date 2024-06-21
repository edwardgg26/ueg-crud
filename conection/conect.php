<?php 
    $hostname_conex = "localhost";
    $username_conex = "root";
    $password_conex = "";
    $database_conex = "uscfacultadingenieria";

    $db = mysqli_connect($hostname_conex,$username_conex,$password_conex,$database_conex);
    
    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
        echo "errno de depuración: " . mysqli_connect_errno();
        echo "error de depuración: " . mysqli_connect_error();
        exit;
    }
?>