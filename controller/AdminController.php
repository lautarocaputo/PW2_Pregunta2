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
        //Top 5 preguntas y respuestas
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

        //Usuarios por pais
        $contadorUsuariosPais = $this->adminModel->getUsuariosPorPais();

        //CantidadUsuarios totales
        $cantidadUsuarios = $this->adminModel->getCantidadUsuarios()[0]['CANTIDAD_USUARIOS'];

        //Partidas Jugadas
        $cantidadPartidasJugadas = $this->adminModel->getCantidadPartidasJugadas()[0]['cantidadTotalDePartidasJugadas'];

        //Preguntas Creadas
        $preguntasCreadas = $this->adminModel->getCantidadPreguntas()[0]['preguntasCreadas'];

        //Usuarios nuevos
        $usuariosNuevos = $this->adminModel->newUsers()[0]['newUsers'];

        $data = array("preguntaUno"=>$preguntaUno, "respuestasCorrectaUno"=>$respuestasCorrectaUno, "preguntaDos"=>$preguntaDos,
            "respuestasCorrectaDos"=>$respuestasCorrectaDos, "preguntaTres"=>$preguntaTres, "respuestasCorrectaTres"=>$respuestasCorrectaTres,
            "preguntaCuatro"=>$preguntaCuatro, "respuestasCorrectaCuatro"=>$respuestasCorrectaCuatro, "preguntaCinco"=>$preguntaCinco,
            "respuestasCorrectaCinco"=>$respuestasCorrectaCinco, "contadorUsuariosPais"=>$contadorUsuariosPais,
            "CANTIDAD_USUARIOS"=>$cantidadUsuarios, "cantidadTotalDePartidasJugadas"=>$cantidadPartidasJugadas, "preguntasCreadas"=>$preguntasCreadas,
            "newUsers"=>$usuariosNuevos);
        $this->renderer->render('admin', $data);
    }

}