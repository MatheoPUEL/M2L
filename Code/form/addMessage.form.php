<?php
session_start();
require_once('../bdd/bdd_co.php');

$dbh = db_connect();
date_default_timezone_set('	Europe/Paris');

    if(isset($_SESSION["user"])){
        $question = isset($_POST["question"]) ? $_POST["question"]:"";
        $sql = "insert into faq (question, dat_question, id_user) VALUES ( :question, :dat_question, :id_user)";
        try{
            $sth = $dbh->prepare($sql);
            $sth->execute(array(":question" => $question, ":dat_question" => date("Y-m-d H:i:s"), ":id_user" => $_SESSION["user_id"]));

            header ('Location: ../ligues.php?id='.$_GET['id']."#questions");
        }catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : ".$ex->getMessage());
            }
            echo "<p>".$sth->rowcount()." enregistrement(s) ajouté(s)</p>";
    }
?>