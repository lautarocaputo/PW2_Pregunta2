<?php
include_once('Configuration.php');
$configuration = new Configuration();
$database = $configuration->getDatabase();

$page = $_GET["page"];
include_once('view/header.php');
switch ($page){
    case 'jugar':
        $tourController = $configuration->getPlayController();
        $tourController->cargarMenu();
        break;
    case "ranking":
        $rankingController = $configuration->getrankingController();
        $rankingController->mostrarRanking();
        break;
    default:
        $home = $configuration->HomeController();
        $home->mostrarHome();
        break;
}
include_once('view/footer.php');


