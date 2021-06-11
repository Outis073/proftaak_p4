<?php

    class SearchController {
        public function index() {
            $view = new View('Search');
            $view->set('title','Zoeken');
            $view->set('content','Zoekresultaten');
            //$view->set('models', Home::getActiveModels());

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $view->set('search',$_POST['search']);
            }

            $view->render();
        }
    }