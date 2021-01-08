<?php
    if (isset($_GET["page"])) {
        switch ($_GET["page"]) {
            case 'profil':
                require 'pages/profil.php';
                break;
            case 'hobby':
                require 'pages/hobby.php';
                break;
            case 'contact':
                require 'pages/contact.php';
                break;
            default :
                require 'pages/profil.php';
        }
    } else {
     require 'pages/profil.php';
    }