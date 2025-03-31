<?php
// Démarrage de la session PHP
session_start();

// Récupération sécurisée des données du formulaire d'inscription
$username = isset($_POST['login']) ? trim($_POST['login']) : null;
$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : null;
$choix_ligue = isset($_POST['ligue']) ? intval($_POST['ligue']) : null;
$mdp = isset($_POST['password']) ? $_POST['password'] : null;
$mdp_confirm = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;

// Validation des entrées
if (empty($username) || empty($email) || empty($choix_ligue) || empty($mdp) || empty($mdp_confirm)) {
    $_SESSION['flash'] = "Tous les champs sont obligatoires.";
    header("Location: ../register.php");
    exit();
}

// Validation du format de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['flash'] = "Format d'email invalide.";
    header("Location: ../register.php");
    exit();
}

// Vérification de la correspondance des mots de passe
if ($mdp !== $mdp_confirm) {
    $_SESSION['flash'] = "Les mots de passe que vous avez rentrés ne correspondent pas !";
    header("Location: ../register.php");
    exit();
}

// Hash du mot de passe
$hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);

// Connexion à la base de données
require_once('../bdd/bdd_co.php');
$dbh = db_connect();

try {
    // Vérification de l'existence de l'email ou du pseudo
    $sql_check_email = "SELECT COUNT(*) FROM user WHERE mail = :email OR pseudo = :pseudo";
    $get_email = $dbh->prepare($sql_check_email);
    $get_email->execute([':email' => $email, ':pseudo' => $username]);
    $email_exists = $get_email->fetchColumn();

    // Si l'email ou le pseudo existe déjà
    if ($email_exists > 0) {
        $_SESSION['flash'] = "L'email ou le pseudo est déjà utilisé par un autre utilisateur.";
        header("Location: ../register.php");
        exit();
    }

    // Insertion sécurisée des données utilisateur
    $sql = "INSERT INTO user (pseudo, mdp, mail, id_usertype, id_ligue) 
            VALUES (:pseudo, :mdp, :email, :usertype, :ligue)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([
        ':pseudo' => $username,
        ':mdp' => $hash_mdp,
        ':email' => $email,
        ':usertype' => 1,
        ':ligue' => $choix_ligue
    ]);

    // Récupération de l'ID utilisateur
    $user_id = $dbh->lastInsertId();

    // Création des variables de session
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user'] = $username;
    $_SESSION['ligue'] = $choix_ligue;
    $_SESSION['usertype'] = 1;

    // Redirection vers la page d'accueil
    header("Location: ../index.php");
    exit();

} catch (PDOException $ex) {
    // Gestion des erreurs de base de données
    error_log("Erreur d'inscription : " . $ex->getMessage());
    $_SESSION['flash'] = "Une erreur est survenue. Veuillez réessayer.";
    header("Location: ../register.php");
    exit();
}
?>