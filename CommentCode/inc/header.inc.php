<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> </title>
    <meta name="description" content="<?= $description ?>" />

    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/ligues.css">

    <!-- Script Font Awesome pour les icônes -->
<script src="https://kit.fontawesome.com/d02eba9fbf.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <!-- Logo avec lien vers la page d'accueil -->
        <h1>
            <a href="./index.php">
                <img width="50px" src="./img/logo.svg" alt="logoM2L">
            </a>
        </h1>

        <!-- Liens de navigation avec affichage conditionnel basé sur l'authentification -->
        <div class="nav-links">
            <?php
                // Vérifier si l'utilisateur est connecté (session existe)
                if(isset($_SESSION['user'])) { 
                    // Vérifier si l'utilisateur est un administrateur (usertype 3)
                    if($_SESSION['usertype'] == 3) { ?>
                        <!-- Lien réservé aux administrateurs -->
                        <a href="./admin_all_ligues.php">Page Administrateur</a>
                    <?php } ?>
                    
                    <!-- Liens pour les utilisateurs authentifiés -->
                    <!-- Lien vers la ligue de l'utilisateur -->
                    <a href="./ligues.php?id=<?= $_SESSION['ligue'] ?>">Ma ligue</a>
                    
                    <!-- Afficher le nom d'utilisateur -->
                    <p><?= $_SESSION['user'] ?></p>
                    
                    <!-- Lien de déconnexion avec icône Font Awesome -->
                    <a href="./deconnexion.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
            <?php } else { ?>
                    <!-- Liens pour les utilisateurs non authentifiés -->
                    <a href="./login.php">Se Connecter</a>
                    <a href="./register.php">S'inscrire</a>
            <?php  } ?>
        </div>
    </nav>



