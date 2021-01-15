<?php
session_start();
// Date and Hour for the first connection
if (!isset($_SESSION['dateFirstVisit'])) {
    $_SESSION['dateFirstVisit'] = date('Y-m-d H:i:s');
}

// Count of view page
if (!isset($_SESSION['countViewPages'])) {
    $_SESSION['countViewPages'] = 1;
} else {
    $_SESSION['countViewPages']++;
}

require 'config/config.php';
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
if ($page) {
    if (array_key_exists($page,$routes)) {
        $metaTitle = $titles[$page];
        $metaDescription = $descriptions[$page];
        $route = $page;
    } else {
        $metaTitle = $titles['error404'];
        $metaDescription = $descriptions['error404'];
        $route = 'error404';
    }
} else {
    $metaTitle = $titles['profil'];
    $metaDescription = $descriptions['profil'];
    $route = 'profil';
}

// Call the route
require 'core/header.php';
require $routes[$route];
require 'core/footer.php';