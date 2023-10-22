<?php

class ProfileModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getUserById($idUser)
    {
        $sql = "SELECT * FROM usuarios WHERE id = '$idUser'";
        $user = $this->database->query($sql);
        return $user[0];
    }
}