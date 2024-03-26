<?php
require 'php/bdd.php';

$req = "SELECT * FROM produit ";
$stmt = $bdd->prepare($req);
$stmt->execute();
$all_product = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link rel="stylesheet" href="assets/style2.css">
</head>

<body>
    <section>
        <nav>
            <ul>
                <li><a href="produits.php">Produit</a></li>
                <li><a href="#">Categorie</a></li>
                <li><a href="#">Commande</a></li>
                <li><a href="#">Client</a></li>
            </ul>
        </nav>
    </section>
    <section class="container">
        <div class="new">
            <a href="form_ajouter_produit.php">Nouveau</a>
        </div>
        <div class="box-produit">
            <table>
                <thead>
                    <tr>
                        <th>REF</th>
                        <th>DESIGN</th>
                        <th>PU</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_product as $product) {  ?>
                        <tr>
                            <td><?= $product['ref'] ?></td>
                            <td><?= $product['design'] ?></td>
                            <td><?= $product['pu'] ?></td>
                            <td>
                                <div class="action">
                                    <a href="form_modifier_produit.php?ref_prod=<?= $product['ref'] ?>" class="modifier">Modifier</a>
                                    <a href="php/trt_supprimer_produit.php?ref_prod=<?= $product['ref'] ?>" class="supprimer">Supprimer</a>
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