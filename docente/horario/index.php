<?php

use Model\Dia;
use Model\Horario;
use Model\Materia;
use Model\Programa;

    require("./../../functions/app.php");
    isntAuth();
    isntTeacher();

    $materias = Materia::whereArray(['id_docente'=>$_SESSION['id']]);
    foreach($materias as $materia){
        $materia->programa = Programa::find($materia->id_programa);

        if($materia->id_horario){
            $materia->horario = Horario::find($materia->id_horario);
            $materia->horario->dia = Dia::find($materia->horario->id_dia);
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
                        <th scope="col">Programa</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($materias as $materia):?>
                        <tr>
                            <td><?php echo $materia->id;?></td>
                            <td><?php echo $materia->nombre;?></td>
                            <td><?php echo $materia->id_horario ? $materia->horario->dia->nombre." - ".$materia->horario->horaFormateada() : null;?></td>
                            <td><?php echo $materia->aula;?></td>
                            <td><?php echo $materia->id_programa ? $materia->programa->nombre : null;?></td>
                            <td><a class="btn btn-primary" href="/docente/alumnos/?id_materia=<?php echo $materia->id;?>">Administrar Curso</a></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="/js/bootstrap.min.js"></script>
</body>
</html>