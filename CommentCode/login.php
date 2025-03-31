<?php
// Démarrage de la session PHP pour gérer les informations de connexion et messages flash
session_start();
// Variable globale définissant le titre de la page
$title = "Accueil M2L";
// Variable globale pour la description de la page
$description = "Ma description";
?>

<?php
// Inclusion du fichier d'en-tête commun qui contient probablement les balises HTML de base
require_once('./inc/header.inc.php')
?>
    <!-- Formulaire de connexion -->
    <form class="loginform" method="POST" action="./form/login.form.php">
        <h1>Connexion</h1>

        <?php
            // Vérification s'il existe un message flash dans la session
            if(isset($_SESSION['flash'])) {
                ?>
                <!-- Affichage du message flash (erreur de connexion, etc.) -->
                <div class="alert-danger">
                    <p><?= $_SESSION['flash'] ?></p>
                </div>
                <?php
                // Effacement des données de session après affichage du message
                session_unset();

            };
        ?>

        <!-- Champ pour l'identifiant de connexion -->
        <label for="logid">Identifiant</label><br>
        <input name="login" type="text" id="logid" required><br>

        <!-- Champ pour le mot de passe -->
        <label for="logpwd">Mot de passe</label><br>
        <input name="password" type="password" id="logpwd" required><br>

        <!-- Bouton de validation du formulaire -->
        <button type="submit" class="button">Valider</button>
        <!-- Lien vers la page d'inscription -->
        <p>Pas de compte ?: <a href="./register.php">Inscrivez vous</a></p>

    </form>
<?php
// Inclusion du fichier de pied de page
require_once('./inc/footer.inc.php')
?>