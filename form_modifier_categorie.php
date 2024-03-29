<?php
require 'php/bdd.php';

$ref_cat = $_GET['ref_cat'];
$req_select_cat_modif = "SELECT * FROM categorie where code = ?";
$stmt_cat_modif = $bdd->prepare($req_select_cat_modif);
$stmt_cat_modif->execute([$ref_cat]);
$cat = $stmt_cat_modif->fetch();

if (!$cat) {
    echo "<script>alert(Categorie non retrouvé.')</script>";
    header("refresh:.2; url=../produits.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modif Categorie</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <section class="container " style="height: auto !important;">
        <div class="box">
            <form action="php/trt_modifier_categorie.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="ref">Code</label>
                    <input type="text" id="code" name="code" readonly value="<?= $cat['code'] ?>">
                </div>
                <div class="input-group">
                    <label for="libelle">Libelle</label>
                    <input type="text" id="libelle" name="libelle" required value="<?= $cat['libelle'] ?>">
                </div>
                <div class="input-group btn">
                    <button type="submit">Valider l'ajout</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>