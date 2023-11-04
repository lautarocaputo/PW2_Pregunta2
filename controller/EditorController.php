<?php

class EditorController
{

    private $renderer;

    public function __construct($editorModel, $renderer)
    {
        $this->editorModel = $editorModel;
        $this->renderer = $renderer;
    }

    public function list()
    {
        $data["suggestedQuestion"] = $this->editorModel->getSuggestedQuestion();
        $data["reportedQuestions"] = $this->editorModel->getReportedQuestionWithQuestion();

        $this->renderer->render('editor', $data);
    }

    public function aprobarPregunta(){
        if(isset($_POST['pregunta_id'])){
            foreach ($_POST['pregunta_id'] as $pregunta_id){
                $this->editorModel->aprobarPregunta($pregunta_id);
            }
            $data["suggestedQuestion"] = $this->editorModel->getSuggestedQuestion();
            $data["reportedQuestions"] = $this->editorModel->getReportedQuestionWithQuestion();
            $this->renderer->render('editor', $data);
        }
    }
}