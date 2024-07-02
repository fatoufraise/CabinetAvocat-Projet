<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Mouhamadou Moustapha SY</title>
    <link rel="stylesheet" href="Styles/sidebar.css">
    <link rel="stylesheet" href="Styles/navbar.css">
    <style>
        .content {
            margin-left: 250px;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .biography {
            background: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .biography p {
            font-size: 1.1em;
            line-height: 1.8;
            color: #555;
            margin-bottom: 10px;
        }

        .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8f8f8;
    padding: 10px 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 100%; /* Utilise toute la largeur */
    /* position: fixed; */ /* Retiré pour rendre non fixe */
}



        .nav-right {
            display: flex;
            align-items: center;
        }

        .notifications {
            margin-right: 20px;
        }

        .notification-icon {
            font-size: 1.5em;
            margin-right: 5px;
        }

        .notification-count {
            font-size: 1.2em;
            color: red;
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .profile-name {
            margin-right: 10px;
            font-weight: bold;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #333;
        }
    </style>
</head>
<body>
    <?php
        // Exemple de données dynamiques
        $notification_count = 3;
        $profile_name = "Mouhamadou Moustapha SY";
        $profile_pic = "chemin/vers/votre/photo.png";
    ?>

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
                <?php echo $notification_count; ?></span>
               
                <div class="profile">
                    <span class="profile-name"><?php echo $profile_name; ?></span>
                    <img src="<?php echo $profile_pic; ?>" alt="Profile Picture" class="profile-pic">
                </div>
            </div>
        </div>

        <h1>Mon profil</h1>

        <div class="biography">
            <p>Mouhamadou Moustapha SY est un avocat expérimenté et dévoué, ayant consacré sa vie au service du droit. Il a obtenu son diplôme de droit à l'Université Cheikh Anta Diop de Dakar. Son parcours professionnel a débuté en 1983 lorsqu'il a intégré le barreau et a gravi les échelons grâce à une série de stages enrichissants.</p>
            <p>En 1984, il a effectué un stage au cabinet de Maître Mamadou LO, spécialiste en droit public, suivi en 1985 par un stage au cabinet de Maître Sahjanane AKDA, spécialiste en droit maritime. Il a continué son apprentissage en 1986 au cabinet de Maître Bakhao SALL, où il a par la suite collaboré de 1986 à 1988.</p>
            <p>En 1989, Mouhamadou Moustapha SY s'est inscrit au grand tableau et a ouvert son propre cabinet au rond-point boulevard Général de Gaulle jusqu'en 1993, puis au rond-point Jet d'eau de 1993 à 1995. Depuis 1995, il est installé au 8D Immeuble D à la Sicap Liberté 6, où il est le propriétaire exclusif des locaux. Son cabinet a acquis une réputation solide, ayant servi des clients prestigieux tels que la SICAP, la SGBS, la Société Nationale de Pédologie et même la mairie de Sicap Liberté 6.</p>
            <p>Avocat passionné et dévoué, Mouhamadou Moustapha SY continue d'exercer ses fonctions avec excellence, offrant ses services juridiques à une clientèle variée et fidèle.</p>
        </div>
    </div>
</body>
</html>
