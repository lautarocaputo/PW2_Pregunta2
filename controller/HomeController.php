<?php

class HomeController {

    public function __construct() {
    }

    public function mostrarHome() {
        include_once('view/home_view.php');
    }
}