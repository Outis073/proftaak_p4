<?php

require_once ( 'views/view.php' );

class Controller
{
    protected string $controller;
    protected string $action;

    public function __construct( string $controller, string $action )
    {
        if ( ! file_exists( 'controllers/' . $controller . 'controller.php' ) )
            throw new Exception( "controller " . $controller . " bestaat niet..." );

        $this->controller = $controller . "controller";
        $this->action = $action;

        require_once ( $controller . 'controller.php' );
    
    }

    public function run() : void
    {
        if ( class_exists( $this->controller ) )
        {
            //$controller = new HomeController(); --> $this->controller == 'HomeController'
            $controller = new $this->controller();

            if ( method_exists( $controller, $this->action ) )
            {
                // $controller->index(); --> $this->action == 'index';
                $controller->{$this->action}();
            }
        }
    }

}