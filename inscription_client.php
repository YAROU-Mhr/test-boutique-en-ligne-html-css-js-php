<?php
// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure la connexion à la base de données
    require 'php/bdd.php';

    // Récupérer les données du formulaire
    $nom = $_POST['nom']; // Nom du client
    $prenom = $_POST['prenom']; // Prénom du client
    $adresse = $_POST['adresse']; // Adresse du client
    $telephone = $_POST['telephone']; // Téléphone du client
    $email = $_POST['email']; // email du client
    $mdp = $_POST['mdp']; // mot de passe du client
    $profil = "Client"; // profile du client

    // Préparer et exécuter la requête d'insertion à la base de donné dans la table client (C'est à dire l'inscription dans notre site)
    $query = "INSERT INTO client (nom, prenom, adresse, telephone, email) VALUES (?, ?, ?, ?, ?)";
    $stmt = $bdd->prepare($query);
    $stmt->execute([$nom, $prenom, $adresse, $telephone, $email]);

    // Préparer et exécuter la requête d'insertion à la base de donné dans la table utilisateur (C'est à dire l'inscription dans notre site)
    $query = "INSERT INTO utilisateur (email, mdp, profil) VALUES (?, ?, ?)";
    $stmt = $bdd->prepare($query);
    $stmt->execute([$email, $mdp, $profil]);

    // Redirection après l'inscription
    echo "<script>alert('Inscription réussie.')</script>";
    header("refresh:.5; url=../index.php");
    exit();
    
} 
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription client</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <section class="container"  style="height: auto !important;">
        <div class="box">
             
            <form method="POST" >   
                <div class="input-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                
                <div class="input-group">
                    <label for="prenom">Prenom</label>
                    <input type="text" id="prenom" name="prenom" required >
                </div>

                <div class="input-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" name="adresse" required>
                </div>

                <div class="input-group">
                    <label for="telephone">Telephone</label>
                    <input type="tel" id="telephone" name="telephone" required >
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required >
                </div>

                <div class="input-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" id="mdp" name="mdp" required >
                </div>

                <div class="input-group btn">
                    <button type="submit">S'inscrire </button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>