<?php
session_start();

include_once("helper/ValidarUsuarioLogeado.php");
include_once('Configuration.php');

$_SESSION['puntaje'] = 0;
$_SESSION['puntajeMasAlto'] = 0;

$configuration = new Configuration();
$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'list';

if ($module !== 'login' && $module !== 'register') {
    $validarUsuarioLogeado = new ValidarUsuarioLogeado();
    $validarUsuarioLogeado->validarUsuarioLogeado();
}

if ($module === 'editor' && !$_SESSION['esEditor']){
    header('Location: /');
}

if ($module === 'admin' && !$_SESSION['esAdmin']){
    header('Location: /');
}


$router->route($module, $method);
