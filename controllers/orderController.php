<?php

require_once ( __DIR__ . '\..\models\order.php');

class orderController{

    public function getOrderHistoryUser(){

        
        $view = new View('orderview');
        $view->set('user', 'Xanh');
        $view->set('title', 'Home');
        $view->set('content', 'welkom');
        $view->set('order', Order::getAll());
        

        $view->render();


    }

    public function test(){

        $view = new View('orderview.edit');
        $view->set('title', 'Home');
        $view->set('content', 'welkom');
        $view->set('test', 'dit is een test');
        $view->set('order', Order::getAll());

        var_dump($_POST);
        

        $view->render();

    }
}
