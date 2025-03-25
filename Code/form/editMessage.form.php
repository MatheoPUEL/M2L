<?php
session_start();
require_once('../bdd/bdd_co.php');
if ($_SESSION["usertype"] > 1) {
    if (isset($_POST['message_edit'])){$message = $_POST['message_edit'];}

    $dbh = db_connect();
    $sql = "UPDATE faq SET question = :question WHERE id_faq = :id";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(['question' => $message, "id" => $_GET['id']]);
        header("location: ../admin_all_ligues.php");
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
} 