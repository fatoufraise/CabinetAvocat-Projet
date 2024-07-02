<?php
session_start();
// Inclure le fichier de connexion à la base de données
require_once 'db_connect.php';

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Enregistrer l'email de l'utilisateur en session
            $_SESSION['email'] = $email;
            // Redirection vers la page d'accueil après connexion réussie
            header("Location: index.php");
            exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>
