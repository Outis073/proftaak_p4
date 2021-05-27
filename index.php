<?php

require_once ( 'controllers/controller.php' );
require_once ( 'models/db.php' );

$controller = "product";
$action = "index";

if ( isset( $_GET['controller'] ) )
    $controller = $_GET['controller'];

if ( isset( $_GET['action'] ) )
    $action = $_GET['action'];
//$controller = new Controller('Task', 'index');
$controller = new Controller($controller, $action);

$controller->run();