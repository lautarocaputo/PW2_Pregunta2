<?php

class AdminController{
    private $renderer;
    public function __construct($homeModel, $renderer)
    {
        $this->homeModel = $homeModel;
        $this->renderer = $renderer;
    }

    public function list(){

    }
}