<?php

namespace Model;

class Materia extends ActiveRecord {
    protected static $tabla = 'materias';
    protected static $columnasDB = ['id', 'nombre','creditos','aula','cupos','id_programa','id_docente','id_horario'];

    public $id;
    public $nombre;
    public $creditos;
    public $aula;
    public $cupos;
    public $id_programa;
    public $id_docente;
    public $id_horario;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->creditos = $args['creditos'] ?? '';
        $this->aula = $args['aula'] ?? '';
        $this->cupos = $args['cupos'] ?? '';
        $this->id_programa = $args['id_programa'] ?? '';
        $this->id_docente = $args['id_docente'] ?? '';
        $this->id_horario = $args['id_horario'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['danger'][] = 'Debes ingresar el nombre';
        }

        if(!$this->creditos) {
            self::$alertas['danger'][] = 'Debes ingresar la cantidad de creditos';
        }else if($this->creditos <= 0 || $this->creditos > 5){
            self::$alertas['danger'][] = 'El minimo de creditos es 1 y el maximo 5';
        }

        if(!$this->aula) {
            self::$alertas['danger'][] = 'Debes ingresar el codigo del aula';
        }else if($this->aula < 1000 || $this->aula > 9999){
            self::$alertas['danger'][] = 'El codigo del aula es de 4 digitos';
        }

        if(!$this->cupos) {
            self::$alertas['danger'][] = 'Debes ingresar una cantidad de cupos';
        }else if($this->cupos <= 0 || $this->cupos > 50){
            self::$alertas['danger'][] = 'El cupo minimo es de 1 y el maximo es de 50';
        }

        if(!$this->id_docente) {
            self::$alertas['danger'][] = 'Debes ingresar el docente que da la clase';
        }

        if(!$this->id_horario) {
            self::$alertas['danger'][] = 'Debes seleccionar el horario';
        }

        return self::$alertas;

    }
}