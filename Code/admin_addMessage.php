<?php
// Variable globale a la page
$title = "Accueil M2L";
$description = "Ma description";
?>

<?php
    require_once('./inc/header.inc.php')
?>
    <form class="loginform" method="POST" action="./form/addMessage.form.php">
        <h1>Publier un message</h1>

        <div class="alert-danger">
            <p>Une erreur est survenue</p>
        </div>

        <label for="ligue">Selectionez votre ligue</label>
        <select name="ligue" id="ligue">
            <option value="0">Football</option>
            <option value="1">Handball</option>
            <option value="2">Takewondo</option>
        </select>

        <textarea name="message" id="" rows="10" style="margin-top: 25px;"></textarea>

        <button type="submit" class="button">Publier</button>
    </form>
<?php
    require_once('./inc/footer.inc.php')
?>
