<?php
// update_client_process.php

// Vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification de l'action à effectuer (dans ce cas, mise à jour)
    if ($_POST['action'] == 'edit') {
        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', 'root', 'justice');

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Récupération des données du formulaire
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $sexe = $_POST['sexe'];
        $profession = $_POST['profession'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Vérification des valeurs pour sexe
        $valid_sexe = ['Masculin', 'Féminin'];
        if (!in_array($sexe, $valid_sexe)) {
            die("Valeur de sexe invalide");
        }

        // Préparation de la requête SQL pour la mise à jour
        $sql = "UPDATE clients SET nom='$nom', prenom='$prenom', adresse='$adresse', sexe='$sexe', profession='$profession', email='$email', phone='$phone' WHERE id=$id";

        // Exécution de la requête SQL
        if ($conn->query($sql) === TRUE) {
            echo "Client mis à jour avec succès";
        } else {
            echo "Erreur lors de la mise à jour du client: " . $conn->error;
        }

        // Fermeture de la connexion à la base de données
        $conn->close();

        // Redirection après la mise à jour
        header("Location: clients.php");
        exit();
    } else {
        // Si l'action n'est pas spécifiée comme 'edit', rediriger vers une page d'erreur ou gérer comme nécessaire
        header("Location: error.php");
        exit();
    }
} else {
    // Si la méthode de requête n'est pas POST, rediriger vers une page d'erreur ou gérer comme nécessaire
    header("Location: error.php");
    exit();
}
?>
