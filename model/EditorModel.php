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