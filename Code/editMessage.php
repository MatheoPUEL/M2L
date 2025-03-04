<?php
// Variable globale a la page
$title = "Edit Message ";
$description = "Ma description";
?>

<?php
    require_once('./inc/header.inc.php')
?>
    <h1>Edition au message: </h1>
    <p>Le message que vous avez posté.</p>
    <form action="" method="post">
        <textarea name="" id="" rows="10" cols="50">Mon message</textarea>
        <button class="button">Valider les modifications</button>
    </form>
<?php
    require_once('./inc/footer.inc.php')
?>
