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

        $contadorUsuariosPais = $this->adminModel->getUsuariosPorPais();

        $cantidadUsuarios = $this->adminModel->getCantidadUsuarios()[0]['CANTIDAD_USUARIOS'];

        $cantidadPartidasJugadas = $this->adminModel->getCantidadPartidasJugadas()[0]['cantidadTotalDePartidasJugadas'];

        $preguntasCreadas = $this->adminModel->getCantidadPreguntas()[0]['preguntasCreadas'];

        $usuariosNuevos = $this->adminModel->newUsers()[0]['newUsers'];

        $youngUsers = $this->adminModel->youngUsers()[0]['youngUsers'];
        $adultUsers = $this->adminModel->adultUsers()[0]['adultUsers'];
        $retiredUsers = $this->adminModel->retiredUsers()[0]['retiredUsers'];

        $newUsersPastWeek = $this->adminModel->newUsersPastWeek()[0]['newUsersPastWeek'];
        $newUsersPastMonth = $this->adminModel->newUsersPastMonth()[0]['newUsersPastMonth'];
        $newUsersPastYear = $this->adminModel->newUsersPastYear()[0]['newUsersPastYear'];

        $data = array("preguntaUno"=>$preguntaUno, "respuestasCorrectaUno"=>$respuestasCorrectaUno, "preguntaDos"=>$preguntaDos,
            "respuestasCorrectaDos"=>$respuestasCorrectaDos, "preguntaTres"=>$preguntaTres, "respuestasCorrectaTres"=>$respuestasCorrectaTres,
            "preguntaCuatro"=>$preguntaCuatro, "respuestasCorrectaCuatro"=>$respuestasCorrectaCuatro, "preguntaCinco"=>$preguntaCinco,
            "respuestasCorrectaCinco"=>$respuestasCorrectaCinco, "contadorUsuariosPais"=>$contadorUsuariosPais,
            "CANTIDAD_USUARIOS"=>$cantidadUsuarios, "cantidadTotalDePartidasJugadas"=>$cantidadPartidasJugadas, "preguntasCreadas"=>$preguntasCreadas,
            "newUsers"=>$usuariosNuevos, "youngUsers"=>$youngUsers, "adultUsers"=>$adultUsers, "retiredUsers"=>$retiredUsers, "newUsersPastWeek"=>$newUsersPastWeek,
            "newUsersPastMonth"=>$newUsersPastMonth, "newUsersPastYear"=>$newUsersPastYear);
        $this->renderer->render('admin', $data);
    }

}