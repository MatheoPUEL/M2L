<?php
// Démarrage de la session
session_start();
// Inclusion du fichier de connexion à la base de données
require_once('../bdd/bdd_co.php');

// Établissement de la connexion à la base de données
$dbh = db_connect();
// Configuration du fuseau horaire sur Europe/Paris
date_default_timezone_set('	Europe/Paris');

   // Vérification si l'utilisateur est connecté (session existante)
   if(isset($_SESSION["user"])){
       // Récupération de la réponse depuis le formulaire POST, ou chaîne vide si non définie
       $reponse = isset($_POST["reponse"]) ? $_POST["reponse"]:"";
       // Préparation de la requête SQL pour mettre à jour la réponse dans la table faq
       $sql = "UPDATE faq SET reponse = :reponse, dat_reponse = :dat_reponse WHERE id_faq = :id_faq";
       try{
           // Préparation et exécution de la requête avec les paramètres
           $sth = $dbh->prepare($sql);
           $sth->execute(array(":reponse" => $reponse, ":dat_reponse" => date("Y-m-d H:i:s"), ":id_faq" => $_GET['idfaq']));

           // Redirection vers la page des ligues avec un ancre vers la section questions
           header ('Location: ../ligues.php?id='.$_GET['idligue']. "#questions");
       }catch (PDOException $ex) {
           // Gestion des erreurs SQL
           die("Erreur lors de la requête SQL : ".$ex->getMessage());
       }
           // Affichage du nombre d'enregistrements modifiés (ce code ne sera jamais exécuté à cause du header)
           echo "<p>".$sth->rowcount()." enregistrement(s) ajouté(s)</p>";
   }
?>