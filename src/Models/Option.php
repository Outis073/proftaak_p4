<?php
//namespace Vitae\Models;
//require_once 'vendor/autoload.php';

class Option extends Model implements Serializable
{
    
    protected string $id;
    protected string $name;
    protected string $price;
    protected string $category;
    protected string $image;

    public function __construct(string $id = "", string $name = "", string $price = "", string $category = "", string $image = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->image = $image;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->name,
            $this->price,
            $this->category,
            $this->image
        ]);
    }

    public function unserialize($data)
    {
        list(
            $this->id,
            $this->name,
            $this->price,
            $this->category,
            $this->image
        ) = unserialize($data);
    }

    public function getSingle()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("SELECT name, price, category, image FROM options WHERE id = :id");
        $stmt->execute([
            ':id' => $this->id
        ]);

        $option = $stmt->fetch();

        if($stmt->rowCount() > 0)
        {
            $this->name = $option['name'];
            $this->price = $option['price'];
            $this->category = $option['category'];
            $this->image = $option['image'];
            
            return $this;
        }

        throw new Exception('Record niet gevonden...');
    }
}