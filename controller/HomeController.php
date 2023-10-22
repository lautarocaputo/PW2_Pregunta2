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
        $this->homeModel->marcarPreguntasUtilizadas();
        $this->homeModel->resetearPuntaje($idUser);
        $data["user"] = $this->homeModel->getUserById($idUser);
        $data["rankingScore"] = $this->homeModel->getUserWithHighestScore($idUser);
        $this->renderer->render('home', $data);
    }
}