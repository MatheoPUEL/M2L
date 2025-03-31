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
    // Récupération de la réponse postée, avec une valeur par défaut vide si non définie
    $reponse = isset($_POST["reponse"]) ? $_POST["reponse"]:"";
    
    // Préparation de la requête SQL pour mettre à jour une réponse dans la table 'faq'
    $sql = "UPDATE faq SET reponse = :reponse, dat_reponse = :dat_reponse WHERE id_faq = :id_faq";
    
    try {
        // Préparation de la requête avec des paramètres sécurisés
        $sth = $dbh->prepare($sql);
        
        // Exécution de la requête avec les valeurs:
        // - La réponse postée
        // - La date et l'heure actuelles
        // - L'ID de la FAQ à mettre à jour
        $sth->execute(array(
            ":reponse" => $reponse, 
            ":dat_reponse" => date("Y-m-d H:i:s"), 
            ":id_faq" => $_GET['idfaq']
        ));

        // Redirection vers la page des ligues avec l'ID approprié, en ciblant la section des questions
        header ('Location: ../ligues.php?id='.$_GET['idligue']. "#questions");
    
    } catch (PDOException $ex) {
        // Gestion des erreurs de base de données
        die("Erreur lors de la requête SQL : ".$ex->getMessage());
    }
    
    // Affichage du nombre d'enregistrements mis à jour (cette ligne sera exécutée après la redirection, donc jamais atteinte)
    echo "<p>".$sth->rowcount()." enregistrement(s) ajouté(s)</p>";
}
?>