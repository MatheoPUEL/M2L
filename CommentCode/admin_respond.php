<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de connexion à la base de données
require_once('./bdd/bdd_co.php');

// Connexion à la base de données
$dbh = db_connect();

// Définition du fuseau horaire
date_default_timezone_set('Europe/Paris');

// Vérification de la connexion de l'utilisateur
if(isset($_SESSION["user"])){
    // Récupération de la question (non utilisée dans ce code)
    $question = isset($_POST["question"]) ? $_POST["question"]:"";
    
    // Requête SQL pour récupérer les détails de la FAQ
    $sql = "SELECT faq.id_faq, faq.question, user.pseudo
            FROM faq
            INNER JOIN user on faq.id_user = user.id_user
            WHERE id_faq = :id;";
    
    try {
        // Préparation et exécution de la requête
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":id" => $_GET['idfaq']));
        $fetch = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        // Gestion des erreurs de requête
        die("Erreur lors de la requête SQL : ".$ex->getMessage());
    }
}
?>

<?php
    // Inclusion de l'en-tête
    require_once('./inc/header.inc.php')
?>
    <!-- Formulaire de réponse -->
    <form 
        action="./form/admin_rep.form.php?idligue=<?=$_GET['idligue']?>&idfaq=<?= $_GET['idfaq'] ?>" 
        method="post" 
        class="form-container"
    >
        <!-- Titre indiquant à qui on répond -->
        <h1>Répondre à <?= $fetch['pseudo'] ?>: </h1>
        
        <!-- Affichage de la question originale -->
        <p><?= $fetch['question'] ?></p>
        
        <!-- Zone de texte pour la réponse -->
        <textarea 
            name="reponse" 
            id="" 
            rows="10" 
            placeholder="Votre réponse"
        ></textarea>
        
        <!-- Bouton de soumission -->
        <button class="button">Répondre</button>
    </form>
<?php
    // Inclusion du pied de page
    require_once('./inc/footer.inc.php')
?>