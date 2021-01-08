<?php
$metaTitle = "Contact";
$metaDescription = "Contactez-moi";
require 'header.php';
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
                <form action="https://httpbin.org/post" method="POST" target="_blank">
                    <div class="champs">
                        <label for="contact_name">Votre Nom : </label>
                        <input type="text" id="contact_name" name="contact_name"
                               placeholder="Tapez votre nom et prénom ici..." required>
                    </div>
                    <div class="champs">
                        <label for="contact_email">Votre @-mail : </label>
                        <input type="email" id="contact_email" name="contact_email"
                               placeholder="Tapez votre adresse email ici..." required>
                    </div>
                    <div id="radio_buttons">
                        <label>Vous êtes :</label>
                        <input type="radio" id="particular" name="contact_type" value="particulier" checked>
                        <label for="particular">Un Particulier</label>
                        <input type="radio" id="pro" name="contact_type" value="pro">
                        <label for="pro">Un Professionnel</label>
                        <input type="radio" id="other" name="contact_type" value="autres">
                        <label for="other">Autres</label>
                    </div>
                    <div id="select_list">
                        <label for="message_subject">Quel est l'objet de votre message : </label>
                        <select name="message_subject" id="message_subject">
                            <option value="contact">Contactez-moi</option>
                            <option value="devis">Besoin d'un Devis</option>
                            <option value="sav">Service Après-Vente</option>
                            <option value="reclamation">Une Réclamation</option>
                            <option value="other">Autres</option>
                        </select>
                    </div>
                    <div id="message">
                        <label for="message_text">Votre message :</label>
                        <textarea name="message_text" id="message_text" cols="50"
                                  rows="10" placeholder="Tapez votre message ici..."></textarea>
                    </div>
                    <div id="buttons">
                        <button type="reset">Réinitialiser le formulaire</button>
                        <button type="submit">Envoyer le formulaire</button>
                    </div>
                </form>
            </article>
            <article class="main_style transparence ">
                <h3 class="sub_title">Envoyez moi un Email</h3>
                <div id="mail_picture">
                    <a href="mailto:contact@mondomaine.fr"><img src="../images/contact/mail.png" width=100 height=100
                                                                alt="Enveloppe"></a>
                    <a href="mailto:contact@mondomaine.fr" class="link_secondary_menu">contact@mondomaine.fr</a>
                </div>
            </article>
        </div>
    </section>
</main>

<?php require 'footer.php'; ?>