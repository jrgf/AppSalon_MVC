<?php 
namespace Controller;

use Classes\Emailer;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router)
    {
        $alertas =[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();
            
            if(empty($alertas)){
                //Comprobar que existe el usuario
                $usuario = Usuario::where('email',$auth->email);
                if($usuario){
                    //Verificar el password
                    if($usuario->comprobarPasswordAndVerificar($auth->password)){
                        //Autenticar el usuario
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre. " ". $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = TRUE;
                        if($usuario->admin == 1){
                            $_SESSION['admin'] = $usuario->admin ?? null;

                            header('Location: /admin');
                        }
                        else{
                            header('Location: /cita');
                        }
                        debuguear($_SESSION);

                    }
                }
                else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }

        }
        $alertas = Usuario::getAlertas();
       $router->render('auth/login',['alertas'=>$alertas,'auth'=>$auth]);
    }
    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }
    public static function forget(Router $router)
    {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty($alertas)){
                $usuario = Usuario::where('email',$auth->email);
                if($usuario && $usuario->confirmado === "1"){
                    //Generar un token de un solo uso
                    $usuario->createToken();
                    $usuario->guardar();
                    //Mandar el correo para restablecer la contraseña
                    $email = new Emailer($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta('exito','Revisa tu email');
                    
                }
                else{
                    Usuario::setAlerta('error','El usuario no existe o no está confirmado');
                   
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/forget',['alertas'=>$alertas]);
    }
    public static function retrieve(Router $router)
    {
       $alertas=[];
       $error = false;
       $token = s($_GET['token']); 
       $usuario = Usuario::where('token',$token);
       if(empty($usuario)){
        Usuario::setAlerta('error','Token no valido');
        $error = true;
       }
       if($_SERVER['REQUEST_METHOD']==='POST'){
        $password = new Usuario($_POST);
        $alertas = $password->validarPassword();
        if(empty($alertas)){
            $usuario->password = null;
            $usuario->password = $password->password;
            $usuario->hashPassword();
            $usuario->token = null;
            $resultado = $usuario->guardar();
            if($resultado){
                header('Location: /');
            }
        }
        
       }
       $alertas = Usuario::getAlertas();
       $router->render('auth/retrieve-password',['alertas'=>$alertas,'error'=>$error]);
    }
    public static function create(Router $router)
    {   
        $usuario = new Usuario($_POST);
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            //Validaciones
           $usuario->sincronizar($_POST);
           $alertas = $usuario->validarNuevaCuenta();
           //Revisar que alertas este vacio
           if(empty($alertas)){
            //Verificar que el usuario no este registrado
            $resultado = $usuario->existeUsuario();
            if($resultado->num_rows){
                $alertas = Usuario::getAlertas();
            }
            else{
                    //Hashear el password
                    $usuario->hashPassword();
                    
                    //Generar token unico
                    $usuario->createToken();
                    $email = new Emailer($usuario->email,$usuario->nombre,$usuario->token);

                    $email->enviarConfirmacion();
                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
           
           }
            
        }
        $router->render('auth/create-cuenta',[
            'usuario'=>$usuario,
            'alertas'=>$alertas,
        ]);
    }
    public static function confirm(Router $router){
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token',$token);
        if(empty($usuario)){
            //Mostrar mensaje de error
            Usuario::setAlerta('error','Token No Valido');
        } else{
            //Actualizar a confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito','Token confirmado');
        }
        //Obtener alertas
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirm',[
            'alertas'=>$alertas
        ]);
    }
    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
        
    }
}