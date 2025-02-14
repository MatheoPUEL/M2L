<?php
    $ligues = array('Football',
                    'Handball',
                    'Takewondo')
?>

Identifiant: <?php echo $_POST['login']; ?><br>
Email: <?php echo $_POST['email']; ?><br>
Ligue choisie: <?php echo $ligues[$_POST['ligue']] ; ?><br>
Mot de passe: <?php echo $_POST['password']; ?><br>
Confirmation de mot de passe: <?php echo $_POST['confirm_password']; ?>
