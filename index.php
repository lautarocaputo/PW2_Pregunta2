<?php
include_once("helper/ValidarUsuarioLogeado.php");
include_once('Configuration.php');

session_start();

$configuration = new Configuration();
$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'list';

if ($module !== 'login' && $module !== 'register') {
    $validarUsuarioLogeado = new ValidarUsuarioLogeado();
    $validarUsuarioLogeado->validarUsuarioLogeado();
}

$router->route($module, $method);