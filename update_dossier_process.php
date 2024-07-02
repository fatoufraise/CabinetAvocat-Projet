<?php
// Vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification de l'action à effectuer (dans ce cas, mise à jour)
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', 'root', 'justice');

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            echo "Connection to the database successful.<br>";
        }

        // Récupération des données du formulaire
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $type = isset($_POST['type']) ? $_POST['type'] : null;
        $etat = isset($_POST['etat']) ? $_POST['etat'] : null;
        $date_ouverture = isset($_POST['date_ouverture']) ? $_POST['date_ouverture'] : null;
        $date_fermeture = isset($_POST['date_fermeture']) && !empty($_POST['date_fermeture']) ? $_POST['date_fermeture'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $nom_dossier = isset($_POST['nom_dossier']) ? $_POST['nom_dossier'] : null;
        $numero = isset($_POST['numero']) ? $_POST['numero'] : null;

        // Affichage des données reçues pour déboguer
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        if ($id !== null && $type !== null && $etat !== null && $date_ouverture !== null && $description !== null && $nom_dossier !== null && $numero !== null) {
            // Préparation de la requête SQL pour la mise à jour
            $sql = "UPDATE dossiers SET type=?, etat=?, date_ouverture=?, date_fermeture=?, description=?, nom_dossier=?, numero=? WHERE id=?";

            // Préparation de la requête SQL
            if ($stmt = $conn->prepare($sql)) {
                echo "SQL statement prepared successfully.<br>";
                
                // Gérer le cas où date_fermeture est null
                if ($date_fermeture === null) {
                    $stmt->bind_param("sssssssi", $type, $etat, $date_ouverture, $date_fermeture, $description, $nom_dossier, $numero, $id);
                } else {
                    $stmt->bind_param("sssssssi", $type, $etat, $date_ouverture, $date_fermeture, $description, $nom_dossier, $numero, $id);
                }

                // Exécution de la requête SQL
                if ($stmt->execute()) {
                    echo "Dossier mis à jour avec succès.<br>";
                } else {
                    echo "Erreur lors de la mise à jour du dossier: " . $stmt->error . "<br>";
                }

                // Fermeture de la connexion à la base de données
                $stmt->close();
            } else {
                echo "Erreur lors de la préparation de la requête SQL: " . $conn->error . "<br>";
            }
        } else {
            echo "Erreur: certaines données du formulaire sont manquantes.<br>";
        }

        $conn->close();

        // Commenter la redirection pour voir les messages de débogage
        header("Location: dossiers.php");
        exit();
    } else {
        // Si l'action n'est pas spécifiée comme 'edit', rediriger vers une page d'erreur ou gérer comme nécessaire
        echo "Action non spécifiée comme 'edit'.<br>";
         header("Location: error.php");
        exit();
    }
} else {
    // Si la méthode de requête n'est pas POST, rediriger vers une page d'erreur ou gérer comme nécessaire
    echo "Méthode de requête non POST.<br>";
     header("Location: error.php");
     exit();
}
?>
