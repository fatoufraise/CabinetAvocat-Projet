<?php
// Inclure le fichier de connexion à la base de données
require_once 'db_connect.php';

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Échapper les caractères spéciaux pour éviter les injections SQL
    $firstname = mysqli_real_escape_string($conn, $firstname);
    $lastname = mysqli_real_escape_string($conn, $lastname);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $address);
    $phone = mysqli_real_escape_string($conn, $phone);
    // Hasher le mot de passe avant de le stocker dans la base de données
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête SQL
    $sql = "INSERT INTO users (nom, prenom, adresse, telephone, email, password) 
            VALUES ('$lastname', '$firstname', '$address', '$phone', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Redirection vers la page de connexion après inscription réussie
        header("Location: accueil.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
