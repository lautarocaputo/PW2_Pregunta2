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

    public function perfil()
    {
        $idUser = $_SESSION['actualUser'];
        $data["user"] = $this->profileModel->getUserById($idUser);
        $this->renderer->render("perfil", $data);
    }
}