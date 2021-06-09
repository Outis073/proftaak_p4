<?php


class Controller
{
    protected string $controller;
    protected string $action;

    public function __construct( string $controller, string $action )
    {
        if (! file_exists('src/Controllers/' . $controller . 'Controller.php')){
            throw new Exception( "Controllers/" . $controller . "Controller.php bestaat niet..." );
        }

        $this->controller = $controller . "Controller";
        $this->action = $action;

        require_once ( $controller . 'Controller.php' );
    
    }

    public function getController(){
        return $this->controller;
    }

    public function run() : void
    {
        if ( class_exists( $this->controller ) )
        {
            $controller = new $this->controller();

            if ( method_exists( $controller, $this->action ) )
            {
                $controller->{$this->action}();
            }
        }
    }

}