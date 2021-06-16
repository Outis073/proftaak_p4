<?php

class ProductController
{
    public function index()
    {
        //Checks if the user is an admin. Throws exception if not.
        if (!$this->authorize())
            throw new Exception('Geen Admin');

        //Create and render view.
        $view = new View('product');
        $view->set('title', 'Beheer');
        $view->set('products', Product::getAll());

        $view->render();
    }

    function authorize()
    {
        //Checks if the user is an admin.
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] == "customer")
            return false;
        return true;
    }

    public function changePrice()
    {
        //Checks if the user is an admin. Throws exception if not.
        if (!$this->authorize())
            throw new Exception('Geen Admin');

        //Checks if the price and id are set. Throws exception if not.
        if (!isset($_POST['newPrice']) || !isset($_POST['id']))
            throw new Exception('Geen prijs/ID gevonden!');

        //Creates new instance of product, then saves new price to database.
        $product = new Product($_POST['id'], "", "", $_POST['newPrice'], "");
        $product->changePrice();

        //Create and render view.
        $view = new View('product');
        $view->set('title', 'Taken');
        $view->set('products', Product::getAll());

        $view->render();
    }

    public function addImage()
    {
        //Checks if the user is an admin. Throws exception if not.
        if (!$this->authorize())
            throw new Exception('Geen Admin');

        //Checks if the image and id are set. Throws exception if not.
        if (!isset($_POST['image_upload']) || !isset($_POST['id']))
            throw new Exception('Geen afbeelding/ID gevonden!');

        //Creates new instance of product, then saves new image to database.
        $product = new Product();
        $product->addImage($_POST['id'], $_POST['image_upload']);

        //Create and render view.
        $view = new View('product');
        $view->set('title', 'Taken');
        $view->set('products', Product::getAll());

        $view->render();
    }

    //This shouldn't exist. Only for testing. Not throwing it out last second.
    public function addToBasket()
    {
        //var_dump(unserialize($_SESSION['basket']));
    }

    public function addProducts()
    {
        //Checks if the user is an admin. Throws exception if not.
        if (!$this->authorize())
            throw new Exception('Geen Admin');

        //Checks if csv was posted.
        //If so: Opens filestream and loops through it.
        //For each row: creates instance of product and adds it to database.
        //Then closes the filestream.
        if (isset($_POST['csvModels'])) {
            $handle = fopen($_FILES['filename']['tmp_name'], "r");
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                $product = new Product("", $data[0], $data[1], $data[2], "");
                $product->addModel();
            }
            fclose($handle);
        }

        //Create and render view.
        $view = new View('product');
        $view->set('title', 'Taken');
        $view->set('products', Product::getAll());

        $view->render();
    }
}
