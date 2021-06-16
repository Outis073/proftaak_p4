<?php


class Controller
{
    protected string $controller;
    protected string $action;

    public function __construct( string $controller, string $action )
    {
        //Checks if the file required actually exists. Throws error if not.
        if (! file_exists('src/Controllers/' . $controller . 'Controller.php')){
            throw new Exception( "Controllers/" . $controller . "Controller.php bestaat niet..." );
        }

        //Sets controller and action.
        $this->controller = $controller . "Controller";
        $this->action = $action;

        //Ensures controller is accessable. Shouldn't be necessary anymore, but I'm not removing it last second.
        require_once ( $controller . 'Controller.php' );
    
    }

    public function getController(){
        //Returns controller.
        return $this->controller;
    }

    public function run() : void
    {
        //Checks if the controller required actually exists.
        if ( class_exists( $this->controller ) )
        {
            //Creates instance of controller.
            $controller = new $this->controller();

            //Checks if the action required actually exists. Throws error if not.
            if ( method_exists( $controller, $this->action ) )
            {
                //Sets default language if there is none.
                if(!isset($_SESSION['lang']))
                {$_SESSION['lang'] = 'nl';}; 
                
                //Executes action.
                $controller->{$this->action}();
            }
        }
    }

}