<?php

use Model\Programa;
    require("./../functions/app.php");
    isntAuth();
    isntAdmin();

    if(isset($_GET['alerta'])){
        Programa::setAlerta('success',$_GET['alerta']);
        $alertas = Programa::getAlertas();
    }

    $programas = Programa::all();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas de ingenieria - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once './../templates/header.php';?>

    <section class="container py-4">

        <h2 class="text-center">Programas</h2>
        
        <a class="btn btn-primary mb-3" href="/programas/crear.php">Crear Programa</a>

        <?php include_once '../templates/alertas.php';?>

        <div class="overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($programas as $programa):?>
                        <tr>
                            <td><?php echo $programa->id;?></td>
                            <td><?php echo $programa->nombre;?></td>
                            <td class="d-flex justify-content-center align-items-center gap-2">
                                <a class="btn btn-primary" href="/materias/?id_programa=<?php echo $programa->id;?>">Administrar materias</a>
                                <a class="btn btn-secondary" href="/programas/editar.php?id=<?php echo $programa->id;?>">Editar</a>
                                <form method="POST" action="/programas/eliminar.php?id=<?php echo $programa->id;?>">
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