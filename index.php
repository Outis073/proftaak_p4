<?php
session_start();
require_once 'vendor/autoload.php';

$controller = "Home";
$action = "index";

if ( isset( $_GET['controller'] ) )
    $controller = $_GET['controller'];

if ( isset( $_GET['action'] ) )
    $action = $_GET['action'];
$controller = new Controller($controller, $action);

$controller->run();