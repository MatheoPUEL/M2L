<?php
session_start();
// Variable globale a la page
$title = "Accueil&nbsp;M2L";
$description = "Ma description";

?>

<?php
    require_once('./inc/header.inc.php')
?>

<header>
        <div>
            <div style="display: flex; flex-direction: row;">
                <h1><?= $title ?></h1>
                <img class="right" src="./img/svg/Leftcorner.svg" alt="">
            </div>
            <img class="bottom" src="./img/svg/Bottomcorner.svg" alt="">
        </div>
        <img class="img-header" src="./img/menu.jpg" style=" object-fit: cover;" alt="">
    </header>

<?php
    require_once('./inc/footer.inc.php')
?>
