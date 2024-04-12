<?php
require 'php/bdd.php';

$ref_numcli = $_GET['ref_numcli'];
$req_select_cat_modif = "SELECT * FROM client where numcli = ?";
$stmt_cat_modif = $bdd->prepare($req_select_cat_modif);
$stmt_cat_modif->execute([$ref_numcli]);
$client = $stmt_cat_modif->fetch();

if (!$client) {
    echo "<script>alert(client non retrouvé.')</script>";
    header("refresh:1; url=../clients.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modif client</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <section class="container" style="height: auto !important;">
        <div class="box">
            <form action="php/trt_modifier_client.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="numcli">Numcli</label>
                    <input type="text" id="numcli" name="numcli" readonly value="<?= $client['numcli'] ?>">
                </div>

                <div class="input-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required value="<?= $client['nom'] ?>">
                </div>
                
                <div class="input-group">
                    <label for="prenom">Prenom</label>
                    <input type="text" id="prenom" name="prenom" required value="<?= $client['prenom'] ?>">
                </div>

                <div class="input-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" name="adresse" required value="<?= $client['adresse'] ?>">
                </div>

                <div class="input-group">
                    <label for="telephone">Telephone</label>
                    <input type="tel" id="telephone" name="telephone" required value="<?= $client['telephone'] ?>">
                </div>

                <div class="input-group btn">
                    <button type="submit">Valider la modification</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>