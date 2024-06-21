<?php

use Model\Programa;

    require("../functions/app.php");
    isntAuth();
    isntAdmin();

    $programa = new Programa;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $programa->sincronizar($_POST);
        $alertas = $programa->validar();
        if(empty($alertas)){
            $resultado = $programa->guardar();
            if($resultado){
                header('Location: /programas/?alerta=Se ha creado el programa con exito.');
            }
        }

        $alertas = Programa::getAlertas();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Programa de ingenieria - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once '../templates/header.php';?>

    <section class="container py-4">
        <h4>Crear Programa</h4>
         <form method="POST">
            <?php include_once '../templates/alertas.php';?>

            <div class="row">
                <?php include_once 'formulario.php';?>
            </div>
            <input type="submit" class="btn btn-primary" value="Crear">
        </form>
    </section>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>