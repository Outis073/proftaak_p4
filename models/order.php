<?php

require_once ('Model.php');


class order extends Model
{
    
    protected string $id;
    protected string $name;
    protected string $price;
    protected string $image;
    protected string $active;
    protected string $description;

    public function __construct(string $id = "", string $name = '', string $price = '', string $image = "",string $active="",string $description="",)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->active = $active;
        $this->description = $description;
    }

    public static function getAll()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("SELECT id, name, price, image, active,description FROM models WHERE active = 1 ORDER BY price");
        $stmt->execute();

        $orderArray = [];

        $allorders = $stmt->fetchAll();

        foreach($allorders as $order)
        {
            array_push( $orderArray, new order($order['id'], $order['name'], $order['price'], $order['image'], $order['active'], $order['description']) );
        }

        return $orderArray;
    }
}


