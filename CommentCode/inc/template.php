<?php
// Définition des variables globales pour la page
// Ces variables seront probablement utilisées dans le header pour le titre et la méta description
$title = "Index";           // Titre de la page
$description = "Ma description";  // Description de la page
?>

<?php
    // Inclusion du fichier d'en-tête commun à toutes les pages
    // Cela permet de centraliser les éléments HTML répétitifs comme les balises <head>, les imports CSS, etc.
    require_once('./inc/header.inc.php')
?>
    
<?php
    // Inclusion du fichier de pied de page commun à toutes les pages
    // Probablement pour centraliser les scripts JS, les balises de fermeture, etc.
    require_once('./inc/footer.inc.php')
?>