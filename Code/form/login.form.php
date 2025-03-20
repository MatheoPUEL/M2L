<?php
require_once "../bdd/bdd_co.php";

session_start();
$dbh = db_connect();
$user = isset($_POST["login"]) ? $_POST["login"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";

// Préparer la requête pour récupérer l'utilisateur et son mot de passe haché
$sql_user = "SELECT pseudo, mdp, id_ligue, id_user, id_usertype FROM user WHERE pseudo = :pseudo";
try {
    $sth = $dbh->prepare($sql_user);
    $sth->execute([":pseudo" => $user]);
    $userData = $sth->fetch(PDO::FETCH_ASSOC); // Récupérer toutes les données de l'utilisateur
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

// Vérifier si l'utilisateur existe et si le mot de passe est correct
if ($userData && password_verify($password, $userData['mdp'])) {
    $_SESSION['user'] = $user;
    $_SESSION['ligue'] = $userData['id_ligue'];
    $_SESSION['usertype'] = $userData['id_usertype'];
    $_SESSION['user_id'] = $userData['id_user'];
    header ('Location: ../index.php');
} else {
    $_SESSION['flash'] = "Identifiant ou mot de passe incorrect !";
    header("Location: ../login.php");
}
?>