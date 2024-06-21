<?php

namespace Model;

class MateriaEstudiante extends ActiveRecord {
    protected static $tabla = 'materias_estudiantes';
    protected static $columnasDB = ['id', 'id_estudiante','id_materia','nota1','nota2','nota3','observaciones'];

    public $id;
    public $id_estudiante;
    public $id_materia;
    public $nota1;
    public $nota2;
    public $nota3;
    public $observaciones;
    public $definitiva;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_estudiante = $args['id_estudiante'] ?? '';
        $this->id_materia = $args['id_materia'] ?? '';
        $this->nota1 = $args['nota1'] ?? '';
        $this->nota2 = $args['nota2'] ?? '';
        $this->nota3 = $args['nota3'] ?? '';
        $this->observaciones = $args['observaciones'] ?? '';
        
    }

    public function updateDefinitiva(){
        $this->definitiva = floatval($this->nota1)*0.30 + floatval($this->nota2)*0.30 + floatval($this->nota3)*0.40 ?? 0 ;
    }

    public function validar() {
        if($this->nota1 < 0 || $this->nota1 > 5) {
            self::$alertas['danger'][] = 'La nota del corte 1 debe ser entre 0 y 5';
        }
        
        if($this->nota2 < 0 || $this->nota2 > 5) {
            self::$alertas['danger'][] = 'La nota del corte 2 debe ser entre 0 y 5';
        }
        if($this->nota3 < 0 || $this->nota3 > 5) {
            self::$alertas['danger'][] = 'La nota del corte 3 debe ser entre 0 y 5';
        }
        
        return self::$alertas;

    }
}