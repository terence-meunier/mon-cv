# Changelog
All notable changes to this project will be documented in this file.

## [Unreleased]

## [1.0.0] - 2021-01-07
### Added
- Directory "images" with files and directory for the ressources of this project
    /images
        /contact
            main.png
        /header 
            header_pictures.png
            profil.jpg
        /icons 
            aircraft.png
            bike.png
            laptop.png
            moto.png
            music.png
            pen.png
            photo.png
        /main 
            fond.jpg
        /social_icons
            facebook.png
            instagram.png
            linked.png
            snapchat.png

- Directory "styles"
    styles.css

- File "README.md"
- File "changelog.md"
- File "contact.html"
- File "hobby.html"
- File "index.html"

### [1.1.0] - 2021-01-08
### Added
- .gitignore => Untracked config folder

### Updated
- styles/styles.css => new color for the main style
- index.html => Add Git competences

## [1.2.0] - 2021-01-10
### Delete
- index.html
- hobby.html
- contact.html

### Added
- index.php -> Front Controller
- pages/profil.php
- pages/hobby.php
- pages/contact.php
- error/404.php
- core/header.php
- core/footer.php
- contact/ => For storage the form contact

## [1.3.1] - 2021-01-12
### Updated
- pages/contact.php => update for secure form in php
- core/footer.php => update label version to 1.2 at 1.3
- changelog.md

## [1.4.1] - 2021-01-15
### Added
- config.php => file contents the routes, titles and description for the page sites
- core/form_traitment.php => traitment for the form of the contact page

### Updated
- index.php (Front controller) : Using Session and refactor the code of the front controller for the route integration
- core/header.php : Documentation the new version of code (v1.4.1)
- core/footer.php : Add DateFirstVisit and a CountViewPage

## Deleted
- page/contact.php : Delete the traitment code for the form and deplace in form_traitment.php

## [1.5] - 2021-01-15
## Updated
- index.php : Use Buffering
- core/traitment : add trim and zero values for the text field and add a array data for autocompletion
- page/contact.php : unset session variable