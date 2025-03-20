<?php
session_start();
require_once('./bdd/bdd_co.php');

$dbh = db_connect();
date_default_timezone_set('Europe/Paris');

    if(isset($_SESSION["user"])){
        $question = isset($_POST["question"]) ? $_POST["question"]:"";
        $sql = "SELECT faq.id_faq, faq.question, user.pseudo
                FROM faq
                INNER JOIN user on faq.id_user = user.id_user
                WHERE id_faq = :id;";
        try{
            $sth = $dbh->prepare($sql);
            $sth->execute(array(":id" => $_GET['idfaq']));
            $fetch = $sth->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : ".$ex->getMessage());
            }
    }

?>

<?php
    require_once('./inc/header.inc.php')
?>
    <form action="./form/admin_rep.form.php?idligue=<?=$_GET['idligue']?>&idfaq=<?= $_GET['idfaq'] ?>" method="post" class="form-container">
        <h1>Répondre à <?= $fetch['pseudo'] ?>: </h1>
        <p><?= $fetch['question'] ?></p>
        <textarea name="reponse" id="" rows="10" placeholder="Votre réponse"></textarea>
        <button class="button">Répondre</button>
    </form>
<?php
    require_once('./inc/footer.inc.php')
?>
