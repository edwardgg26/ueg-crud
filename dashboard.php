<?php 
    require("./functions/app.php");
    isntAuth();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - USC</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once './templates/header.php';?>

    <div class="container px-3 py-4 ">

        <h2 class="text-center">Panel de Administración</h2>
        
        <div class="row mt-3 g-3  ">
            <?php if($_SESSION['rol_id'] == '1'):?>
                <div class="col-12 col-lg-4">
                    <a class="d-block bg-secondary py-4 text-center fw-bold text-white text-decoration-none" href="/programas/">Programas</a>
                </div>
                <div class="col-12 col-lg-4">
                    <a class="d-block bg-secondary py-4 text-center fw-bold text-white text-decoration-none" href="/usuarios/">Usuarios</a>
                </div>
                <div class="col-12 col-lg-4">
                    <a class="d-block bg-secondary py-4 text-center fw-bold text-white text-decoration-none" href="/horarios/">Horarios</a>
                </div>
            <?php endif;?>

            <?php if($_SESSION['rol_id'] == '2'):?>
                <div class="col-12 col-lg-4">
                    <a class="d-block bg-secondary py-4 text-center fw-bold text-white text-decoration-none" href="/docente/horario/">Materias</a>
                </div>
            <?php endif;?>

            <?php if($_SESSION['rol_id'] == '3'):?>
                <div class="col-12 col-lg-4">
                    <a class="d-block bg-secondary py-4 text-center fw-bold text-white text-decoration-none" href="/estudiante/matriculas/">Matricular</a>
                </div>
                <div class="col-12 col-lg-4">
                    <a class="d-block bg-secondary py-4 text-center fw-bold text-white text-decoration-none" href="/estudiante/horario/">Horario</a>
                </div>
                <div class="col-12 col-lg-4">
                    <a class="d-block bg-secondary py-4 text-center fw-bold text-white text-decoration-none" href="/estudiante/notas/">Notas</a>
                </div>
            <?php endif;?>
        </div>
    </div>

    <script src="/js/bootstrap.min.js"></script>
</body>
</html>