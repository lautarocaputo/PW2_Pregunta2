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
        
    public function getUserWithHighestScore($idUser) {
        $sql = "SELECT puntuacion_masAlta, nombre_completo FROM usuarios ORDER BY puntuacion_masAlta DESC";
        $user = $this->database->query($sql);
        return $user;
    }

    public function sendSuggestedQuestion($pregunta, $preguntaCorrecta, $primeraPreguntaIncorrecta, $segundaPreguntaIncorrecta, $terceraPreguntaIncorrecta) {
        if(!empty($pregunta) && !empty($preguntaCorrecta) && !empty($primeraPreguntaIncorrecta) && !empty($segundaPreguntaIncorrecta) && !empty($terceraPreguntaIncorrecta)) {
            $query = "INSERT INTO preguntas_sugeridas (pregunta, respuesta_correcta, primera_respuesta_incorrecta, segunda_respuesta_incorrecta, tercera_respuesta_incorrecta)
            VALUES('$pregunta', '$preguntaCorrecta', '$primeraPreguntaIncorrecta', '$segundaPreguntaIncorrecta', '$terceraPreguntaIncorrecta');";
            $this->database->insert($query);
        }
    }

    public function resetearPuntaje($userID)
    {
        $sql = "UPDATE usuarios SET puntuacion_actual = 0 WHERE id = $userID";
        return $this->database->update($sql);
    }

}