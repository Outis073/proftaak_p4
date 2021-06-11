<?php

    class SearchController {
        public function index() {
            $view = new View('Search');
            $view->set('title','Zoeken');
            $view->set('content','Zoekresultaten');
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $view->set('search',$_POST['search']);
                $view->set('searchResults', Search::getSearchResults($_POST['search']));
            }

            $view->render();
        }
    }