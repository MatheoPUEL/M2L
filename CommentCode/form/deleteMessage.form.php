<?php
// Démarrage de la session PHP pour accéder aux variables de session
session_start();

// Vérification du niveau de permissions de l'utilisateur
// Si le type d'utilisateur est supérieur à 1 (généralement indique un utilisateur admin ou modérateur)
if ($_SESSION["usertype"] > 1) {
    // Inclusion du fichier de connexion à la base de données
    require_once("../bdd/bdd_co.php");
    
    // Établissement de la connexion à la base de données
    $dbh = db_connect();
    
    // Préparation de la requête SQL pour supprimer une entrée FAQ
    $sql = "DELETE FROM faq WHERE id_faq = :id";
    
    // Préparation de la requête avec un paramètre sécurisé
    $stmt = $dbh->prepare($sql);
    
    // Exécution de la requête en passant l'ID de la FAQ à supprimer
    $stmt->execute(array(":id" => $_GET["idfaq"]));
    
    // Redirection vers la page des ligues, en ciblant la section des questions
    header("Location: ../ligues.php?id=".$_GET["idligue"]."#questions");
} else {
    // Si l'utilisateur n'a pas les permissions suffisantes, affiche "test"
    echo "test";
}
?>