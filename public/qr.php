<?php
require "../third-party/phpqrcode/qrlib.php";


$level = "Q";
$tamaño = 4;
$framSize = 2;
$ruta="https//:localhost/profile/perfil&idUsuario=".$_GET['id'];
QRcode::png($ruta, null, $level, $tamaño, $framSize);

?>