<?php
// add_client_process.php

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'root', 'justice');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$sexe = $_POST['sexe'];
$profession = $_POST['profession'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Insertion dans la base de données
$sql = "INSERT INTO clients (nom, prenom, adresse, sexe, profession, email, phone) VALUES ('$nom', '$prenom', '$adresse', '$sexe', '$profession', '$email', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Nouveau client ajouté avec succès";
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirection après l'ajout
header("Location: clients.php");
exit();
?>
