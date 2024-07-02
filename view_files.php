<?php
// view_files.php
$id_dossier = $_GET['id'];

// Database connection
$conn = new mysqli("localhost", "root", "root", "justice");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete'])) {
    $file_id = $_POST['file_id'];
    $file_path = $_POST['file_path'];

    // Delete file from server
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Delete file record from database
    $sql_delete = "DELETE FROM documents WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $file_id);
    $stmt_delete->execute();
    $stmt_delete->close();
}

$sql = "SELECT * FROM documents WHERE id_dossier = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_dossier);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Files</title>
    <link rel="stylesheet" href="view_files.css">
</head>
<body>
    <div class="container">
        <h1>Files for Dossier ID: <?php echo htmlspecialchars($id_dossier); ?></h1>
        <table class="table">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Size</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $file_id = htmlspecialchars($row['id']);
                        $file_name = htmlspecialchars($row['nom_fichier']);
                        $file_size = htmlspecialchars($row['taille_fichier']);
                        $file_type = htmlspecialchars($row['type_mime']);
                        $file_path = htmlspecialchars($row['chemin_fichier']);

                        echo "<tr>
                            <td>{$file_name}</td>
                            <td>{$file_size}</td>
                            <td>{$file_type}</td>
                            <td>
                            <a href='{$file_path}' target='_blank'>👁️</a>

                                <form method='post' action='' style='display:inline-block;'>
                                    <input type='hidden' name='file_id' value='{$file_id}'>
                                    <input type='hidden' name='file_path' value='{$file_path}'>
                                    <button type='submit' name='delete'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No files found</td></tr>";
                }
                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
        <button onclick="location.href='dossiers.php'">Back to Dossiers</button>
    </div>
</body>
</html>
