<?php
use Model\Materia;
use Model\MateriaEstudiante;
use Model\Usuario;
    require("./../../functions/app.php");
    isntAuth();
    isntTeacher();

    if(!isset($_GET['id_materia']) || !filter_var($_GET['id_materia'], FILTER_VALIDATE_INT)) header('Location: /docente/horario/');
    $materia = Materia::find($_GET['id_materia']);
    if(!$materia) header('Location: /docente/horario/');

    if(isset($_GET['alerta'])){
        Materia::setAlerta('success',$_GET['alerta']);
        $alertas = Materia::getAlertas();
    }

    $materias_estudiantes = MateriaEstudiante::whereArray(['id_materia'=>$_GET['id_materia']]);

    foreach($materias_estudiantes as $materia_estudiante){
        $materia_estudiante->estudiante = Usuario::find($materia_estudiante->id_estudiante);
        $materia_estudiante->updateDefinitiva();
    }   
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso <?php echo $materia->nombre;?> - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once './../../templates/header.php';?>

    <section class="container py-4">

        <h2 class="text-center">Curso <?php echo $materia->nombre;?></h2>
        <?php include_once './../../templates/alertas.php';?>

        <div class="overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Corte 1</th>
                        <th scope="col">Corte 2</th>
                        <th scope="col">Corte 3</th>
                        <th scope="col">Definitiva</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($materias_estudiantes as $materia_estudiante):?>
                        <tr>
                            <td><?php echo $materia_estudiante->estudiante->id;?></td>
                            <td><?php echo $materia_estudiante->estudiante->nombres." ".$materia_estudiante->estudiante->apellidos;?></td>
                            <td><?php echo $materia_estudiante->nota1;?></td>
                            <td><?php echo $materia_estudiante->nota2;?></td>
                            <td><?php echo $materia_estudiante->nota3;?></td>
                            <td><?php echo $materia_estudiante->definitiva;?></td>
                            <td class="d-flex justify-content-center align-items-center gap-2">
                                <a class="btn btn-secondary" href="/docente/alumnos/editar.php?id=<?php echo $materia_estudiante->id;?>">Editar</a>
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