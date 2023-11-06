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
        $idUser = $_SESSION['actualUser'];
        $data["user"] = $this->profileModel->getUserById($idUser);
        $this->renderer->render("profile", $data);
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
}
