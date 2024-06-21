<?php

use Model\Materia;
use Model\MateriaEstudiante;
use Model\Usuario;

    require("./../../functions/app.php");
    isntAuth();
    isntTeacher();

    if(!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) header('Location: /docente/horario/');
    $materia_estudiante = MateriaEstudiante::find($_GET['id']);
    if(!$materia_estudiante) header('Location: /docente/horario/');

    $materia_estudiante->estudiante = Usuario::find($materia_estudiante->id_estudiante);
    if($materia_estudiante->id_materia) $materia_estudiante->materia = Materia::find($materia_estudiante->id_materia);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $materia_estudiante->sincronizar($_POST);
        $alertas = $materia_estudiante->validar();

        if(empty($alertas)){
            $resultado = $materia_estudiante->guardar();
            if($resultado){
                header('Location: /docente/alumnos/?id_materia='.$materia_estudiante->id_materia.'&alerta=Se han editado las notas del alumno con exito.');
            }
        }

        $alertas = MateriaEstudiante::getAlertas();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $materia_estudiante->estudiante->nombres." ".$materia_estudiante->estudiante->apellidos." - ".$materia_estudiante->materia->nombre;?> - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once './../../templates/header.php';?>

    <section class="container py-4">
        <h4><?php echo $materia_estudiante->estudiante->nombres." ".$materia_estudiante->estudiante->apellidos." - ".$materia_estudiante->materia->nombre;?></h4>
         <form method="POST">
            <?php include_once './../../templates/alertas.php';?>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mb-3 gy-3">
                <?php include_once 'formulario.php';?>
            </div>
            <input type="submit" class="btn btn-primary" value="Editar">
        </form>
    </section>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>