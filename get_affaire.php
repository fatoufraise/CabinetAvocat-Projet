<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM affaires WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $affaire = $result->fetch_assoc();
            echo json_encode($affaire);
        } else {
            echo json_encode(['error' => 'Affaire not found']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Erreur de préparation de la requête SQL']);
    }
} else {
    echo json_encode(['error' => 'Invalid ID']);
}
?>
