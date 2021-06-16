<?php

    class HomeController {
        public function index() {
            //Create and render view.
            $view = new View('Home');
            $view->set('models', Home::getActiveModels());

            $view->render();
        }

        public function getOptions()
    	{
            //Check if id was posted. Throws error if not.
    		if (!isset($_POST['id']))
            	throw new Exception('Geen model gevonden (how?)');
    		
            //Check if basket exists. Creates it if not.
    		if (!isset( $_SESSION['basket']))
    		{
    			$newBasket = new Basket();
    			$_SESSION['basket'] = serialize($newBasket);
    		}

            //Creates a bike and saves it in a session variable.
    		$newBike = new Bike("", $_POST['id']);
    		$_SESSION['bike'] = serialize($newBike);

            //Create and render view.
            $view = new View('Option');
            $view->set('title','Home');
            $view->set('content','Personaliseer je fiets');
            $view->set('bike', $newBike);
            $view->set('bikeOptions', $newBike->get('options'));
            $view->set('options', Home::getOptions());

            $view->render();
    	}

        public function changeLanguage(){
            //Checks if language is posted, throws error if not.
            if (!isset( $_POST['language']))
                throw new Exception('Geen taal gevonden');
            //Sets new language.
            $_SESSION['lang'] = $_POST['language'];
            $this->index(); //Creates and renders view (see index function above).
        }


    }