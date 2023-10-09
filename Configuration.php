<?php
include_once('helper/MySqlDatabase.php');
include_once("helper/MustacheRender.php");
include_once('helper/Router.php');
include_once('helper/Logger.php');

include_once('model/HomeModel.php');
include_once('model/LoginModel.php');

include_once('controller/HomeController.php');
include_once('controller/LoginController.php');
include_once('third-party/mustache/src/Mustache/Autoloader.php');


class Configuration
{
    private $configFile = 'config/configuration.ini';

    public function __construct()
    {
    }

    public function getHomeController()
    {
        return new HomeController(
            new HomeModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

    private function getArrayConfig()
    {
        return parse_ini_file($this->configFile);
    }

    private function getRenderer()
    {
        return new MustacheRender('view/partial');
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

    public function getRouter()
    {
        return new Router(
            $this,
            "getHomeController",
            "list");
    }

    public function getLoginController()
    {
        return new LoginController(
            new LoginModel($this->getDatabase()),
            $this->getRenderer()
        );
    }

}
