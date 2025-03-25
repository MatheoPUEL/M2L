<?php
// Variable globale à la page
$title = "Edit Message ";
$description = "Ma description";
session_start();

if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] > 1) {
    // Vérifier que l'ID est bien passé et valide
    if (isset($_GET["idfaq"]) && is_numeric($_GET["idfaq"])) {
        require_once('./bdd/bdd_co.php');
        $dbh = db_connect();
        $sql = "SELECT * FROM faq WHERE id_faq = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(":id" => $_GET["idfaq"]));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            $row = "Aucune donnée trouvée pour cet ID.";
        }
    } else {
        $row = "L'ID de la FAQ n'est pas valide.";
        exit;
    }
}
?>

<?php
    require_once('./inc/header.inc.php')
?>

    <form action="./form/editMessage.form.php?id=<?=$_GET["idfaq"] ?>" method="post" class="form-container">
        <h1>Edition du message: </h1>
        <p>Le message que vous avez posté.</p>
        <textarea name="message_edit" id="" rows="10"><?= $row['question'] ?></textarea>
        <button class="button">Valider les modifications</button>
    </form>
<?php
    require_once('./inc/footer.inc.php')
?>
