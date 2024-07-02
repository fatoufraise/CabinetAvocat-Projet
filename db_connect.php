<?php
$db_host = 'localhost';     // Nom du serveur MySQL (généralement 'localhost')
$db_user = 'root';      // Nom d'utilisateur MySQL
$db_password = 'root';  // Mot de passe MySQL
$db_name = 'justice';      // Nom de la base de données

// Connexion à la base de données MySQL
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
