<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <section class="container">
        <div class="box">
            <div class="message">
                <ul>
                    <li>Lorem ipsum dolor sit a!Lorem ipsum dolor sit a!</li>
                    <li>Lorem ipsum dolor sit a!</li>
                </ul>
            </div>
            <form method="POST" action="php/login.php">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" required>
                </div>

                <div class="input-group btn">
                    <button type="submit">Se connecter</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>