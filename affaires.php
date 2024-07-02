<?php
include 'db_connect.php'; // Include database connection

// Check if the form has been submitted (POST method)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data using $_POST
    $date = $_POST['date'];
    $type_affaire = $_POST['type_affaire'];
    $faits = $_POST['faits'];
    $numero_dossier = $_POST['numero_dossier'];
    $affaire_a_suivre_id = $_POST['affaire_a_suivre_id'];
    $client_id = $_POST['client_id'];
    $statut = $_POST['statut'];
    $titre = $_POST['titre'];

    // Prepare SQL statement
    $sql = "INSERT INTO affaires (date, type_affaire, faits, numero_dossier, affaire_a_suivre_id, client_id, statut, titre)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check for SQL preparation errors
    if ($stmt === false) {
        die('SQL statement preparation error: ' . $conn->error);
    }

    // Bind parameters and execute SQL statement
    $stmt->bind_param("ssssssss", $date, $type_affaire, $faits, $numero_dossier, $affaire_a_suivre_id, $client_id, $statut, $titre);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Redirect to the same page after successful addition
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        // Error message on insertion failure
        echo "Error adding case: " . $stmt->error;
    }

    // Close prepared statement
    $stmt->close();
}

// Select existing cases from the database for display
$sql_select = "SELECT * FROM affaires";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affaires</title>
    <link rel="stylesheet" href="Styles/sidebar.css">
    <link rel="stylesheet" href="Styles/main-content.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/affaire.css">
    <style>
        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 150px;
            text-align: center;
            transition: transform 0.2s;
        }
        .card img {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }
        .card:hover {
            transform: scale(1.05);
        }
        /* Styles for modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
   /* Boutons d'action */
.edit-btn, .delete-btn, #add-case-btn {
    background-color: #dddddd; /* Couleur de fond par défaut */
    color: white; /* Couleur du texte par défaut */
    border: none; /* Supprime le bord */
    padding: 10px 20px; /* Remplissage intérieur */
    text-align: center; /* Alignement du texte */
    text-decoration: none; /* Supprime la décoration du texte */
    display: inline-block; /* Affichage en ligne */
    font-size: 14px; /* Taille de police */
    margin-right: 5px; /* Marge droite */
    cursor: pointer; /* Curseur de la souris */
    border-radius: 5px; /* Bordure arrondie */
    transition: background-color 0.3s; /* Transition pour le survol */
}

#add-case-btn {
    background-color: #B6A39E; /* Marron clair */
}

.edit-btn {
    background-color: #007BFF; /* Bleu */
}

.delete-btn {
    background-color: #FF0000; /* Rouge */
}

#add-case-btn:hover {
    background-color: #BCA588; /* Marron clair au survol */
}

.edit-btn:hover {
    background-color: #0056B3; /* Bleu au survol */
}

