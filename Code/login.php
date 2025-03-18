<?php
session_start();
// Variable globale a la page
$title = "Accueil M2L";
$description = "Ma description";
?>

<?php
    require_once('./inc/header.inc.php')
?>
    <form class="loginform" method="POST" action="./form/login.form.php">
        <h1>Connexion</h1>

        <?php
            if(isset($_SESSION['flash'])) {
                ?>
                <div class="alert-danger">
                    <p><?= $_SESSION['flash'] ?></p>
                </div>
                <?php
                session_unset();

            };
        ?>

        <label for="logid">Identifiant</label><br>
        <input name="login" type="text" id="logid" required><br>

        <label for="logpwd">Mot de passe</label><br>
        <input name="password" type="password" id="logpwd" required><br>

        <button type="submit" class="button">Valider</button>
        <p>Pas de compte ?: <a href="./register.php">Inscrivez vous</a></p>

    </form>
<?php
    require_once('./inc/footer.inc.php')
?>
