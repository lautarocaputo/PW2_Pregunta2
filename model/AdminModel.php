<?php

class AdminModel{

    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function getCantidadUsuarios(){
        $query = "SELECT COUNT(id) AS CANTIDAD_USUARIOS FROM usuarios";
        return $this->database->query($query);
    }

    public function getPreguntaTopUno(){
        $query = "SELECT pregunta_texto, contador_respuestas_correctas FROM preguntas WHERE contador_respuestas_correctas = 
                                           (SELECT MAX(contador_respuestas_correctas) FROM preguntas)";
        return $this->database->query($query);
    }
    public function getPreguntaTopDos(){
        $query = "SELECT pregunta_texto, contador_respuestas_correctas
FROM preguntas
ORDER BY contador_respuestas_correctas DESC
LIMIT 1 OFFSET 1";
        return $this->database->query($query);
    }
    public function getPreguntaTopTres(){
        $query ="SELECT pregunta_texto, contador_respuestas_correctas
FROM preguntas
ORDER BY contador_respuestas_correctas DESC
LIMIT 1 OFFSET 2";
        return $this->database->query($query);
    }
    public function getPreguntaTopCuatro(){
        $query = "SELECT pregunta_texto, contador_respuestas_correctas
FROM preguntas
ORDER BY contador_respuestas_correctas DESC
LIMIT 1 OFFSET 3";
        return $this->database->query($query);
    }
    public function getPreguntaTopCinco(){
        $query = "SELECT pregunta_texto, contador_respuestas_correctas
FROM preguntas
ORDER BY contador_respuestas_correctas DESC
LIMIT 1 OFFSET 4";
        return $this->database->query($query);
    }
}
