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
        // Lógica para mostrar el formulario de inicio de sesión
        $this->renderer->render('login');
    }

    public function ingresarlogin()
    {
        // Lógica para procesar el inicio de sesión

        $username = $_POST['username'];
        $password = $_POST['password'];
        $usuario = $this->loginModel->getUser($username, $password);
        $idUsuario = $usuario[0]['id'] ?? "";
        $usuarioVerificado = $usuario[0]['esta_verificado'] ?? "";

        if (!empty($usuario)) {
            $_SESSION['actualUser'] = $idUsuario;
            if ($usuario[0]['rol'] == 'editor') {
                $_SESSION['esEditor'] = true;
            }
            header('location: /');
            exit();
        } else {
            $error['errorDatos'] = "El username o contraseña son incorrectos";
            $this->renderer->render('login', $error);
        }
    }
}