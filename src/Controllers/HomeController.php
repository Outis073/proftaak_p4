<?php

    class HomeController {
        public function index() {
            $view = new View('Home');
            // $view->set('title','Home');
            // $view->set('content','Welkom bij de site van VitaeBikes');
            $view->set('models', Home::getActiveModels());

            $view->render();
        }

        public function getOptions()
    	{
    		if (!isset($_POST['id']))
            	throw new Exception('Geen model gevonden (how?)');
    		
    		if (!isset( $_SESSION['basket']))
    		{
    			$newBasket = new Basket();
    			$_SESSION['basket'] = serialize($newBasket);
    		}

    		$newBike = new Bike("", $_POST['id']);
    		$_SESSION['bike'] = serialize($newBike);

            $view = new View('Option');
            $view->set('title','Home');
            $view->set('content','Personaliseer je fiets');
            $view->set('bike', $newBike);
            $view->set('bikeOptions', $newBike->get('options'));
            $view->set('options', Home::getOptions());

            $view->render();
    	}

        public function changeLanguage(){
            if (!isset( $_POST['language']))
                throw new Exception('Geen taal gevonden');
            $_SESSION['lang'] = $_POST['language'];
            $this->index();
        }


    }