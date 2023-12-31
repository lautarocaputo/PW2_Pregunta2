<?php

class Timer
{
    private $start_time = null;
    private $end_time = null;

    public function start()
    {
        $this->start_time = microtime(true);
    }

    public function stop()
    {
        $this->end_time = microtime(true);
    }

    public function getElapsedTime()
    {
        if ($this->start_time === null) {
            throw new Exception('You must start the timer before getting the elapsed time');
        }

        $end_time = $this->end_time !== null ? $this->end_time : microtime(true);

        return $end_time - $this->start_time;
    }
}


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

        $tiempoRestante = isset($_SESSION['tiempoRestante']) ? $_SESSION['tiempoRestante'] : 10;

        if ($tiempoRestante <= 0) {
            $this->terminarPartida();
            return;
        }

        if (!isset($_SESSION['preguntaActual'])) {
            $usuario = $_SESSION['actualUser'];
            $dificultadParaElUsuario = $this->playModel->calcularDificultadUsuario($usuario);

            try {
                $pregunta = $this->playModel->getPreguntaRandom($dificultadParaElUsuario);
                $_SESSION['preguntaActual'] = $pregunta;
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
                $this->terminarPartidaConMensaje($mensaje);
                return;
            }
        }

        $pregunta = $_SESSION['preguntaActual'];
        $tematica = $pregunta['Pregunta_ID'];
        $respuestas = $this->playModel->getRespuestas($tematica);
        shuffle($respuestas);

        $data = [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas,
            'puntaje' => $_SESSION['puntaje'] ?? 0,
            'puntajeMasAlto' => isset($_SESSION['puntajeMasAlto']),
            'tiempoRestante' => $tiempoRestante,
            'esEditor' => $_SESSION['esEditor'] ?? "",
            'esAdmin' => $_SESSION['esAdmin'] ?? "",
        ];
        $this->renderer->render('play', $data);

    }

    public function validarRespuesta()
    {

        if(!$this->validarTiempoPregunta($_SESSION['horaDeArranque'])){
            $this->terminarPartida();
            return;
        }

        if (!isset($_POST['respuestaID'])) { 
            $this->renderer->render('perdiste', ['error_msg' => 'Tienes que seleccionar una respuesta.', 'puntaje' => $this->playModel->getPuntajeActual($_SESSION['actualUser']), 'puntajeMasAlto' => $this->playModel->getPuntajeMasAlto($_SESSION['actualUser'])]);
            return;
        }

        if (!isset($_SESSION['preguntaActual']) || $_SESSION['preguntaActual']['Pregunta_ID'] !=$_GET['preguntaID']) {
            $this->terminarPartida();
            return;
        }

        unset($_SESSION['preguntaActual']);

        $usuario = $_SESSION['actualUser'];
        $respuestaID = $_POST['respuestaID'];
        $preguntaID = $_GET['preguntaID'];
        $model = $this->playModel;

        $model->marcarPreguntaUtilizada($preguntaID);

        $respuestaCorrecta = $model->validarRespuesta($respuestaID);

        if ($respuestaCorrecta) {
            $this->playModel->incrementarContadorRespuestasCorrectas($usuario, $preguntaID);
            $this->playModel->calcularDificultadPregunta($preguntaID);
            $this->playModel->calcularDificultadUsuario($usuario);
            if (!isset($_SESSION['puntaje'])) {
                $_SESSION['puntaje'] = 0;
            }
            $_SESSION['puntaje']++;
            $puntajeEnPartida = $_SESSION['puntaje'];
            $this->playModel->guardarPuntaje($_SESSION['actualUser'], $puntajeEnPartida);
            $this->jugar();
        } else {
            $this->playModel->incrementarContadorRespuestasIncorrectas($usuario, $preguntaID);
            $this->playModel->calcularDificultadPregunta($preguntaID);
            $this->playModel->calcularDificultadUsuario($usuario);
            $this->terminarPartida();
        }
    }

    public function setTiempoRestante()
    {
        $tiempoRestante = isset($_POST['tiempoRestante']) ? $_POST['tiempoRestante'] : 10;

        $_SESSION['tiempoRestante'] = $tiempoRestante;

        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
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

    public function terminarPartidaConMensaje($mensaje)
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

        $this->renderer->render('perdiste', ['error_msg' => $mensaje, 'puntaje' => $puntajeActual, 'puntajeMasAlto' => $puntajeMasAlto]);
    }

    public function enviarPreguntaReportada()
    {
        $preguntaID = isset($_GET['preguntaID']) ? $_GET['preguntaID'] : 0;

        $this->playModel->reportQuestion($preguntaID);
        $this->renderer->render('reportedQuestion');
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

    public function validarTiempoPregunta($horaDeArranque){
        

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $horaActual = date("Y-m-d H:i:s");

        $startTimestamp = strtotime($horaDeArranque);
        $currentTimestamp = strtotime($horaActual);
 
        $diferenciaEnSegundos = $currentTimestamp - $startTimestamp;

        if ($diferenciaEnSegundos > 10) {
            return false;
        } else {
            return true;
        }
    }

    public function guardarTiempoDeArranque(){
        $horaDeArranque = $_POST['startTime'];
        $_SESSION['horaDeArranque'] = $horaDeArranque;
    }
}