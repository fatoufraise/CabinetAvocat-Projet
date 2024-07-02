<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous</title>
    <link rel="stylesheet" href="Styles/sidebar.css">
    <link rel="stylesheet" href="Styles/main-content.css">
    <link rel="stylesheet" href="Styles/navbar.css">
</head>
<body>
    <div class="sidebar">
        <h2><img src="icons/la-regle-horizontale.png" alt="barre"></h2>
        <a href="clients.php"><img src="icons/icon-client.png" alt="client"></a>
        <a href="affaires.php"><img src="icons/icon-affaire.png" alt="affaire"></a>
        <a href="dossiers.php"><img src="icons/dossier-ouvert.png" alt="dossier"></a>
        <a href="rendezvous.php"><img src="icons/icon-rendezvous.png" alt="rendezvous"></a>
        <a href="profile.php"><img src="icons/icon-profil.png" alt="profil"></a>
        <a href="accueil.php"><img src="icons/icon-logout.png" alt="logout"></a>
    </div>
    <div class="content">
        <div class="navbar">
            <div class="nav-left">
                <!-- Logo or title could go here -->
            </div>
            <div class="nav-right">
                
                <div class="profile">
                    <!-- Profile picture and name -->
                    <?php
                    // Récupérer le nom de l'avocat et la photo de profil depuis une base de données ou une session
                    $profileName = "Nom de l'avocat"; // Exemple statique, à remplacer par une variable dynamique
                    $profilePic = "path/to/profile-pic.jpg"; // Exemple statique, à remplacer par une variable dynamique
                    ?>
                    <span class="profile-name"><?php echo $profileName; ?></span>
                    <img src="<?php echo $profilePic; ?>" alt="Profile Picture" class="profile-pic">
                </div>
            </div>
        </div>
        <h1>Mes rendez-vous</h1>    <div class="calendar-header">
    <!-- Votre lien pour ajouter un rendez-vous -->
    <a href="add_rv.php" class="add-appointment-button">Ajouter un rendez-vous</a>
</div>
        <p>Voici vos rendez-vous prévus</p>
       
     

<style> 
.add-appointment-button {
    background-color: #5a5a5a;
    color: white;
    border: none;
    padding: 10px 20px;
    margin: 5px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 18px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.add-appointment-button:hover {
    background-color: #333333;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    transform: translateY(-2px);
}
</style>

        <?php
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "justice";

        // Créer une connexion
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Connexion échouée: " . $conn->connect_error);
        }

        // Requête pour obtenir les rendez-vous
        $sql = "SELECT date, description FROM meetings";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<ul>";
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row["date"] . ": " . $row["description"] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Aucun rendez-vous trouvé.";
        }

        // Fermer la connexion
        $conn->close();
        ?>
    </div>
</body>
</html>

