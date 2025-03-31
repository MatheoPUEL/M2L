<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de connexion à la base de données
require_once('./bdd/bdd_co.php');
$dbh = db_connect();

// Requête SQL pour récupérer les FAQs avec des informations utilisateur et de ligue
$sql = "SELECT faq.id_faq, ligue.lib_ligue, faq.question, faq.reponse, 
                faq.dat_question, faq.dat_reponse, user.pseudo, 
                faq.id_user, user.id_ligue
         FROM faq 
         INNER JOIN user on faq.id_user = user.id_user
         INNER JOIN ligue on user.id_ligue = ligue.id_ligue
         ORDER BY faq.dat_question desc;";

try {
    // Préparation et exécution de la requête
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    // Gestion des erreurs de requête
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
?>

<?php
// Inclusion de l'en-tête
require_once('./inc/header.inc.php')
?>

<!-- Style CSS pour la mise en page du tableau -->
<style>
    /* Styles pour le tableau, les lignes, les colonnes, etc. */
    /* (Styles détaillés dans le code original) */
</style>

<div class="container" style="width: 80%; position: relative; left: 50%; transform: translateX(-50%)">
    <!-- Tableau des FAQs -->
    <table>
        <tr>
            <th>Utilisateur</th>
            <th>Ligue</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
        
        <?php
        // Boucle pour afficher chaque FAQ
        foreach($rows as $row){
            ?>
            <tr>
                <td><?= $row['pseudo'] ?></td>
                <td><?= $row['lib_ligue'] ?></td>
                <td><?= $row['question'] ?></td>
                <td class="actions">
                    <!-- Bouton de suppression -->
                    <a class="red" href="./form/deleteMessage.form.php?idfaq=<?=$row['id_faq']?>&idligue=<?=$row['id_ligue']?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                    
                    <!-- Bouton d'édition -->
                    <a class="blue" href="./editMessage.php?idfaq=<?=$row['id_faq']?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>

                    <?php
                    // Bouton de réponse si pas de réponse existante
                    if($row['reponse'] == null) {
                    ?>
                        <a class="blue" href="./admin_respond.php?idfaq=<?=$row['id_faq']?>&idligue=<?=$row['id_ligue']?>">
                            <i class="fa-solid fa-reply"></i>
                        </a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <!-- Liste des ligues -->
    <h1>Liste des ligues</h1>
    <ul>
        <?php 
            // Nouvelle connexion à la base de données
            $dbh = db_connect();
            $sql = "SELECT id_ligue, lib_ligue FROM `ligue`";
            
            try {
                // Préparation et exécution de la requête
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            // Affichage des ligues (sauf les deux premières)
            if (count($rows) > 0) {
                foreach($rows as $row){
                    if ($row['id_ligue'] > 1) {
                        ?>
                        <li>
                            <a href="./ligues.php?id=<?=$row['id_ligue']?>">
                                <?= $row['lib_ligue'] ?>
                            </a>
                        </li>
                        <?php
                    }
                }
            }
        ?>
    </ul>
</div>

<?php
// Inclusion du pied de page
require_once('./inc/footer.inc.php')
?>