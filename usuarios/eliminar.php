<?php

use Model\Usuario;

    require("../functions/app.php");
    isntAuth();
    isntAdmin();

    if(!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) header('Location: /usuarios/');
    $usuario = Usuario::find($_GET['id']);
    if(!$usuario) header('Location: /usuarios/');
    $resultado = $usuario->eliminar();
    if($resultado){
        header('Location: /usuarios/?alerta=Se ha eliminado el usuario con exito.');
    }
?>