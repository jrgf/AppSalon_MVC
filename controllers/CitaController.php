<?php 

namespace Controller;
use Model\Usuario;
use MVC\Router;

class CitaController{
    public static function index(Router $router){

        session_start();
        isAuth();
        $router->render('cita/index',['nombre'=>$_SESSION['nombre'],'id'=>$_SESSION['id']]);
    }
}