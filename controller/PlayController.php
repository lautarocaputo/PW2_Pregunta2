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

        $_SESSION['tiempoRestante'] = $tiempoRestante;

        // Obtén la pregunta actual de la sesión
        $pregunta = $_SESSION['preguntaActual'];
        $tematica = $pregunta['Pregunta_ID'];
        $respuestas = $this->playModel->getRespuestas($tematica);
        shuffle($respuestas);

        $data = [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas,
            'puntaje' => $_SESSION['puntaje'],
            'puntajeMasAlto' => isset($_SESSION['puntajeMasAlto']),
            'tiempoRestante' => $tiempoRestante,
        ];

        $this->renderer->render('play', $data);
    }



    public function validarRespuesta()
    {
        if (!isset($_POST['respuestaID'])) {
            $this->renderer->render('perdiste', ['error_msg' => 'Tienes que seleccionar una respuesta.']);
            return;
        }

        $_SESSION['tiempoRestante'] = 10;

        unset($_SESSION['preguntaActual']);

        $usuario = $_SESSION['actualUser'];
        $respuestaID = $_POST['respuestaID'];
        $preguntaID = $_GET['preguntaID'];
        $model = $this->playModel;

        $model->marcarPreguntaUtilizada($preguntaID);

        $respuestaCorrecta = $model->validarRespuesta($respuestaID);

        if (!$respuestaCorrecta) {
            $this->playModel->incrementarContadorRespuestasIncorrectas($usuario, $preguntaID);
            $this->playModel->calcularDificultadPregunta($preguntaID);
            $this->playModel->calcularDificultadUsuario($usuario);
            $this->terminarPartida();
        } else {
            $this->playModel->incrementarContadorRespuestasCorrectas($usuario, $preguntaID);
            $this->playModel->calcularDificultadPregunta($preguntaID);
            $this->playModel->calcularDificultadUsuario($usuario);
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

        $this->renderer->render('perdiste', ['error_msg' => $mensaje,'puntaje' => $puntajeActual, 'puntajeMasAlto' => $puntajeMasAlto]);
    }

    public function getTiempoRestante()
    {
        $tiempoRestante = isset($_SESSION['tiempoRestante']) ? $_SESSION['tiempoRestante'] : 0;

        header('Content-Type: application/json');
        echo json_encode(['tiempoRestante' => $tiempoRestante]);
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
}
