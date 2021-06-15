<?php
class Basket extends Model implements Serializable
{
    protected $bikes = [];

    public function __construct()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPGetBikesFromBasket( :id)");
        $stmt->execute([
            ':id' => $_SESSION['user_id']
        ]);

        $allBikes = $stmt->fetchAll();

        foreach($allBikes as $bike)
        {
            array_push($this->bikes, new Bike($bike['id'], $bike['model_id']));
        }
    }

    public function save(){
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPEmptyBasket( :id )");
        $stmt->execute([
            ':id' => $_SESSION['user_id']
        ]);

        foreach($this->bikes as $bike){
            $stmt = $pdo->prepare("CALL SPAddBikeToBasket( :user_id, :model_id)");
            $stmt->execute([
                ':user_id' => $_SESSION['user_id'],
                ':model_id' => $bike->get('model')->get('id')
            ]);

            $result = $stmt->fetch();
            $id = $result['@id'];
            
            $options = $bike->get('options');

            foreach($options as $option){
                $stmt = $pdo->prepare("CALL SPAddBikeToBasket( :bike_id, :option_id)");
                $stmt->execute([
                    ':bike_id' => $id,
                    ':option_id' => $option->get('id')
                ]);
            }
        }
    }

    public function order(){
        $pdo = DB::connect();
        $stmt = $pdo->prepare("CALL SPCreateOrder( :id, :delivery_method, :payment_method)");
        $stmt->execute([
            ':id' => $_SESSION['user_id'],
            ':delivery_method' => "Just throw it really hard",
            ':payment_method' => "I.O.U."
        ]);

        $stmt = $pdo->prepare("CALL SPEmptyBasket( :id)");
        $stmt->execute([
            ':id' => $_SESSION['user_id']
        ]);

        unset($_SESSION['basket']);
    }

    public function removeBike($id){
        foreach ($this->bikes as $bike) {
            if($bike->get('id') == $id)
            {
                unset($this->get('bikes')[(array_search ($bike, $this->get('bikes')))]);
                break;
            }
        }
    }

    public function serialize()
    {
        return serialize([
            $this->bikes
        ]);
    }

    public function unserialize($data)
    {
        list(
            $this->bikes
        ) = unserialize($data);
    }

}