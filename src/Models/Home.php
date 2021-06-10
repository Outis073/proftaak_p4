<?php

// require_once ('Model.php');


class Home extends Model
{
    
    protected $modelList = array();

    public function __construct()
    {
    }

    public static function getActiveModels()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPGetModels()");
        $stmt->execute();

        $modelArray = [];

        $allModels = $stmt->fetchAll();

        foreach($allModels as $model)
        {
            array_push( $modelArray, new Product($model['id'], $model['name'], $model['description'], $model['price'], $model['image']) );
        }

        return $modelArray;
    }
    
    public static function getOptions()
    {
        $pdo = DB::connect();

        $stmt = $pdo->prepare("CALL SPGetOptions()");
        $stmt->execute();

        $optionsArray = [];

        $allOptions = $stmt->fetchAll();

        foreach($allOptions as $option)
        {
            array_push($optionsArray, new Option($option['id'], $option['name'], $option['price'], $option['category'], $option['image']) );
        }

        return $optionsArray;
    }    
}


