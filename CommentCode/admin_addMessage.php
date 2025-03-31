<?php
// Variable globale a la page
$title = "Accueil M2L";
$description = "Ma description";
?>

<?php
   // Inclusion de l'en-tête du site
   require_once('./inc/header.inc.php')
?>
   <!-- Formulaire de publication de message -->
   <form class="loginform" method="POST" action="./form/addMessage.form.php">
       <h1>Publier un message</h1>

       <!-- Zone d'alerte pour les erreurs -->
       <div class="alert-danger">
           <p>Une erreur est survenue</p>
       </div>

       <!-- Menu déroulant pour sélectionner une ligue -->
       <label for="ligue">Selectionez votre ligue</label>
       <select name="ligue" id="ligue">
           <option value="0">Football</option>
           <option value="1">Handball</option>
           <option value="2">Takewondo</option>
       </select>

       <!-- Zone de texte pour le message -->
       <textarea name="message" id="" rows="10" style="margin-top: 25px;"></textarea>

       <!-- Bouton d'envoi du formulaire -->
       <button type="submit" class="button">Publier</button>
   </form>
<?php
   // Inclusion du pied de page du site
   require_once('./inc/footer.inc.php')
?>