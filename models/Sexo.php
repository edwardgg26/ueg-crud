<?php

namespace Model;

class Sexo extends ActiveRecord {
    protected static $tabla = 'sexos';
    protected static $columnasDB = ['id', 'nombres'];

    public $id;
    public $nombre;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }
}