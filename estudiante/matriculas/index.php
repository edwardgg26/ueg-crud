<?php

use Model\Dia;
use Model\Horario;
use Model\Materia;
use Model\MateriaEstudiante;
use Model\Usuario;
use Model\Programa;
    require("./../../functions/app.php");
    isntAuth();
    isntStudent();

    $programa = Programa::find($_SESSION['id_programa']);

    if(isset($_GET['alerta'])){
        if(!isset($_GET['alert_type'])){
            Materia::setAlerta('success',$_GET['alerta']);
        }else{
            Materia::setAlerta('danger',$_GET['alerta']);
        }
        $alertas = Materia::getAlertas();
    }

    $materias = Materia::whereArray(['id_programa'=>$_SESSION['id_programa']]);
    
    foreach($materias as $materia){
        if($materia->id_docente){
            $materia->docente = Usuario::find($materia->id_docente);
        }
        
        if($materia->id_horario){
            $materia->horario = Horario::find($materia->id_horario);
            $materia->horario->dia = Dia::find($materia->horario->id_dia);
        }

        
        $matriculada = MateriaEstudiante::whereArray(['id_estudiante'=>$_SESSION['id'],'id_materia'=>$materia->id]);
        if(empty($matriculada) || !$matriculada){

            $materia->estado = 'disponible';
        }else{
            $materia->estado = 'matriculada';
        }
    }   
    // debuguear($materias);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias de <?php echo $programa->nombre;?> - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once './../../templates/header.php';?>

    <section class="container py-4">

        <h2 class="text-center">Materias de <?php echo $programa->nombre;?></h2>

        <?php include_once './../../templates/alertas.php';?>

        <div class="overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Docente</th>
                        <th scope="col">Cupos</th>
                        <th scope="col">Creditos</th>
                        <th scope="col">Aula</th>
                        <th scope="col">Horario</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($materias as $materia):?>
                        <tr>
                            <td><?php echo $materia->id;?></td>
                            <td><?php echo $materia->nombre;?></td>
                            <td><?php echo $materia->id_docente ? $materia->docente->nombres." ".$materia->docente->apellidos : null;?></td>
                            <td <?php echo $materia->cupos <= 0 ? 'class="text-danger"':null;?>><?php echo $materia->cupos;?></td>
                            <td><?php echo $materia->creditos;?></td>
                            <td><?php echo $materia->aula;?></td>
                            <td><?php echo $materia->id_horario ? $materia->horario->dia->nombre." - ".$materia->horario->horaFormateada() : null;?></td>
                            <td class="d-flex justify-content-center align-items-center gap-2">
                                <?php if($materia->estado === 'disponible'):?>
                                    <form method="POST" action="/estudiante/matriculas/crear.php?id=<?php echo $materia->id;?>">
                                        <input type="submit" class="btn btn-success" value="Matricular">
                                    </form>
                                <?php endif;?>

                                <?php if($materia->estado === 'matriculada'):?>
                                    <form method="POST" action="/estudiante/matriculas/eliminar.php?id=<?php echo $materia->id;?>">
                                        <input type="submit" class="btn btn-danger" value="Cancelar">
                                    </form>
                                <?php endif;?>
                                <!-- <form>
                                    <input type="submit" class="btn btn-warning disabled" value="Cruce" disabled>
                                </form>

                                 -->
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="/js/bootstrap.min.js"></script>
</body>
</html>