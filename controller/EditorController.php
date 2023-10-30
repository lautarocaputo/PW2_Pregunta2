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
}