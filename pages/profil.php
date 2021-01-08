<?php
    $metaTitle = "Profil";
    $metaDescription = "Venez découvrir le profil de mon CV.";
    require 'header.php';
?>
<main>
    <section>
        <h1 class="main_style">Mon Profil</h1>
        <p class="main_style">
            Je m'appelle Térence Meunier.
            <br>
            <br>
            J'ai d'abord travaillé dans le domaine de la construction de maisons individuelles, pour finalement me
            tourner vers le métier de Technicien Développeur Web.
            <br>
            <br>
            Pour moi, le Développeur est capable d'apporter une réponse et une expertise technique
            sur des problèmes posés par le cahier des charges du client.
            <br>
            <br>
            Il doit être une source d'innovation et de proposition pour toujours améliorer le produit et contribuer à la valeur ajoutée pour le client.
        </p>
    </section>
    <section>
        <h2 class="main_style">Compétences | Hobbies | Formations | Expériences</h2>
        <div id="content">
            <article class="main_style transparence">
                <h3 class="sub_title">Mes Compétences</h3>
                <ul>
                    <li>Infographie</li>
                    <li>Dessinateur du bâtiment</li>
                    <li>Développement Web</li>
                    <li>Git</li>
                </ul>
                <h3 class="sub_title">Mes Hobbies</h3>
                <ol>
                    <li>Moto</li>
                    <li>VTT</li>
                    <li>Aéronautique</li>
                    <li>Informatique</li>
                    <li>Photographie</li>
                    <li>Dessin</li>
                    <li>Musique</li>
                </ol>
            </article>
            <article class="main_style transparence">
                <h3 class="sub_title">Formations</h3>
                <table>
                    <tr>
                        <th>Période</th>
                        <th>Formation</th>
                    </tr>
                    <tr>
                        <td>2000</td>
                        <td>BAC STI Génie Electronique - Lycée Saint Louis de CREST</td>
                    </tr>
                    <tr>
                        <td>2000-2001</td>
                        <td>1ère Année IUT Informatique Systèmes Industriels - IUT de VALENCE</td>
                    </tr>
                    <tr>
                        <td>2001-2003</td>
                        <td>BTS Génie Electronique - Lycée Briffaut de VALENCE</td>
                    </tr>
                    <tr>
                        <td>2004-2005</td>
                        <td>Ecole supérieure d'Infographie ARIES de GRENOBLE</td>
                    </tr>
                </table>
                <h3 class="sub_title">Exériences Professionnelles</h3>
                <table>
                    <tr>
                        <th>Période</th>
                        <th>Entreprise</th>
                    </tr>
                    <tr>
                        <td>2013-2019</td>
                        <td>AK GROUPE à St Marcel les Valence en tant que Dessinateur Projeteur</td>
                    </tr>
                    <tr>
                        <td>2009-2012</td>
                        <td>Gérant de la SARL Inter Service Plans</td>
                    </tr>
                    <tr>
                        <td>2007-2009</td>
                        <td>SARL Inter Service Plans à Vizille en tant que Dessinateur Projeteur</td>
                    </tr>
                </table>
            </article>
        </div>
    </section>
</main>

<!-- On ajoute le footer à la page -->
<?php require 'footer.php'; ?>