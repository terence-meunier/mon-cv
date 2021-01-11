<?php
    $http_code = 200;
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
    if ($page) {
        switch ($page) {
            case 'profil':
                $page_include = 'profil';
                $metaTitle = 'Profil';
                $metaDescription = 'Page profil de mon CV';
                break;
            case 'hobby':
                $page_include = 'hobby';
                $metaTitle = 'Hobby';
                $metaDescription = 'Page hobby de mon CV';
                break;
            case 'contact':
                $page_include = 'contact';
                $metaTitle = 'Contact';
                $metaDescription = 'Page contact de mon CV';
                break;
            default :
                $http_code = 404;
        }
    } else {
     require 'pages/profil.php';
    }

    if ($http_code != 200) {
        require  'error' . DIRECTORY_SEPARATOR . $http_code . '.php';
    } else {
        require 'pages' . DIRECTORY_SEPARATOR . 'header.php';
        require 'pages' . DIRECTORY_SEPARATOR . $page_include . '.php';
    }