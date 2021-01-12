<?php
// Testé si le formulaire à été envoyé
$formSent = filter_has_var(INPUT_POST, 'gender');

if ($formSent) {
    // Nettoyage des données réceptionnées
    $args = [
        'gender' => FILTER_SANITIZE_STRING,
        'contact_lastname' => FILTER_SANITIZE_STRING,
        'contact_firstname' => FILTER_SANITIZE_STRING,
        'contact_email' => FILTER_SANITIZE_EMAIL,
        'contact_subject' => FILTER_SANITIZE_STRING,
        'message_text' => FILTER_SANITIZE_STRING
    ];

    $datas = filter_input_array(INPUT_POST, $args);

    // Testé si les champs sont renseignés (champs vides)
        // Champ nom
        $lastnameIsEmpty = empty($datas['contact_lastname']);
        // Champ prénom
        $firstnameIsEmpty = empty($datas['contact_firstname']);
        // Champ email
        $emailIsEmpty = empty($datas['contact_email']);
        // Champ message
        $messageIsEmpty = empty($datas['message_text']);
    // Verifier si l'adresse email est valide
    $datas['contact_email'] = filter_var($datas['contact_email'], FILTER_VALIDATE_EMAIL);
    if ($datas['contact_email']) {
        $emailIsValid = true;
    } else {
        $emailIsValid = false;
    }
    // Verifier si le message fait au moins 5 caractères
    $min5car = strlen($datas['contact_lastname']) >= 5;
    // Verifier si le genre renseigné est "Mr" ou "Mme"
    $genderIsValid = $datas['gender'] === "Mr" || $datas['gender'] === "Mme";
    // Verifier si le sujet renseigné est "proposition emploi" ou "demande information et prestations"
    $subjectIsValid = $datas['contact_subject'] === "proposition emploi" || $datas['contact_subject'] === "demande information et prestations";
    // Enregistrement dans le fichier texte dans le dossier /contact sous la forme "contact_2020-01-12-09-52-00.txt"
    if (!$lastnameIsEmpty && !$firstnameIsEmpty && !$emailIsEmpty && !$messageIsEmpty && $emailIsValid && $min5car && $genderIsValid && $subjectIsValid) {
        // Envoyer les données dans le fichier texte
    } else {
        // Une des données n'est pas valide
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
                <form action="?page=contact" method="POST">
                    <div id="select_list">
                        <label for="gender">Genre : </label>
                        <select name="gender" id="gender">
                            <option value="Mr">Monsieur</option>
                            <option value="Mme">Madame</option>
                        </select>
                    </div>
                    <div class="champs">
                        <label for="contact_lastname">Votre Nom : </label>
                        <input type="text" id="contact_lastname" name="contact_lastname"
                               placeholder="Tapez votre nom ici...">
                    </div>
                    <div class="champs">
                        <label for="contact_firstname">Votre Prénom : </label>
                        <input type="text" id="contact_firstname" name="contact_firstname"
                               placeholder="Tapez votre Prénom...">
                    </div>
                    <div class="champs">
                        <label for="contact_email">Votre adresse mail : </label>
                        <input type="text" id="contact_email" name="contact_email"
                               placeholder="Tapez votre adresse email ici...">
                    </div>
                    <div id="radio_buttons">
                        <label>raison du contact :</label>
                        <input type="radio" id="emploi" name="contact_subject" value="proposition emploi" checked>
                        <label for="emploi">Proposition d'emploi</label>
                        <input type="radio" id="info_prestations" name="contact_subject"
                               value="demande information et prestations">
                        <label for="info_prestations">Demande d'information et prestations</label>
                    </div>
                    <div id="message">
                        <label for="message_text">Votre message :</label>
                        <textarea name="message_text" id="message_text" cols="50"
                                  rows="10" placeholder="Tapez votre message ici..."></textarea>
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