<?php

    class SearchController {
        public function index() {
            //Create view.
            $view = new View('Search');
            
            //Checks if the page was loaded through post. Sets view variables if so.
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $view->set('search',$_POST['search']);
                $view->set('searchResults', Search::getSearchResults($_POST['search']));
            }

            //Renders view.
            $view->render();
        }

        function authorize(){
            //Checks if the user is an admin.
            if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] == "customer")
                return false;
            return true;
        }

        public function searchHistory(){
            //Checks if the user is an admin. Throws exception if not.
            if(!$this->authorize())
                throw new Exception('Geen Admin');

            //Create and render view.
            $view = new View('SearchHistory');
            $view->set('title','Zoekopdrachten');
            $view->set('content','Zoekopdrachten');
            $view->set('searchFailures', Search::getFailedSearches());

            $view->render();
        }

        public function removeSearch(){
            //Checks if the user is an admin. Throws exception if not.
            if(!$this->authorize())
                throw new Exception('Geen Admin');

            //Checks if id is posted. Throws exception if not.
            if (!isset( $_POST['id']))
                throw new Exception('Geen ID gevonden!');

            //Creates instance of search and then removes it from database.
            $search = new Search($_POST['id'], "", "");
            $search->removeSearch();

            $this->searchHistory(); //Create and render view.
        }
    }