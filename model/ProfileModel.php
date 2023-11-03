<?php

class ProfileModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUserById($idUser)
    {
        $sql = "SELECT * FROM usuarios WHERE id = '$idUser'";
        $user = $this->database->query($sql);
        return $user[0];
    }

    public function buscarPerfil($usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$usuario' OR correo_electronico = '$usuario' OR nombre_completo LIKE '%$usuario%'";
        $user = $this->database->query($sql);

        if ($user) {
            return $user[0];
        } else {
            return false;
        }
    }
}
