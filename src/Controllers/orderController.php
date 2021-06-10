<?php

	require_once ( __DIR__ . '\..\models\order.php');

class orderController{

    public function index(){
        $view = new View('Order');
        $view->set('user', 'Xanh');
        $view->set('title', 'Home');
        $view->set('content', 'welkom');
        $view->set('orders', Order::SPGetOrderHistoryUser(1));
        

        $view->render();


    }

}
