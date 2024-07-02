<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dossiers</title>
    <link rel="stylesheet" href="Styles/sidebar.css">
    <link rel="stylesheet" href="Styles/main-content.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .sidebar {
            width: 50px;
            background-color: #B6A39E;
            color: white;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar img {
            width: 20px;
            height: 20px;
            margin-bottom: 10px;
        }

        .content {
            margin-left: 60px;
            padding: 20px;
        }


        .main-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
            margin-bottom: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }
       
    .add-dossier-btn {
        padding: 10px 20px;
        background-color: #B6A39E; /* Nouvelle couleur pour le bouton "+" */
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .add-dossier-btn:hover {
        background-color: #b3947a; /* Couleur plus sombre au survol */
    }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .table-content {
            overflow-x: auto;
        }

        .dossier-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dossier-table thead {
            background-color: #f9fafb;
        }

        .dossier-table th, .dossier-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .dossier-table th {
            background-color: #f1f3f4;
            font-weight: normal;
        }

        .dossier-table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .dossier-table tr:hover {
            background-color: #eef1f5;
        }

        .dossier-table button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            margin-right: 5px;
        }

        .dossier-table button:hover {
            background-color: #0056b3;
        }

        .dossier-table button.delete {
            background-color: #dc3545;
        }

        .dossier-table button.delete:hover {
            background-color: #bd2130;
        }

        .form-container {
            display: none;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 20px 0;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .input-group textarea {
            resize: vertical;
            height: 100px;
        }

        .button {
            padding: 10px 20px;
            background-color: #d7b49e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #b3947a;
        }
        .upload-btn {
    padding: 8px 16px;
    background-color: #4CAF50; /* Couleur de fond */
    color: white; /* Couleur du texte */
    border: none;
    cursor: pointer;
    border-radius: 5px; /* Bordures arrondies */
    transition: background-color 0.3s; /* Transition douce pour le changement de couleur */
}

.upload-btn:hover {
    background-color: #45a049; /* Couleur de fond au survol */
}



    .button-update {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.button-update:hover {
    background-color: #0056b3;
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
                    <img src="images/chaton-essai.jpeg" alt="Profile Picture" class="profile-pic">
                </div>
            </div>
        </div>
        
        <div class="main-container">
            <header class="header">
            <div class="header-left">
                    <h1>Mes dossiers</h1>
                </div>
                <div class="header-right">
                <button class="add-dossier-btn" onclick="toggleForm()">+</button>

                </div>
            </header>
            <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Rechercher un dossier...">
            </div>
            <div class="table-content">
                <table class="dossier-table">
                <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom du dossier</th>
                            <th>Type</th>
                            <th>Date Ouverture</th>
                            <th>Date Fermeture</th>
                            <th>Descriptions</th>
                            <th>Etat</th>
                            <th>Numero</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="dossierTableBody">

                    <?php
                        // Connexion à la base de données
                       // Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'root', 'justice');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM dossiers";
$result = $conn->query($sql);

if ($result === false) {
    // Ajoutez une ligne pour afficher l'erreur de requête SQL
    die('Erreur SQL: ' . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['nom_dossier']}</td>
        <td>{$row['type']}</td>
        <td>{$row['date_ouverture']}</td>
        <td>{$row['date_fermeture']}</td>
        <td>{$row['description']}</td>
        <td>{$row['etat']}</td>
        <td>{$row['numero']}</td>
        <td>
            <button class='upload-btn' onclick=\"location.href='upload.php?id={$row['id']}'\">Upload</button>
            <button onclick='editDossier(this)'>Modifier</button>
            <button onclick='deleteDossier(this)' class='delete'>Supprimer</button>
        </td>
    </tr>";
    
    }
} else {
    echo "<tr><td colspan='8'>Aucun dossier trouvé</td></tr>";
}

$conn->close();

                        ?>

                </table>
            </div>
        </div>
        <div class="form-container" id="dossierForm">
    <form id="addDossierForm" method="POST" action="add_dossier_process.php">
        <div class="input-group">
            <label for="nom_dossier">Nom du dossier</label>
            <input type="text" id="nom_dossier" name="nom_dossier" required>
        </div>
        <div class="input-group">
            <label for="type">Type</label>
            <input type="text" id="type" name="type" required>
        </div>
        <div class="input-group">
            <label for="type">Numero</label>
            <input type="text" id="numero" name="numero" required>
        </div>
        <div class="input-group">
            <label for="statut">Etat</label>
            <input type="text" id="etat" name="etat" required>
        </div>
        <div class="input-group">
            <label for="date_ouverture">Date d'ouverture</label>
            <input type="date" id="date_ouverture" name="date_ouverture" required>
        </div>
        <div class="input-group">
            <label for="date_fermeture">Date de fermeture</label>
            <input type="date" id="date_fermeture" name="date_fermeture" required>
        </div>
        <div class="input-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="button">Ajouter un dossier</button>
    </form>
</div>

<form id="dossierFormEdit" method="post" action="update_dossier_process.php" style="display:none;">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" id="dossierIdEdit" name="id">
    <label for="nomDossierEdit">Nom du Dossier:</label>
    <input type="text" id="nomDossierEdit" name="nom_dossier"><br>
    <label for="typeEdit">Type:</label>
    <input type="text" id="typeEdit" name="type"><br>
    <label for="etatEdit">État:</label>
    <input type="text" id="etatEdit" name="etat"><br>
    <label for="date_ouvertureEdit">Date d'Ouverture:</label>
    <input type="date" id="date_ouvertureEdit" name="date_ouverture"><br>
    <label for="date_fermetureEdit">Date de Fermeture:</label>
    <input type="date" id="date_fermetureEdit" name="date_fermeture"><br>
    <label for="descriptionEdit">Description:</label>
    <textarea id="descriptionEdit" name="description"></textarea><br>
    <label for="numeroEdit">Numéro:</label>
    <input type="text" id="numeroEdit" name="numero"><br>
    <button type="submit" class="button-update">Mettre à jour</button> <!-- Utilisation de la classe 'button-update' pour le style -->
</form>



<form id="deleteForm" action="delete_dossier_process.php" method="POST" style="display: none;">
    <input type="hidden" name="id" id="dossierIdDelete" value="">
    <input type="hidden" name="action" value="delete">
</form>
<script>
function toggleForm() {
    var form = document.getElementById('dossierForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function editDossier(button) {
    var row = button.parentNode.parentNode; // Récupère la ligne du bouton cliqué
    var cells = row.getElementsByTagName('td');

    // Pré-remplit les champs du formulaire d'édition avec les données actuelles du dossier
    document.getElementById('dossierIdEdit').value = cells[0].innerText;
    document.getElementById('nomDossierEdit').value = cells[1].innerText;
    document.getElementById('typeEdit').value = cells[2].innerText;
    document.getElementById('etatEdit').value = cells[3].innerText;
    document.getElementById('date_ouvertureEdit').value = cells[4].innerText;
    document.getElementById('date_fermetureEdit').value = cells[5].innerText;
    document.getElementById('descriptionEdit').value = cells[6].innerText;
    document.getElementById('numeroEdit').value = cells[7].innerText;

    // Affiche le formulaire pour l'édition
    document.getElementById('dossierFormEdit').style.display = 'block';
}


function deleteDossier(button) {
    var row = button.parentNode.parentNode; // Récupère la ligne du bouton cliqué
    var id = row.cells[0].innerText; // Récupère l'ID du dossier à supprimer

    // Pré-remplit l'ID du dossier dans le formulaire de suppression
    document.getElementById('dossierIdDelete').value = id;

    // Soumet le formulaire de suppression
    document.getElementById('deleteForm').submit();
}

document.getElementById('searchInput').addEventListener('input', function() {
    var filter = this.value.toLowerCase();
    var rows = document.getElementById('dossierTableBody').getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var found = false;
        for (var j = 1; j < cells.length - 1; j++) { // Commence à 1 pour ignorer la colonne #
            var cellText = cells[j].textContent.toLowerCase();
            if (cellText.indexOf(filter) > -1) {
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
