<?php
class PlayController {
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
        if (!isset($_SESSION['tiempoRestante']) || $_SESSION['tiempoRestante'] <= 0) {
            $this->terminarPartida();
            return;
        }

        $pregunta = $this->playModel->getPreguntaRandom();

        if (!$pregunta) {
            $this->terminarPartida();
            return;
        }

        $tematica = $pregunta['Tematica_ID'];
        $respuestas = $this->playModel->getRespuestas($tematica);
        shuffle($respuestas);

        $data = [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas,
            'puntaje' => $_SESSION['puntaje'],
            'puntajeMasAlto' => isset($_SESSION['puntajeMasAlto']),
            'tiempoRestante' => $_SESSION['tiempoRestante'] = 10,
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
        $model = $this->playModel;

        $model->marcarPreguntaUtilizada($preguntaID);

        $respuestaCorrecta = $model->validarRespuesta($respuestaID);

        if (!$respuestaCorrecta) {
            $this->terminarPartida();
        } else {
            $_SESSION['puntaje'] += 1;
            $puntajeEnPartida = $_SESSION['puntaje'];
            $this->playModel->guardarPuntaje($_SESSION['actualUser'], $puntajeEnPartida);
            $this->jugar();
        }
    }

    public function terminarPartida()
    {
        $puntajeActual = $this->playModel->getPuntajeActual($_SESSION['actualUser']);
        $puntajeMasAlto = $this->playModel->getPuntajeMasAlto($_SESSION['actualUser']);

        if ($puntajeActual > $puntajeMasAlto) {
            $this->playModel->actualizarPuntajeMasAlto($_SESSION['actualUser'], $puntajeActual);
        }

        $this->playModel->guardarPuntaje($_SESSION['actualUser'], 0);
        $_SESSION['puntaje'] = 0;
        $puntajeMasAlto = $this->playModel->getPuntajeMasAlto($_SESSION['actualUser']);
        $_SESSION['puntajeMasAlto'] = $puntajeMasAlto;

        $this->playModel->marcarPreguntasUtilizadas();

        $this->renderer->render('perdiste', ['puntaje' => $puntajeActual, 'puntajeMasAlto' => $puntajeMasAlto]);
    }

    public function getTiempoRestante()
    {
        $tiempoRestante = isset($_SESSION['tiempoRestante']) ? $_SESSION['tiempoRestante'] : 0;

        header('Content-Type: application/json');
        echo json_encode(['tiempoRestante' => $tiempoRestante]);
    }

    public function mostrarPuntuacion()
    {
        $puntajeActual = $this->playModel->getPuntajeActual($_SESSION['actualUser']);
        $puntajeMasAlto = $this->playModel->getPuntajeMasAlto($_SESSION['actualUser']);

        if ($puntajeActual > $puntajeMasAlto) {
            $this->playModel->actualizarPuntajeMasAlto($_SESSION['actualUser'], $puntajeActual);
        }

        $this->playModel->guardarPuntaje($_SESSION['actualUser'], 0);
        $_SESSION['puntaje'] = 0;
        $puntajeMasAlto = $this->playModel->getPuntajeMasAlto($_SESSION['actualUser']);
        $_SESSION['puntajeMasAlto'] = $puntajeMasAlto;

        $this->playModel->marcarPreguntasUtilizadas();

        $this->renderer->render('perdiste', ['puntaje' => $puntajeActual, 'puntajeMasAlto' => $puntajeMasAlto]);
    }
}