<?php
// Inclusion du fichier de connexion à la base de données
require_once "../bdd/bdd_co.php";

// Démarrage de la session
session_start();
// Établissement de la connexion à la base de données
$dbh = db_connect();
// Récupération des données de connexion depuis le formulaire POST
$user = isset($_POST["login"]) ? $_POST["login"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

// Préparer la requête pour récupérer l'utilisateur et son mot de passe haché
$sql_user = "SELECT pseudo, mdp, id_ligue, id_user, id_usertype FROM user WHERE pseudo = :pseudo";
try {
   // Préparation et exécution de la requête avec le nom d'utilisateur
   $sth = $dbh->prepare($sql_user);
   $sth->execute([":pseudo" => $user]);
   $userData = $sth->fetch(PDO::FETCH_ASSOC); // Récupérer toutes les données de l'utilisateur
} catch (PDOException $ex) {
   // Gestion des erreurs SQL
   die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

// Vérifier si l'utilisateur existe et si le mot de passe est correct
if ($userData && password_verify($password, $userData['mdp'])) {
   // Si l'authentification réussit, enregistrement des données utilisateur en session
   $_SESSION['user'] = $user;
   $_SESSION['ligue'] = $userData['id_ligue'];
   $_SESSION['usertype'] = $userData['id_usertype'];
   $_SESSION['user_id'] = $userData['id_user'];
   // Redirection vers la page d'accueil
   header ('Location: ../index.php');
} else {
   // Si l'authentification échoue, message d'erreur en session et redirection vers la page de connexion
   $_SESSION['flash'] = "Identifiant ou mot de passe incorrect !";
   header("Location: ../login.php");
}
?>