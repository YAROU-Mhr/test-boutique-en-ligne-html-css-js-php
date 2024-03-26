<?php
    require 'php/bdd.php';
    $req = "Select * from categorie";
    $stmt = $bdd->prepare($req);
    $stmt->execute();
    $all_catrgory = $stmt->fetchAll();
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
            <form  action="php/trt_ajout_produit.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="ref">Ref</label>
                    <input type="text" id="ref" name="ref" required>
                </div>
                <div class="input-group">
                    <label for="design">Designation</label>
                    <input type="text" id="design" name="design" required>
                </div>
                <div class="input-group">
                    <label for="pu">Prix Unitaire</label>
                    <input type="number" id="pu" name="pu" required>
                </div>

                <div class="input-group">
                    <label for="img">Image</label>
                    <input type="file" id="img" name="img" required>
                </div>

                <div class="input-group">
                    <label for="cat">Selectionner une catégorie</label>
                    <select name="cat" id="cat">
                        <?php foreach($all_catrgory as $category){ ?>
                            <option value="<?=$category['code']?>"><?=$category['libelle']?></option>
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