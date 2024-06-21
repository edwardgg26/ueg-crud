<?php

use Model\Dia;
use Model\Horario;

    require("./../functions/app.php");
    isntAuth();
    isntAdmin();

    if(isset($_GET['alerta'])){
        Horario::setAlerta('success',$_GET['alerta']);
        $alertas = Horario::getAlertas();
    }

    $horarios = Horario::all();

    foreach($horarios as $horario){
        $horario->dia = Dia::find($horario->id_dia);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios de ingenieria - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once './../templates/header.php';?>

    <section class="container py-4">

        <h2 class="text-center">Horarios</h2>
        
        <a class="btn btn-primary mb-3" href="/horarios/crear.php">Crear Horario</a>

        <?php include_once '../templates/alertas.php';?>

        <div class="overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Dia</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($horarios as $horario):?>
                        <tr>
                            <td><?php echo $horario->id;?></td>
                            <td><?php echo $horario->horaFormateada();?></td>
                            <td><?php echo $horario->dia->nombre;?></td>
                            <td class="d-flex justify-content-center align-items-center gap-2">
                                <a class="btn btn-secondary" href="/horarios/editar.php?id=<?php echo $horario->id;?>">Editar</a>
                                <form method="POST" action="/horarios/eliminar.php?id=<?php echo $horario->id;?>">
                                    <input type="submit" class="btn btn-danger" value="Eliminar">
                                </form>
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