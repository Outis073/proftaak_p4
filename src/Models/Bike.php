<?php
class Bike extends Model implements Serializable
{
    protected string $id;
    protected Product $model;
    protected $options = [];

    public function __construct(string $bike_id = '', string $model_id = '')
    {
        $this->id = $bike_id;
        $dummyModel = new Product($model_id, "", "", "", "");
        $this->model = $dummyModel->getSingle();

        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPGetBikeOptions( :id)");
        $stmt->execute([
            ':id' => $bike_id
        ]);

        $allOptions = $stmt->fetchAll();

        foreach($allOptions as $option)
        {
            array_push($this->options, new Option($option['id'], $option['name'], $option['price'], $option['category'], $option['image']));
        }
    }

    public function sendContactForm()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPSendContactForm( :firstName, :lastName, :email, :text)");
        $stmt->execute([
            ':firstName' => $this->firstName,
            ':lastName' => $this->lastName,
            ':email' => $this->email,
            ':text' => $this->text
        ]);
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

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->model,
            $this->options
        ]);
    }

    public function unserialize($data)
    {
        list(
            $this->id,
            $this->model,
            $this->options
        ) = unserialize($data);
    }
}