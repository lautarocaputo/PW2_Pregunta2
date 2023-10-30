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
    
}