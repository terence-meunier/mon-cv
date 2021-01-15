<?php
session_start();
// Date and Hour for the first connection
// Choose the Europe/Paris timezone for default
date_default_timezone_set('Europe/Paris');
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
        $route = $routes[$page];
    } else {
        $metaTitle = $titles['error404'];
        $metaDescription = $descriptions['error404'];
        http_response_code(404);
        $route = $routes['error404'];
    }
} else {
    $metaTitle = $titles['profil'];
    $metaDescription = $descriptions['profil'];
    $route = $routes['profil'];
}

// Call the route
// Buffering
ob_start();
// Add in the buffering
require 'core/header.php';
require $route;
require 'core/footer.php';
// Stock buffering and clean
$buffer = ob_get_clean();
// Display buffering
echo $buffer;