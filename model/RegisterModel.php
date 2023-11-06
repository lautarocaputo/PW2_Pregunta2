<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'third-party/PHPMailer/src/Exception.php';
require 'third-party/PHPMailer/src/PHPMailer.php';
require 'third-party/PHPMailer/src/SMTP.php';

class RegisterModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function checkUser($username)
    {
        $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$username'";
        return $this->database->query($query);
    }

    public function checkMail($email)
    {
        $query = "SELECT * FROM usuarios WHERE correo_electronico = '$email'";
        return $this->database->query($query);
    }

    public function register($name, $fecha_nacimiento, $sexo, $pais, $ciudad, $email, $password, $username,$lat,$long)
    {
        $query = "INSERT INTO usuarios(nombre_completo, ano_nacimiento, sexo, pais, ciudad, correo_electronico, contrasena, nombre_usuario,  activo,latitud,longitud) 
                  VALUES('$name', '$fecha_nacimiento', '$sexo', '$pais', '$ciudad', '$email', '$password', '$username', 'true',$lat,$long)";
        return $this->database->insert($query);
    }

    public function mailBienvenida($mailDestino,$usuarioDestino){
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lautaro0611@gmail.com';
        $mail->Password = 'iadi vdgf eodl axyn';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('Pregunta2@games.com', 'Pregunta2');
        $mail->addAddress($mailDestino, $usuarioDestino);
        $mail->Subject = 'Bienvenida';
        $mail->Body = 'Gracias por registrarte en Pregunta2!';

        if ($mail->send()) {
            return true;
        } else {
            return 'Error al enviar el correo: ' . $mail->ErrorInfo;
        }
    
    }
}

