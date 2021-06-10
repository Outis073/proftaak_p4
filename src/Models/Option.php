<?php
//namespace Vitae\Models;
//require_once 'vendor/autoload.php';

class Option extends Model
{
    
    protected string $id;
    protected string $name;
    protected string $price;
    protected string $category;
    protected string $image;

    public function __construct(string $id = "", string $name = '', string $price = '', string $category = "", string $image = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->image = $image;
    }

    public static function addToBasket()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPGetOptions()");
        $stmt->execute();

        $productArray = [];

        $allProducts = $stmt->fetchAll();

        foreach($allProducts as $product)
        {
            array_push( $productArray, new Product($product['id'], $product['name'], $product['description'], $product['price'], $product['image']) );
        }

        return $productArray;
    }

}