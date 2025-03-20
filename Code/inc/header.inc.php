<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> </title>
    <meta name="description" content="<?= $description ?>" />

    <link rel="stylesheet" href="./style/main.css">
    <link rel="stylesheet" href="./style/ligues.css">

    <script src="https://kit.fontawesome.com/d02eba9fbf.js" crossorigin="anonymous"></script>
</head>
<body>
    

    <nav>
        <h1><a href="./index.php"><img width="50px" src="./img/logo.svg" alt="logoM2L"></a></h1>
        <div class="nav-links">
            <?php
                if(isset($_SESSION['user'])) { 
                    if($_SESSION['usertype'] == 3) { ?>
                        <a href="./admin_all_ligues.php">Page Administrateur</a>
                    <?php } ?>
                    <a href="./ligues.php?id=<?= $_SESSION['ligue'] ?>">Ma ligue</a>
                    <p><?= $_SESSION['user'] ?></p>
                    <a href="./deconnexion.php"><i class="fa-solid fa-right-from-bracket"></i></a>
            <?php } else { ?>
                    <a href="./login.php">Se Connecter</a>
                    <a href="./register.php">S'inscrire</a>
            <?php  } ?>
        </div>
    </nav>



