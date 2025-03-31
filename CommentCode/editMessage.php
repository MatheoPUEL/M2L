<?php
// Définition des variables pour le titre et la description de la page
$title = "Edit Message ";
$description = "Ma description";
// Démarrage de la session pour accéder aux variables de session
session_start();

// Vérification si l'utilisateur a un niveau d'autorisation supérieur à 1 (modérateur ou admin)
if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] > 1) {
    // Vérification que l'ID de la FAQ est bien présent dans l'URL et qu'il est numérique
    if (isset($_GET["idfaq"]) && is_numeric($_GET["idfaq"])) {
        // Inclusion du fichier de connexion à la base de données
        require_once('./bdd/bdd_co.php');
        // Connexion à la base de données
        $dbh = db_connect();
        // Requête SQL pour récupérer les informations de la question dans la FAQ
        $sql = "SELECT * FROM faq WHERE id_faq = :id";
        // Préparation de la requête
        $stmt = $dbh->prepare($sql);
        // Exécution de la requête avec le paramètre id
        $stmt->execute(array(":id" => $_GET["idfaq"]));
        // Récupération du résultat sous forme de tableau associatif
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si aucun résultat n'est trouvé, afficher un message d'erreur
        if (!$row) {
            $row = "Aucune donnée trouvée pour cet ID.";
        }
    } else {
        // Message d'erreur si l'ID n'est pas valide
        $row = "L'ID de la FAQ n'est pas valide.";
        // Arrêt de l'exécution du script
        exit;
    }
}
?>

<?php
    // Inclusion de l'en-tête du site
    require_once('./inc/header.inc.php')
?>

    <!-- Formulaire d'édition du message -->
    <form action="./form/editMessage.form.php?id=<?=$_GET["idfaq"] ?>" method="post" class="form-container">
        <!-- Titre du formulaire -->
        <h1>Edition du message: </h1>
        <!-- Explication du formulaire -->
        <p>Le message que vous avez posté.</p>
        <!-- Zone de texte préremplie avec la question existante -->
        <textarea name="message_edit" id="" rows="10"><?= $row['question'] ?></textarea>
        <!-- Bouton pour soumettre les modifications -->
        <button class="button">Valider les modifications</button>
    </form>
<?php
    // Inclusion du pied de page du site
    require_once('./inc/footer.inc.php')
?>