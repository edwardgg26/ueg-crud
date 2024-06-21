<?php

namespace Model;

class Programa extends ActiveRecord {
    protected static $tabla = 'programas';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['danger'][] = 'Debes ingresar el nombre';
        }

        return self::$alertas;

    }
}