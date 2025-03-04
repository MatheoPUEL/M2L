<?php
// Variable globale a la page
$title = "TENNIS CLUB";
$description = "Ma description";

$localisation = "Notre club de tennis possède plusieurs terrains d'entrainement et de matchs. Si vous souhaitez nous rencontrer, afin de voir comment se deroule un entrainement ou inscrire votre enfant, vous trouverez ci-dessus l'adresse du terrain où nous retrouver.";
$faq = "Si vous souhaitez avoir des précisions sur la ligue ou nous poser une question, n'hésitez pas, nous y répondrons dans les plus brefs délais. <br><small>*Si votre question ne respecte pas les règles du site ou n'est pas posée dans la bonne section du site, celle-ci sera supprimée.</small>";
?>

<?php
    require_once('./inc/header.inc.php')
?>


    <header>
        <div>
            <h1><?= $title ?></h1>
            <img class="bottom" src="./img/svg/Bottomcorner.svg" alt="">
            <img class="right" src="./img/svg/Leftcorner.svg" alt="">
        </div>
        <img class="img-header" src="./img/tennis.jpg" style=" object-fit: cover;" alt="">
    </header>

    <section class="services" id="services">
        <h1>Services</h1>
        <p>En cours de dev</p>
    </section>

    <section class="grid-location" id="localisation">
        <div class="content-loc">
            <h1>Localisation</h1>
            <p><?= $localisation ?></p>
        </div>
        <div class="media-loc">
            <iframe width="650" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=450&amp;height=450&amp;hl=en&amp;q=13%20Rue%20Jean%20Moulin,%2054510%20Tomblaine+(Maison%20des%20ligues)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
    </section>

    <section class="FAQ" id="faq">
        <div class="content-faq">
            <form method="post" action="./form/addMessage.form.php">
                <textarea name="message" id="message" rows="10" cols="35" placeholder="Votre message"></textarea>
                <button class="button">Envoyer</button>
            </form>
        </div>
        <div class="media-faq">
            <h1>FAQ</h1>
            <h3><?= $faq ?></h3>
        </div>
    </section>

    <section class="questions" id="questions">
         <h1>Les questions déjà posées</h1>
            <!-- A répeter pour le foreach des questions -->
             <!-- ajouter la classe no-response si il y a pas de réponse a la question qui est posé -->
        <div class="question-post">
            <div class="question-header">
                <div><p>Jhon doe</p></div>
                <div>
                    <ul class="question-date_info">
                        <li>23-04-2024</li>
                        <li>11h50</li>
                    </ul>
                </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste adipisci delectus nobis esse ex quasi facilis hic facere omnis necessitatibus. Eligendi consequuntur, fuga sint eius atque quisquam? Pariatur, non in.</p>
        </div>

        <div class="response">
            <div class="question-header">
                <div><p>Admin</p></div>
                <div>
                    <ul class="question-date_info">
                        <li>23-04-2024</li>
                        <li>14h30</li>
                    </ul>
                </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste adipisci delectus nobis esse ex quasi facilis hic facere omnis necessitatibus. Eligendi consequuntur, fuga sint eius atque quisquam? Pariatur, non in.</p>
        </div>

        <div class="question-post">
            <div class="question-header">
                <div><p>Jhon doe</p></div>
                <div>
                    <ul class="question-date_info">
                        <li>23-04-2024</li>
                        <li>11h50</li>
                    </ul>
                </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste adipisci delectus nobis esse ex quasi facilis hic facere omnis necessitatibus. Eligendi consequuntur, fuga sint eius atque quisquam? Pariatur, non in.</p>
            <!-- Afficher seulement si on est administrateur -->
            <div class="question-footer">
                <button class="red"><i class="fa-solid fa-trash"></i> &nbsp; Supprimer</button>
                <button class="blue"><i class="fa-solid fa-reply"></i> &nbsp; Répondre</button>
            </div>
        </div>

        <div class="question-post">
            <div class="question-header">
                <div><p>Jhon doe</p></div>
                <div>
                    <ul class="question-date_info">
                        <li>23-04-2024</li>
                        <li>11h50</li>
                    </ul>
                </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste adipisci delectus nobis esse ex quasi facilis hic facere omnis necessitatibus. Eligendi consequuntur, fuga sint eius atque quisquam? Pariatur, non in.</p>
            <!-- Afficher seulement si c'est l'utilisateur qui a posté le message -->
            <div class="question-footer">
                <button type="submit" class="blue"><i class="fa-solid fa-edit"></i> &nbsp; Editer</button>
            </div>
        </div>

    </section>
<?php
    require_once('./inc/footer.inc.php')
?>