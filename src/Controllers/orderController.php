<?php

	require_once ( __DIR__ . '\..\models\order.php');

class orderController{

    public function index(){
        $view = new View('Order');
        $view->set('orders', Order::SPGetOrderHistoryUser($_SESSION['user_id']));
        

        $view->render();


    }

}
