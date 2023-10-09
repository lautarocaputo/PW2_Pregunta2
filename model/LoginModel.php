<?php

class LoginModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUser($username, $password)
    {
        $query = "SELECT * FROM usuario WHERE username = '$username' AND password = '$password'";
        return $this->database->query($query);
    }

    public function setUserVerified($token) {
        $query =  "UPDATE usuario SET esta_verificado = 'true' WHERE verify_token = '$token'";
        return $this->database->update($query);
    }

}