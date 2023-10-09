<?php
class RegisterModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function checkUser($username)
    {
        $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$username'";
        return $this->database->query($query);
    }

    public function checkMail($email)
    {
        $query = "SELECT * FROM usuarios WHERE correo_electronico = '$email'";
        return $this->database->query($query);
    }

    public function register($name, $fecha_nacimiento, $sexo, $pais, $ciudad, $email, $password, $username, $foto_perfil)
    {
        $query = "INSERT INTO usuarios(nombre_completo, ano_nacimiento, sexo, pais, ciudad, correo_electronico, contrasena, nombre_usuario, foto_perfil, activo) 
VALUES('$name', '$fecha_nacimiento', '$sexo', '$pais', '$ciudad', '$email', '$password', '$username', '$foto_perfil', 'true')";
        return $this->database->insert($query);
    }
}

