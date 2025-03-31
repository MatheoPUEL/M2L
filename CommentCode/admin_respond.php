<?php
// Démarrage de la session pour accéder aux variables de session
session_start();
// Inclusion du fichier de connexion à la base de données
require_once('./bdd/bdd_co.php');

// Connexion à la base de données
$dbh = db_connect();
// Configuration du fuseau horaire pour Paris
date_default_timezone_set('Europe/Paris');

    // Vérification si l'utilisateur est connecté
    if(isset($_SESSION["user"])){
        // Récupération de la question depuis le formulaire ou initialisation à vide
        $question = isset($_POST["question"]) ? $_POST["question"]:"";
        // Requête SQL pour récupérer les informations de la FAQ et de l'utilisateur associé
        $sql = "SELECT faq.id_faq, faq.question, user.pseudo
                FROM faq
                INNER JOIN user on faq.id_user = user.id_user
                WHERE id_faq = :id;";
        try{
            // Préparation et exécution de la requête avec le paramètre id_faq
            $sth = $dbh->prepare($sql);
            $sth->execute(array(":id" => $_GET['idfaq']));
            // Récupération du résultat sous forme de tableau associatif
            $fetch = $sth->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $ex) {
            // Gestion des erreurs de requête SQL
            die("Erreur lors de la requête SQL : ".$ex->getMessage());
            }
    }

?>

<?php
    // Inclusion de l'en-tête du site
    require_once('./inc/header.inc.php')
?>
    <!-- Formulaire de réponse à une question de FAQ -->
    <form action="./form/admin_rep.form.php?idligue=<?=$_GET['idligue']?>&idfaq=<?= $_GET['idfaq'] ?>" method="post" class="form-container">
        <!-- Titre du formulaire affichant le nom de l'utilisateur qui a posé la question -->
        <h1>Répondre à <?= $fetch['pseudo'] ?>: </h1>
        <!-- Affichage de la question posée -->
        <p><?= $fetch['question'] ?></p>
        <!-- Zone de texte pour saisir la réponse -->
        <textarea name="reponse" id="" rows="10" placeholder="Votre réponse"></textarea>
        <!-- Bouton pour soumettre la réponse -->
        <button class="button">Répondre</button>
    </form>
<?php
    // Inclusion du pied de page du site
    require_once('./inc/footer.inc.php')
?>