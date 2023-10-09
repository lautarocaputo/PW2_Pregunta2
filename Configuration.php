<?php
include_once('helper/Database.php');
include_once('helper/Render.php');
include_once('helper/MustacheRender.php');
include_once("helper/Router.php");
include_once("helper/Logger.php");
include_once('helper/Redirect.php');

include_once('third-party/mustache/src/Mustache/Autoloader.php');

include_once ('controller/LoginController.php');
include_once ('controller/HomeController.php');

include_once ('model/LoginModel.php');
include_once ('model/HomeModel.php');


class Configuration {

    private $configFile = 'config/config.ini';
    public function __construct() {
    }

    private function getArrayConfig()
    {
        return parse_ini_file($this->configFile);
    }
    public function getDatabase()
    {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);
    }
    private function getRenderer()
    {
        return new MustacheRender('view/partial');
    }

    public function getLoginController()
    {
        return new LoginController(
            new LoginModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getRouter() {
        return new Router($this,"getHomeController","list");
    }
}
