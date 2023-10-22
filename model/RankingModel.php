<?php

class RankingModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getUserWithHighestScore($idUser)
    {
        $sql = "SELECT puntuacion_masAlta, nombre_completo FROM usuarios;
        $user = $this->database->query($sql);
        return $user[0];
    }
}