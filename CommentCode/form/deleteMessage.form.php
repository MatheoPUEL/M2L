<?php
// Démarrage de la session
session_start();

// Vérification si l'utilisateur a un type supérieur à 1 (probablement un administrateur ou modérateur)
if ($_SESSION["usertype"] > 1) {
   // Inclusion du fichier de connexion à la base de données
   require_once("../bdd/bdd_co.php");
   // Établissement de la connexion à la base de données
   $dbh = db_connect();
   // Préparation de la requête SQL pour supprimer une question de la FAQ
   $sql = "DELETE FROM faq WHERE id_faq = :id";
   // Préparation et exécution de la requête avec l'ID de la FAQ
   $stmt = $dbh->prepare($sql);
   $stmt->execute(array(":id" => $_GET["idfaq"]));
   // Redirection vers la page des ligues avec l'ancre vers la section questions
   header("Location: ../ligues.php?id=".$_GET["idligue"]."#questions");
} else {
   // Si l'utilisateur n'a pas les permissions suffisantes, affiche "test"
   echo "test";
}