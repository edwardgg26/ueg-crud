<?php

function debuguear($dato){
    echo '<pre>';
    echo var_dump($dato);
    echo '</pre>';
    return exit;
}

function arrancaSesion(){
    if(!isset($_SESSION)){
        session_start();
    }
}
function isAuth(){
    arrancaSesion();
    if(isset($_SESSION['id'])){
        header('Location: /dashboard.php');
    }
}

function isntAuth(){
    arrancaSesion();
    if(!isset($_SESSION['id'])){
        header('Location: /');
    }
}

function isntAdmin(){
    if($_SESSION['rol_id'] != 1) header('Location: /dashboard.php');
}

function isntTeacher(){
    if($_SESSION['rol_id'] != 2) header('Location: /dashboard.php');
}

function isntStudent(){
    if($_SESSION['rol_id'] != 3) header('Location: /dashboard.php');
}