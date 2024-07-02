<?php 
include 'header.php'; 
include 'sidebar.php'; 
include 'navbar.php'; 
session_start(); 
$nomAvocat = $_SESSION['nom_avocat']; // Supposons que le nom de l'avocat soit stocké dans une session
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="Styles/sidebar.css">
    <link rel="stylesheet" href="Styles/main-content.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/widgets.css"> <!-- Ajouter votre nouveau fichier CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                // Exemple d'événements, vous pouvez les charger dynamiquement à partir de votre base de données
                {
                    title: 'Rendez-vous avec Client A',
                    start: '2023-10-10'
                },
                {
                    title: 'Affaire B - Tribunal',
                    start: '2023-10-15'
                }
            ]
        });

        calendar.render();
    });

    // Fonction pour obtenir la localisation et la météo
    function getWeather() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                var apiKey = 'YOUR_API_KEY'; // Remplacez par votre clé API OpenWeatherMap
                var weatherUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=${apiKey}`;

                $.get(weatherUrl, function(data) {
                    var temp = data.main.temp;
                    var weather = data.weather[0].description;
                    $('#weather').html(`Température: ${temp}°C, ${weather}`);
                });
            });
        } else {
            $('#weather').html('La géolocalisation n\'est pas supportée par ce navigateur.');
        }
    }

    $(document).ready(function() {
        getWeather();
    });
    </script>
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
                <div class="notifications">
                    <!-- Notifications icon and count -->
                    <?php
                    // Connexion à la base de données
                    $conn = new mysqli('localhost', 'root', 'root', 'justice');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Requête pour obtenir le nombre de notifications non lues
                    $sql = "SELECT COUNT(*) AS count FROM notifications WHERE lu = 0";
                    $result = $conn->query($sql);

                    $notificationCount = 0;
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $notificationCount = $row['count'];
                    }
                    $conn->close();
                    ?>
                    <span class="notification-count"><?php echo $notificationCount; ?></span>
                </div>
                <div class="profile">
                    <!-- Profile picture and name -->
                    <span class="profile-name"><?php echo $nomAvocat; ?></span>
                    <img src="" alt="Profile Picture" class="profile-pic">
                </div>
            </div>
        </div>
        <h1>Bienvenue sur votre Tableau de Bord</h1>
       

        <div class="widgets">
            <div class="widget calendar-widget">
                <h2>Calendrier</h2>
                <div id='calendar'></div>
            </div>
            
            
            <div class="widget stats-widget">
                <h2>Statistiques</h2>
                <?php
                // Connexion à la base de données
                $conn = new mysqli('localhost', 'root', 'root', 'justice');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Requêtes pour obtenir les statistiques
                $sqlClients = "SELECT COUNT(*) AS count FROM clients";
                $resultClients = $conn->query($sqlClients);
                $clientCount = $resultClients->num_rows > 0 ? $resultClients->fetch_assoc()['count'] : 0;

                $sqlAffaires = "SELECT COUNT(*) AS count FROM affaires WHERE status = 'en cours'";
                $resultAffaires = $conn->query($sqlAffaires);
                $affaireCount = $resultAffaires->num_rows > 0 ? $resultAffaires->fetch_assoc()['count'] : 0;

                $sqlRendezvous = "SELECT COUNT(*) AS count FROM rendezvous WHERE DATE(date) = CURDATE()";
                $resultRendezvous = $conn->query($sqlRendezvous);
                $rendezvousCount = $resultRendezvous->num_rows > 0 ? $resultRendezvous->fetch_assoc()['count'] : 0;

                $conn->close();
                ?>
                <p>Clients: <?php echo $clientCount; ?></p>
                <p>Affaires en cours: <?php echo $affaireCount; ?></p>
                <p>Rendez-vous aujourd'hui: <?php echo $rendezvousCount; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
