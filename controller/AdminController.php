<?php

class AdminController{

    private $adminModel;
    private $renderer;
    public function __construct($adminModel, $renderer)
    {
        $this->adminModel = $adminModel;
        $this->renderer = $renderer;
    }

    public function list(){
        $preguntaUno = $this->adminModel->getPreguntaTopUno()[0]['pregunta_texto'];
        $respuestasCorrectaUno = $this->adminModel->getPreguntaTopUno()[0]['contador_respuestas_correctas'];
        $preguntaDos = $this->adminModel->getPreguntaTopDos()[0]['pregunta_texto'];
        $respuestasCorrectaDos = $this->adminModel->getPreguntaTopDos()[0]['contador_respuestas_correctas'];
        $preguntaTres = $this->adminModel->getPreguntaTopTres()[0]['pregunta_texto'];
        $respuestasCorrectaTres = $this->adminModel->getPreguntaTopTres()[0]['contador_respuestas_correctas'];
        $preguntaCuatro = $this->adminModel->getPreguntaTopCuatro()[0]['pregunta_texto'];
        $respuestasCorrectaCuatro = $this->adminModel->getPreguntaTopCuatro()[0]['contador_respuestas_correctas'];
        $preguntaCinco = $this->adminModel->getPreguntaTopCinco()[0]['pregunta_texto'];
        $respuestasCorrectaCinco = $this->adminModel->getPreguntaTopCinco()[0]['contador_respuestas_correctas'];

        $data = array("preguntaUno"=>$preguntaUno, "respuestasCorrectaUno"=>$respuestasCorrectaUno, "preguntaDos"=>$preguntaDos,
            "respuestasCorrectaDos"=>$respuestasCorrectaDos, "preguntaTres"=>$preguntaTres, "respuestasCorrectaTres"=>$respuestasCorrectaTres,
            "preguntaCuatro"=>$preguntaCuatro, "respuestasCorrectaCuatro"=>$respuestasCorrectaCuatro, "preguntaCinco"=>$preguntaCinco,
            "respuestasCorrectaCinco"=>$respuestasCorrectaCinco);
        $this->renderer->render('admin', $data);
    }
}