<?php

use Model\Horario;

    require("../functions/app.php");
    isntAuth();
    isntAdmin();

    if(!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) header('Location: /horarios/');
    $horario = Horario::find($_GET['id']);
    if(!$horario) header('Location: /horarios/');
    $resultado = $horario->eliminar();
    if($resultado){
        header('Location: /horarios/?alerta=Se ha eliminado el horario con exito.');
    }
?>