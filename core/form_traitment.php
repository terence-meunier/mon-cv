<?php
session_start();
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
    'contact_email' => FILTER_VALIDATE_EMAIL,
    'contact_subject' => FILTER_SANITIZE_STRING,
    'message_text' => FILTER_SANITIZE_STRING
];

// On teste si le nettoyage c'est bien passé
$datas = filter_input_array(INPUT_POST, $args);

// Testé si les champs sont renseignés (champs vides)
// Champ nom
if (empty($datas['contact_lastname'])) {
    $formErrors['contact_lastname'] = 'Le champ nom est vide';
} else {
    $formErrors['contact_lastname'] = false;
}
// Champ prénom
if (empty($datas['contact_firstname'])) {
    $formErrors['contact_firstname'] = 'Le champ prénom est vide';
} else {
    $formErrors['contact_firstname'] = false;
}
// Champ email
if (empty($datas['contact_email'])) {
    $formErrors['contact_email'] = 'Le champ email est vide';
} else {
    $formErrors['contact_email'] = false;
}
// Champ message
if (empty($datas['message_text'])) {
    $formErrors['message_text'] = 'Le champ message est vide';
} else {
    $formErrors['message_text'] = false;
}
// Champ pseudo
if (empty($datas['contact_pseudo'])) {
    $formErrors['contact_pseudo'] = 'Le champ pseudo est vide';
} else {
    $formErrors['contact_pseudo'] = false;
}

// Verifier si l'adresse email est valide
if ($datas['contact_email']) {
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
        header("Location: /?page=contact");
        exit();
    } else {
        // Message d'information - Il y a eu une erreur dans l'écriture du fichier
        $formInfos['msg_info'] = 'Erreur d\'écriture du fichier';
        // On passe les variables à la session
        $_SESSION['errorsMsg'] = $formErrors;
        $_SESSION['infosMsg'] = $formInfos;
        $_SESSION['datas'] = $datas;
        // Et on redirige
        header("Location: /?page=contact");
        exit();
    }
} else {
    // Message d'information - Erreur dans les données
    $formInfos['msg_info'] = 'Des données du formulaire à envoyé ne sont pas valide';
    $_SESSION['errorsMsg'] = $formErrors;
    $_SESSION['infosMsg'] = $formInfos;
    $_SESSION['datas'] = $datas;
    header("Location: /?page=contact");
    exit();
}