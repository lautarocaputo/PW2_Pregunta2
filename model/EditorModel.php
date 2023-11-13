<?php

class EditorModel

{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getSuggestedQuestion() {
        $query = "SELECT * FROM preguntas_sugeridas";
        return $this->database->query($query);
    }

    public function getReportedQuestionWithQuestion() {
        $query = "SELECT pr.id_pregunta_reportada, pr.motivo, p.Pregunta_ID, p.Pregunta_texto
                  FROM preguntas_reportadas pr
                  LEFT JOIN preguntas p ON pr.id_pregunta_reportada = p.Pregunta_ID";
        return $this->database->query($query);
    }

    public function getPreguntaPorId($preguntaID){
        $query = "SELECT * FROM preguntas WHERE Pregunta_ID = $preguntaID";
        return $this->database->query($query);
    }

    public function getRespuestasPorIdPregunta($preguntaID){
        $query = "SELECT r.* FROM respuestas r 
        INNER JOIN preguntas p ON r.Tematica_ID = p.Tematica_ID
        WHERE p.Pregunta_ID = $preguntaID ORDER BY r.Correcta desc";

        return $this->database->query($query);
    }

    public function getTematicaPorIdPregunta($preguntaID){
        $query = "SELECT Tematica_ID FROM preguntas WHERE Pregunta_ID = $preguntaID";
        return $this->database->query($query); 
    }

    public function corregirPregunta($idPregunta,$pregunta,$respuesta1,$respuesta2,$respuesta3,$respuesta4){

        $pregunta = $this->database->escape($pregunta);
        $respuesta1 = $this->database->escape($respuesta1);
        $respuesta2 = $this->database->escape($respuesta2);
        $respuesta3 = $this->database->escape($respuesta3);
        $respuesta4 = $this->database->escape($respuesta4);


        $query = "UPDATE `preguntas` SET Pregunta_texto = '$pregunta' WHERE Pregunta_ID = $idPregunta";
        $this->database->update($query);
       
        $tematicaId = $this->getTematicaPorIdPregunta($idPregunta)[0][0];

        $query = "DELETE FROM `respuestas` WHERE `Tematica_ID` = '$tematicaId'";
        $this->database->update($query);
       
        $query = "INSERT INTO `respuestas` (`Respuesta_texto`, `Correcta`, `Tematica_ID`) VALUES ('$respuesta1', '1', '$tematicaId')";
        $this->database->insert($query);
        
        
        $query = "INSERT INTO `respuestas` (`Respuesta_texto`, `Correcta`, `Tematica_ID`) VALUES ('$respuesta2', '0', '$tematicaId')";
        $this->database->insert($query);
        
        $query = "INSERT INTO `respuestas` (`Respuesta_texto`, `Correcta`, `Tematica_ID`) VALUES ('$respuesta3', '0', '$tematicaId')";
        $this->database->insert($query);
        
        $query = "INSERT INTO `respuestas` (`Respuesta_texto`, `Correcta`, `Tematica_ID`) VALUES ('$respuesta4', '0', '$tematicaId')";
        $this->database->insert($query);

        $query = "DELETE FROM `preguntas_reportadas` WHERE `id_pregunta_reportada` = '$idPregunta'";
        $this->database->update($query);
    }
    
}