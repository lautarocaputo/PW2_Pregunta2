<?php
include_once('helper/Database.php');
include_once('helper/MustacheRender.php');
include_once("helper/Router.php");
include_once("helper/Logger.php");

include_once('third-party/mustache/src/Mustache/Autoloader.php');

include_once ('controller/HomeController.php');
include_once ('controller/LoginController.php');

include_once ('model/HomeModel.php');
include_once ('model/LoginModel.php');


class Configuration {

    private $configFile = 'config/configuration.ini';
    public function __construct() {
    }

    private function getArrayConfig()
    {
        return parse_ini_file($this->configFile);
    }
    public function getDatabase()
    {
        $config = $this->getArrayConfig();
        return new Database(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']);
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

    public function getRegisterController()
    {
        return new RegisterController(
            new RegisterModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getHomeController()
    {
        return new HomeController(
            new HomeModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    public function getRouter() {
        return new Router($this,"getHomeController","login");
    }
}
