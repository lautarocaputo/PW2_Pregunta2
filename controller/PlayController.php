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
        $pregunta = $this->playModel->getPreguntaRandom();

        if (!$pregunta) {
            $this->mostrarPuntuacion();
            return;
        }

        $tematica = $pregunta['Tematica_ID'];
        $respuestas = $this->playModel->getRespuestas($tematica);
        shuffle($respuestas);

        $data = [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas,
            'puntaje' => $_SESSION['puntaje'],
        ];

        $this->renderer->render('play', $data);
    }

    public function validarRespuesta()
    {
        if (!isset($_POST['respuestaID'])) {
            $this->renderer->render('perdiste', ['error_msg' => 'Tienes que seleccionar una respuesta.']);
            return;
        }

        $respuestaID = $_POST['respuestaID'];
        $preguntaID = $_GET['preguntaID'];
        $puntos = $_GET['puntos'];
        $model = $this->playModel;

        $model->marcarPreguntaUtilizada($preguntaID);

        $respuestaCorrecta = $model->validarRespuesta($respuestaID);

        if (!$respuestaCorrecta) {
            $this->jugar();
        } else {
            $_SESSION['puntaje'] += 1;
            $this->jugar();
        }
    }

    private function mostrarPuntuacion()
    {
        $puntajeActual = $this->playModel->getPuntajeActual($_SESSION['actualUser']);

        $this->playModel->guardarPuntaje($_SESSION['actualUser'], $puntajeActual);

        $puntajeMasAlto = $this->playModel->getPuntajeMasAlto($_SESSION['actualUser']);
        if ($puntajeActual > $puntajeMasAlto) {
            $this->playModel->actualizarPuntajeMasAlto($_SESSION['actualUser'], $puntajeActual);
        }
        $this->playModel->marcarPreguntasUtilizadas();

        $this->renderer->render('perdiste', ['puntaje' => $puntajeActual]);
    }

}

