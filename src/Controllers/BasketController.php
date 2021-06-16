<?php

class BasketController
{
    public function index()
    {
        //Checks if session variable basket exists. Creates it if it doesn't.
        if (!isset( $_SESSION['basket']))
        {
            $newBasket = new Basket();
            $_SESSION['basket'] = serialize($newBasket);
        }

        //Gets basket from session variable.
        $basket = unserialize($_SESSION['basket']);

        //Create and render view.
        $view = new View('Basket');
        $view->set('title', 'Contact');
        $view->set('bikes', $basket->get('bikes')); 
        $basket = new Basket();

        $view->render();
    }

    public function addOption(){
        $bike = unserialize($_SESSION['bike']);                             //Gets bike from session.
        $option = (new Option($_POST['id'], "", "", "", ""))->getSingle();  //Creates new option with id.
        $options = $bike->get('options');                                   //Gets options from bike.
        $options[] = $option;                                               //Adds option to bike's options.
        $bike->set('options', $options);                                    //Puts the options back on the bike.
        $_SESSION['bike'] = serialize($bike);                               //Saves bike in session variable.

        //Create and render view.
        $view = new View('Option');
        $view->set('title','Home');
        $view->set('content','Personaliseer je fiets');
        $view->set('bike', $bike);
        $view->set('bikeOptions', $bike->get('options'));
        $view->set('options', Home::getOptions());

        $view->render();
    }

    public function removeOption(){
        $bike = unserialize($_SESSION['bike']);                         //Gets bike from session variable.
        $options = $bike->get('options');                               //Gets options from bike.
        foreach($options as $option){                                   //Loops through options.
            if($option->get('id') == $_POST['id']){                     //Check if option should be deleted.
                unset($options[(array_search ($option, $options))]);    //Deletes option.
                break;                                                  //Break out of foreach loop.
            }
        }

        //Saves options back into bike, then saves bike in session variable.
        $bike->set('options', $options);
        $_SESSION['bike'] = serialize($bike);

        //Create and render view.
        $view = new View('Option');
        $view->set('title','Home');
        $view->set('content','Personaliseer je fiets');
        $view->set('bike', $bike);
        $view->set('bikeOptions', $bike->get('options'));
        $view->set('options', Home::getOptions());

        $view->render();
    }

    public function addToBasket(){
        $basket = unserialize($_SESSION['basket']);     //Gets basket from session variable.
        $bike = unserialize($_SESSION['bike']);         //Gets bike from session variable.
        $bikes = $basket->get('bikes');                 //Gets bikes from basket.
        $bikes[] = $bike;                               //Adds bike to bikes.
        $basket->set('bikes', $bikes);                  //Saves bikes in basket.
        $basket->save();                                //Saves basket in database.
        $_SESSION['basket'] = serialize($basket);       //Saves basket in session variable.

        //Create and render view.
        $view = new View('Home');
        $view->set('models', Home::getActiveModels());
        $view->render();
    }

    public function save(){
        //Gets basket from session variable and saves it to database.
        $basket = unserialize($_SESSION['basket']);
        $basket->save();

        //Create and render view.
        $view = new View('Home');
        $view->set('models', Home::getActiveModels());
        $view->render();
    }

    public function order(){
        //Checks if basket session variable exists. Creates it if not.
        if (!isset( $_SESSION['basket']))
        {
            $newBasket = new Basket();
            $_SESSION['basket'] = serialize($newBasket);
        }

        //Gets basket from session variable.
        $basket = unserialize($_SESSION['basket']);

        //Orders everything in basket.
        $basket->order();;

        //Create and render view.
        $view = new View('Home');
        $view->set('models', Home::getActiveModels());
        $view->render();
    }

    public function removeBike(){
        $basket = unserialize($_SESSION['basket']);     //Get basket from session variable.
        $basket->removeBike($_POST['id']);              //Removes bike from basket.
        $basket->save();                                //Saves basket in database.
        $_SESSION['basket'] = serialize($basket);       //Saves basket in session variable.

        //Create and render view.
        $view = new View('Basket');
        $view->set('bikes', $basket->get('bikes'));
        $view->render(); 
    }

}
