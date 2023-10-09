<?php

class ValidarUsuarioLogeado{

    public function validarUsuarioLogeado() {
        if (!isset($_SESSION['actualUser'])) {
            header('Location: /login');
            echo "holis";
            exit();
        }
    }
}