<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && isset($_POST['date']) && isset($_POST['type_affaire']) && isset($_POST['faits']) && isset($_POST['numero_dossier']) && isset($_POST['affaire_a_suivre_id']) && isset($_POST['client_id']) && isset($_POST['statut']) && isset($_POST['titre'])) {
        // Récupération des données du formulaire
        $id = intval($_POST['id']);
        $date = $conn->real_escape_string($_POST['date']);
        $type_affaire = $conn->real_escape_string($_POST['type_affaire']);
        $faits = $conn->real_escape_string($_POST['faits']);
        $numero_dossier = $conn->real_escape_string($_POST['numero_dossier']);
        $affaire_a_suivre_id = $conn->real_escape_string($_POST['affaire_a_suivre_id']);
        $client_id = $conn->real_escape_string($_POST['client_id']);
        $statut = $conn->real_escape_string($_POST['statut']);
        $titre = $conn->real_escape_string($_POST['titre']);

        // Préparation de la requête SQL pour la mise à jour
        $query = "UPDATE affaires SET 
                    date = '$date', 
                    type_affaire = '$type_affaire', 
                    faits = '$faits', 
                    numero_dossier = '$numero_dossier', 
                    affaire_a_suivre_id = '$affaire_a_suivre_id', 
                    client_id = '$client_id', 
                    statut = '$statut', 
                    titre = '$titre' 
                  WHERE id = $id";

        // Exécution de la requête SQL
        if ($conn->query($query) === TRUE) {
            header("Location: affaires.php");
            exit();
        } else {
            echo "Erreur lors de la mise à jour de l'affaire: " . $conn->error;
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
    } else {
        // Si des données manquent dans le formulaire, rediriger vers une page d'erreur
        header("Location: error.php");
        exit();
    }
} else {
    // Si la méthode de requête n'est pas POST, rediriger vers une page d'erreur
    header("Location: error.php");
    exit();
}
?>
