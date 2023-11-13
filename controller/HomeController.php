<?php

class HomeController
{

    private $renderer;
    private $homeModel;

    public function __construct($homeModel, $renderer)
    {
        $this->homeModel = $homeModel;
        $this->renderer = $renderer;
    }

    public function cargar(){
        $this->renderer->render('home');
    }

    public function list()
    {
        $idUser = $_SESSION['actualUser'];
        $this->homeModel->marcarPreguntasUtilizadas();
        $this->homeModel->resetearPuntaje($idUser);
        $data["user"] = $this->homeModel->getUserById($idUser);
        $data["rankingScore"] = $this->homeModel->getUserWithHighestScore($idUser);

        $position = 1;

        foreach ($data["rankingScore"] as &$user) {
            $user['position'] = $position;
            $position++;
        }

       echo json_encode($data);
    }

    public function enviarPreguntaSugerida()
    {
        $pregunta = isset($_POST['pregunta']) ? $_POST['pregunta'] : '';
        $preguntaCorrecta = isset($_POST['correcta']) ? $_POST['correcta'] : '';
        $primeraPreguntaIncorrecta = isset($_POST['incorrecta1']) ? $_POST['incorrecta1'] : '';
        $segundaPreguntaIncorrecta = isset($_POST['incorrecta2']) ? $_POST['incorrecta2'] : '';
        $terceraPreguntaIncorrecta = isset($_POST['incorrecta3']) ? $_POST['incorrecta3'] : '';

        $data["pregunta"] = $pregunta;
        $data["preguntaCorrecta"] = $preguntaCorrecta;
        $data["primeraPreguntaIncorrecta"] = $primeraPreguntaIncorrecta;
        $data["segundaPreguntaIncorrecta"] = $segundaPreguntaIncorrecta;
        $data["terceraPreguntaIncorrecta"] = $terceraPreguntaIncorrecta;


        $this->homeModel->sendSuggestedQuestion($pregunta, $preguntaCorrecta, $primeraPreguntaIncorrecta, $segundaPreguntaIncorrecta, $terceraPreguntaIncorrecta);
        $this->renderer->render('suggestedQuestion', $data);

    }
}