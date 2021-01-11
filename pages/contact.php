<?php
// Traitement du formulaire
// Tableau de filtres
$args = [
    'gender' => FILTER_SANITIZE_STRING,
    'contact_lastname' => FILTER_SANITIZE_STRING,
    'contact_firstname' => FILTER_SANITIZE_STRING,
    'contact_email' => FILTER_SANITIZE_EMAIL,
    'contact_subject' => FILTER_SANITIZE_STRING,
    'message_text' => FILTER_SANITIZE_STRING
];

// Application des filtres sur POST
$datas = filter_input_array(INPUT_POST, $args);

// Test si les champ sont vide
// Champ Nom
if (isset($datas['contact_lastname']) && empty($datas['contact_lastname'])) {
    $lastnameIsEmpty = true;
} else {
    $lastnameIsEmpty = false;
}
// Champ Prénom
if (isset($datas['contact_firstname']) && empty($datas['contact_firstname'])) {
    $firstnameIsEmpty = true;
} else {
    $firstnameIsEmpty = false;
}
// Champ email
if (isset($datas['contact_email']) && empty($datas['contact_email'])) {
    $emailIsEmpty = true;
} else {
    $emailIsEmpty = false;
}
// Champ message
if (isset($datas['message_text']) && empty($datas['message_text'])) {
    $messageIsEmpty = true;
} else {
    $messageIsEmpty = false;
}

// Verification de l'adresse email valide
if (isset($datas['contact_email']) && filter_var($datas['contact_email'], FILTER_VALIDATE_EMAIL)) {
    $emailIsValid = true;
} else {
    $emailIsValid = false;
}

// Enregistrement du fichier
if ($datas && !$lastnameIsEmpty && !$firstnameIsEmpty && !$emailIsEmpty && !$messageIsEmpty && $emailIsValid) {
    // Création du nom du fichier
    $file = 'contact/contact_' . date('Y-m-d-H-i-s') . '.txt';

    // Ajout des données au fichier et gestion d'une variable d'information si le message est enregistré
    if (file_put_contents($file, implode(' | ', $datas))) {
        $info_msg = "Votre message est enregistré";
    } else {
        $info_msg = "Erreur d'enregistrement du message";
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
                <p><?php if (isset($info_msg)) {
                        echo $info_msg;
                    } ?></p>
                <h3 class="sub_title">Formulaire de Contact</h3>
                <form action="index.php?page=contact" method="POST">
                    <div id="select_list">
                        <label for="gender">Genre : </label>
                        <select name="gender" id="gender">
                            <option value="Mr">Monsieur</option>
                            <option value="Mme">Madame</option>
                        </select>
                    </div>
                    <p class="error_message"><?php if($lastnameIsEmpty) { echo 'Champ nom vide'; } ?></p>
                    <div class="champs">
                        <label for="contact_lastname">Votre Nom : </label>
                        <input type="text" id="contact_lastname" name="contact_lastname"
                               placeholder="Tapez votre nom ici..." value="<?= $datas['contact_lastname'] ?>">
                    </div>
                    <p class="error_message"><?php if($firstnameIsEmpty) { echo 'Champ prénom vide'; } ?></p>
                    <div class="champs">
                        <label for="contact_firstname">Votre Prénom : </label>
                        <input type="text" id="contact_firstname" name="contact_firstname"
                               placeholder="Tapez votre Prénom..." value="<?= $datas['contact_firstname'] ?>">
                    </div>
                    <p class="error_message"><?php if($emailIsEmpty) { echo 'Champ email vide'; } ?></p>
                    <p class="error_message"><?php if(isset($datas['contact_email']) && !$emailIsValid) { echo 'Email non valide'; } ?></p>
                    <div class="champs">
                        <label for="contact_email">Votre adresse mail : </label>
                        <input type="text" id="contact_email" name="contact_email"
                               placeholder="Tapez votre adresse email ici..." value="<?= $datas['contact_email'] ?>">
                    </div>
                    <div id="radio_buttons">
                        <label>raison du contact :</label>
                        <input type="radio" id="emploi" name="contact_subject" value="proposition d'emploi" checked>
                        <label for="emploi">Proposition d'emploi</label>
                        <input type="radio" id="info_prestations" name="contact_subject"
                               value="demande d'information et prestations">
                        <label for="info_prestations">Demande d'information et prestations</label>
                    </div>
                    <p class="error_message"><?php if($messageIsEmpty) { echo 'Champ message vide'; } ?></p>
                    <div id="message">
                        <label for="message_text">Votre message :</label>
                        <textarea name="message_text" id="message_text" cols="50"
                                  rows="10" placeholder="Tapez votre message ici..."><?= $datas['message_text'] ?></textarea>
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