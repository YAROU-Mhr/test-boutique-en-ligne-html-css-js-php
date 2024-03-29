<?php
require 'php/bdd.php';

$req = "SELECT * FROM categorie ";
$stmt = $bdd->prepare($req);
$stmt->execute();
$all_categorie = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorire</title>
    <link rel="stylesheet" href="assets/style2.css">
</head>

<body>
    <section>
        <nav>
            <ul>
            <li><a href="produits.php">Produit</a></li>
                <li><a href="categorie.php">Categorie</a></li>
                <li><a href="commande.php">Commande</a></li>
                <li><a href="#">Client</a></li>
            </ul>
        </nav>
    </section>
    <section class="container">
        <div class="box-produit">
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Libelle</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_categorie as $categorie) {  ?>
                        <tr>
                            <td><?= $categorie['code'] ?></td>
                            <td><?= $categorie['libelle'] ?></td>
                            <td>
                                <div class="action">
                                    <a href="form_modifier_categorie.php?ref_cat=<?= $categorie['code'] ?>" class="modifier">Modifier</a>
                                    <a href="php/trt_supprimer_categorie.php?ref_cat=<?= $categorie['code'] ?>" class="supprimer">Supprimer</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </section>
</body>

</html>