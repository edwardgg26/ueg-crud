<?php

use Model\Dia;
use Model\Horario;

    require("../functions/app.php");
    isntAuth();
    isntAdmin();

    $dias = Dia::all('ASC');
    $horario = new Horario;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $horario->sincronizar($_POST);
        $alertas = $horario->validar();
        if(empty($alertas)){
            $resultado = $horario->guardar();
            if($resultado){
                header('Location: /horarios/?alerta=Se ha creado el horario con exito.');
            }
        }

        $alertas = Horario::getAlertas();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Horario de ingenieria - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once '../templates/header.php';?>

    <section class="container py-4">
        <h4>Crear Horario</h4>
        <form method="POST">
            <?php include_once '../templates/alertas.php';?>
            <div class="row row-cols-1 row-cols-md-2 gy-3">
                <?php include_once 'formulario.php';?>
            </div>
            <input type="submit" class="mt-3 btn btn-primary" value="Crear">
        </form>
    </section>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>