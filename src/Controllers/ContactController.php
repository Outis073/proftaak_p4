<?php

class ContactController
{
    public function index()
    {
        $view = new View('Contact');
        $view->set('title', 'Contact');

        $view->render();
    }
}
