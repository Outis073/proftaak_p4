<?php

// require_once ('Model.php');


class order extends Model
{
    
    protected string $id;
    protected string $date;
    protected string $delivery_date;
    protected string $payment_option;
    protected string $status;
    



    public function __construct(string $id = "", string $date="",string $delivery_date="",string $payment_option="",string $status="")
    {
        $this->id = $id;
        $this->date = $date;
        $this->delivery_date = $delivery_date;
        $this->payment_option = $payment_option;
        $this->status = $status;
    }

    // public static function getAll()
    // {
    //     $pdo = DB::connect();

    //     $stmt = $pdo->prepare("SELECT id, name, price, image, active,description FROM models WHERE active = 1 ORDER BY price");
    //     $stmt->execute();

    //     $orderArray = [];

    //     $allorders = $stmt->fetchAll();

    //     foreach($allorders as $order)
    //     {
    //         array_push( $orderArray, new order($order['id'], $order['name'], $order['price'], $order['image'], $order['active'], $order['description']) );
    //     }

    //     return $orderArray;
    // }
    
    public static function SPGetOrderHistoryUser($id)
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPGetOrderHistoryUser(:id)");
        $stmt->execute([

            ':id' => $id
        ]);

        $orderArray = [];

        $allorders = $stmt->fetchAll();

        //var_dump($allorders);

        foreach($allorders as $order)
        {
            array_push( $orderArray, new order($order['id'], $order['date'], $order['delivery_date'], $order['payment_option'], $order['status']) );
        }

        return $orderArray;
    }
}


