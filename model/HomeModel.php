<?php

class HomeModel

{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getUserById($id) {
        $query = "SELECT * FROM usuarios WHERE id = '$id'";
        return $this->database->query($query);
    }

    public function marcarPreguntasUtilizadas() {
        $sql = "UPDATE Preguntas SET Utilizada = 0 WHERE Utilizada = 1";
        $this->database->query($sql);
    }

    public function resetearPuntaje($userID)
    {
        $sql = "UPDATE usuarios SET puntuacion_actual = 0 WHERE id = $userID";
        return $this->database->update($sql);
    }

}