<?php

use Model\Programa;

    require("../functions/app.php");
    isntAuth();
    isntAdmin();

    if(!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) header('Location: /programas/');
    $programa = Programa::find($_GET['id']);
    if(!$programa) header('Location: /programas/');
    $resultado = $programa->eliminar();
    if($resultado){
        header('Location: /programas/?alerta=Se ha eliminado el programa con exito.');
    }
?>