<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes clients</title>
    <link rel="stylesheet" href="Styles/sidebar.css">
    <link rel="stylesheet" href="Styles/main-content.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <link rel="stylesheet" href="Styles/client.css">
    <style>
    
    /* CSS pour styliser les boutons */
    .client-table button {
        padding: 8px 16px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        margin-right: 5px;
    }

    .client-table button:hover {
        background-color: #0056b3;
    }

    .client-table button.delete {
        background-color: #dc3545;
    }

    .client-table button.delete:hover {
        background-color: #bd2130;
    }

    .add-client-btn {
        background-color: #B6A39E; /* Nouvelle couleur pour le bouton "+" */
        color: white;
        border: none;
        cursor: pointer;
        padding: 8px 16px;
    }

    .add-client-btn:hover {
        background-color: #A38F8B; /* Couleur au survol */
    }
</style>

       
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
                    <h1>Mes clients</h1>
                </div>
                <div class="header-right">
                    <button class="add-client-btn" onclick="toggleForm()">+</button>
                </div>
            </header>
            <hr>
            <div class="sub-header">
                <div class="client-count">
                    <h2>Nombre de clients : <span id="clientCount"><?php echo $clientCount; ?></span></h2>
                </div>
                <div class="search-bar">
                    <input type="text" id="searchInput" placeholder="Rechercher un client...">
                </div>
            </div>
            <div class="table-content">
                <table class="client-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Adresse</th>
                            <th>Sexe</th>
                            <th>Profession</th>
                            <th>Adresse e-mail</th>
                            <th>Numéro de téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="clientTableBody">
                        <?php
                        // Connexion à la base de données
                        $conn = new mysqli('localhost', 'root', 'root', 'justice');

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Récupération des clients depuis la base de données
                      // Récupération des clients depuis la base de données
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $clientCount = $result->num_rows; // Nombre de clients
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nom']}</td>
            <td>{$row['prenom']}</td>
            <td>{$row['adresse']}</td>
            <td>{$row['sexe']}</td>
            <td>{$row['profession']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>
                <button onclick='editClient(this)'>Modifier</button>
                <button onclick='deleteClient(this)' class='delete'>Supprimer</button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='9'>Aucun client trouvé</td></tr>";
}

$conn->close();
?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="clientForm" class="form-container" style="display: none;">
            <form id="clientFormElement" action="add_client_process.php" method="POST">
                <div class="input-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="input-group">
                    <label for="prenom">Prenom :</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div class="input-group">
                    <label for="adresse">Adresse :</label>
                    <input type="text" id="adresse" name="adresse" required>
                </div>
                <div class="input-group">
                    <label>Sexe :</label>
                    <label><input type="radio" name="sexe" value="Masculin"> Masculin</label>
                    <label><input type="radio" name="sexe" value="Féminin"> Féminin</label>
                </div>
                <div class="input-group">
                    <label for="profession">Profession :</label>
                    <input type="text" id="profession" name="profession" required>
                </div>
                <div class="input-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="phone">Téléphone :</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <button type="submit" class="button">Ajouter</button>
            </form>
        </div>

        <div id="clientFormEdit" class="form-container" style="display: none;">
            <form id="clientFormEditElement" action="update_client_process.php" method="POST">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="clientIdEdit" value="">
                <div class="input-group">
                    <label for="nomEdit">Nom :</label>
                    <input type="text" id="nomEdit" name="nom" required>
                </div>
                <div class="input-group">
                    <label for="prenomEdit">Prenom :</label>
                    <input type="text" id="prenomEdit" name="prenom" required>
                </div>
                <div class="input-group">
                    <label for="adresseEdit">Adresse :</label>
                    <input type="text" id="adresseEdit" name="adresse" required>
                </div>
                <div class="input-group">
                    <label>Sexe :</label>
                    <label><input type="radio" name="sexe" value="Masculin"> Masculin</label>
                    <label><input type="radio" name="sexe" value="Féminin"> Féminin</label>
                </div>
                <div class="input-group">
                    <label for="professionEdit">Profession :</label>
                    <input type="text" id="professionEdit" name="profession" required>
                </div>
                <div class="input-group">
                    <label for="emailEdit">Email :</label>
                    <input type="email" id="emailEdit" name="email" required>
                </div>
                <div class="input-group">
                    <label for="phoneEdit">Téléphone :</label>
                    <input type="tel" id="phoneEdit" name="phone" required>
                </div>
                <button type="submit" class="button">Enregistrer</button>
            </form>
        </div>

        <form id="deleteForm" action="delete_client_process.php" method="POST" style="display: none;">
            <input type="hidden" name="id" id="clientIdDelete" value="">
            <input type="hidden" name="action" value="delete">
        </form>

    </div>

    <script>
        function toggleForm() {
            var form = document.getElementById('clientForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function editClient(button) {
            var row = button.parentNode.parentNode; // Récupère la ligne du bouton cliqué
            var cells = row.getElementsByTagName('td');

            // Pré-remplit les champs du formulaire d'édition avec les données actuelles du client
            document.getElementById('clientIdEdit').value = cells[0].innerText;
            document.getElementById('nomEdit').value = cells[1].innerText;
            document.getElementById('prenomEdit').value = cells[2].innerText;
            document.getElementById('adresseEdit').value = cells[3].innerText;

            // Coche le bouton radio correspondant au "Sexe" actuel du client dans le formulaire d'édition
            var sexe = cells[4].innerText.toLowerCase();
            var radiosEdit = document.getElementsByName('sexe');
            for (var i = 0; i < radiosEdit.length; i++) {
                if (radiosEdit[i].value.toLowerCase() === sexe) {
                    radiosEdit[i].checked = true;
                    break;
                }
            }

            document.getElementById('professionEdit').value = cells[5].innerText;
            document.getElementById('emailEdit').value = cells[6].innerText;
            document.getElementById('phoneEdit').value = cells[7].innerText;

            // Affiche le formulaire pour l'édition
            document.getElementById('clientFormEdit').style.display = 'block';
        }

        function deleteClient(button) {
            var row = button.parentNode.parentNode; // Récupère la ligne du bouton cliqué
            var id = row.cells[0].innerText; // Récupère l'ID du client à supprimer

            // Pré-remplit l'ID du client dans le formulaire de suppression
            document.getElementById('clientIdDelete').value = id;

            // Soumet le formulaire de suppression
            document.getElementById('deleteForm').submit();
        }

        document.getElementById('searchInput').addEventListener('input', function() {
    var filter = this.value.toLowerCase();
    var rows = document.getElementById('clientTableBody').getElementsByTagName('tr');

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
// Après avoir récupéré les données des clients et mis à jour le tableau HTML
var clientCount = <?php echo $clientCount; ?>; // Récupère le nombre de clients depuis PHP

// Met à jour le nombre de clients affiché dans le span
document.getElementById('clientCount').textContent = clientCount;

    </script>
</body>
</html>
