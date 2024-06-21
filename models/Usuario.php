<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombres', 'apellidos', 'password', 'email', 'id_rol', 'id_sexo', 'id_programa'];

    public $id;
    public $nombres;
    public $apellidos;
    public $password;
    public $email;
    public $id_rol;
    public $id_sexo;
    public $id_programa;
    public $first_time;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombres = $args['nombres'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->id_rol = $args['id_rol'] ?? '';
        $this->id_sexo = $args['id_sexo'] ?? '';
        $this->id_programa = $args['id_programa'] ?? '';
    }

    public function validar() {
        if(!$this->id) {
            self::$alertas['danger'][] = 'La cedula no puede ir vacia';
        }else if($this->id <= 99999999 || $this->id > 2000000000 ){
            self::$alertas['danger'][] = 'Debes ingresar una cedula valida';
        }

        if(!$this->nombres) {
            self::$alertas['danger'][] = 'Debes ingresar el/los nombres';
        }

        if(!$this->apellidos) {
            self::$alertas['danger'][] = 'Debes ingresar el/los apellidos';
        }

        if(!$this->password) {
            self::$alertas['danger'][] = 'El Password no puede ir vacio';
        }

        if(!$this->email) {
            self::$alertas['danger'][] = 'Debes ingresar el email';
        }

        if(!$this->id_rol) {
            self::$alertas['danger'][] = 'Debes seleccionar el rol';
        }

        if(!$this->id_programa) {
            self::$alertas['danger'][] = 'Debes seleccionar el programa';
        }

        if(!$this->id_sexo) {
            self::$alertas['danger'][] = 'Debes seleccionar el sexo';
        }

        return self::$alertas;

    }

    public function validar_edicion() {
        if(!$this->id) {
            self::$alertas['danger'][] = 'La cedula no puede ir vacia';
        }

        if(!$this->nombres) {
            self::$alertas['danger'][] = 'Debes ingresar el/los nombres';
        }

        if(!$this->apellidos) {
            self::$alertas['danger'][] = 'Debes ingresar el/los apellidos';
        }

        if(!$this->email) {
            self::$alertas['danger'][] = 'Debes ingresar el email';
        }

        if(!$this->id_rol) {
            self::$alertas['danger'][] = 'Debes seleccionar el rol';
        }

        if(!$this->id_sexo) {
            self::$alertas['danger'][] = 'Debes seleccionar el sexo';
        }
        return self::$alertas;

    }

    // Validar el Login de Usuarios
    public function validarLogin() {
        if(!$this->id) {
            self::$alertas['danger'][] = 'El Debes ingresar la cedula';
        }

        if(!$this->password) {
            self::$alertas['danger'][] = 'El Password no puede ir vacio';
        }
        return self::$alertas;

    }

    // Validación para cuentas nuevas
    public function validar_cuenta() {
        if(!$this->nombres) {
            self::$alertas['danger'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['danger'][] = 'El Password no puede ir vacio';
        }
        if(strlen($this->password) < 6) {
            self::$alertas['danger'][] = 'El password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Valida el Password 
    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['danger'][] = 'El Password no puede ir vacio';
        }else if(strlen($this->password) < 6) {
            self::$alertas['danger'][] = 'El password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
}