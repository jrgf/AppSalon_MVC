<?php 
namespace Controller;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;
use MVC\Router;

class APIController{
    public static function servicios(){
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }
    public static function guardar(){
        //Almacena la cita y devuelve el Id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        //Almacena la cita y los servicios
        $id = $resultado['id'];
        $idServicios = explode(',',$_POST['servicios']);

        foreach($idServicios as $idServicio){
            $args = [
                'citasId'=>$id,
                'servicioId'=>$idServicio];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
        echo json_encode(['resultado'=>$resultado]);
    }
    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
}