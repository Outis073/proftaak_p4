<?php

require_once 'vendor/autoload.php';


$controller = "Product";
$action = "index";

if ( isset( $_GET['controller'] ) )
    $controller = $_GET['controller'];

if ( isset( $_GET['action'] ) )
    $action = $_GET['action'];
//$controller = new Controller('Task', 'index');
$controller = new Controller($controller, $action);

$controller->run();