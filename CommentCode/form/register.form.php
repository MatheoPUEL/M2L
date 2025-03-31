<?php

// Démarrage de la session
session_start();


// Récupère toute les informations du formulaire et les stoque sur les variable  

$username = isset($_POST['login']) ? $_POST['login'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$choix_ligue =  isset($_POST['ligue']) ? $_POST['ligue'] : null;
$mdp = isset($_POST['password']) ? $_POST['password'] : null;
$mdp_confirm = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;

// Je regarde si le mot de passe entrer et le mot de passe de confirmation correspondent, sinon je affiche un message d'erreur et je redirige vers la page d'inscription

if ($mdp == $mdp_confirm) {

   // Je hash le mot de passe rentré

   $hash_mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);

   // Je me connecte a la base de donnée 

   require_once('../bdd/bdd_co.php');

   $dbh = db_connect();

   // Je fait une requette qui permet de savoir si le mail de l'utilisateur est déjà dans la db

   $sql_check_email = "SELECT COUNT(*) FROM user WHERE mail = :email or pseudo = :pseudo";
   $get_email = $dbh->prepare($sql_check_email);
   $get_email->execute([':email'=>$email, ':pseudo'=>$username]);
   $email_exists = $get_email->fetchColumn();

   // Si le mail est déja dans la db je redirige l'utilisateur vers la page d'inscription et lui affiche un message. 

   if ($email_exists > 0) {
       $_SESSION['flash'] = "L'email ou le pseudo est déjà utilisé par un autre utilisateur.";
       header("Location: ../register.php");
       exit();
   } else { 

       // sinon j'insert les données de l'utilisateur dans la db et lui crée les id de sessino aussi. 
       
       $sql = "INSERT INTO user (pseudo, mdp, mail, id_usertype, id_ligue)
       VALUES ('".$username."', '".$hash_mdp."', '".$email."', 1, '".$choix_ligue."')";
       $dbh->exec($sql);
       $user_id = $dbh->lastInsertId();
       $_SESSION['user_id'] = $user_id;
       $_SESSION['user'] = $username;
       $_SESSION['ligue'] = $choix_ligue;
       $_SESSION['usertype'] = 1;
  
       header("Location: ../index.php");
       exit();
   }

} else {
   $_SESSION['flash'] = "Les mots de passe que vous avez rentrés ne correspondent pas !";
   header("Location: ../register.php");
}