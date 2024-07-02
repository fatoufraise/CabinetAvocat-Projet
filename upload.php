<?php
// upload.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_dossier = $_POST['id_dossier'];
    $target_dir = "uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_paths = [];
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $file_name = basename($_FILES['files']['name'][$key]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($tmp_name, $target_file)) {
            $file_paths[] = $target_file;
            // Insert file metadata into the database
            $conn = new mysqli("localhost", "root", "root", "justice");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("INSERT INTO documents (id_dossier, chemin_fichier, nom_fichier, taille_fichier, type_mime) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issis", $id_dossier, $target_file, $file_name, $_FILES['files']['size'][$key], $_FILES['files']['type'][$key]);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }
    }
    header("Location: view_files.php?id=$id_dossier");
    exit;
} else {
    $id_dossier = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Files</title>
    <link rel="stylesheet" href="upload_files.css"> <!-- Link to the CSS file -->
</head>
<body>
    <div class="container">
        <h1>Upload Files</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_dossier" value="<?php echo htmlspecialchars($id_dossier); ?>">
            <input type="file" name="files[]" multiple>
            <button type="submit">Upload</button>
        </form>
    </div>
</body>
</html>

