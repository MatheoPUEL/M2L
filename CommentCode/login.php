<?php
// Démarrage de la session pour accéder aux variables de session
session_start();
// Définition des variables globales pour le titre et la description de la page
$title = "Accueil M2L";
$description = "Ma description";
?>

<?php
    // Inclusion de l'en-tête du site
    require_once('./inc/header.inc.php')
?>
    <!-- Formulaire de connexion -->
    <form class="loginform" method="POST" action="./form/login.form.php">
        <!-- Titre du formulaire -->
        <h1>Connexion</h1>

        <?php
            // Vérification de l'existence d'un message flash en session
            if(isset($_SESSION['flash'])) {
                ?>
                <!-- Affichage du message d'erreur dans un conteneur stylisé -->
                <div class="alert-danger">
                    <p><?= $_SESSION['flash'] ?></p>
                </div>
                <?php
                // Suppression de toutes les variables de session après affichage du message
                session_unset();
            };
        ?>

        <!-- Champ pour l'identifiant -->
        <label for="logid">Identifiant</label><br>
        <input name="login" type="text" id="logid" required><br>

        <!-- Champ pour le mot de passe -->
        <label for="logpwd">Mot de passe</label><br>
        <input name="password" type="password" id="logpwd" required><br>

        <!-- Bouton de soumission du formulaire -->
        <button type="submit" class="button">Valider</button>
        <!-- Lien vers la page d'inscription -->
        <p>Pas de compte ?: <a href="./register.php">Inscrivez vous</a></p>

    </form>
<?php
    // Inclusion du pied de page du site
    require_once('./inc/footer.inc.php')
?>