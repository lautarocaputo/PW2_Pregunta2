<?php

class PokedexController {
    private $render;
    private $model;

    public function __construct($render, $model) {
        $this->render = $render;
        $this->model = $model;
    }

    public function list() {
        $busqueda = $_GET['search'] ?? '';
        $datos["pokemon"] = $this->model->list($busqueda);
        $this->render->printView('home', $datos);
    }

    public function alta(){
        $data = [];

        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }

        $data['action'] = '/pokedex/procesarAlta';
        $data['submitText'] = 'Crear';
        $this->render->printView('formAlta', $data);
    }

    public function procesarAlta(){
        if( empty($_POST['numero'] ) || empty($_POST['nombre'] ) || empty($_POST['tipo'] ) ){
            $_SESSION["error"] = "Alguno de los campos era erroneo o vacio";
            Redirect::to('/pokedex/alta');
        }

        $numero = $_POST["numero"];
        $tipo = $_POST['tipo'];
        $nombre = $_POST['nombre'];

        $this->model->alta($numero, $nombre, $tipo);
        Redirect::root();
    }

    public function borrar() {
        $id = $_GET['id'];
        $this->model->borrar($id);

        Redirect::root();
    }

    public function editar() {



        $id = $_GET['id'];
        $pokemon = $this->model->get($id);
        Logger::info('Pokemon editar:' . json_encode($pokemon));
        $data = [];
        $data['numero'] = $pokemon["numero"];
        $data['nombre'] = $pokemon['nombre'];
        $data['action'] = "/pokedex/procesarEditar";
        $data["submitText"] = "Editar";

        Logger::info('Pokemon editar - Datos:' . json_encode($data));
        $this->render->printView('formAlta', $data);
    }

}