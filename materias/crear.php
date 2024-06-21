<?php

use Model\Dia;
use Model\Horario;
use Model\Materia;
use Model\Programa;
use Model\Usuario;

    require("../functions/app.php");
    isntAuth();
    isntAdmin();

    if(!isset($_GET['id_programa']) || !filter_var($_GET['id_programa'], FILTER_VALIDATE_INT)) header('Location: /programas/');
    $programa = Programa::find($_GET['id_programa']);
    if(!$programa) header('Location: /programas/');

    $docentes = Usuario::whereArray(['id_rol'=>2]);
    $horarios = Horario::all();
    foreach($horarios as $horario){
        $horario->dia = Dia::find($horario->id_dia);
    }
    $materia = new Materia;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $materia->sincronizar($_POST);
        $materia->id_programa = $_GET['id_programa'];
        $alertas = $materia->validar();
        if(empty($alertas)){
            $cruce = Materia::whereArray(['id_horario'=>$materia->id_horario,'id_docente'=>$materia->id_docente]);
            if(empty($cruce)){
                $resultado = $materia->guardar();
                if($resultado){
                    header('Location: /materias/?id_programa='.$materia->id_programa.'&alerta=Se ha creado la materia con exito.');
                }
            }else{
                Materia::setAlerta('danger','El docente ya tiene registrada una asignatura en ese horario');
            }
        }

        $alertas = Materia::getAlertas();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Materia - <?php echo $programa->nombre;?> - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once '../templates/header.php';?>

    <section class="container py-4">
        <h4>Crear Materia - <?php echo $programa->nombre;?></h4>
         <form method="POST">
            <?php include_once '../templates/alertas.php';?>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mb-3 gy-3">
                <?php include_once 'formulario.php';?>
            </div>
            <input type="submit" class="btn btn-primary" value="Crear">
        </form>
    </section>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>