<?php

class HomeController
{

    private $renderer;

    public function __construct($homeModel, $renderer)
    {
        $this->homeModel = $homeModel;
        $this->renderer = $renderer;
    }

    public function list()
    {
        $idUser = $_SESSION['actualUser'];
        $data["user"] = $this->homeModel->getUserById($idUser);
        $this->renderer->render('home', $data);
    }
}