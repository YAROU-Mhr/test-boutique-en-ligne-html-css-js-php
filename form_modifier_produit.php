<?php
require 'php/bdd.php';
$req = "Select * from categorie";
$stmt = $bdd->prepare($req);
$stmt->execute();
$all_catrgory = $stmt->fetchAll();

$ref_prod = $_GET['ref_prod'];

$req_select_prod_modif = "SELECT * FROM produit where ref = ?";
$stmt_prod_modif = $bdd->prepare($req_select_prod_modif);
$stmt_prod_modif->execute([$ref_prod]);
$product = $stmt_prod_modif->fetch();

if (!$product) {
    echo "<script>alert(Produit non retrouvé.')</script>";
    header("refresh:.2; url=../produits.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <section class="container " style="height: auto !important;">
        <div class="box">
            <form action="php/trt_modifier_produit.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="ref">Ref</label>
                    <input type="text" id="ref" name="ref" readonly value="<?= $product['ref'] ?>">
                </div>
                <div class="input-group">
                    <label for="design">Designation</label>
                    <input type="text" id="design" name="design" required value="<?= $product['design'] ?>">
                </div>
                <div class="input-group">
                    <label for="pu">Prix Unitaire</label>
                    <input type="number" id="pu" name="pu" required value="<?= $product['pu'] ?>">
                </div>

                <div class="input-group">
                    <label for="img">Image</label>
                    <input type="file" id="img" name="img">
                    <?php if ($product['imageprod']) { ?>
                        <img src="php/<?= $product['imageprod'] ?>" alt="image produit" height="100px" width="100px">
                    <?php } ?>

                </div>

                <div class="input-group">
                    <label for="cat">Selectionner une catégorie</label>
                    <select name="cat" id="cat">
                        <?php foreach ($all_catrgory as $category) { ?>
                            <option value="<?= $category['code'] ?>" <?= $product['code'] ==  $category['code'] ? 'selected' : '' ?>><?= $category['libelle'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="input-group btn">
                    <button type="submit">Valider l'ajout</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>