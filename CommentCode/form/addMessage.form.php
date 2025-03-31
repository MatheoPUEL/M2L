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
        // Récupération de la question depuis le formulaire POST, ou chaîne vide si non définie
        $question = isset($_POST["question"]) ? $_POST["question"]:"";
        // Préparation de la requête SQL pour insérer la question dans la table faq
        $sql = "insert into faq (question, dat_question, id_user) VALUES ( :question, :dat_question, :id_user)";
        try{
            // Préparation et exécution de la requête avec les paramètres
            $sth = $dbh->prepare($sql);
            $sth->execute(array(":question" => $question, ":dat_question" => date("Y-m-d H:i:s"), ":id_user" => $_SESSION["user_id"]));

            // Redirection vers la page des ligues avec un ancre vers la section questions
            header ('Location: ../ligues.php?id='.$_GET['id']."#questions");
        }catch (PDOException $ex) {
            // Gestion des erreurs SQL
            die("Erreur lors de la requête SQL : ".$ex->getMessage());
            }
            // Affichage du nombre d'enregistrements ajoutés (ce code ne sera jamais exécuté à cause du header)
            echo "<p>".$sth->rowcount()." enregistrement(s) ajouté(s)</p>";
    }
?>