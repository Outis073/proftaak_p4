<?php
    require_once 'vendor/autoload.php';
    session_start();
    //require_once ('src/Controllers/Controller.php');
    //require_once ('DB.php');

    //require_once ('src/Helpers/session_helper.php');

    $controller = "Home";
    $action = "index";

    if(isset($_GET['controller'])) {
        $controller = $_GET['controller'];
    }

    if(isset($_GET['action'])) {
        $action = $_GET['action'];
    }

    $controller = new Controller($controller,$action);
    $controller->run();

