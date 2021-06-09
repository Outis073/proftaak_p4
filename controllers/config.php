<?php

session_start();

if (!isset($_SESSION['lang']))
    $_SESSION['lang'] = "en";
else if (isset($_GET['lang']) && $_SESSION['lang']!=($_GET['lang']) && !empty($_GET['lang'])){
    if($_get['lang'] == "en")
        $_SESSION['lang'] = "en";
    else
        $_SESSION['lang'] = "DE";
    };

    echo "Choose: language" . $_SESSION['lang'];
?>