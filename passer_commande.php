<?php
#on démarre la session
session_start();
#on récupère le numcli que l'on avait passée à la connection
#Si on a pas on l'envoie a la connection puisque sans connection on a pas de numcli et sans numcli on peut pas placer commande
if(!isset($_SESSION['numcli'])){
    echo "<script>alert('Veuillez vous connecter')</script>";
    header("refresh:1; url=index.php");
    exit();
} 

// Inclure la connexion à la base de données
require 'php/bdd.php';

$ref_prod = $_GET['ref'];
$req_produit = "SELECT * FROM produit WHERE ref = ?";
$stmt_produit = $bdd->prepare($req_produit);
$stmt_produit->execute([$ref_prod]);

$produit_trouvee = $stmt_produit->fetch();



// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $quantite = $_POST['quantite']; // l'input quantite
    $etat = "en cours"; 
    //Vus que la session est allumé on peut récupérer l'id que l'on a envoyé a la connection
    $numcli = $_SESSION['numcli'] ;
    $dateActuelle = date("Y-m-d"); // Format YYYY-MM-DD

    $req_insert = "INSERT INTO `commande`( `date`, `etat`, `qte`, `numcli`, `ref`) VALUES ('$dateActuelle','$etat','$quantite','$numcli','$ref_prod')";
    $stmt_insert = $bdd->prepare($req_insert);
    $stmt_insert->execute();
    if($stmt_insert){
        echo "<script>alert('Commande ajouté. Veuillez poursuivre')</script>";
        header("refresh:1; url=recherche_produit.php");
        exit();
    }else{
        echo "<script>alert('Commande non ajouté')</script>";
        header("refresh:1; url=recherche_produit.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer commande</title>
    <link rel="stylesheet" href="assets/style2.css">
</head>

<body>
    <section>
        <nav>
            <ul>
                <li><a href="php/logout.php">Déconnection</a></li>
            </ul>
        </nav>
    </section>
    <section style="padding: 1rem 2rem;margin-top:2rem ; border-top:2px solid blue ; border-bottom:2px solid blue">
        <div>
            <h2 style="margin-left: 2rem;">PASSER UNE COMMANDE </h2>
            <div style="display: flex; align-items:center ;justify-content:center">
                <div style="display: flex; align-items:center ;justify-content:space-between;width:750px;">
                    <div >
                        <p style="padding: 1rem 0;">Référence : <?= $produit_trouvee['ref'] ?></p>
                        <p style="padding: 1rem 0;">Désignation :<?= $produit_trouvee['design'] ?></p>
                        <p style="padding: 1rem 0;">Prix Unitaire : <?= $produit_trouvee['pu'] ?> F CFA</p>
                    </div>
                    <div >
                        <img src="php/<?= $produit_trouvee['imageprod'] ?>" alt="produit" height="250px" width="250px">
                    </div>
                </div>
            </div>

            <form method="post" style="width:100%; text-align:center; padding:1rem 0px;">
                <label for="quantite">Entrer la quantité : </label>
                <input type="number" name="quantite" id="quantite" min="1" style="padding:3px 5px; margin:0px 15px; border:1px solid blue; width:250px" required>
                <button type="submit" style="background: blue; padding:5px 15px; border:none; color:white"> Commander </button>
            </form>
        </div>
    </section>
</body>

</html>