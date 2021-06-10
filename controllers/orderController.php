<?php

require_once ( __DIR__ . '\..\models\order.php');

class orderController{

    public function getOrderHistoryUser(){

        
        $view = new View('orderview');
        $view->set('user', 'Xanh');
        $view->set('title', 'Home');
        $view->set('content', 'welkom');
        $view->set('order', Order::SPGetOrderHistoryUser(1));
        

        $view->render();


    }

}
