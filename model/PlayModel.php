<?php

class playModel

{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getPreguntaRandom() {
        $sql = "SELECT * FROM Preguntas WHERE Utilizada = '0' ORDER BY RAND() LIMIT 1";
        $pregunta = $this->database->query($sql);

        if (!empty($pregunta)) {
            $preguntaID = $pregunta[0]['Pregunta_ID'];
            return $pregunta[0];
        }

        return null;
    }

    public function getRespuestas($tematica) {
        $sql = "SELECT * FROM Respuestas WHERE Tematica_ID = $tematica ORDER BY RAND()";
        return $this->database->query($sql);
    }

    public function marcarPreguntaUtilizada($preguntaID) {
        $sql = "UPDATE Preguntas SET Utilizada = 1 WHERE Pregunta_ID = $preguntaID";
        $this->database->query($sql);
    }

    public function validarRespuesta($respuestaID) {
        $sql = "SELECT * FROM respuestas WHERE Respuesta_ID = $respuestaID AND Correcta = 1";
        $respuesta = $this->database->query($sql);

        if(isset($respuesta[0])){
            return $respuesta[0];
        } else {
            return false;
        }
    }

}