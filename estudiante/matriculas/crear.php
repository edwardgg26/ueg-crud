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

        $matriculadas = MateriaEstudiante::whereArray(['id_estudiante'=>$_SESSION['id']]);
        $creditosTotales = null;
        foreach($matriculadas as $matriculada){
            $matriculada->materia = Materia::find($matriculada->id_materia);
            $creditosTotales+=$matriculada->materia->creditos;
        }

        if($materia->cupos > 0){
            if($creditosTotales <= (15 - $materia->creditos)){
                $materia->cupos-=1;
                $resultado_materia = $materia->guardar();
                if($resultado_materia){
                    $materia_estudiante = new MateriaEstudiante(['id_estudiante'=>$_SESSION['id'], 'id_materia'=>$materia->id]);
                    $resultado = $materia_estudiante->guardar();
                    if($resultado){
                        header('Location: /estudiante/matriculas/?alerta=Se ha registrado en la asignatura con exito.');
                    }
                }
            }else{
                header('Location: /estudiante/matriculas/?alert_type=danger&alerta=No puedes matricular mas de 15 creditos.');
            }
        }else{
            header('Location: /estudiante/matriculas/?alert_type=danger&alerta=No hay cupos para ese curso.');
        }
    }else{
        header('Location: /estudiante/matriculas/');
    }
?>