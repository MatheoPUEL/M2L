<?php
// Démarrage de la session PHP pour gérer les informations de connexion et messages flash
session_start();
// Inclusion du fichier de connexion à la base de données
require_once('./bdd/bdd_co.php');

// Variables globales pour la page
$title = "Accueil M2L"; // Titre de la page
$description = "Ma description"; // Description de la page
?>

<?php
// Inclusion du fichier d'en-tête commun qui contient probablement les balises HTML de base
require_once('./inc/header.inc.php')
?>
    <!-- Formulaire d'inscription -->
    <form class="loginform" method="POST" action="./form/register.form.php">
        <h1>Inscription</h1>

        <?php
            // Vérification s'il existe un message flash dans la session
            if(isset($_SESSION['flash'])) {
                ?>
                <!-- Affichage du message flash (erreur d'inscription, etc.) -->
                <div class="alert-danger">
                    <p><?= $_SESSION['flash'] ?></p>
                </div>
                <?php
                // Effacement des données de session après affichage du message
                session_unset();
            };
        ?>

        <!-- Champ pour l'identifiant (limité à 40 caractères) -->
        <label for="regid">Identifiant</label><br>
        <input maxlength="40" name="login" type="text" id="regid" required>

        <!-- Champ pour l'email (limité à 40 caractères) -->
        <label for="regem">Email</label><br>
        <input maxlength="40" name="email" type="email" id="regem" required><br>    

        <!-- Sélection de la ligue -->
        <label for="ligue">Sélectionnez votre ligue</label>
        <select name="ligue" id="ligue">
        <?php 
            // Connexion à la base de données
            $dbh = db_connect();
            // Requête SQL pour récupérer les ligues
            $sql = "SELECT id_ligue, lib_ligue FROM `ligue`";
            try {
                // Préparation et exécution de la requête
                $sth = $dbh->prepare($sql);
                $sth->execute();
                // Récupération des résultats sous forme de tableau associatif
                $rows= $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                // Gestion des erreurs de requête SQL
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            // Vérification s'il y a des ligues à afficher
            if (count($rows) > 0) {
                // Boucle pour afficher les options du menu déroulant
                foreach($rows as $row){
                    // Exclusion de la ligue avec id_ligue = 1 (probablement une ligue par défaut)
                    if ($row['id_ligue'] > 1) {
                        ?>
                        <option value="<?= $row['id_ligue'] ?>"><?= $row['lib_ligue'] ?></option>
                        <?php
                    }
                }
            }
        ?>
        </select>

        <!-- Champ pour le mot de passe (limité à 255 caractères) -->
        <label for="regpwd">Mot de passe</label><br>
        <input maxlength="255" name="password" type="password" id="regpwd" required><br>

        <!-- Champ de confirmation du mot de passe (limité à 255 caractères) -->
        <label for="regcpwd">Confirmez le mot de passe</label><br>
        <input maxlength="255" name="confirm_password" type="password" id="regcpwd" required><br>

        <!-- Bouton de validation du formulaire -->
        <button type="submit" class="button">Valider</button>
        <!-- Lien vers la page de connexion -->
        <p>Vous avez déjà un compte ?: <a href="./login.php">Connectez vous</a></p>
    </form>
<?php
// Inclusion du fichier de pied de page
require_once('./inc/footer.inc.php')
?>