<?php 
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;
class Emailer{

    public $email;
    public $nombre;
    public $token;
    public function __construct($email,$nombre,$token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    public function enviarConfirmacion(){
        $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'bd064cd704ebfe';
    $phpmailer->Password = '245decf911be39';

    $phpmailer->setFrom('cuentas@appsalon.com');
    $phpmailer->addAddress('cuentas@appsalon.com','Appsalon.com');
    $phpmailer->isHTML(TRUE);
    $phpmailer->CharSet = "UTF-8";
    $phpmailer->Subject = 'Confirma tu cuenta';


    $contenido = "<html>";
    $contenido .= "<p><strong>Hola ".$this->nombre."</strong> Has creado tu cuenta en AppSalon.Confirmala visitando el siguiente enlace</p>";
    $contenido .= "<p>Presiona aquí <a href = 'http://localhost:3000/confirm-cuenta?token=".$this->token."'>Confirmar cuenta</a></p>";
    $contenido .= "<p>Si no solicitaste esta cuenta.Ignora este correo</p></html>";
    $phpmailer->Body = $contenido;
    
    $phpmailer->send();

    }
    public function enviarInstrucciones(){
        $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'bd064cd704ebfe';
    $phpmailer->Password = '245decf911be39';

    $phpmailer->setFrom('cuentas@appsalon.com');
    $phpmailer->addAddress('cuentas@appsalon.com','Appsalon.com');
    $phpmailer->isHTML(TRUE);
    $phpmailer->CharSet = "UTF-8";
    $phpmailer->Subject = 'Restablece tu password';


    $contenido = "<html>";
    $contenido .= "<p><strong>Hola ".$this->nombre."</strong> Has solicitado restablecer tu password.Sigue el siguiente enlace para hacerlo</p>";
    $contenido .= "<p>Presiona aquí <a href = 'http://localhost:3000/retrieve?token=".$this->token."'>Recuperar password</a></p>";
    $contenido .= "<p>Si no solicitaste esta cuenta.Ignora este correo</p></html>";
    $phpmailer->Body = $contenido;
    
    $phpmailer->send();

    }
    
}