<?php
session_start();
// Date et heure de la première connexion
if (!isset($_SESSION['dateFirstVisit'])) {
    $_SESSION['dateFirstVisit'] = date('Y-m-d H:i:s');
}

// Nombre de pages visiter
if (!isset($_SESSION['countViewPages'])) {
    $_SESSION['countViewPages'] = 1;
} else {
    $_SESSION['countViewPages']++;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Térence Meunier">
    <meta name="description" content="<?= $metaDescription ?>">
    <link rel="stylesheet" href="styles/styles.css" type="text/css">
    <title>Térence MEUNIER - <?= $metaTitle ?></title>
</head>

<body>
<header>
    <p><a href="?page=profil" class="link_header">Térence MEUNIER<br>Infographiste | Dev Web | Dessinateur</a></p>
    <img src="images/header/profil.jpg" alt="Photo de profil">
</header>

<nav id="main_menu" class="main_style">
    <ul>
        <li><a href="?page=profil" class="link_main_menu">Mon Profil</a></li>
        <li><a href="?page=hobby" class="link_main_menu">Mon Hobby</a></li>
        <li><a href="?page=contact" class="link_main_menu">Contact</a></li>
    </ul>
</nav>