<?php

class RankingController {
    private $RankingModel;

    public function __construct($RankingModel) {
        $this->RankingModel = $RankingModel;
    }

    public function mostrarRanking() {
        $canciones = $this->RankingModel->getRanking();
        include_once('view/ranking_view.php');
    }
}