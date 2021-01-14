<?php
// Testé si le formulaire à été envoyé avec tous les champs nécessaire
$formSent = filter_has_var(INPUT_POST, 'gender')
    && filter_has_var(INPUT_POST, 'contact_lastname')
    && filter_has_var(INPUT_POST, 'contact_firstname')
    && filter_has_var(INPUT_POST,'contact_email')
    && filter_has_var(INPUT_POST,'contact_subject')
    && filter_has_var(INPUT_POST,'message_text');

// Si le formulaire à bien été envoyé avec tous les champs nécessaire, on fait le traitement
if ($formSent) {
    // Nettoyage des données réceptionnées
    $args = [
        'gender' => FILTER_SANITIZE_STRING,
        'contact_lastname' => FILTER_SANITIZE_STRING,
        'contact_firstname' => FILTER_SANITIZE_STRING,
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
    $isLastnameEmpty = empty($datas['contact_lastname']);
    // Champ prénom
    $isFirstnameEmpty = empty($datas['contact_firstname']);
    // Champ email
    $isEmailEmpty = empty($datas['contact_email']);
    // Champ message
    $isMessageEmpty = empty($datas['message_text']);

    // Verifier si l'adresse email est valide
    if ($datas['contact_email']) {
        $isEmailValid = true;
    } else {
        $isEmailValid = false;
    }

    // Verifier si le message fait au moins 5 caractères
    $isMin5car = strlen($datas['message_text']) >= 5;

    // Verifier si le genre renseigné est "Mr" ou "Mme"
    $isGenderValid = ($datas['gender'] === "Mr") || ($datas['gender'] === "Mme");

    // Verifier si le sujet renseigné est "proposition emploi" ou "demande information et prestations"
    $isSubjectValid = ($datas['contact_subject'] === "proposition emploi") || ($datas['contact_subject'] === "demande information et prestations");

    // Enregistrement dans le fichier texte dans le dossier /contact sous la forme "contact_2020-01-12-09-52-00.txt"
    if ($isClean && !$isLastnameEmpty && !$isFirstnameEmpty && !$isEmailEmpty && !$isMessageEmpty && $isEmailValid && $isMin5car && $isGenderValid && $isSubjectValid) {
        // Envoyer les données dans le fichier texte
        // On écrit le chemin du fichier
        $file = 'contact/contact_' . date('Y-m-d-H-i-s') . '.txt';
        // Ecriture du fichier
        if (file_put_contents($file, implode(' - ', $datas))) {
            // Message d'information - Tout s'est bien passé
            $msg_info = "Votre message à bien été envoyé";
            // On vide le formulaire
            $datas['contact_lastname'] = '';
            $datas['contact_firstname'] = '';
            $datas['contact_email'] = '';
            $datas['message_text'] = '';
        } else {
            $msg_info = "Erreur d'écriture du fichier";
        }
    } else {
        // Message d'information - Erreur dans les données
        $msg_info = "Des données du formulaire à envoyé ne sont pas valide";
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
                <p class="error_message"><?= isset($msg_info) ? $msg_info : '' ?></p>
                <form action="?page=contact" method="POST">
                    <p class="error_message"><?= (isset($datas['gender']) && !$isGenderValid) ? $datas['gender'] . 'n\'est pas une donnée valide petit malin^^' : '' ?></p>
                    <div id="select_list">
                        <label for="gender">Genre : </label>
                        <select name="gender" id="gender">
                            <option value="Mr">Monsieur</option>
                            <option value="Mme">Madame</option>
                        </select>
                    </div>
                    <p class="error_message"><?= (isset($isLastnameEmpty) && $isLastnameEmpty) ? 'Champ nom vide' : '' ?></p>
                    <div class="champs">
                        <label for="contact_lastname">Votre Nom : </label>
                        <input type="text" id="contact_lastname" name="contact_lastname"
                               placeholder="Tapez votre nom ici..."
                               value="<?= isset($datas['contact_lastname']) ? $datas['contact_lastname'] : '' ?>">
                    </div>
                    <p class="error_message"><?= (isset($isFirstnameEmpty) && $isFirstnameEmpty) ? 'Champ prénom vide' : '' ?></p>
                    <div class="champs">
                        <label for="contact_firstname">Votre Prénom : </label>
                        <input type="text" id="contact_firstname" name="contact_firstname"
                               placeholder="Tapez votre Prénom..."
                               value="<?= isset($datas['contact_firstname']) ? $datas['contact_firstname'] : '' ?>">
                    </div>
                    <p class="error_message"><?= (isset($isEmailEmpty) && $isEmailEmpty) ? 'Champ email vide' : '' ?></p>
                    <p class="error_message"><?= (isset($isEmailValid) && !$isEmailValid) ? 'Email non valide' : '' ?></p>
                    <div class="champs">
                        <label for="contact_email">Votre adresse mail : </label>
                        <input type="text" id="contact_email" name="contact_email"
                               placeholder="Tapez votre adresse email ici...">
                    </div>
                    <p class="error_message"><?= (isset($datas['contact_subject']) && !$isSubjectValid) ? $datas['contact_subject'] . 'n\'est pas une donnée valide petit malin^^' : '' ?></p>
                    <div id="radio_buttons">
                        <label>raison du contact :</label>
                        <input type="radio" id="emploi" name="contact_subject" value="proposition emploi" checked>
                        <label for="emploi">Proposition d'emploi</label>
                        <input type="radio" id="info_prestations" name="contact_subject"
                               value="demande information et prestations">
                        <label for="info_prestations">Demande d'information et prestations</label>
                    </div>
                    <p class="error_message"><?= (isset($isMessageEmpty) && $isMessageEmpty) ? 'Champ prénom vide' : '' ?></p>
                    <p class="error_message"><?= (isset($isMin5car) && !$isMin5car) ? 'Le message doit comporter minimum 5 caractères' : '' ?></p>
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