<?php

use Model\Programa;
use Model\Rol;
use Model\Usuario;

    require("./../functions/app.php");
    isntAuth();
    isntAdmin();

    if(isset($_GET['alerta'])){
        Usuario::setAlerta('success',$_GET['alerta']);
        $alertas = Usuario::getAlertas();
    }

    $usuarios = Usuario::all();

    foreach($usuarios as $usuario){
        if($usuario->id_rol) $usuario->rol = Rol::find($usuario->id_rol);
        if($usuario->id_programa) $usuario->programa = Programa::find($usuario->id_programa);
        
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios de ingenieria - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once './../templates/header.php';?>

    <section class="container py-4">

        <h2 class="text-center">Usuarios</h2>
        
        <a class="btn btn-primary mb-3" href="/usuarios/crear.php">Crear Usuario</a>

        <?php include_once '../templates/alertas.php';?>

        <div class="overflow-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Cedula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Programa</th>
                        <th scope="col">Rol</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $usuario):?>
                        <tr>
                            <td><?php echo $usuario->id;?></td>
                            <td><?php echo $usuario->nombres." ".$usuario->apellidos;?></td>
                            <td><?php echo $usuario->email;?></td>
                            <td><?php echo $usuario->id_programa? $usuario->programa->nombre : null;?></td>
                            <td><?php echo  $usuario->id_rol? $usuario->rol->nombre:null;?></td>
                            <td>
                                <?php if($usuario->id !== $_SESSION['id']): ?>
                                    <form class="d-flex justify-content-center align-items-center gap-2" method="POST" action="/usuarios/eliminar.php?id=<?php echo $usuario->id;?>">
                                        <input type="submit" class="btn btn-danger" value="Eliminar">
                                    </form>
                                <?php endif;?>
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