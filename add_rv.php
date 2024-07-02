<?php
$servername = "localhost";
$username = "root";
$password = "root"; // Ensure this matches your MySQL root password
$dbname = "justice";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ajouter un rendez-vous
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client = $conn->real_escape_string($_POST['client']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "INSERT INTO meetings (client, date, time, description) VALUES ('$client', '$date', '$time', '$description')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Récupérer les rendez-vous
$sql = "SELECT * FROM meetings ORDER BY date, time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous</title>
    <link rel="stylesheet" href="Styles/sidebar.css">
    <link rel="stylesheet" href="Styles/main-content.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
        margin: 0;
        padding: 0;
        color: #333;
    }
    
    .content {
        flex: 1;
        padding: 20px;
        background-color: #e7e7e7;
        display: flex;
        flex-direction: column;
        position: relative;
        margin-left: 250px;
        margin-top: 50px;
    }
    
    .calendar {
    margin-bottom: 20px;
    background-color: #827c7c;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 80%; /* Diminuer la largeur du calendrier */
    margin: 20px auto; /* Centrer le calendrier avec une marge en haut */
}


.delete-button {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: red;
    align-self: center;
}

    
.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    color: white; /* Couleur du texte pour l'en-tête */
}
    
    .meeting-list {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        flex: 1;
        overflow-y: auto;
    }
    
    .meeting {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #dedede;
        border-radius: 5px;
    }
    
    .meeting:hover {
        background-color: #D7B49E;
    }
    
    .meeting-time {
        font-weight: bold;
    }
    
    .meeting-details {
        flex: 1;
        margin-left: 20px;
    }
    
    .add-button {
        position: absolute;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background-color: #827c7c;
        color: #fff;
        border: none;
        border-radius: 50%;
        font-size: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }
    
    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .close {
        color: #B6A39E;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .search-bar {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    
    #search-input {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        flex: 1;
        margin-right: 10px;
    }
    
    #search-button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #827c7c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    
    #search-button:hover {
        background-color: #6d6767;
    }
    .meeting.filtered {
        border: 2px solid #ccc;
        background-color: #f0f0f0;
    }


.calendar-header button {
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

.calendar-header button:hover {
    background-color: #333333;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
    transform: translateY(-2px);
}




    </style>
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
                <div class="search-bar">
                    <input type="text" id="search-input" placeholder="Rechercher...">
                    <button id="search-button">Rechercher</button>
                </div>
            </div>
        </div>

        <div class="calendar">
            <div class="calendar-header">
                <button id="prevYear">&lt;&lt;</button>
                <button id="prevMonth">&lt;</button>
                <h2 id="calendar-header"></h2>
                <button id="nextMonth">&gt;</button>
                <button id="nextYear">&gt;&gt;</button>
            </div>
            <table id="calendar-table">
                <!-- Le calendrier sera généré dynamiquement ici -->
            </table>
        </div>

        <div class="meeting-list" id="meeting-list">
    <h2>Mes Rendez-vous</h2>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='meeting'>";
            echo "<div class='meeting-time'>" . $row["time"] . "</div>";
            echo "<div class='meeting-details'><strong>" . $row["client"] . "</strong><br>" . $row["description"] . "<br>" . $row["date"] . "</div>";
            echo "<button class='delete-button' data-id='" . $row["id"] . "'>&#128465;</button>"; // Emoji poubelle
            echo "</div>";
        }
    } else {
        echo "No meetings found";
    }
    $conn->close();
    ?>
</div>

        <button class="add-button" id="add-button">+</button>
    </div>

    <!-- Le Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Planifier un Rendez-vous</h2>
            <form id="meeting-form" method="post" action="">
                <label for="client">Nom du Client:</label>
                <input type="text" id="client" name="client" required><br><br>
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br><br>
                <label for="time">Heure:</label>
                <input type="time" id="time" name="time" required><br><br>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required><br><br>
                <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript pour la fonctionnalité du modal
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("add-button");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "flex";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // JavaScript pour le calendrier
        function generateCalendar(year, month) {
            var calendarHeader = document.getElementById('calendar-header');
            var calendarTable = document.getElementById('calendar-table');
            calendarTable.innerHTML = '';

            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            calendarHeader.innerText = monthNames[month] + ' ' + year;

            var firstDay = new Date(year, month).getDay();
            var daysInMonth = 32 - new Date(year, month, 32).getDate();

            var tbl = document.createElement('table');
            tbl.innerHTML = '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';

            var date = 1;
            for (var i = 0; i < 6; i++) {
                var row = document.createElement('tr');

                for (var j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        var cell = document.createElement('td');
                        cell.innerText = '';
                        row.appendChild(cell);
                    } else if (date > daysInMonth) {
                        break;
                    } else {
                        var cell = document.createElement('td');
                        cell.innerText = date;
                        row.appendChild(cell);
                        date++;
                    }
                }
                tbl.appendChild(row);
            }
            calendarTable.appendChild(tbl);
        }

        var today = new Date();
        var currentMonth = today.getMonth();
        var currentYear = today.getFullYear();

        document.getElementById('prevMonth').onclick = function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar(currentYear, currentMonth);
        }

        document.getElementById('nextMonth').onclick = function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar(currentYear, currentMonth);
        }

        document.getElementById('prevYear').onclick = function() {
            currentYear--;
            generateCalendar(currentYear, currentMonth);
        }

        document.getElementById('nextYear').onclick = function() {
            currentYear++;
            generateCalendar(currentYear, currentMonth);
        }

        generateCalendar(currentYear, currentMonth);

        document.getElementById('search-button').addEventListener('click', function() {
            var searchText = document.getElementById('search-input').value.toLowerCase();
            var meetings = document.getElementsByClassName('meeting');
        
            for (var i = 0; i < meetings.length; i++) {
                var meetingDetails = meetings[i].getElementsByClassName('meeting-details')[0];
                var clientName = meetingDetails.getElementsByTagName('strong')[0].innerText.toLowerCase();
                var description = meetingDetails.innerText.toLowerCase();
                var date = meetingDetails.innerText.toLowerCase();
        
                if (clientName.includes(searchText) || description.includes(searchText) || date.includes(searchText)) {
                    meetings[i].style.display = 'block';
                } else {
                    meetings[i].style.display = 'none';
                }
            }
        });
    
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function() {
            const meetingId = this.getAttribute('data-id');
            if (confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous?')) {
                fetch(`delete_meeting.php?id=${meetingId}`, {
                    method: 'GET'
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        this.parentElement.remove();
                    } else {
                        alert('Une erreur est survenue. Veuillez réessayer.');
                    }
                });
            }
        });
    });
</script>

    </script>
</body>
</html>
