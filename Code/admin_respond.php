<?php
// Variable globale a la page
$title = "Respond to ";
$description = "Ma description";
?>

<?php
    require_once('./inc/header.inc.php')
?>
    <form action="" method="post" class="form-container">
        <h1>Réponse a Jhon doe: </h1>
        <p>Message de la personne à laquelle on est en train de répondre</p>
        <textarea name="" id="" rows="10" placeholder="Votre réponse"></textarea>
        <button class="button">Répondre</button>
    </form>
<?php
    require_once('./inc/footer.inc.php')
?>
