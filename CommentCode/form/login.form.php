<?php
// Inclusion du fichier de connexion à la base de données
require_once "../bdd/bdd_co.php";

// Démarrage de la session PHP
session_start();

// Établissement de la connexion à la base de données
$dbh = db_connect();

// Récupération sécurisée du login et du mot de passe depuis le formulaire POST
// Utilisation de l'opérateur ternaire pour définir des valeurs par défaut
$user = isset($_POST["login"]) ? $_POST["login"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

// Préparation de la requête SQL pour récupérer les informations de l'utilisateur
$sql_user = "SELECT pseudo, mdp, id_ligue, id_user, id_usertype FROM user WHERE pseudo = :pseudo";

try {
    // Préparation et exécution de la requête avec un paramètre sécurisé
    $sth = $dbh->prepare($sql_user);
    $sth->execute([":pseudo" => $user]);
    
    // Récupération des données de l'utilisateur sous forme de tableau associatif
    $userData = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    // Gestion des erreurs de base de données
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

// Vérification de l'authentification
// 1. Vérifier si l'utilisateur existe
// 2. Vérifier si le mot de passe correspond au hash stocké
if ($userData && password_verify($password, $userData['mdp'])) {
    // Authentification réussie : création de variables de session
    $_SESSION['user'] = $user;
    $_SESSION['ligue'] = $userData['id_ligue'];
    $_SESSION['usertype'] = $userData['id_usertype'];
    $_SESSION['user_id'] = $userData['id_user'];
    
    // Redirection vers la page d'accueil
    header('Location: ../index.php');
    exit(); // Arrêter l'exécution du script après redirection
} else {
    // Authentification échouée
    // Stockage d'un message flash dans la session
    $_SESSION['flash'] = "Identifiant ou mot de passe incorrect !";
    
    // Redirection vers la page de login
    header("Location: ../login.php");
    exit(); // Arrêter l'exécution du script après redirection
}
?>