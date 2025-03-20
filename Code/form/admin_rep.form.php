<?php
session_start();
require_once('../bdd/bdd_co.php');

$dbh = db_connect();
date_default_timezone_set('	Europe/Paris');

    if(isset($_SESSION["user"])){
        $reponse = isset($_POST["reponse"]) ? $_POST["reponse"]:"";
        $sql = "UPDATE faq SET reponse = :reponse, dat_reponse = :dat_reponse WHERE id_faq = :id_faq";
        try{
            $sth = $dbh->prepare($sql);
            $sth->execute(array(":reponse" => $reponse, ":dat_reponse" => date("Y-m-d H:i:s"), ":id_faq" => $_GET['idfaq']));

            header ('Location: ../ligues.php?id='.$_GET['idligue']. "#questions");
        }catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : ".$ex->getMessage());
        }
            echo "<p>".$sth->rowcount()." enregistrement(s) ajouté(s)</p>";
    }
?>