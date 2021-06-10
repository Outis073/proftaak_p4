<?php

    //require_once ('src/Views/View.php');
    
    class Controller {
        protected string $controller;
        protected string $action;

        public function __construct(string $controller, string $action) {
            if(!file_exists('src/Controllers/' . $controller . 'Controller.php')) {
                throw new Exception("controller " . $controller . " bestaat niet...");
            } else {
                $this->controller = $controller . "Controller";
                $this->action = $action;

                require_once($controller . 'Controller.php');

            }        
        }

        public function run() : void {
            
            if(class_exists($this->controller)) {

                $controller = new $this->controller();

                if(method_exists($controller,$this->action)){
                    $controller->{$this->action}();
                }
            } 
        }

    }