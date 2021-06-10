<?php

<<<<<<< HEAD
	require_once ( __DIR__ . '\..\models\order.php');

class orderController{

    public function index(){
        $view = new View('Order');
        $view->set('user', 'Xanh');
        $view->set('title', 'Home');
        $view->set('content', 'welkom');
        $view->set('orders', Order::SPGetOrderHistoryUser(1));
=======
require_once ( __DIR__ . '\..\models\order.php');

class orderController{

    public function getOrderHistoryUser(){

        
        $view = new View('orderview');
        $view->set('user', 'Xanh');
        $view->set('title', 'Home');
        $view->set('content', 'welkom');
        $view->set('order', Order::SPGetOrderHistoryUser(1));
>>>>>>> 19ac4f545da21c9c24bd21930049e9fd891ce2f5
        

        $view->render();


    }

}
