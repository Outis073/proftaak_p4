<?php


require_once ('controllers/controller.php');
require_once ('db.php');


$controller="order";
$action="getOrderHistoryUser";

if( isset($_GET['controller']))
    $controller= $_GET['controller'];

if( isset($_GET['action']))
    $action= $_GET['action'];

$controller = new Controller($controller,$action);
$controller->run();