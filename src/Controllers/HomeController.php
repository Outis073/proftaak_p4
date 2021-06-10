<?php

    class HomeController {
        public function index() {
            $view = new View('Home');
            $view->set('title','Home');
            $view->set('content','Welkom bij de site van VitaeBikes');
            $view->set('models', Home::getActiveModels());

            $view->render();
        }

        public function getOptions()
    	{
            $view = new View('Option');
            $view->set('title','Home');
            $view->set('content','Personaliseer je fiets');
            $view->set('options', Home::getOptions());

            $view->render();
    	}
    }