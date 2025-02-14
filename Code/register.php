<?php
// Variable globale a la page
$title = "Accueil M2L";
$description = "Ma description";
?>

<?php
    require_once('./inc/header.inc.php')
?>
    <form class="loginform" method="POST" action="./form/register.form.php">
        <h1>Inscription</h1>

        <div class="alert-danger">
            <p>Une erreur est arrivé</p>
        </div>

        <label for="regid">Identifiant</label><br>
        <input maxlength="40" name="login" type="text" id="regid" required>

        <label for="regem">Email</label><br>
        <input maxlength="40" name="email" type="text" id="regem" required><br>    


        <label for="ligue">Selectionez votre ligue</label>
        <select name="ligue" id="ligue">
            <option value="0">Football</option>
            <option value="1">Handball</option>
            <option value="2">Takewondo</option>
        </select>

        <label for="regpwd">Mot de passe</label><br>
        <input maxlength="255" name="password" type="password" id="regpwd" required><br>

        <label for="regcpwd">Confirmez le mot de passe</label><br>
        <input maxlength="255" name="confirm_password" type="password" id="regcpwd" required><br>

        <button type="submit" class="button">Valider</button>
        <p>Vous avez déjà un compte ?: <a href="./login.php">Connectez vous</a></p>
    </form>
<?php
    require_once('./inc/footer.inc.php')
?>
