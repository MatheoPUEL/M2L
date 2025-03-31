<?php
// Démarrage de la session PHP
session_start();

// Définition des variables globales de la page
$title = "Accueil&nbsp;M2L"; // Titre de la page avec une espace insécable
$description = "Ma description"; // Description de la page (à personnaliser)
?>

<?php
    // Inclusion du fichier d'en-tête commun du site
    require_once('./inc/header.inc.php')
?>

<header>
    <!-- Conteneur principal de l'en-tête -->
    <div>
        <!-- Conteneur pour le titre et un élément décoratif -->
        <div style="display: flex; flex-direction: row;">
            <!-- Affichage dynamique du titre de la page -->
            <h1><?= $title ?></h1>
            
            <!-- Image décorative pour le coin gauche -->
            <img class="right" src="./img/svg/Leftcorner.svg" alt="">
        </div>
        
        <!-- Image décorative pour le coin inférieur -->
        <img class="bottom" src="./img/svg/Bottomcorner.svg" alt="">
    </div>
    
    <!-- Image principale de l'en-tête -->
    <img class