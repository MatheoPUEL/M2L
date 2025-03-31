<?php
// Démarrage de la session pour accéder aux variables de session
session_start();
// Inclusion du fichier de connexion à la base de données
require_once('./bdd/bdd_co.php');

// Définition des variables globales pour le titre et la description de la page
$title = "Accueil M2L";
$description = "Ma description";
?>

<?php
    // Inclusion de l'en-tête du site
    require_once('./inc/header.inc.php')
?>
    <!-- Formulaire d'inscription -->
    <form class="loginform" method="POST" action="./form/register.form.php">
        <!-- Titre du formulaire -->
        <h1>Inscription</h1>

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

        <!-- Champ pour l'identifiant avec limite de 40 caractères -->
        <label for="regid">Identifiant</label><br>
        <input maxlength="40" name="login" type="text" id="regid" required>

        <!-- Champ pour l'email avec limite de 40 caractères -->
        <label for="regem">Email</label><br>
        <input maxlength="40" name="email" type="email" id="regem" required><br>    

        <!-- Menu déroulant pour sélectionner une ligue -->
        <label for="ligue">Sélectionnez votre ligue</label>
        <select name="ligue" id="ligue">
        <?php 
            // Connexion à la base de données
            $dbh = db_connect();
            // Requête SQL pour récupérer toutes les ligues
            $sql = "SELECT id_ligue, lib_ligue FROM `ligue`";
            try {
                // Préparation et exécution de la requête
                $sth = $dbh->prepare($sql);
                $sth->execute();
                // Récupération de toutes les ligues
                $rows= $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                // Gestion des erreurs de requête SQL
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            // Affichage des options du menu déroulant si des ligues sont trouvées
            if (count($rows) > 0) {
                foreach($rows as $row){
                    // Exclusion de la ligue avec ID 1 (probablement réservée à l'administration)
                    if ($row['id_ligue'] > 1) {
                        ?>
                        <option value="<?= $row['id_ligue'] ?>"><?= $row['lib_ligue'] ?></option>
                        <?php
                    }
                }
            }
        ?>
        </select>

        <!-- Champ pour le mot de passe avec limite de 255 caractères -->
        <label for="regpwd">Mot de passe</label><br>
        <input maxlength="255" name="password" type="password" id="regpwd" required><br>

        <!-- Champ pour confirmer le mot de passe avec limite de 255 caractères -->
        <label for="regcpwd">Confirmez le mot de passe</label><br>
        <input maxlength="255" name="confirm_password" type="password" id="regcpwd" required><br>

        <!-- Bouton de soumission du formulaire -->
        <button type="submit" class="button">Valider</button>
        <!-- Lien vers la page de connexion -->
        <p>Vous avez déjà un compte ?: <a href="./login.php">Connectez vous</a></p>
    </form>
<?php
    // Inclusion du pied de page du site
    require_once('./inc/footer.inc.php')
?>