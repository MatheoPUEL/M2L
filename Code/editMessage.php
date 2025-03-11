<?php
// Variable globale a la page
$title = "Edit Message ";
$description = "Ma description";
?>

<?php
    require_once('./inc/header.inc.php')
?>

    <form action="" method="post" class="form-container">
        <h1>Editez votre message: </h1>
        <p>Le message que vous avez posté.</p>
        <textarea name="" id="" rows="10">Ici se trouvera le message que vous avez posté et vous pouvez le modifier ici à tout moment</textarea>
        <button class="button">Valider les modifications</button>
    </form>
<?php
    require_once('./inc/footer.inc.php')
?>
