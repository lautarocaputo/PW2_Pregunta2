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
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $this->loginModel->setUserVerified($token);
        }
    }

    public function ingresarlogin()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashPassword = md5($password);
        $usuario = $this->loginModel->getUser($username, $hashPassword);
        $idUsuario = $usuario[0]['idUsuario'] ?? "";
        $usuarioVerificado = $usuario[0]['esta_verificado'] ?? "";


        if (!empty($usuario) && $usuarioVerificado == 'true') {
            $_SESSION['actualUser'] = $idUsuario;
            header('location: /');
            exit();
        } else {
            $error['errorDatos'] = "El username o contraseña son incorrectos";
            $this->renderer->render('login', $error);
        }


    }
}