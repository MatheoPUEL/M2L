<?php
// Démarrage de la session PHP pour accéder aux variables de session
session_start();

// Inclusion du fichier de connexion à la base de données
require_once('../bdd/bdd_co.php');

// Vérification du niveau de permissions de l'utilisateur
// Si le type d'utilisateur est supérieur à 1 (généralement indique un utilisateur admin ou modérateur)
if ($_SESSION["usertype"] > 1) {
    // Récupération du message à éditer depuis le formulaire POST
    // Utilisation d'une condition ternaire pour affecter la valeur de $message
    if (isset($_POST['message_edit'])){
        $message = $_POST['message_edit'];
    }

    // Établissement de la connexion à la base de données
    $dbh = db_connect();
    
    // Préparation de la requête SQL pour mettre à jour la question dans la table FAQ
    $sql = "UPDATE faq SET question = :question WHERE id_faq = :id";
    
    try {
        // Préparation de la requête avec des paramètres sécurisés
        $sth = $dbh->prepare($sql);
        
        // Exécution de la requête avec les valeurs:
        // - Le nouveau texte de la question
        // - L'ID de la FAQ à mettre à jour
        $sth->execute([
            'question' => $message, 
            "id" => $_GET['id']
        ]);
        
        // Redirection vers la page d'administration des ligues après mise à jour
        header("location: ../admin_all_ligues.php");
    
    } catch (PDOException $ex) {
        // Gestion des erreurs de base de données
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
}
?>