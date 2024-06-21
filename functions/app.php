<?php 

use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';

require __DIR__. '/../conection/conect.php';
require 'funciones.php';
// Conectarnos a la base de datos
ActiveRecord::setDB($db);