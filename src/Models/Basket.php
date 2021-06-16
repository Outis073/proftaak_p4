<?php
class Basket extends Model implements Serializable
{
    protected $bikes = [];

    public function __construct()
    {
        //Connects to database.
        //Creates and prepares sql statement.
        //Executes statement.
        //Gets results from the sql statement.
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPGetBikesFromBasket( :id)");
        $stmt->execute([
            ':id' => $_SESSION['user_id']
        ]);

        $allBikes = $stmt->fetchAll();

        //Loop through all the retrieved bikes and adds each to the list of bikes in the basket.
        foreach($allBikes as $bike)
        {
            array_push($this->bikes, new Bike($bike['id'], $bike['model_id']));
        }
    }

    public function save(){
        //Connects to database.
        //Creates and prepares sql statement.
        //Executes statement.
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPEmptyBasket( :id )");
        $stmt->execute([
            ':id' => $_SESSION['user_id']
        ]);

        //Loop through all the bikes in the basket.
        foreach($this->get('bikes') as $bike){
            //Creates and prepares sql statement.
            //Executes statement.
            //Gets results from the sql statement.
            $stmt = $pdo->prepare("CALL SPAddBikeToBasket( :user_id, :model_id)");
            $stmt->execute([
                ':user_id' => $_SESSION['user_id'],
                ':model_id' => $bike->get('model')->get('id')
            ]);

            $result = $stmt->fetch();
            $id = $result['@id'];
            
            //Gets the options from the bike.
            $options = $bike->get('options');
            //Loops through the options and adds each to the bike.
            foreach($options as $option){
                $stmt = $pdo->prepare("CALL SPAddOptionsToBike( :bike_id, :option_id)");
                $stmt->execute([
                    ':bike_id' => $id,
                    ':option_id' => $option->get('id')
                ]);
            }
        }
    }

    public function order(){
        //Connects to database.
        //Creates and prepares sql statement.
        //Executes statement.
        //Gets results from the sql statement.
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
        //Unsets the basket session variable.
        unset($_SESSION['basket']);
    }

    public function removeBike($id){
        //Loops through all of the bikes, checks if the bike needs to be removed and if so: removes it.
        foreach ($this->get('bikes') as $key => $bike) {
            if($bike->get('id') == $id)
            {
                $bikesArray = $this->get('bikes');
                unset($bikesArray[$key]);
                $this->set('bikes', $bikesArray);
                break; //Break out of foreach.
            }
        }
    }

    public function serialize()
    {
        //Serializes the bikes, allowing them to be saved in a session variable.
        return serialize([
            $this->bikes
        ]);
    }

    public function unserialize($data)
    {
        //Unserializes the bikes, allowing them to be retrieved from the session variable.
        list(
            $this->bikes
        ) = unserialize($data);
    }

}