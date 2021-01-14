<?php
// Testé si le formulaire à été envoyé avec tous les champs nécessaire
$formSent = filter_has_var(INPUT_POST, 'gender')
    && filter_has_var(INPUT_POST, 'contact_lastname')
    && filter_has_var(INPUT_POST, 'contact_firstname')
    && filter_has_var(INPUT_POST, 'contact_email')
    && filter_has_var(INPUT_POST, 'contact_subject')
    && filter_has_var(INPUT_POST, 'message_text')
    && filter_has_var(INPUT_POST, 'contact_pseudo');

// Si le formulaire à bien été envoyé avec tous les champs nécessaire, on fait le traitement
if ($formSent) {

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
    if ($datas = filter_input_array(INPUT_POST, $args)) {
        $isClean = true;
    } else {
        $isClean = false;
    }

    // Testé si les champs sont renseignés (champs vides)
    // Champ nom
    if (empty($datas['contact_lastname'])) {
        $formErrors['contact_lastname'] = 'Le champ nom est vide';
    } else {
        $formErrors['contact_lastname'] = false;
    }
    // Champ prénom
    if (empty($datas['contact_firstname'])) {
        $formErrors['contact_firstname'] = 'Le champ nom est vide';
    } else {
        $formErrors['contact_firstname'] = false;
    }
    // Champ email
    if (empty($datas['contact_email'])) {
        $formErrors['contact_email'] = 'Le champ nom est vide';
    } else {
        $formErrors['contact_email'] = false;
    }
    // Champ message
    if (empty($datas['message_text'])) {
        $formErrors['message_text'] = 'Le champ nom est vide';
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
    if ($isClean
        && !$formErrors['gender']
        && !$formErrors['contact_lastname']
        && !$formErrors['contact_firstname']
        && !$formErrors['contact_pseudo']
        && !$formErrors['contact_email']
        && !$formErrors['message_text']
        && !$formErrors['contact_email_valid']
        && !$formErrors['min5car']
        && !$formErrors['contact_subject']) {
        // Envoyer les données dans le fichier texte
        // On écrit le chemin du fichier
        $file = 'contact/contact_' . date('Y-m-d-H-i-s') . '.txt';
        // Ecriture du fichier
        if (file_put_contents($file, implode(' - ', $datas))) {
            // Message d'information - Tout s'est bien passé
            $formInfos['msg_info'] = 'Les informations ont bien été enregistrées';
            // On vide le formulaire
            $datas['contact_lastname'] = '';
            $datas['contact_firstname'] = '';
            $datas['contact_email'] = '';
            $datas['message_text'] = '';
            $datas['contact_pseudo'] = '';
        } else {
            $formInfos['msg_info'] = 'Erreur d\'écriture du fichier';
        }
    } else {
        // Message d'information - Erreur dans les données
        $formInfos['msg_info'] = 'Des données du formulaire à envoyé ne sont pas valide';
    }
}
?>
<main>
    <section>
        <h1 class="main_style">Contactez moi !</h1>
    </section>
    <section>
        <h2 class="main_style">Vous pouvez me contactez par mail ou par le biais du formulaire de contact</h2>
        <div id="content">
            <article class="main_style transparence">
                <h3 class="sub_title">Formulaire de Contact</h3>
                <p class="error_message"><?= isset($formInfos['msg_info']) ? $formInfos['msg_info'] : '' ?></p>
                <form action="?page=contact" method="POST">
                    <p class="error_message"><?= (isset($formErrors['gender']) && $formErrors['gender']) ? $formErrors['gender'] : '' ?></p>
                    <div id="select_list">
                        <label for="gender">Genre : </label>
                        <select name="gender" id="gender">
                            <option value="Mr">Monsieur</option>
                            <option value="Mme">Madame</option>
                        </select>
                    </div>
                    <p class="error_message"><?= (isset($formErrors['contact_lastname']) && $formErrors['contact_lastname']) ? $formErrors['contact_lastname'] : '' ?></p>
                    <div class="champs">
                        <label for="contact_lastname">Votre Nom : </label>
                        <input type="text" id="contact_lastname" name="contact_lastname"
                               placeholder="Tapez votre nom ici..."
                               value="<?= isset($datas['contact_lastname']) ? $datas['contact_lastname'] : '' ?>">
                    </div>
                    <p class="error_message"><?= (isset($formErrors['contact_firstname']) && $formErrors['contact_firstname']) ? $formErrors['contact_firstname'] : '' ?></p>
                    <div class="champs">
                        <label for="contact_firstname">Votre Prénom : </label>
                        <input type="text" id="contact_firstname" name="contact_firstname"
                               placeholder="Tapez votre Prénom..."
                               value="<?= isset($datas['contact_firstname']) ? $datas['contact_firstname'] : '' ?>">
                    </div>
                    <p class="error_message"><?= (isset($formErrors['contact_email']) && $formErrors['contact_email']) ? $formErrors['contact_email'] : '' ?></p>
                    <p class="error_message"><?= (isset($formErrors['contact_email_valid']) && $formErrors['contact_email_valid']) ? $formErrors['contact_email_valid'] : '' ?></p>
                    <div class="champs">
                        <label for="contact_email">Votre adresse mail : </label>
                        <input type="text" id="contact_email" name="contact_email"
                               placeholder="Tapez votre adresse email ici...">
                    </div>
                    <p class="error_message"><?= (isset($formErrors['contact_pseudo']) && $formErrors['contact_pseudo']) ? $formErrors['contact_pseudo'] : '' ?></p>
                    <div class="champs">
                        <label for="contact_pseudo">Votre pseudo : </label>
                        <input type="text" id="contact_pseudo" name="contact_pseudo"
                               placeholder="Tapez votre pseudo ici..." value="<?= isset($datas['contact_pseudo']) ? $datas['contact_pseudo'] : '' ?>">
                    </div>
                    <p class="error_message"><?= (isset($formErrors['contact_subject']) && $formErrors['contact_subject']) ? $formErrors['contact_subject'] : '' ?></p>
                    <div id="radio_buttons">
                        <label>raison du contact :</label>
                        <input type="radio" id="emploi" name="contact_subject" value="proposition emploi" checked>
                        <label for="emploi">Proposition d'emploi</label>
                        <input type="radio" id="info_prestations" name="contact_subject"
                               value="demande information et prestations">
                        <label for="info_prestations">Demande d'information et prestations</label>
                    </div>
                    <p class="error_message"><?= (isset($formErrors['message_text']) && $formErrors['message_text']) ? $formErrors['message_text'] : '' ?></p>
                    <p class="error_message"><?= (isset($formErrors['min5car']) && $formErrors['min5car']) ? $formErrors['min5car'] : '' ?></p>
                    <div id="message">
                        <label for="message_text">Votre message :</label>
                        <textarea name="message_text" id="message_text" cols="50"
                                  rows="10"
                                  placeholder="Tapez votre message ici..."><?= isset($datas['message_text']) ? $datas['message_text'] : '' ?></textarea>
                    </div>
                    <div id="buttons">
                        <button type="submit">Envoyer le formulaire</button>
                    </div>
                </form>
            </article>
            <article class="main_style transparence ">
                <h3 class="sub_title">Envoyez moi un Email</h3>
                <div id="mail_picture">
                    <a href="mailto:contact@mondomaine.fr"><img src="images/contact/mail.png" width=100 height=100
                                                                alt="Enveloppe"></a>
                    <a href="mailto:contact@mondomaine.fr" class="link_secondary_menu">contact@mondomaine.fr</a>
                </div>
            </article>
        </div>
    </section>
</main>