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
    public function getLatitud($idUser)
    {
        $sql = "SELECT latitud FROM usuarios WHERE id = '$idUser'";
        $latitud = $this->database->query($sql);
        return $latitud[0];
    }

    public function getLongitud($idUser)
    {
        $sql = "SELECT longitud FROM usuarios WHERE id = '$idUser'";
        $longitud = $this->database->query($sql);
        return $longitud[0];
    }


    public function guardarCambios($idUser, $name, $fecha_nacimiento, $sexo, $pais, $ciudad, $email, $password, $username)
    {
        if($idUser != null && $name != null && $fecha_nacimiento != null && $sexo != null && $pais != null && $ciudad != null && $email != null && $password != null && $username != null){
            
            $sql = "UPDATE usuarios SET nombre_completo = '$name', ano_nacimiento = '$fecha_nacimiento', sexo = '$sexo', pais = '$pais', ciudad = '$ciudad', correo_electronico = '$email', contrasena = '$password', nombre_usuario = '$username' WHERE id = '$idUser'";
            $this->database->query($sql);
        }
        
    }
}
