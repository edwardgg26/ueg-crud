<?php

use Model\Dia;
use Model\Horario;
use Model\Materia;
use Model\MateriaEstudiante;
use Model\Usuario;

    require("./../../functions/app.php");
    isntAuth();
    isntStudent();

    // $materias = Materia::whereArray(['id_programa'=>$_SESSION['id_programa']]);
    $matriculadas = MateriaEstudiante::whereArray(['id_estudiante'=>$_SESSION['id']]);
    foreach($matriculadas as $matriculada){
        if($matriculada->id_materia){
            $matriculada->materia = Materia::find($matriculada->id_materia);
            if($matriculada->materia->id_docente){
                $matriculada->materia->docente = Usuario::find($matriculada->materia->id_docente);
            }

            if($matriculada->materia->id_horario){
                $matriculada->materia->horario = Horario::find($matriculada->materia->id_horario);
                $matriculada->materia->horario->dia = Dia::find($matriculada->materia->horario->id_dia);
            }
        }
    }   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Horario - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once './../../templates/header.php';?>

    <section class="container py-4">

        <h2 class="text-center">Mi Horario</h2>

        <?php include_once './../../templates/alertas.php';?>

        <div class="overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Aula</th>
                        <th scope="col">Docente</th>
                        <th scope="col">Creditos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($matriculadas as $matriculada):?>
                        <tr>
                            <td><?php echo $matriculada->materia->id;?></td>
                            <td><?php echo $matriculada->materia->nombre;?></td>
                            <td><?php echo $matriculada->materia->id_horario ? $matriculada->materia->horario->dia->nombre." - ".$matriculada->materia->horario->horaFormateada() : null;?></td>
                            <td><?php echo $matriculada->materia->aula;?></td>
                            <td><?php echo $matriculada->materia->id_docente ? $matriculada->materia->docente->nombres." ".$matriculada->materia->docente->apellidos : null;?></td>
                            <td><?php echo $matriculada->materia->creditos;?></td>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="/js/bootstrap.min.js"></script>
</body>
</html>