<?php

class ProductController
{
    public function index()
    {
        if(!$_SESSION['user_type'] == "admin")
            header("index.php?Controller=Home&Action=index");

        $view = new View('product');
        $view->set('title', 'Taken');
        $view->set('products', Product::getAll());

        $view->render();
    }

    public function changePrice(){
        if (!isset( $_POST['newPrice']) || !isset( $_POST['id']))
            throw new Exception('Geen prijs/ID gevonden!');

        $product = new Product($_POST['id'], "", "", $_POST['newPrice'], "");
        $product->changePrice();

        $view = new View('product');
        $view->set('title', 'Taken');
        $view->set('products', Product::getAll());

        $view->render();
    }

    public function addImage(){
        if (!isset( $_POST['image_upload']) || !isset( $_POST['id']))
            throw new Exception('Geen afbeelding/ID gevonden!');

        $product = new Product();
        $product->addImage($_POST['id'], $_POST['image_upload']);

        $view = new View('product');
        $view->set('title', 'Taken');
        $view->set('products', Product::getAll());

        $view->render();
    }


    public function addProducts(){
        if (isset($_POST['csvModels'])) 
        {
            $handle = fopen($_FILES['filename']['tmp_name'], "r");
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) 
            {
                $product = new Product("", $data[0], $data[1], $data[2], "");
                $product->addModel();
            }
            fclose($handle);
        }

        $view = new View('product');
        $view->set('title', 'Taken');
        $view->set('products', Product::getAll());

        $view->render();
    }
}
