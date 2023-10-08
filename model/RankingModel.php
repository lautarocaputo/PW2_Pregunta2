<?php

class RankingModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getRanking() {
        //return $this->database->query('SELECT * FROM ranking');
    }
}