.delete-btn:hover {
    background-color: #CC0000; /* Rouge au survol */
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
                <!-- Logo or title could go here -->
            </div>
            <div class="nav-right">
                
                <div class="profile">
                    <!-- Profile picture and name -->
                    <span class="profile-name">Nom de l'avocat</span>
                    <img src="path/to/profile-pic.png" alt="Profile Picture" class="profile-pic">
                </div>
            </div>
        </div>
        <div class="main-container">
            <header class="header">
                <div class="header-title">
                    <h1>Gestion des affaires (affaires nationales)</h1>
                </div>
                
                <div class="header-actions">
                    <button id="add-case-btn">+</button>
                </div>


            </header>
            <div class="cards-container">
    <button class="card" data-type="criminal">
        <img src="icons/criminal-icon.png" alt="Criminel">
        <h3>Affaires criminelles</h3>
    </button>
    <button class="card" data-type="civil">
        <img src="icons/civil-icon.png" alt="Civil">
        <h3>Affaires civiles</h3>
    </button>
    <button class="card" data-type="family">
        <img src="icons/family-icon.png" alt="Familial">
        <h3>Affaires familiales</h3>
    </button>
    <button class="card" data-type="probate">
        <img src="icons/probate-icon.png" alt="Social">
        <h3>Affaires sociales</h3>
    </button>
    <button class="card" data-type="administrative">
        <img src="icons/administrative-icon.png" alt="Administratif">
        <h3>Affaires administratives</h3>
    </button>
    <button class="card" data-type="juvenile">
        <img src="icons/juvenile-icon.png" alt="Consultation">
        <h3>Consultation Juridique</h3>
    </button>
    <button class="card" data-type="tax">
        <img src="icons/tax-icon.png" alt="Commercial">
        <h3>Affaires commerciales</h3>
    </button>
    <button class="card" data-type="real-estate">
        <img src="icons/real-estate-icon.png" alt="Immobilier">
        <h3>Affaires immobilières</h3>
    </button>
    <button class="card" data-type="immigration">
        <img src="icons/immigration-icon.png" alt="Immigration">
        <h3>Affaires d'immigration</h3>
    </button>
    <button class="card" data-type="environmental">
        <img src="icons/environmental-icon.png" alt="Environnemental">
        <h3>Affaires environnementales</h3>
    </button>
    <button class="card" data-type="intellectual-property">
        <img src="icons/intellectual-property-icon.png" alt="Propriété intellectuelle">
        <h3>Propriété intellectuelle</h3>
    </button>
    <button class="card" data-type="contract">
        <img src="icons/contract-icon.png" alt="Contrats">
        <h3>Contrats</h3>
    </button>
    <button class="card" data-type="employment">
        <img src="icons/employment-icon.png" alt="Droit du travail">
        <h3>Droit du travail</h3>
    </button>
    <button class="card" data-type="healthcare">
        <img src="icons/healthcare-icon.png" alt="Santé">
        <h3>Affaires de santé</h3>
    </button>
</div>

            <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Rechercher une affaire...">
                </div>
            
            <div class="cases-table">
                <h2>Affaires transmises</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Titre de l'affaire</th>
                            <th>Type d'affaire</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Client</th>
                            <th>Numéro de dossier</th>
                            <th>Faits</th>
                            <th>Affaire à suivre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="cases-list">
                    <?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['titre'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['type_affaire'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['statut'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['client_id'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['numero_dossier'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['faits'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['affaire_a_suivre_id'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>
                <button class='edit-btn' data-id='{$row['id']}'>Modifier</button>
                <form action='delete_affaire_process.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='id' value='{$row['id']}'>
                    <button type='submit' class='delete-btn'>Supprimer</button>
                </form>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='9'>Aucune affaire trouvée</td></tr>";
}
?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal for Adding a Case -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Ajouter une affaire</h2>
            <form id="add-case-form" method="POST" action="affaires.php">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br>
                <label for="type_affaire">Type d'affaire:</label>
                <input type="text" id="type_affaire" name="type_affaire" required><br>
                <label for="faits">Faits:</label>
                <textarea id="faits" name="faits" required></textarea><br>
                <label for="numero_dossier">Numéro de dossier:</label>
                <input type="text" id="numero_dossier" name="numero_dossier" required><br>
                <label for="affaire_a_suivre_id">Affaire à suivre ID:</label>
                <input type="text" id="affaire_a_suivre_id" name="affaire_a_suivre_id"><br>
                <label for="client_id">Client ID:</label>
                <input type="number" id="client_id" name="client_id" required><br>
                <label for="statut">Statut:</label>
                <input type="text" id="statut" name="statut" required><br>
                <label for="titre">Titre:</label>
                <input type="text" id="titre" name="titre" required><br>
                <input type="submit" value="Ajouter l'affaire">
            </form>
        </div>
    </div>
    

    <!-- The Modal for Editing a Case -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Modifier une affaire</h2>
            <form id="edit-case-form" method="POST" action="edit_affaire_process.php">
                <input type="hidden" id="affaireIdEdit" name="id">
                <label for="dateEdit">Date:</label>
                <input type="date" id="dateEdit" name="date" required><br>
                <label for="type_affaireEdit">Type d'affaire:</label>
                <input type="text" id="type_affaireEdit" name="type_affaire" required><br>
                <label for="faitsEdit">Faits:</label>
                <textarea id="faitsEdit" name="faits" required></textarea><br>
                <label for="numero_dossierEdit">Numéro de dossier:</label>
                <input type="text" id="numero_dossierEdit" name="numero_dossier" required><br>
                <label for="affaire_a_suivre_idEdit">Affaire à suivre ID:</label>
                <input type="text" id="affaire_a_suivre_idEdit" name="affaire_a_suivre_id"><br>
                <label for="client_idEdit">Client ID:</label>
                <input type="number" id="client_idEdit" name="client_id" required><br>
                <label for="statutEdit">Statut:</label>
                <input type="text" id="statutEdit" name="statut" required><br>
                <label for="titreEdit">Titre:</label>
                <input type="text" id="titreEdit" name="titre" required><br>
                <input type="submit" value="Mettre à jour l'affaire">
            </form>
        </div>
    </div>
    <script>
        var modal = document.getElementById("myModal");
        var editModal = document.getElementById("editModal");

        var btn = document.getElementById("add-case-btn");
        var span = document.getElementsByClassName("close");

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span[0].onclick = function() {
            modal.style.display = "none";
        }
        span[1].onclick = function() {
            editModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            if (event.target == editModal) {
                editModal.style.display = "none";
            }
        }

        document.querySelectorAll('.edit-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                
                // Fetch the case data using AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "get_affaire.php?id=" + id, true);
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        var affaire = JSON.parse(xhr.responseText);
                        
                        if (!affaire.error) {
                            document.getElementById('affaireIdEdit').value = affaire.id;
                            document.getElementById('dateEdit').value = affaire.date;
                            document.getElementById('type_affaireEdit').value = affaire.type_affaire;
                            document.getElementById('faitsEdit').value = affaire.faits;
                            document.getElementById('numero_dossierEdit').value = affaire.numero_dossier;
                            document.getElementById('affaire_a_suivre_idEdit').value = affaire.affaire_a_suivre_id;
                            document.getElementById('client_idEdit').value = affaire.client_id;
                            document.getElementById('statutEdit').value = affaire.statut;
                            document.getElementById('titreEdit').value = affaire.titre;

                            editModal.style.display = "block";
                        } else {
                            alert(affaire.error);
                        }
                    } else {
                        alert('Error fetching case details');
                    }
                };
                xhr.send();
            });
        });
        document.getElementById('searchInput').addEventListener('input', function() {
    var filter = this.value.toLowerCase();
    var rows = document.getElementById('cases-list').getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var found = false;
        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].textContent.toLowerCase();
            if (cellText.includes(filter)) {
                found = true;
                break;
            }
        }
        rows[i].style.display = found ? '' : 'none';
    }
});

    </script>
</body>
</html>
