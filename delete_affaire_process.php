<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM affaires WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Rediriger vers la page affaires.php après suppression
        header("Location: affaires.php");
        exit(); // S'assurer que le script s'arrête après la redirection
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
