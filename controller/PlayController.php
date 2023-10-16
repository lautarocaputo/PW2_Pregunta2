<?php

class PlayController
{
    private $playModel;
    private $renderer;

    public function __construct($playModel, $renderer)
    {
        $this->playModel = $playModel;
        $this->renderer = $renderer;
    }


    public function index()
    {
        $data = array();
        $this->renderer->render('play', $data);
    }

    public function jugar()
    {
        if ($pregunta = $this->playModel->getPreguntaRandom()) {
            $tematica = $pregunta['Tematica_ID'];
            $respuestas = $this->playModel->getRespuestas($tematica);
            $data = array(
                'pregunta' => $pregunta,
                'respuestas' => $respuestas,
                'Puntaje' => $_SESSION['puntaje']
            );
            $this->renderer->render('play', $data);
        } else {
            $this->renderer->render('perdiste', ['error_msg' => 'No hay mas preguntas disponibles en este momento.']);
        }
    }

    public function validarRespuesta()
    {
        $respuestaID = $_POST['respuestaID'];
        $preguntaID = $_GET['preguntaID'];
        $puntos = $_GET['puntos'];
        $model = $this->playModel;

        $model->marcarPreguntaUtilizada($preguntaID);

        $respuestaCorrecta = $model->validarRespuesta($respuestaID);
        
        if (!$respuestaCorrecta) {
            $_SESSION['puntaje'] = 0;
            $this->renderer->render('perdiste', ['error_msg' => 'Perdiste, respuesta incorrecta.']);
        } else {
            $_SESSION['puntaje'] += $puntos;
            $this->jugar();
        }
    }
}
