<?php
    // Démarrage de la session
    session_start();
    
    // Destruction de la session courante
    // Cela supprime toutes les variables de session
    session_destroy();
    
    // Redirection vers la page d'accueil
    header('location: ./index.php');
    
    // Arrêt de l'exécution du script
    exit;
?>