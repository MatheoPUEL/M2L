<?php
session_start();
$ligues = array('Football', 'Handball', 'Takewondo');

$username = isset($_POST['login']) ? $_POST['login'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$choix_ligue =  isset($ligues[$_POST['ligue']]) ? $_POST['ligue'] : null;
$mdp = isset($_POST['password']) ? $_POST['password'] : null;
$mdp_confirm = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;


if ($mdp == $mdp_confirm) {
    $hash_mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);

    require_once('../bdd/bdd_co.php');

    $dbh = db_connect();

    $sql_check_email = "SELECT COUNT(*) FROM user WHERE mail = :email";
    $get_email = $dbh->prepare($sql_check_email);
    $get_email->execute([':email'=>$email]);
    $email_exists = $get_email->fetchColumn();

    if ($email_exists > 0) {
        $_SESSION['flash'] = "L'email est déjà utilisé par un autre utilisateur.";
        header("Location: ../register.php");
        exit();
    } else { 
        $sql = "INSERT INTO user (pseudo, mdp, mail, id_usertype, id_ligue)
        VALUES ('".$username."', '".$hash_mdp."', '".$email."', 1, '".$choix_ligue."')";
        $dbh->exec($sql);
        header("Location: ../register.php");
        exit();
    }

} else {
    $_SESSION['flash'] = "Les mots de passe que vous avez rentrés ne correspondent pas !";
    header("Location: ../register.php");
}