<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Térence Meunier">
    <meta name="description" content="<?= isset($metaDescription) ? $metaDescription : 'Page sans description' ?>">
    <link rel="stylesheet" href="styles/styles.css" type="text/css">
    <title>Térence MEUNIER - <?= isset($metaTitle) ? $metaTitle : 'Mon CV' ?></title>
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