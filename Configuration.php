<?php
include_once('helpers/MySqlDatabase.php');

include_once ("model/PlayModel.php");
include_once('model/RankingModel.php');

include_once('controller/PlayController.php');
include_once('controller/RankingController.php');
include_once('controller/HomeController.php');


class Configuration {
    private $configFile = 'config/config.ini';

    public function __construct() {
    }

    public function getDatabase() {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);

    }

    public function getPlayController() {
        $database = $this->getDatabase();
        $PlayModel = new PlayModel($database);
        return new PlayController($PlayModel);
    }


    public function getRankingController() {
        $database = $this->getDatabase();
        $rankingModel = new RankingModel($database);
        return new RankingController($rankingModel);
    }

    private function getArrayConfig() {
        return parse_ini_file($this->configFile);
    }

    public function HomeController() {
        return new HomeController();
    }
}