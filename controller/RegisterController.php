<?php

class RegisterController{

    private $registerModel;
    private $renderer;

    public function __construct($registerModel, $renderer)
    {
        $this->registerModel = $registerModel;
        $this->renderer = $renderer;
    }

    public function register(){
        $this->renderer->render('register');
    }

    public function registration(){

    }
}