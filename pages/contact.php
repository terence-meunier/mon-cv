<?php
if (isset($_SESSION['errorsMsg'])) {
    $formErrors = $_SESSION['errorsMsg'];
}
if (isset($_SESSION['infosMsg'])) {
    $formInfos = $_SESSION['infosMsg'];
}
if (isset($_SESSION['datas'])) {
    $datas = $_SESSION['datas'];
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
                <form action="../core/form_traitment.php" method="POST">
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
                               placeholder="Tapez votre pseudo ici..."
                               value="<?= isset($datas['contact_pseudo']) ? $datas['contact_pseudo'] : '' ?>">
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