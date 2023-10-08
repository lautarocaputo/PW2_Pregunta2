<?php

class PlayController {
    private $PlayModel;

    public function __construct($PlayModel) {
        $this->PlayModel = $PlayModel;
    }

    public function cargarMenu() {
        //cargar menu de partida
        $Partida = $this->PlayModel->menuDeJuego();
        include_once('view/jugar_view.php');
    }
}