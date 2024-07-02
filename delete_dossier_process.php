<?php
// Vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification de l'action à effectuer (dans ce cas, suppression)
    if ($_POST['action'] == 'delete') {
        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', 'root', 'justice');

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Récupération de l'ID du dossier à supprimer depuis le formulaire
        $id = $_POST['id'];

        // Préparation de la requête SQL pour la suppression
        $sql = "DELETE FROM dossiers WHERE id=?"; // Utilisation de requête préparée pour la sécurité

        // Préparation de la requête SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        // Exécution de la requête SQL
        if ($stmt->execute()) {
            echo "Dossier supprimé avec succès"; // Message facultatif pour le débogage
        } else {
            echo "Erreur lors de la suppression du dossier: " . $stmt->error;
        }

        // Fermeture de la connexion à la base de données
        $stmt->close();
        $conn->close();

        // Redirection après la suppression
        header("Location: dossiers.php"); // Assurez-vous que le chemin est correct
        exit();
    } else {
        // Si l'action n'est pas spécifiée comme 'delete', rediriger vers une page d'erreur ou gérer comme nécessaire
        header("Location: error.php"); // Redirection vers une page d'erreur
        exit();
    }
} else {
    // Si la méthode de requête n'est pas POST, rediriger vers une page d'erreur ou gérer comme nécessaire
    header("Location: error.php"); // Redirection vers une page d'erreur
    exit();
}
?>
