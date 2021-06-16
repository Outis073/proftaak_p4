<?php

class ContactController
{
    public function index()
    {
        //Create and render view.
        $view = new View('Contact');
        $view->set('title', 'Contact');

        $view->render();
    }

    public function sendContactForm(){
        //Checks if all forms are filled, throws exception otherwise. This is already checked on front end, should never throw error.
    	if (!isset( $_POST['first_name']) || !isset( $_POST['last_name']) || !isset( $_POST['email']) || !isset( $_POST['message']))
            throw new Exception('Vul alle velden in.');

        //Creates instance of contact, then saves it to database.
    	$contact = new Contact($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['message']);
        $contact->sendContactForm();
        $this->index(); //Creates and renders view (see index function above).
    }
}
