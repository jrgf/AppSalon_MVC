<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\LoginController;
use Controller\CitaController;
use Controller\APIController;
use Controller\AdminController;
use Controller\ServicioController;

$router = new Router();

//Iniciar Sesión
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);

//Recuperar Password
$router->get('/forget',[LoginController::class,'forget']);
$router->post('/forget',[LoginController::class,'forget']);
$router->get('/retrieve',[LoginController::class,'retrieve']);
$router->post('/retrieve',[LoginController::class,'retrieve']);
//Crear cuenta

$router->get('/create-cuenta',[LoginController::class,'create']);
$router->post('/create-cuenta',[LoginController::class,'create']);

//Confirmar cuenta
$router->get('/confirm-cuenta',[LoginController::class,'confirm']);
$router->get('/mensaje',[LoginController::class,'mensaje']);
//Area Privada
$router->get('/cita',[CitaController::class, 'index']);
$router->get('/admin',[AdminController::class, 'index']);
//API de citas
$router->get('/api/servicios',[APIController::class,'servicios']);
$router->post('/api/citas',[APIController::class,'guardar']);
$router->post('/api/eliminar',[APIController::class,'eliminar']);
$router->get('/servicios',[ServicioController::class,'index']);
$router->get('/servicios/crear',[ServicioController::class,'crear']);
$router->post('/servicios/crear',[ServicioController::class,'crear']);
$router->get('/servicios/actualizar',[ServicioController::class,'actualizar']);
$router->post('/servicios/actualizar',[ServicioController::class,'actualizar']);
$router->post('/servicios/eliminar',[ServicioController::class,'eliminar']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();