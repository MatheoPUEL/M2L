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
<!-- <div class="container">
    <p>Petit Commentaire tous les liens pour la page sont listés ci-dessous. La nav bar est en mode connecté c'est pour ça qu'elle indique tous les liens vers les sections de la page. Si l'utilisateur est déconnecté vous ne trouverez que 2 bouttons un pour se connecter et 1 pour s'inscrire</p>

    <ul>
        <li><a href="./ligues.php">Ligues </a></li>
        <li><a href="./login.php">Se connecter</a></li>
        <li><a href="./register.php">S'inscrire</a></li>
    </ul>
    <h1>Pour les admins</h1>
    <ul>
        <li><a href="./admin_respond.php">Réponse de message</a></li>
    </ul>
    <h1>Pour les super admin</h1>
    <ul>
        <li><a href="./admin_all_ligues.php">Liste des ligues</a></li>
        <li><a href="./admin_addMessage.php">Ajouter un message sur n'importe quelle ligue</a></li>
    </ul>
    <h1>Pour les utilisateurs</h1>
    <ul>
        <li><a href="./editMessage.php">Editer son message</a></li>
    </ul>
</div> -->

<?php
    require_once('./inc/footer.inc.php')
?>
