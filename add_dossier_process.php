<?php
include('db_connect.php');

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'root', 'justice');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données du formulaire
$type = $_POST['type'];
$etat = $_POST['etat'];
$date_ouverture = $_POST['date_ouverture'];
$date_fermeture = $_POST['date_fermeture'];
$description = $_POST['description'];
$nom_dossier = $_POST['nom_dossier'];
$numero = $_POST['numero'];

// Préparation de la requête SQL d'insertion (utilisation de requête préparée recommandée)
$sql = "INSERT INTO dossiers (type, etat, date_ouverture, date_fermeture, description, nom_dossier, numero) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Erreur de préparation de la requête SQL: ' . $conn->error);
}

// Liaison des paramètres et exécution de la requête
$stmt->bind_param("sssssss", $type, $etat, $date_ouverture, $date_fermeture, $description, $nom_dossier, $numero);

if ($stmt->execute()) {
    echo "Nouveau dossier ajouté avec succès";
} else {
    echo "Erreur lors de l'ajout du dossier: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirection après l'ajout
header("Location: dossiers.php");
exit();
?>
