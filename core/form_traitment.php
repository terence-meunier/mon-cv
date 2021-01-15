<?php
session_start();
// Tester si le formulaire est envoyé
if (filter_has_var(INPUT_POST, 'gender')) {
// Tableau des messages d'erreurs
    $formErrors = [
        'gender' => false,
        'contact_lastname' => false,
        'contact_firstname' => false,
        'contact_pseudo' => false,
        'contact_email' => false,
        'contact_email_valid' => false,
        'contact_subject' => false,
        'message_text' => false,
        'min5car' => false
    ];

// Tableau des messages d'informations
    $formInfos = [
        'msg_info' => ''
    ];

// Nettoyage des données réceptionnées
    $args = [
        'gender' => FILTER_SANITIZE_STRING,
        'contact_lastname' => FILTER_SANITIZE_STRING,
        'contact_firstname' => FILTER_SANITIZE_STRING,
        'contact_pseudo' => FILTER_SANITIZE_STRING,
        'contact_email' => FILTER_SANITIZE_EMAIL,
        'contact_subject' => FILTER_SANITIZE_STRING,
        'message_text' => FILTER_SANITIZE_STRING
    ];

// On teste si le nettoyage c'est bien passé
    $datasSanitize = filter_input_array(INPUT_POST, $args);
    $datas = filter_input_array(INPUT_POST, $args);
    $_SESSION['datas'] = $datasSanitize;


// Testé si les champs sont renseignés (champs vides)
// Champ nom
    if (empty(trim($datas['contact_lastname'])) || trim($datas['contact_lastname'] == "0")) {
        $formErrors['contact_lastname'] = 'Le champ nom est vide';
    } else {
        $formErrors['contact_lastname'] = false;
        $datas['contact_lastname'] = trim($datas['contact_lastname']);
    }
// Champ prénom
    if (empty(trim($datas['contact_firstname'])) || trim($datas['contact_firstname'] == "0")) {
        $formErrors['contact_firstname'] = 'Le champ prénom est vide';
    } else {
        $formErrors['contact_firstname'] = false;
        $datas['contact_firstname'] = trim($datas['contact_firstname']);
    }
// Champ email
    if (empty(trim($datas['contact_email'])) || trim($datas['contact_email'] == "0")) {
        $formErrors['contact_email'] = 'Le champ email est vide';
    } else {
        $formErrors['contact_email'] = false;
        $datas['contact_email'] = trim($datas['contact_email']);
    }
// Champ message
    if (empty(trim($datas['message_text'])) || trim($datas['message_text'] == "0")) {
        $formErrors['message_text'] = 'Le champ message est vide';
    } else {
        $formErrors['message_text'] = false;
        $datas['message_text'] = trim($datas['message_text']);
    }
// Champ pseudo
    if (empty(trim($datas['contact_pseudo'])) || trim($datas['contact_pseudo'] == "0")) {
        $formErrors['contact_pseudo'] = 'Le champ pseudo est vide';
    } else {
        $formErrors['contact_pseudo'] = false;
        $datas['contact_pseudo'] = trim($datas['contact_pseudo']);
    }

// Verifier si l'adresse email est valide
    if (filter_var($datas['contact_email'], FILTER_VALIDATE_EMAIL)) {
        $formErrors['contact_email_valid'] = false;
    } else {
        $formErrors['contact_email_valid'] = 'Email non valide';
    }

// Verifier si le message fait au moins 5 caractères
    if (strlen($datas['message_text']) >= 5) {
        $formErrors['min5car'] = false;
    } else {
        $formErrors['min5car'] = 'Minimum 5 caractères';
    }

// Verifier si le genre renseigné est "Mr" ou "Mme"
    if (($datas['gender'] === "Mr") || ($datas['gender'] === "Mme")) {
        $formErrors['gender'] = false;
    } else {
        $formErrors['gender'] = "Le genre doit être 'Mr' ou 'Mme'";
    }

// Verifier si le sujet renseigné est "proposition emploi" ou "demande information et prestations"
    if (($datas['contact_subject'] === "proposition emploi") || ($datas['contact_subject'] === "demande information et prestations")) {
        $formErrors['contact_subject'] = false;
    } else {
        $formErrors['contact_subject'] = "Le sujet doit être 'proposition emploi' ou 'demande information et prestations'";
    }

// Enregistrement dans le fichier texte dans le dossier /contact sous la forme "contact_2020-01-12-09-52-00.txt"
    if (!$formErrors['gender']
        && !$formErrors['contact_lastname']
        && !$formErrors['contact_firstname']
        && !$formErrors['contact_pseudo']
        && !$formErrors['contact_email']
        && !$formErrors['contact_email_valid']
        && !$formErrors['message_text']
        && !$formErrors['min5car']
        && !$formErrors['contact_subject']) {
        // Envoyer les données dans le fichier texte
        // On écrit le chemin du fichier
        $file = '../contact/contact_' . date('Y-m-d-H-i-s') . '.txt';
        // Ecriture du fichier
        if (file_put_contents($file, implode(PHP_EOL, $datas))) {
            // Message d'information - Tout s'est bien passé
            $formInfos['msg_info'] = 'Merci, votre message à bien été pris en compte';
            // On vide le formulaire
            $datas['contact_lastname'] = '';
            $datas['contact_firstname'] = '';
            $datas['contact_email'] = '';
            $datas['message_text'] = '';
            $datas['contact_pseudo'] = '';
            // On passe les variables à la session
            $_SESSION['infosMsg'] = $formInfos;
            // On supprime les variables de la session
            unset($_SESSION['errorsMsg']);
            unset($_SESSION['datas']);
            // Redirection
            $redirectUrl = dirname($_SERVER['PHP_SELF'], 2) . '/?page=contact';
            header("Location: $redirectUrl");
            exit;
        } else {
            // Message d'information - Il y a eu une erreur dans l'écriture du fichier
            $formInfos['msg_info'] = 'Erreur d\'écriture du fichier';
            // On passe les variables à la session
            $_SESSION['errorsMsg'] = $formErrors;
            $_SESSION['infosMsg'] = $formInfos;
            // Et on redirige
            $redirectUrl = dirname($_SERVER['PHP_SELF'], 2) . '/?page=contact';
            header("Location: $redirectUrl");
            exit;
        }
    } else {
        // Message d'information - Erreur dans les données
        $formInfos['msg_info'] = 'Des données du formulaire à envoyé ne sont pas valide';
        $_SESSION['errorsMsg'] = $formErrors;
        $_SESSION['infosMsg'] = $formInfos;
        $redirectUrl = dirname($_SERVER['PHP_SELF'], 2) . '/?page=contact';
        header("Location: $redirectUrl");
        exit;
    }
}