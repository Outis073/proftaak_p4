<?php

    class HomeController {
        public function index() {

            $view = new View('Home');
            $view->set('title','Home');
            $view->set('content','Welkom op de site van VITA E-Bikes');

            $view->render();
        }
    }