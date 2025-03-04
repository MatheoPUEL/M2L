<?php

$host = 'localhost';
$dbname = 'appfaq';
$username = 'root';
$password = '';
try {
$dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
echo "Connexion réussie !";
}
catch (PDOException $ex)
{
die("Erreur lors de la connexion SQL : " . $ex->getMessage());
}

$id = 3;
$sql = "SELECT * FROM `user` WHERE id_user=:id";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(':id' => $id));
    $row = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

if ($row) {
    echo "<p>" . $row['pseudo'] . "</p>";
}

?>