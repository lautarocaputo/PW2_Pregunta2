<?php
class LoginController
{
    private $loginModel;
    private $renderer;

    public function __construct($loginModel, $renderer)
    {
        $this->loginModel = $loginModel;
        $this->renderer = $renderer;
    }

    public function login()
    {
        $this->renderer->render('login');
    }

    public function ingresarlogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usuario = $this->loginModel->getUser($username, $password);
        $idUsuario = $usuario[0]['id'] ?? "";
        $usuarioVerificado = $usuario[0]['esta_verificado'] ?? "";
        $lat = $_POST['lat'];
        $long = $_POST['long'];

        if (!empty($usuario)) {
            $_SESSION['actualUser'] = $idUsuario;
            $this->loginModel->actualizarCoordenadas($lat, $long, $idUsuario);
            if($usuario[0]['rol'] === 'e'){
                $_SESSION['esEditor'] = true;
            }elseif ($usuario[0]['rol'] === 'a'){
                $_SESSION['esAdmin'] = true;
            }
            header("Location:/ ");
            exit();
        } else {
            $error['errorDatos'] = "El username o contraseña son incorrectos";
            $this->renderer->render('login', $error);
        }
    }
}