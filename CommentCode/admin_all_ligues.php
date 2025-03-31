<?php
// Démarrage de la session
session_start();
// Inclusion du fichier de connexion à la base de données
require_once('./bdd/bdd_co.php');
// Établissement de la connexion à la base de données
$dbh = db_connect();
// Requête SQL pour récupérer les questions FAQ avec informations utilisateur et ligue
$sql = "SELECT faq.id_faq, ligue.lib_ligue, faq.question, faq.reponse, faq.dat_question, faq.dat_reponse, user.pseudo, faq.id_user, user.id_ligue
                FROM faq 
                INNER JOIN user on faq.id_user = user.id_user
                INNER JOIN ligue on user.id_ligue = ligue.id_ligue
                ORDER BY faq.dat_question desc;";
try {
    // Préparation et exécution de la requête
    $sth = $dbh->prepare($sql);
    $sth->execute();
    // Récupération de tous les résultats sous forme de tableau associatif
    $rows= $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    // Gestion des erreurs SQL
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

?>
<?php
// Inclusion de l'en-tête du site
require_once('./inc/header.inc.php')
?>

<style>
    /* Style pour le tableau */
    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Style pour les cellules du tableau */
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    /* Style pour les en-têtes de colonnes */
    th {
        background-color: #405cf5;
        color: white;
        font-weight: bold;
    }

    /* Style pour les lignes paires */
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    /* Style pour toutes les lignes */
    tr {
        background-color: #c5c5c5;
    }
    /* Style pour la colonne des actions */
    .actions {
        display: flex;
    }


    /* Style pour les liens dans les cellules */
    td a {
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 6px;

        color: #FFFFFF;

        transition-duration: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;

    }

    /* Style pour les liens au survol */
    td a:hover {
        cursor: pointer;
        opacity: 80%;
    }
    /* Style pour les liens rouges (suppression) */
    a .red {
        background-color: red;
    }
    /* Style pour les liens bleus (modification, réponse) */
    a .blue {
        background-color: #405cf5;
    }

</style>
<div class="container" style="width: 80%; position: relative; left: 50%; transform: translateX(-50%)">
    <!-- Tableau des messages FAQ -->
    <table>
        <tr>
            <th>Utlisateur</th>
            <th>Ligue</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
        <?php
            // Boucle sur chaque ligne de résultat pour afficher les données
            foreach($rows as $row){
                ?>
                <tr>
                    <td><?= $row['pseudo'] ?></td>
                    <td><?= $row['lib_ligue'] ?></td>
                    <td><?= $row['question'] ?></td>
                    <td class="actions">
                        <!-- Lien pour supprimer le message -->
                        <a class="red" href="./form/deleteMessage.form.php?idfaq=<?=$row['id_faq']?>&idligue=<?=$row['id_ligue']?>"><i class="fa-solid fa-trash"></i></a>
                        <!-- Lien pour modifier le message -->
                        <a class="blue" href="./editMessage.php?idfaq=<?=$row['id_faq']?>"><i class="fa-solid fa-pen-to-square"></i></a>

                        <?php
                        // Affiche le bouton de réponse seulement si aucune réponse n'existe
                        if($row['reponse'] == null) {
                        ?>
                            <!-- Lien pour répondre au message -->
                            <a class="blue" href="./admin_respond.php?idfaq=<?=$row['id_faq']?>&idligue=<?=$row['id_ligue']?>"><i class="fa-solid fa-reply"></i></a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        ?>

    </table>

    <!-- Section liste des ligues -->
    <h1>Liste des ligues</h1>
    <ul>
        <?php 
            // Nouvelle connexion à la base de données
            $dbh = db_connect();
            // Requête SQL pour récupérer toutes les ligues
            $sql = "SELECT id_ligue, lib_ligue FROM `ligue`";
            try {
                // Préparation et exécution de la requête
                $sth = $dbh->prepare($sql);
                $sth->execute();
                // Récupération de tous les résultats sous forme de tableau associatif
                $rows= $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                // Gestion des erreurs SQL
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            // Vérification si des ligues existent et affichage
            if (count($rows) > 0) {
                foreach($rows as $row){
                    // N'affiche que les ligues avec id > 1
                    if ($row['id_ligue'] > 1) {
                        ?>
                        <li><a href="./ligues.php?id=<?=$row['id_ligue']?>"><?= $row['lib_ligue'] ?></a></li>
                        <?php
                    }
                }
            }
        ?>
        </ul>

</div>


<?php
// Inclusion du pied de page du site
require_once('./inc/footer.inc.php')
?>