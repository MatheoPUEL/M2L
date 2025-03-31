<<?php
// Définition des variables globales de la page
$title = "Accueil M2L";           // Titre de la page
$description = "Ma description";  // Description de la page
?>

<?php
    // Inclusion du fichier d'en-tête commun
    require_once('./inc/header.inc.php')
?>
    
    <!-- Formulaire de publication de message -->
    <form class="loginform" method="POST" action="./form/addMessage.form.php">
        <!-- Titre du formulaire -->
        <h1>Publier un message</h1>

        <!-- Zone d'affichage des erreurs -->
        <div class="alert-danger">
            <p>Une erreur est survenue</p>
        </div>

        <!-- Sélection de la ligue -->
        <label for="ligue">Selectionez votre ligue</label>
        <select name="ligue" id="ligue">
            <option value="0">Football</option>
            <option value="1">Handball</option>
            <option value="2">Takewondo</option>
        </select>

        <!-- Zone de texte pour le message -->
        <textarea 
            name="message" 
            id="" 
            rows="10" 
            style="margin-top: 25px;"
        ></textarea>

        <!-- Bouton de soumission -->
        <button type="submit" class="button">Publier</button>
    </form>

<?php
    // Inclusion du fichier de pied de page commun
    require_once('./inc/footer.inc.php')
?>
