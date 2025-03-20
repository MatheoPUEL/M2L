<?php
session_start();

if ($_SESSION["usertype"] > 1) {
    require_once("../bdd/bdd_co.php");
    $dbh = db_connect();
    $sql = "DELETE FROM faq WHERE id_faq = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(":id" => $_GET["idfaq"]));
    header("Location: ../ligues.php?id=".$_GET["idligue"]."#questions");
} else {
    echo "test";
}