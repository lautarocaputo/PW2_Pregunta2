<?php

class ProfileController
{
    private $profileModel;
    private $renderer;

    public function __construct($profileModel, $renderer)
    {
        $this->profileModel = $profileModel;
        $this->renderer = $renderer;
    }

    public function index()
    {
        $data = array();
        $this->renderer->render('profile', $data);
    }

    public function perfil()
    {
        if (empty($_GET['idUsuario'])) {
          $idUser = $_SESSION['actualUser'];
          $data["user"] = $this->profileModel->getUserById($idUser); 
          $data["isPropioUsuario"] = true;
          $data['esEditor'] = $_SESSION['esEditor'] ?? "";
          $data['esAdmin'] = $_SESSION['esAdmin'] ?? "";

          $this->renderer->render("profile", $data);
        } else {
            $data["user"] = $this->profileModel->getUserById($_GET['idUsuario']);
            $this->renderer->render("profile", $data);
        }
    }

    public function buscarPerfil()
    {
        $usuario = $_POST['usuario'];

        if ($this->profileModel->buscarPerfil($usuario)) {
            $data["user"] = $this->profileModel->buscarPerfil($usuario);
            $this->renderer->render('profile', $data);
        } else {
            $data["error"] = "No se ha encontrado el usuario";
            $this->renderer->render("404", $data);
        }
    }

    public function getUbicacion()
    {
        if ($_GET['id'] != null) {
            $idUser = $_GET['id'];

            $coordenadas["latitud"] = $this->profileModel->getLatitud($idUser)["latitud"];
            $coordenadas["longitud"] = $this->profileModel->getLongitud($idUser)["longitud"];

            echo json_encode($coordenadas);
        }
    }

    public function cargarEditarPerfil(){
        $this->renderer->render('editarProfile');
    }

    public function guardarCambios(){

        $data = array();
    
        $idUser = $_SESSION['actualUser'];
        $name = $_POST["name"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $sexo = $_POST["sexo"];
        $pais = $_POST["pais"];
        $ciudad = $_POST["ciudad"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordConfirm = $_POST["passwordConfirm"];
        $username = $_POST["username"];
    
        if( $password != $passwordConfirm){
            $data['error']= "Las contraseñas no coinciden";
            $this->renderer->render('editarProfile', $data);
            return;
        } else {
            $this->profileModel->guardarCambios($idUser, $name, $fecha_nacimiento, $sexo, $pais, $ciudad, $email, $password, $username);
            header("Location: /profile/perfil");
        }
    }
}
