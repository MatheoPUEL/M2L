<?php
// Variable globale a la page
$title = "Accueil M2L";
$description = "Ma description";
?>

<?php
    require_once('./inc/header.inc.php')
?>
    <p>Petit Commentaire tout les liens pour la page sont listé si dessous. La nav bar est en mode connecté c'est pour ça que elle indique tout les liens vers les sections de la page. Si l'utilisateur est déconnecter vous ne trouverez que 2 boutton un pour se connecter et 1 pour s'inscrire</p>

    <ul>
        <li><a href="./ligues.php">Ligues</a></li>
        <li><a href="./login.php">Se connecter</a></li>
        <li><a href="./register.php">S'inscrire</a></li>
    </ul>
    <h1>Pour les admins</h1>
    <ul>
        <li><a href="./admin_respond.php">Réponse de message</a></li>
        <li><a href="./admin_all_ligues.php">Liste des ligues</a></li>
    </ul>
<?php
    require_once('./inc/footer.inc.php')
?>
