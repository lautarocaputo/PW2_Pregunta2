<?php

class RegisterController{

    private $registerModel;
    private $renderer;

    public function __construct($registerModel, $renderer)
    {
        $this->registerModel = $registerModel;
        $this->renderer = $renderer;
    }

    public function register(){
        $this->renderer->render('register');
    }

    public function registration(){
        $name = $_POST['name'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $sexo = $_POST['sexo'];
        $pais = $_POST['pais'];
        $ciudad = $_POST['ciudad'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $foto_perfil = $_POST['foto_perfil'];
        $latitud = $_POST['lat'];
        $longitud = $_POST['long'];
        $existe = false;

        $userExistente = $this->registerModel->checkUser($username);
        $emailExistente = $this->registerModel->checkMail($email);
        if (!empty($userExistente)){
            $error['errorUsuarioExistente'] = "El usuario ya existe.";
            $this->renderer->render('register', $error);
            $existe = true;
        }
        if (!empty($emailExistente)){
            $error['errorEmailExistente'] = "El email ya esta en uso.";
            $this->renderer->render('register', $error);
            $existe = true;
        }
        if($existe===false){
            $this->registerModel->register($name, $fecha_nacimiento, $sexo, $pais, $ciudad, $email, $password, $username, $foto_perfil,$latitud,$longitud);
            $this->mailBienvenida($email,$name);
            header('location: /home');
            exit();
        }
    }

    public function mailBienvenida($mail,$nombreUsuario){
        $this->registerModel->mailBienvenida($mail,$nombreUsuario);
    }
}