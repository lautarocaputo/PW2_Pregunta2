<?php

class ValidarUsuarioLogeado
{

    public function validarUsuarioLogeado() {
        if (!isset($_SESSION['actualUser'])) {
            header('Location: /login/login');
            exit();
        }
    }
}