<?php

class playModel

{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getPreguntaRandom($tematicaID) {
        $sql = "SELECT * FROM Preguntas WHERE Tematica_ID = $tematicaID AND Utilizada = 0 ORDER BY RAND() LIMIT 1";
        $pregunta = $this->database->query($sql);

        if (!empty($pregunta)) {
            $preguntaID = $pregunta[0]['Pregunta_ID'];
            $this->marcarPreguntaUtilizada($preguntaID);
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
        $sql = "SELECT * FROM Respuestas WHERE Respuesta_ID = $respuestaID AND Es_Correcta = 1";
        $respuesta = $this->database->query($sql);

        return !empty($respuesta);
    }

}