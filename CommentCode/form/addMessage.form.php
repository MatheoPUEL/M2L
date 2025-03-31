<?php
// Démarrage de la session PHP pour accéder aux variables de session
session_start();

// Inclusion du fichier de connexion à la base de données
require_once('../bdd/bdd_co.php');

// Établissement de la connexion à la base de données
$dbh = db_connect();

// Définition du fuseau horaire sur Paris pour les opérations de date
date_default_timezone_set('Europe/Paris');

// Vérification si un utilisateur est connecté
if(isset($_SESSION["user"])){
    // Récupération de la question postée, avec une valeur par défaut vide si non définie
    $question = isset($_POST["question"]) ? $_POST["question"]:"";
    
    // Préparation de la requête SQL pour insérer une nouvelle question dans la table 'faq'
    $sql = "insert into faq (question, dat_question, id_user) VALUES ( :question, :dat_question, :id_user)";
    
    try {
        // Préparation de la requête avec des paramètres sécurisés
        $sth = $dbh->prepare($sql);
        
        // Exécution de la requête avec les valeurs:
        // - La question postée
        // - La date et l'heure actuelles
        // - L'ID de l'utilisateur connecté
        $sth->execute(array(
            ":question" => $question, 
            ":dat_question" => date("Y-m-d H:i:s"), 
            ":id_user" => $_SESSION["user_id"]
        ));

        // Redirection vers la page des ligues avec l'ID approprié, en ciblant la section des questions
        header ('Location: ../ligues.php?id='.$_GET['id']."#questions");
    
    } catch (PDOException $ex) {
        // Gestion des erreurs de base de données
        die("Erreur lors de la requête SQL : ".$ex->getMessage());
    }
    
    // Affichage du nombre d'enregistrements ajoutés (cette ligne sera exécutée après la redirection, donc jamais atteinte)
    echo "<p>".$sth->rowcount()." enregistrement(s) ajouté(s)</p>";
}
?>