<?php
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
    if (isset($page)) {
        switch ($page) {
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