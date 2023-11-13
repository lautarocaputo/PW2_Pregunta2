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
        $query = "SELECT r.* FROM respuesta r WHERE r.Pregunta_ID = $preguntaID ORDER BY r.Correcta desc";

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

        $query = "DELETE FROM `respuesta` WHERE `Pregunta_ID` = '$idPregunta'";
        $this->database->update($query);
       
        $query = "INSERT INTO `respuesta` (`Respuesta_texto`, `Correcta`, `Pregunta_ID`) VALUES ('$respuesta1', '1', '$idPregunta')";
        $this->database->insert($query);
        
        $query = "INSERT INTO `respuesta` (`Respuesta_texto`, `Correcta`, `Pregunta_ID`) VALUES ('$respuesta2', '0', '$idPregunta')";
        $this->database->insert($query);
        
        $query = "INSERT INTO `respuesta` (`Respuesta_texto`, `Correcta`, `Pregunta_ID`) VALUES ('$respuesta3', '0', '$idPregunta')";
        $this->database->insert($query);
        
        $query = "INSERT INTO `respuesta` (`Respuesta_texto`, `Correcta`, `Pregunta_ID`) VALUES ('$respuesta4', '0', '$idPregunta')";
        $this->database->insert($query);

        $query = "DELETE FROM `preguntas_reportadas` WHERE `id_pregunta_reportada` = '$idPregunta'";
        $this->database->update($query);
    }
    
    public function aprobarPregunta($pregunta_id){
        $query = "UPDATE preguntas_sugeridas SET aprobada = 1 WHERE id = $pregunta_id";
         If($this->database->update($query)){
             $this->insertQuestionAroved($pregunta_id);
             $this->insertAnswers();
             $this->deleteQuestionAproved($pregunta_id);
         }
    }

    public function denegarPregunta($pregunta_id){
        $query = "DELETE FROM preguntas_sugeridas WHERE id = $pregunta_id";
        return $this->database->delete($query);
    }

    public function insertQuestionAroved($pregunta_id){
        $query = "INSERT INTO preguntas(Pregunta_texto) SELECT pregunta FROM preguntas_sugeridas WHERE id = $pregunta_id";
        return $this->database->insert($query);
    }

    public function insertAnswers(){
        $query = "INSERT INTO respuesta(Pregunta_ID, correcta, Respuesta_texto)
SELECT p.Pregunta_ID, 1, ps.respuesta_correcta FROM preguntas_sugeridas ps, preguntas p WHERE ps.pregunta = p.Pregunta_texto 
UNION ALL
SELECT p.Pregunta_ID, 0, ps.primera_respuesta_incorrecta FROM preguntas_sugeridas ps, preguntas p WHERE ps.pregunta = p.Pregunta_texto
UNION ALL
SELECT p.Pregunta_ID, 0, ps.segunda_respuesta_incorrecta FROM preguntas_sugeridas ps, preguntas p WHERE ps.pregunta = p.Pregunta_texto 
UNION ALL
SELECT p.Pregunta_ID, 0, ps.tercera_respuesta_incorrecta FROM preguntas_sugeridas ps, preguntas p WHERE ps.pregunta = p.Pregunta_texto";
        return $this->database->insert($query);
    }

    public function deleteQuestionAproved($pregunta_id){
        $query = "DELETE FROM preguntas_sugeridas WHERE id = $pregunta_id";
        return $this->database->delete($query);
    }
}