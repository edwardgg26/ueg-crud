<?php

use Model\Materia;

    require("../functions/app.php");
    isntAuth();
    isntAdmin();

    if(!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) header('Location: /programas/');
    $materia = Materia::find($_GET['id']);
    if(!$materia) header('Location: /programas/');
    $resultado = $materia->eliminar();
    if($resultado){
        header('Location: /materias/?id_programa='.$materia->id_programa.'&alerta=Se ha eliminado la materia con exito.');
    }
?>