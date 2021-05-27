<?php

require_once ( 'model.php' );

class Product extends Model
{
    
    protected string $id;
    protected string $name;
    protected string $description;
    protected string $price;

    public function __construct(string $id = "", string $name = '', string $description = '', string $price = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public static function getAll()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("SELECT id, name, description, price FROM models WHERE active = 1");
        $stmt->execute();

        $productArray = [];

        $allProducts = $stmt->fetchAll();

        foreach($allProducts as $product)
        {
            array_push( $productArray, new Product($product['id'], $product['name'], $product['description'], $product['price']) );
        }

        return $productArray;
    }

    public function changePrice($id, $price)
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPChangeModelPrice( :id, :price)");
                $stmt->execute([
            ':id' => $id,
            ':price' => $price
        ]);
    }

    public function getSingle($id)
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("SELECT * FROM Model WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);

        $product = $stmt->fetch();

        if($stmt->rowCount() > 0)
        {
            $this->name = $product['name'];
            $this->description = $product['description'];
            $this->price = $product['price'];
            
            return $this;
        }

        throw new Exception('Record niet gevonden...');
    }
/*
    public function save()
    {
        $pdo = DB::connect();
        if ( isset( $_POST['id'] ) )
        {
            $stmt = $pdo->prepare("UPDATE `tasks` SET `person` = :person, `title` = :title, `description` = :description WHERE `tasks`.`id` = :id");
            $stmt->execute([
                ':id' => $_POST['id'],
                ':person' => $this->person,
                ':title' => $this->title,
                ':description' => $this->description
            ]);
        } else
        {
            $stmt = $pdo->prepare("INSERT INTO `tasks` (`person`, `title`, `description`) VALUES (:person, :title, :description) ");
            $stmt->execute([
                ':person' => $this->person,
                ':title' => $this->title,
                ':description' => $this->description
            ]);
        }
    }
*/

    public function delete()
    {
        $pdo = DB::connect();
        
        $stmt = $pdo->prepare("DELETE FROM `models` WHERE `tasks`.`id` = :id");
        $stmt->execute([
            ':id' => $this->id
        ]);
    }

}