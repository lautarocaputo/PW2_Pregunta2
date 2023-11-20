<?php

class AdminModel{

    private $database;

    public function __construct($database){
        $this->database = $database;
    }

    public function getCantidadUsuarios(){
        $query = "SELECT COUNT(id) AS CANTIDAD_USUARIOS FROM usuarios";
        return $this->database->query($query);
    }

    public function getPreguntaTopUno(){
        $query = "SELECT pregunta_texto, contador_respuestas_correctas FROM preguntas WHERE contador_respuestas_correctas = 
                                           (SELECT MAX(contador_respuestas_correctas) FROM preguntas)";
        return $this->database->query($query);
    }
    public function getPreguntaTopDos(){
        $query = "SELECT pregunta_texto, contador_respuestas_correctas
FROM preguntas
ORDER BY contador_respuestas_correctas DESC
LIMIT 1 OFFSET 1";
        return $this->database->query($query);
    }
    public function getPreguntaTopTres(){
        $query ="SELECT pregunta_texto, contador_respuestas_correctas
FROM preguntas
ORDER BY contador_respuestas_correctas DESC
LIMIT 1 OFFSET 2";
        return $this->database->query($query);
    }
    public function getPreguntaTopCuatro(){
        $query = "SELECT pregunta_texto, contador_respuestas_correctas
FROM preguntas
ORDER BY contador_respuestas_correctas DESC
LIMIT 1 OFFSET 3";
        return $this->database->query($query);
    }
    public function getPreguntaTopCinco(){
        $query = "SELECT pregunta_texto, contador_respuestas_correctas
FROM preguntas
ORDER BY contador_respuestas_correctas DESC
LIMIT 1 OFFSET 4";
        return $this->database->query($query);
    }

    public function getUsuariosPorPais(){
        $query = "SELECT COUNT(id) AS contadorUsuarios, pais FROM usuarios GROUP BY pais";
        return $this->database->query($query);
    }

    public function getCantidadPartidasJugadas(){
        $query = "SELECT SUM(contador_respuestas_incorrectas) AS cantidadTotalDePartidasJugadas FROM usuarios";
        return $this->database->query($query);
    }

    public function getCantidadPreguntas(){
        $query = "SELECT COUNT(Pregunta_ID) AS preguntasCreadas FROM preguntas";
        return $this->database->query($query);
    }

    public function newUsers(){
        $query = "SELECT COUNT(id) AS newUsers FROM usuarios WHERE fecha_registro >= CURDATE()";
        return $this->database->query($query);
    }

    public function youngUsers(){
        $query = "SELECT COUNT(id) AS youngUsers FROM usuarios WHERE YEAR(CURDATE()) - YEAR(ano_nacimiento) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(ano_nacimiento, '%m%d')) < 18 AND YEAR(CURDATE()) - YEAR(ano_nacimiento) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(ano_nacimiento, '%m%d')) > 0";
        return $this->database->query($query);
    }

    public function adultUsers(){
        $query = "SELECT COUNT(id) AS adultUsers FROM usuarios WHERE YEAR(CURDATE()) - YEAR(ano_nacimiento) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(ano_nacimiento, '%m%d')) >= 18 AND YEAR(CURDATE()) - YEAR(ano_nacimiento) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(ano_nacimiento, '%m%d')) <= 64";
        return $this->database->query($query);
    }

    public function retiredUsers(){
        $query = "SELECT COUNT(id) AS retiredUsers FROM usuarios WHERE YEAR(CURDATE()) - YEAR(ano_nacimiento) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(ano_nacimiento, '%m%d')) >= 65";
        return $this->database->query($query);
    }

    public function newUsersPastWeek(){
        $query = "SELECT COUNT(id) AS newUsersPastWeek FROM usuarios WHERE YEAR(CURDATE()) = YEAR(fecha_registro) 
          AND DATE_FORMAT(fecha_registro, '%m%d') 
              BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 7 DAY, '%m%d') AND DATE_FORMAT(CURDATE(), '%m%d')";
        return $this->database->query($query);
    }

    public function newUsersPastMonth(){
        $query = "SELECT COUNT(id) AS newUsersPastMonth 
          FROM usuarios 
          WHERE YEAR(CURDATE()) = YEAR(fecha_registro) 
          AND MONTH(CURDATE()) = MONTH(fecha_registro)
          AND fecha_registro >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
        return $this->database->query($query);
    }

    public function newUsersPastYear(){
        $query = "SELECT COUNT(id) AS newUsersPastYear 
          FROM usuarios 
          WHERE YEAR(CURDATE()) - YEAR(fecha_registro) = 0
          AND fecha_registro >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)";
        return $this->database->query($query);
    }
}
