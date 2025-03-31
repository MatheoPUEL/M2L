<!-- Déclaration du type de document HTML5 -->
<!DOCTYPE html>
<!-- Balise HTML avec attribut de langue français -->
<html lang="fr">
<head>
    <!-- Définition de l'encodage des caractères en UTF-8 -->
    <meta charset="UTF-8">
    <!-- Configuration de l'affichage sur les appareils mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page récupéré depuis une variable PHP -->
    <title><?= $title ?> </title>
    <!-- Description de la page pour les moteurs de recherche -->
    <meta name="description" content="<?= $description ?>" />

    <!-- Liens vers les feuilles de style CSS -->
    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/ligues.css">

    <!-- Intégration de la bibliothèque Font Awesome pour les icônes -->
    <script src="https://kit.fontawesome.com/d02eba9fbf.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <!-- Barre de navigation du site -->
    <nav>
        <!-- Logo clickable qui renvoie vers la page d'accueil -->
        <h1><a href="./index.php"><img width="50px" src="./img/logo.svg" alt="logoM2L"></a></h1>
        <!-- Conteneur pour les liens de navigation -->
        <div class="nav-links">
            <?php
                // Vérification si l'utilisateur est connecté
                if(isset($_SESSION['user'])) { 
                    // Vérification si l'utilisateur est un administrateur (type 3)
                    if($_SESSION['usertype'] == 3) { ?>
                        <!-- Lien vers la page d'administration accessible uniquement aux administrateurs -->
                        <a href="./admin_all_ligues.php">Page Administrateur</a>
                    <?php } ?>
                    <!-- Lien vers la page de la ligue de l'utilisateur connecté -->
                    <a href="./ligues.php?id=<?= $_SESSION['ligue'] ?>">Ma ligue</a>
                    <!-- Affichage du nom de l'utilisateur connecté -->
                    <p><?= $_SESSION['user'] ?></p>
                    <!-- Bouton de déconnexion avec icône -->
                    <a href="./deconnexion.php"><i class="fa-solid fa-right-from-bracket"></i></a>
            <?php } else { ?>
                    <!-- Liens pour se connecter et s'inscrire pour les utilisateurs non connectés -->
                    <a href="./login.php">Se Connecter</a>
                    <a href="./register.php">S'inscrire</a>
            <?php  } ?>
        </div>
    </nav>