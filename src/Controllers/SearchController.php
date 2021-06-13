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

        function authorize(){
            if(!isset($_SESSION['user_type']) || !$_SESSION['user_type'] == "admin")
                header("Location: index.php?controller=Home&action=index");
        }

        public function searchHistory(){
            $this->authorize();

            $view = new View('SearchHistory');
            $view->set('title','Zoekopdrachten');
            $view->set('content','Zoekopdrachten');
            $view->set('searchFailures', Search::getFailedSearches());
            /*if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $view->set('searchFailures', Search::getFailedSearches());
            }*/

            $view->render();
        }

        public function removeSearch(){
            $this->authorize();

            if (!isset( $_POST['id']))
                throw new Exception('Geen ID gevonden!');

            $search = new Search($_POST['id'], "", "");
            $search->removeSearch();

            $this->searchHistory();
        }
    }