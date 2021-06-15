<?php

class BasketController
{
    public function index()
    {
        if (!isset( $_SESSION['basket']))
        {
            $newBasket = new Basket();
            $_SESSION['basket'] = serialize($newBasket);
        }

        $basket = unserialize($_SESSION['basket']);

        $view = new View('Basket');
        $view->set('title', 'Contact');
        $view->set('bikes', $basket->get('bikes')); 
        $basket = new Basket();

        $view->render();
    }

    public function addOption(){
        $bike = unserialize($_SESSION['bike']);
        $option = (new Option($_POST['id'], "", "", "", ""))->getSingle();
        $options = $bike->get('options');
        $options[] = $option;
        $bike->set('options', $options);
        $_SESSION['bike'] = serialize($bike);

        $view = new View('Option');
        $view->set('title','Home');
        $view->set('content','Personaliseer je fiets');
        $view->set('bike', $bike);
        $view->set('bikeOptions', $bike->get('options'));
        $view->set('options', Home::getOptions());

        $view->render();
    }

    public function removeOption(){
        $bike = unserialize($_SESSION['bike']);
        $options = $bike->get('options');
        foreach($options as $option){
            if($option->get('id') == $_POST['id']){
                unset($options[(array_search ($option, $options))]);
                break;
            }
        }

        $bike->set('options', $options);
        $_SESSION['bike'] = serialize($bike);

        $view = new View('Option');
        $view->set('title','Home');
        $view->set('content','Personaliseer je fiets');
        $view->set('bike', $bike);
        $view->set('bikeOptions', $bike->get('options'));
        $view->set('options', Home::getOptions());

        $view->render();
    }

    public function addToBasket(){
        $basket = unserialize($_SESSION['basket']);
        $bike = unserialize($_SESSION['bike']);
        $bikes = $basket->get('bikes');
        $bikes[] = $bike;
        $basket->set('bikes', $bikes);
        $basket->save();
        $_SESSION['basket'] = serialize($basket);



        $view = new View('Home');
        $view->set('models', Home::getActiveModels());
        $view->render();
    }

    public function save(){
        $basket = unserialize($_SESSION['basket']);
        $basket->save();

        $view = new View('Home');
        $view->set('models', Home::getActiveModels());
        $view->render();
    }

    public function order(){
        if (!isset( $_SESSION['basket']))
        {
            $newBasket = new Basket();
            $_SESSION['basket'] = serialize($newBasket);
        }

        $basket = unserialize($_SESSION['basket']);

        $basket->order();;

        $view = new View('Home');
        $view->set('models', Home::getActiveModels());
        $view->render();
    }

    public function removeBike(){
        $basket = unserialize($_SESSION['basket']);
        $basket->removeBike($_POST['id']);
        $basket->save();
        $_SESSION['basket'] = serialize($basket);

        $view = new View('Basket');
        $view->set('bikes', $basket->get('bikes'));
        $view->render(); 
    }

}
