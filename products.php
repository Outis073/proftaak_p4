<?php

// vult de titel van de pagina in
$page_title = 'Welkom bij Vita E-Bikes';
// laat header.html weten dat dit menu-item actief is
$active = 1;	
// laad de html header in
include ('includes/header.html');

// in mysqli_connect staan de inloggegevens voor de server
include ('includes/mysqli_connect_'.$_SERVER['SERVER_NAME'].'.php');

// laad de html footer in
include ('includes/footer.html');
