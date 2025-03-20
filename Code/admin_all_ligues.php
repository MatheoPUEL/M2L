<?php
session_start();
require_once('./bdd/bdd_co.php');
$dbh = db_connect();
$sql = "SELECT faq.id_faq, ligue.lib_ligue, faq.question, faq.reponse, faq.dat_question, faq.dat_reponse, user.pseudo, faq.id_user, user.id_ligue
                FROM faq 
                INNER JOIN user on faq.id_user = user.id_user
                INNER JOIN ligue on user.id_ligue = ligue.id_ligue
                ORDER BY faq.dat_question desc;";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $rows= $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

?>
<?php
require_once('./inc/header.inc.php')
?>

<style>
    table {

        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #405cf5;
        color: white;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr {
        background-color: #c5c5c5;
    }
    .actions {
        display: flex;
    }


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

    td a:hover {
        cursor: pointer;
        opacity: 80%;
    }
    a .red {
        background-color: red;
    }
    a .blue {
        background-color: #405cf5;
    }

</style>
<div class="container" style="width: 80%; position: relative; left: 50%; transform: translateX(-50%)">


    <table>
        <tr>
            <th>Utlisateur</th>
            <th>Ligue</th>

            <th>Message</th>
            <th>Actions</th>
        </tr>
        <?php

            foreach($rows as $row){
                ?>
                <tr>
                    <td><?= $row['pseudo'] ?></td>
                    <td><?= $row['lib_ligue'] ?></td>
                    <td><?= $row['question'] ?></td>
                    <td class="actions">
                        <a class="red" href="./form/deleteMessage.form.php?idfaq=<?=$row['id_faq']?>&idligue=<?=$row['id_ligue']?>"><i class="fa-solid fa-trash"></i></a>
                        <?php
                        if($row['reponse'] == null) {
                        ?>
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

    <h1>Liste des ligues</h1>
    <ul>
        <li><a href="./ligues.php">Takewondo</a></li>
        <li><a href="./ligues.php">Football</a></li>
        <li><a href="./ligues.php">Handball</a></li>
        <li><a href="./ligues.php">Autre</a></li>
    </ul>

</div>



<?php
require_once('./inc/footer.inc.php')
?>
