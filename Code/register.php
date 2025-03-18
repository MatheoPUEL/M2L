<?php
session_start();
require_once('./bdd/bdd_co.php');

// Variable globale a la page
$title = "Accueil M2L";
$description = "Ma description";


?>

<?php
    require_once('./inc/header.inc.php')
?>
    <form class="loginform" method="POST" action="./form/register.form.php">
        <h1>Inscription</h1>

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


        <label for="regid">Identifiant</label><br>
        <input maxlength="40" name="login" type="text" id="regid" required>

        <label for="regem">Email</label><br>
        <input maxlength="40" name="email" type="email" id="regem" required><br>    


        <label for="ligue">Sélectionnez votre ligue</label>
        <select name="ligue" id="ligue">
        <?php 
            $dbh = db_connect();
            $sql = "SELECT id_ligue, lib_ligue FROM `ligue`";
            try {
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $rows= $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            if (count($rows) > 0) {
                foreach($rows as $row){
                    if ($row['id_ligue'] > 1) {
                        ?>
                        <option value="<?= $row['id_ligue'] ?>"><?= $row['lib_ligue'] ?></option>
                        <?php
                    }
                }
            }
        ?>
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
