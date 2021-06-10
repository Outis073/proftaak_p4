<?php
//namespace Vitae\Models;
//require_once 'vendor/autoload.php';

class Product extends Model
{
    
    protected string $id;
    protected string $name;
    protected string $description;
    protected string $price;
    protected string $image;

    public function __construct(string $id = "", string $name = '', string $description = '', string $price = "", string $image = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
    }

    public static function getAll()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("SELECT id, name, description, price, image FROM models WHERE active = 1");  //STORED PROCEDURE!!!!!!!!!!!!!!!!!!!!!!!!!
        $stmt->execute();

        $productArray = [];

        $allProducts = $stmt->fetchAll();

        foreach($allProducts as $product)
        {
            array_push( $productArray, new Product($product['id'], $product['name'], $product['description'], $product['price'], $product['image']) );
        }

        return $productArray;
    }

    public function changePrice()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPChangeModelPrice( :id, :price)");
                $stmt->execute([
            ':id' => $this->id,
            ':price' => $this->price
        ]);
    }

    public function addModel()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPAddModel( :name, :description, :price)");
                $stmt->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':price' => $this->price
        ]);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function addImage($id, $image)
    {
        $name = $_FILES['file']['name'];
        $target_dir = "src/images/";
        //check if image exists. If exist:
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        if(in_array($imageFileType,$extensions_arr)){
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name)){
                $pdo = DB::connect();

                $stmt = $pdo->prepare("UPDATE models SET image = :name WHERE id = :id");
                        $stmt->execute([
                    ':id' => $id,
                    ':name' => $name
                ]);
            }
        }



        $pdo = DB::connect();

        $stmt = $pdo->prepare("UPDATE models SET image = :name WHERE id = :id");
                $stmt->execute([
            ':id' => $id,
            ':name' => $name
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