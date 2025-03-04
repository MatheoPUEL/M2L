<?php
    $ligues = array('Football',
                    'Handball',
                    'Takewondo')
?>

Message posté: <?php if(isset($_POST['message'])) {echo $_POST['message'];};  ?><br>
Ligue sélectioner: <?php if(isset($_POST['ligue'])) { echo $ligues[$_POST['ligue']] ; };  ?><br>

