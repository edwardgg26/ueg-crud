<?php

use Model\Materia;
use Model\MateriaEstudiante;

    require("../../functions/app.php");
    isntAuth();
    isntStudent();

    if(!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) header('Location: /estudiante/matriculas/');
    $materia = Materia::find($_GET['id']);
    if(!$materia) header('Location: /estudiante/matriculas/');

    if($_SESSION['id_programa'] === $materia->id_programa){

        $materia->cupos+=1;
        $resultado_materia = $materia->guardar();
        if($resultado_materia){
            $matriculada = MateriaEstudiante::whereArray(['id_estudiante'=>$_SESSION['id'],'id_materia'=>$materia->id]);
            $matriculada = array_shift($matriculada);
            $resultado = $matriculada->eliminar();
            if($resultado){
                header('Location: /estudiante/matriculas/?alerta=Se ha retirado de la asignatura con exito.');
            }
        }
    }else{
        header('Location: /estudiante/matriculas/');
    }
?>