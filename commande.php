<?php
require 'php/bdd.php';

$req = "SELECT * FROM commande ";
$stmt = $bdd->prepare($req);
$stmt->execute();
$all_commande = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande</title>
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
                        <th>Num</th>
                        <th>Date</th>
                        <th>Etat</th>
                        <th>Quantité</th>
                        <th>numcli</th>
                        <th>ref</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_commande as $commande) {  ?>
                        <tr>
                            <td><?= $commande['numcmd'] ?></td>
                            <td><?= $commande['date'] ?></td>
                            <td><?= $commande['etat'] ?></td>
                            <td><?= $commande['qte'] ?></td>
                            <td><?= $commande['numcli'] ?></td>
                            <td><?= $commande['ref'] ?></td>
                            <td>
                                <div class="action">
                                    <a href="form_update_commande_etat.php?ref_numcmd=<?= $commande['numcmd'] ?>" class="supprimer">Modifier etat</a>
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