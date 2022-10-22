<?php

namespace Model;

class Usuario extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    
    //Constructor
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token= $args['token'] ?? '';
       


    }
    
    //Mensajes de validacion para crear una cuenta
    public function validarNuevaCuenta()
    {
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre del cliente es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][]='El apellido del cliente es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][]='Debe proporcionar un email';
        }

        if(strlen($this->password)<6 && !$this->password){
            self::$alertas['error'][]='El password debe tener al menos 6 caracteres y es obligatorio';
        }
        if(strlen($this->telefono)<10){
            self::$alertas['error'][]='El número de telefono debe tener 10 digitos';
        }
        if(!$this->telefono){
            self::$alertas['error'][]='El número de telefono es obligatorio';
        }

       
    }
    public function existeUsuario(){
    $query = "SELECT * FROM ".self::$tabla." WHERE email = '".$this->email."' LIMIT 1";
    $resultado = self::$db->query($query);
    if($resultado->num_rows){
        self::$alertas['error'][] = 'El usuario esta registrado';
    }
    return $resultado;
  }
  public function hashPassword(){
    $this->password = password_hash($this->password,PASSWORD_BCRYPT);
  }
  public function createToken(){
    $this->token = uniqid();
  }

  public function validarLogin()
  {
    if(!$this->email){
        self::$alertas['error'][]='El email es obligatorio';
    }
    if(!$this->password){
        self::$alertas['error'][]='El password es obligatorio';
    }
    return self::$alertas;
  }
  public  function comprobarPasswordAndVerificar($password){
    $resultado = password_verify($password,$this->password);
    if($resultado){
        
    }
    if(!$this->confirmado || !$resultado){
       self::$alertas['error'][]='Password incorrecto o tu cuenta no esta confirmada';    
    }
    else{
       return true;
    }
  }
  public function validarEmail(){
    if(!$this->email){
        self::$alertas['error'][]='El email es obligatorio';
    }
    return self::$alertas;
  }
  public function validarPassword(){
    if(!$this->password){
        self::$alertas['error'][]='El password es obligatorio';

    }
    if(strlen($this->password)<6){
        self::$alertas['error'][]='El password debe tener mínimo 6 caracteres';
    }
    return self::$alertas;
  }
}