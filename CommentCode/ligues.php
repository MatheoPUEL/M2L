<?php
// Démarrage de la session PHP
session_start();

// Vérification de la présence de l'ID de ligue dans l'URL
if(isset($_GET['id'])) {
    // Inclusion du fichier de connexion à la base de données
    require_once('./bdd/bdd_co.php');
    $dbh = db_connect();

    // Préparation de la requête pour récupérer les informations de la ligue
    $sql_ligue = "SELECT * FROM ligue WHERE id_ligue = :id";
    try {
        // Exécution de la requête avec l'ID passé en paramètre
        $sth = $dbh->prepare($sql_ligue);
        $sth->execute([":id" => $_GET['id']]);
        // Récupération des données de la ligue sous forme de tableau associatif
        $ligueData = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        // Gestion des erreurs de requête SQL
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }

    // Extraction de l'ID et de l'image de la ligue
    $idligue = $ligueData['id_ligue'];
    $image = $ligueData['image'];

    // Vérification des droits d'accès à la page
    // L'utilisateur doit soit appartenir à la ligue, soit avoir un accès admin (ligue 1)
    if(isset($_SESSION['ligue']) && $_SESSION['ligue'] == $idligue || $_SESSION['ligue'] == 1) {
        $title = $ligueData['lib_ligue'];
        $description = $ligueData['description'];
    } else {
        // Redirection si l'utilisateur n'a pas les droits
        header('Location: ./index.php');
    }

    // Redirection spécifique pour la ligue avec ID 1 (probablement une page admin)
    if ($_GET['id'] == 1) {
        header('Location: ./admin_all_ligues.php');
    }
} else {
    // Redirection si aucun ID de ligue n'est fourni
    header('Location: ./index.php');
}

// Texte par défaut pour la section FAQ
$faq = "Si vous souhaitez avoir des précisions sur la ligue ou nous poser une question, n'hésitez pas, nous y répondrons dans les plus brefs délais. <br><small>*Si votre question ne respecte pas les règles du site ou n'est pas posée dans la bonne section du site, celle-ci sera supprimée.</small>";
?>

<?php
    // Inclusion de l'en-tête du site
    require_once('./inc/header.inc.php')
?>
    <!-- Section Header avec titre et image de la ligue -->
    <header>
        <div>
            <div style="display: flex; flex-direction: row;">
                <h1><?= $title ?></h1>
                <img class="right" src="./img/svg/Leftcorner.svg" alt="">
            </div>
            <img class="bottom" src="./img/svg/Bottomcorner.svg" alt="">
        </div>
        <img class="img-header" src="./img/<?=$image?>" style=" object-fit: cover;" alt="">
    </header>

    <!-- Section Services (en développement) -->
    <section class="services" id="services">
        <h1>Services</h1>
        <p>En cours de dev</p>
    </section>

    <!-- Section Localisation -->
    <section class="grid-location" id="localisation">
        <div class="content-loc">
            <h1>Localisation</h1>
            <p><?= $description ?></p>
        </div>
        <div class="media-loc">
            <iframe width="650" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=450&amp;height=450&amp;hl=en&amp;q=13%20Rue%20Jean%20Moulin,%2054510%20Tomblaine+(Maison%20des%20ligues)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
    </section>

    <!-- Section FAQ avec formulaire de question -->
    <section class="FAQ" id="faq">
        <div class="content-faq">
            <form method="post" action="./form/addMessage.form.php?id=<?=$_GET['id']?>">
                <textarea name="question" id="question" rows="10" cols="35" placeholder="Votre message"></textarea>
                <button class="button">Envoyer</button>
            </form>
        </div>
        <div class="media-faq">
            <h1>FAQ</h1>
            <h3><?= $faq ?></h3>
        </div>
    </section>

    <!-- Section des questions déjà posées -->
    <section class="questions" id="questions">
         <h1>Les questions déjà posées</h1>

        <?php
        // Nouvelle connexion à la base de données
        require_once ('./bdd/bdd_co.php');
        $dbh = db_connect();

        // Requête pour récupérer les questions et leurs réponses
        $sql = "SELECT faq.id_faq, faq.question, faq.reponse, faq.dat_question, faq.dat_reponse, user.pseudo, faq.id_user
                FROM faq 
                INNER JOIN user on faq.id_user = user.id_user
                WHERE user.id_ligue = :idligue
                ORDER BY faq.dat_question desc;";
        try {
            // Préparation et exécution de la requête
            $sth = $dbh->prepare($sql);
            $sth->execute([":idligue"=>$_GET['id']]);
            $rows= $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            // Gestion des erreurs SQL
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

        // Affichage des questions
        if (count($rows) > 0) {
            foreach($rows as $row){
                // Formatage de la date de la question
                $dat_question = new DateTime($row['dat_question']);
                $dat_dmy = $dat_question->format('d-m-Y');
                $dat_mh = $dat_question->format('H:i')
                ?>
                <!-- Bloc de question -->
                <div class="question-post">
                    <div class="question-header">
                        <div>
                            <p>
                                <?= $row['pseudo'] ?> 
                                <!-- Options de suppression/modification pour les admin -->
                                <?php if ($row['id_user'] == $_SESSION['usertype'] > 1  ){ ?>
                                    <a href="./form/deleteMessage.form.php?idfaq=<?=$row['id_faq']?>&idligue=<?=$_GET['id']?>"> - Supprimer</a>
                                    <a href="./editMessage.php?idfaq=<?=$row['id_faq']?>"> - Modifier</a>
                                <?php } ?>
                                <!-- Option de réponse pour les admin -->
                                <?php if ($_SESSION['usertype'] > 1 && $row['reponse'] == null ){ ?>
                                    <a href="./admin_respond.php?idfaq=<?=$row['id_faq']?>"> - Répondre</a>
                                <?php } ?>
                            </p>
                        </div>
                        <ul class="question-date_info">
                            <li><?= $dat_dmy ?></li>
                            <li><?= $dat_mh ?></li>
                        </ul>
                    </div>
                    <p><?= $row['question'] ?></p>
                </div>

                <?php
                // Affichage de la réponse si elle existe
                if ($row['reponse'] != "") {
                    $dat_reponse = new DateTime($row['dat_reponse']);
                    $dat_dmy = $dat_reponse->format('d-m-Y');
                    $dat_mh = $dat_reponse->format('H:m')
                    ?>
                    <div class="response">
                        <div class="question-header">
                            <div><p>Admin</p></div>
                            <div>
                                <ul class="question-date_info">
                                    <li><?= $dat_dmy ?></li>
                                    <li><?= $dat_mh ?></li>
                                </ul>
                            </div>
                        </div>
                        <p><?= $row['reponse'] ?></p>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </section>
<?php
    // Inclusion du pied de page
    require_once('./inc/footer.inc.php')
?>