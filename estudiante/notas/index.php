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
        }
        $matriculada->updateDefinitiva();
    }   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Notas - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once './../../templates/header.php';?>

    <section class="container py-4">

        <h2 class="text-center">Mis Notas</h2>

        <?php include_once './../../templates/alertas.php';?>

        <div class="overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Docente</th>
                        <th scope="col">Corte 1</th>
                        <th scope="col">Corte 2</th>
                        <th scope="col">Corte 3</th>
                        <th scope="col">Definitiva</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($matriculadas as $matriculada):?>
                        <tr>
                            <td><?php echo $matriculada->materia->id;?></td>
                            <td><?php echo $matriculada->materia->nombre;?></td>
                            <td><?php echo $matriculada->materia->id_docente ? $matriculada->materia->docente->nombres." ".$matriculada->materia->docente->apellidos : null;?></td>
                            <td><?php echo $matriculada->nota1;?></td>
                            <td><?php echo $matriculada->nota2;?></td>
                            <td><?php echo $matriculada->nota3;?></td>
                            <td><?php echo $matriculada->definitiva;?></td>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="/js/bootstrap.min.js"></script>
</body>
</html>