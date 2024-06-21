<?php

use Model\Programa;
use Model\Rol;
use Model\Sexo;
use Model\Usuario;

    require("../functions/app.php");
    isntAuth();
    isntAdmin();

    $roles = Rol::all();
    $sexos = Sexo::all();
    $programas = Programa::all();

    $usuario = new Usuario;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $usuario->sincronizar($_POST);
        $alertas = $usuario->validar();
        if(empty($alertas)){
            $usuarioRep = Usuario::find($usuario->id);
            if(!$usuarioRep){
                $usuario->hashPassword();
                $usuario->first_time = true;
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /usuarios/?alerta=Se ha creado el usuario con exito.');
                }
            }else{
                Usuario::setAlerta('danger','Ya hay un usuario registrado con esa cedula');
            }
        }

        $alertas = Usuario::getAlertas();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario de ingenieria - USC</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once '../templates/header.php';?>

    <section class="container py-4">
        <h4>Crear Usuario</h4>
         <form method="POST">
            <?php include_once '../templates/alertas.php';?>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mb-3 gy-3">
                <?php include_once 'formulario.php';?>
            </div>
            <input type="submit" class="btn btn-primary" value="Crear">
        </form>
    </section>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>