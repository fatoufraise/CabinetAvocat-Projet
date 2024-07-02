<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="signup.php" method="post">
                <h1>S'inscrire</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>S'inscrire avec </span>
                <input type="text" name="firstname" placeholder="Prénom" required />
                <input type="text" name="lastname" placeholder="Nom" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="text" name="address" placeholder="Adresse" required />
                <input type="tel" name="phone" placeholder="Numéro de téléphone" required />
                <input type="password" name="password" placeholder="Mot de passe" required />
                <button type="submit">S'inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="login.php" method="post">
                <h1>Se connecter</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>Se connecter avec </span>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Mot de passe" required />
                <button type="submit">Se connecter</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bon retour parmi nous !</h1>
                    <p>Connectez-vous pour accéder à votre espace personnalisé et gérer efficacement votre cabinet d'avocats, ou si vous n'êtes pas encore inscrit, faites le maintenant !</p>
                    <button class="ghost" id="signIn">S'inscrire</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bienvenue sur votre espace de gestion juridique</h1>
                    <p>Inscrivez-vous dès maintenant pour optimiser la gestion de votre cabinet et gagner en efficacité ou si vous avez déjà un compte, Connectez-vous !</p>
                    <button class="ghost" id="signUp">Se connecter</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>