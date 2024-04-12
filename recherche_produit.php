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

$req = "SELECT * FROM categorie ";
$stmt = $bdd->prepare($req);
$stmt->execute();
$all_categorie = $stmt->fetchAll();

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $search = $_POST['search']; // l'input search

    $req_rechercher_produit = "SELECT * FROM produit WHERE code = ?";
    $stmt_rechercher_produit = $bdd->prepare($req_rechercher_produit);
    $stmt_rechercher_produit->execute([$search]);

    $produit_trouvee = $stmt_rechercher_produit->fetchAll();
 
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche produit</title>
    <link rel="stylesheet" href="assets/style2.css">
    <style>
        .box-produit {
            padding: 1rem;
            margin: 1rem;
            width: 400px;
            /* background-color: white; */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .box-produit a {
            padding: 3px 5px;
            color: #fff;
            font-size: 1.2rem;
            border-radius: 5px;
            background: #843B0C;
            text-decoration: none;
        }

        .box-produit p {
            margin: 5px 0 !important;
        }
    </style>
</head>

<body>
    <?php if(isset($_SESSION['numcli'])){ ?>
    <section>
        <nav>
            <ul>
                <li><a href="php/logout.php">Déconnection</a></li>
            </ul>
        </nav>
    </section>
    <?php } ?>

    <section >
        <div style="border-bottom: 1px solid blue;width:100%; text-align:center; padding:1rem 0px;">
            <form method="post">
                <label for="search">Catégorie :</label>
                <select name="search" id="search" style="padding:3px 5px; margin:0px 15px; border:1px solid blue; width:150px">
                    <?php foreach ($all_categorie as $categorie) { ?>
                        <option value="<?= $categorie['code'] ?>"><?= $categorie['libelle'] ?></option>
                    <?php } ?>
                </select>
                <button type="submit" style="background: blue; padding:5px 15px; border:none; color:white">Rechercher</button>
            </form>
        </div>

        <div style="padding:1rem;">
            <h2>CATEGORIE DES FOURNITURES SCOLAIRES</h2>
            <div style="display: flex; justify-content:around; flex-wrap:wrap;">
                <?php
                    if (!empty($produit_trouvee)) {
                        foreach ($produit_trouvee as $produit) {
                ?>
                        <div class="box-produit">
                            <img src="php/<?=$produit['imageprod']?>" alt="produit" height="150px" width="200px">
                            <div>
                                <p> <?=$produit['design']?> </p>
                                <p> <?=$produit['pu']?> F CFA</p>
                                <a href="passer_commande.php?ref=<?=$produit['ref']?>">Choisir...</a>
                            </div>
                        </div>

                <?php
                        }
                    }
                ?>


            </div>
        </div>
    </section>
</body>

</html>