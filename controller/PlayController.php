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
        $data=array();
        $this->renderer->render('play',$data);
    }

    public function jugar()
    {
        $model = new playModel($this->database);

        $tematicaID = mt_rand(1, 4);

        $pregunta = $model->getPreguntaRandom($tematicaID);

        if ($pregunta) {
            $preguntaID = $pregunta['Pregunta_ID'];
            $respuestas = $model->getRespuestas($preguntaID);
            $data = array(
                'pregunta' => $pregunta,
                'respuestas' => $respuestas
            );
            $this->renderer->render('play', $data);
        } else {
            $this->renderer->render('perdiste');
        }
    }

    public function validarRespuesta()
    {
        $respuestaID = $_POST['respuestaID'];
        $model = new playModel($this->database);
        $respuestaCorrecta = $model->validarRespuesta($respuestaID);
        if ($respuestaCorrecta) {
            $this->jugar();
        } else {
            $this->renderer->render('perdiste');
        }
    }
}