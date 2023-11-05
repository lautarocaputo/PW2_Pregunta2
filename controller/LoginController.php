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

        if (!empty($usuario)) {

            $lat = $_POST['lat'];
            $long = $_POST['long'];

            $this->loginModel->actualizarCoordenadas($lat, $long, $idUsuario);

            $_SESSION['actualUser'] = $idUsuario;

            header('location: /');
            exit();
        } else {
            $error['errorDatos'] = "El username o contraseña son incorrectos";
            $this->renderer->render('login', $error);
        }
    }
}