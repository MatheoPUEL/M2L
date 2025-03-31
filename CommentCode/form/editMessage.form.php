<?php
// Démarrage de la session
session_start();
// Inclusion du fichier de connexion à la base de données
require_once('../bdd/bdd_co.php');
// Vérification si l'utilisateur a un type supérieur à 1 (administrateur ou modérateur)
if ($_SESSION["usertype"] > 1) {
   // Récupération du message édité depuis le formulaire POST
   if (isset($_POST['message_edit'])){$message = $_POST['message_edit'];}

   // Établissement de la connexion à la base de données
   $dbh = db_connect();
   // Préparation de la requête SQL pour mettre à jour la question dans la table faq
   $sql = "UPDATE faq SET question = :question WHERE id_faq = :id";
   try {
       // Préparation et exécution de la requête avec les paramètres
       $sth = $dbh->prepare($sql);
       $sth->execute(['question' => $message, "id" => $_GET['id']]);
       // Redirection vers la page d'administration de toutes les ligues
       header("location: ../admin_all_ligues.php");
   } catch (PDOException $ex) {
       // Gestion des erreurs SQL
       die("Erreur lors de la requête SQL : " . $ex->getMessage());
   }
}