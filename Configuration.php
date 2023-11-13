<?php
include_once('helper/Database.php');
include_once('helper/MustacheRender.php');
include_once("helper/Router.php");
include_once("helper/Logger.php");

include_once('third-party/mustache/src/Mustache/Autoloader.php');

include_once ('controller/HomeController.php');
include_once ('controller/LoginController.php');
include_once ('controller/LogOutController.php');
include_once ('controller/RegisterController.php');
include_once ('controller/PlayController.php');
include_once ('controller/ProfileController.php');
include_once ('controller/EditorController.php');
include_once ('controller/AdminController.php');

include_once ('model/HomeModel.php');
include_once ('model/LoginModel.php');
include_once ('model/RegisterModel.php');
include_once ('model/PlayModel.php');
include_once ('model/ProfileModel.php');
include_once ('model/EditorModel.php');
include_once ('model/AdminModel.php');


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
            $config['database']);
    }
    private function getRenderer()
    {
        return new MustacheRender('view/partial');
    }

    public function getLoginController()
    {
        $model = new LoginModel($this->getDatabase());
        return new LoginController($model, $this->getRenderer());
    }

    public function getLogOutController()
    {
        return new LogOutController();
    }

    public function getRegisterController()
    {
        $model = new RegisterModel($this->getDatabase());
        return new RegisterController($model, $this->getRenderer());
    }

    public function getHomeController()
    {
        $model = new HomeModel($this->getDatabase());
        return new HomeController($model, $this->getRenderer());
    }

    public function getPlayController()
    {
        $model = new playModel($this->getDatabase());
        return new PlayController($model, $this->getRenderer());
    }

    public function getProfileController()
    {
        $model = new ProfileModel($this->getDatabase());
        return new ProfileController($model, $this->getRenderer());
    }

    public function getEditorController()
    {
        $model = new EditorModel($this->getDatabase());
        return new EditorController($model, $this->getRenderer());
    }

    public function getAdminController(){
        $model = new AdminModel($this->getDatabase());
        return new AdminController($model, $this->getRenderer());
    }

    public function getRouter() {
        return new Router($this,"getHomeController","cargar");
    }

}
