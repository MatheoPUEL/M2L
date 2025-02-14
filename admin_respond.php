<?php
// Variable globale a la page
$title = "Respond to ";
$description = "Ma description";
?>

<?php
    require_once('./inc/header.inc.php')
?>
    <h1>Réponse au message: </h1>
    <p>Le message que la personne a posté.</p>
    <form action="" method="post">
        <textarea name="" id="" rows="10" cols="50"></textarea>
        <button class="button">Répondre</button>
    </form>
<?php
    require_once('./inc/footer.inc.php')
?>
