<?php

namespace Model;

use DateTime;

class Horario extends ActiveRecord {
    protected static $tabla = 'horarios';
    protected static $columnasDB = ['id', 'hora', 'id_dia'];

    public $id;
    public $hora;
    public $id_dia;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->id_dia = $args['id_dia'] ?? '';
    }

    public function validar() {
        if(!$this->hora) {
            self::$alertas['danger'][] = 'Debes seleccionar la hora';
        }

        if(!$this->id_dia) {
            self::$alertas['danger'][] = 'Debes ingresar el dia';
        }

        return self::$alertas;

    }

    public function horaFormateada(){
        $hora_format = new DateTime($this->hora);
        return $hora_format->format('h:i A');
    }
}