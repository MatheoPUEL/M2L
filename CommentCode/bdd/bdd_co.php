<?php

// Fonction pour se connecter à la base de données
function db_connect() {
   $dsn = 'mysql:host=localhost;dbname=appfaq';  // contient le nom du serveur et de la base
   $user = 'root';
   $password = '';
   try {
     // Création d'un nouvel objet PDO avec les paramètres de connexion
     $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
     // Configuration du mode d'erreur pour générer des exceptions
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $ex) {
     // En cas d'erreur de connexion, arrête le script et affiche le message d'erreur
     die("Erreur lors de la connexion SQL : " . $ex->getMessage());
   }
   // Retourne l'objet de connexion à la base de données
   return $dbh;
 }
?>