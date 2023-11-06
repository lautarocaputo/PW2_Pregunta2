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

    public function list()
    {
        $data["suggestedQuestion"] = $this->editorModel->getSuggestedQuestion();
        $data["reportedQuestions"] = $this->editorModel->getReportedQuestionWithQuestion();

        $this->renderer->render('editor', $data);
    }

    public function aprobarODenegarPregunta(){
        if(isset($_POST['pregunta_id'])){
            if($_POST['action'] === 'aprobar'){
                foreach ($_POST['pregunta_id'] as $pregunta_id){
                    $this->editorModel->aprobarPregunta($pregunta_id);
                }
            }elseif ($_POST['action'] === 'denegar'){
                foreach ($_POST['pregunta_id'] as $pregunta_id){
                    $this->editorModel->denegarPregunta($pregunta_id);
                }
            }
        }
        $data["suggestedQuestion"] = $this->editorModel->getSuggestedQuestion();
        $data["reportedQuestions"] = $this->editorModel->getReportedQuestionWithQuestion();
        $this->renderer->render('editor', $data);
    }
}