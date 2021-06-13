<?php

class ContactController
{
    public function index()
    {
        $view = new View('Contact');
        $view->set('title', 'Contact');

        $view->render();
    }

    public function sendContactForm(){
    	if (!isset( $_POST['first_name']) || !isset( $_POST['last_name']) || !isset( $_POST['email']) || !isset( $_POST['message']))
            throw new Exception('Vul alle velden in.');

    	$contact = new Contact($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['message']);
        $contact->sendContactForm();
        $this->index();
    }
}
