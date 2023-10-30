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

    public function getPuntajeActual($actualUser) {
        $sql = "SELECT puntuacion_actual FROM usuarios WHERE id = $actualUser";
        $puntaje = $this->database->query($sql);
        return $puntaje[0]['puntuacion_actual'];
    }

    public function guardarPuntaje($userID, $puntaje)
    {
        $sql = "UPDATE usuarios SET puntuacion_actual = $puntaje WHERE id = $userID";
        return $this->database->update($sql);
    }

    public function getPuntajeMasAlto($userID)
    {
        $sql = "SELECT puntuacion_masalta FROM usuarios WHERE id = $userID";
        $result = $this->database->query($sql);

        if (!empty($result)) {
            return (int)$result[0]['puntuacion_masalta'];
        } else {
            return 0;
        }
    }

    public function actualizarPuntajeMasAlto($userID, $puntaje)
    {
        $sql = "UPDATE usuarios SET puntuacion_masalta = $puntaje WHERE id = $userID";
        return $this->database->update($sql);
    }

    public function marcarPreguntasUtilizadas() {
        $sql = "UPDATE Preguntas SET Utilizada = 0 WHERE Utilizada = 1";
        $this->database->query($sql);
    }

    public function reportQuestion($preguntaID) {
         $query = "INSERT INTO preguntas_reportadas (id_pregunta_reportada) VALUES($preguntaID);";
        return $this->database->insert($query);
    }    

}