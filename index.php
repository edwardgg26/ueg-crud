<?php

use Model\Rol;
use Model\Usuario;
    require("./functions/app.php");
    isAuth();

    $validador = new Usuario;
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $validador->sincronizar($_POST);
        $alertas = $validador->validarLogin();
        if(empty($alertas)){
            $user = Usuario::find($validador->id);
    
            if($user){
                if(password_verify($validador->password,$user->password)){
                    $_SESSION['id'] = $user->id;
                    $_SESSION['nombre'] = $user->nombres." ".$user->apellidos;
                    $_SESSION['email'] = $user->email;
                    $rol = Rol::find($user->id_rol);
                    $_SESSION['rol_id'] = $rol->id;
                    $_SESSION['rol_nombre'] = $rol->nombre;
                    if($user->id_programa) $_SESSION['id_programa'] = $user->id_programa;
            
                    header("location: /dashboard.php");
                }else{
                    Usuario::setAlerta('danger','Contraseña incorrecta');
                }
            }else{
                Usuario::setAlerta('danger','Usuario no encontrado');
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
    <title>Login Facultad Ingenieria USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include_once './templates/header.php';?>

    <section class="container p-3 py-4">
        <h4>Inicio de Sesion</h4>
        <div class="row">
            <form class="col-12 col-lg-6" action="/" method="POST">
                <?php include_once './templates/alertas.php';?>
                <div class="mb-3">
                    <label for="id" class="form-label">Cedula</label>
                    <input type="number" name="id" class="form-control" id="id" aria-describedby="cedula">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <input type="submit" class="btn btn-primary" value="Ingresar">
            </form>
        </div>
    </section>

    <script src="/js/bootstrap.min.js"></script>
</body>
</html>