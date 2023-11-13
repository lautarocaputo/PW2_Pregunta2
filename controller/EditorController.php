<?php

class EditorController
{

    private $renderer;
    private $editorModel;

    public function __construct($editorModel, $renderer)
    {
        $this->editorModel = $editorModel;
        $this->renderer = $renderer;
    }

    public function cargar(){
        $data["suggestedQuestion"] = $this->editorModel->getSuggestedQuestion();
        $this->renderer->render('editor', $data);
    }

    public function list()
    {
        $data["reportedQuestions"] = $this->editorModel->getReportedQuestionWithQuestion();
        echo json_encode($data);
    }

    public function cargarCorregirPregunta(){
        $id = $_GET["id_pregunta_reportada"];

        $data["pregunta"] = $this->editorModel->getPreguntaPorId($id);
        $data["respuestas"] = $this->editorModel->getRespuestasPorIdPregunta($id);
        $data["id_pregunta_reportada"] = $id;

        $this->renderer->render('corregirPregunta', $data);

    }

    public function corregirPregunta(){
        $idPregunta = $_POST["id"];
        $pregunta = $_POST["pregunta"];
        $respuesta1 = $_POST["respuesta1"];
        $respuesta2 = $_POST["respuesta2"];
        $respuesta3 = $_POST["respuesta3"];
        $respuesta4 = $_POST["respuesta4"];

        $this->editorModel->corregirPregunta($idPregunta,$pregunta,$respuesta1,$respuesta2,$respuesta3,$respuesta4);

        header("Location: /editor/cargar");
    }
}