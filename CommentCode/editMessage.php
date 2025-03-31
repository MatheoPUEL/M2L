<?php
// Définition des variables globales de la page
$title = "Edit Message "; // Titre de la page
$description = "Ma description"; // Description de la page

// Démarrage de la session PHP
session_start();

// Vérification des permissions utilisateur
if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] > 1) {
    // Vérifie si l'ID de la FAQ est présent et est un nombre valide
    if (isset($_GET["idfaq"]) && is_numeric($_GET["idfaq"])) {
        // Inclusion du fichier de connexion à la base de données
        require_once('./bdd/bdd_co.php');
        
        // Établissement de la connexion à la base de données
        $dbh = db_connect();
        
        // Préparation de la requête SQL pour récupérer les détails de la FAQ
        $sql = "SELECT * FROM faq WHERE id_faq = :id";
        $stmt = $dbh->prepare($sql);
        
        // Exécution de la requête avec l'ID passé en paramètre
        $stmt->execute(array(":id" => $_GET["idfaq"]));
        
        // Récupération de la ligne correspondante
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Gestion du cas où aucune donnée n'est trouvée
        if (!$row) {
            $row = "Aucune donnée trouvée pour cet ID.";
        }
    } else {
        // Gestion des ID invalides
        $row = "L'ID de la FAQ n'est pas valide.";
        exit; // Arrête l'exécution du script
    }
}
?>

<?php
    // Inclusion de l'en-tête du site
    require_once('./inc/header.inc.php')
?>

    <!-- Formulaire d'édition de message -->
    <form action="./form/editMessage.form.php?id=<?=$_GET["idfaq"] ?>" method="post" class="form-container">
        <h1>Edition du message: </h1>
        <p>Le message que vous avez posté.</p>
        
        <!-- Zone de texte pré-remplie avec la question actuelle -->
        <textarea name="message_edit" id="" rows="10"><?= $row['question'] ?></textarea>
        
        <!-- Bouton de validation des modifications -->
        <button class="button">Valider les modifications</button>
    </form>
<?php
    // Inclusion du pied de page du site
    require_once('./inc/footer.inc.php')
?>