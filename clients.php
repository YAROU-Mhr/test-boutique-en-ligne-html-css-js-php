<?php
require 'php/bdd.php';

$req = "SELECT * FROM client ";
$stmt = $bdd->prepare($req);
$stmt->execute();
$all_client = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client</title>
    <link rel="stylesheet" href="assets/style2.css">
</head>

<body>
    <section>
        <?php
            require 'include/nav.php'
        ?>
    </section>
    <section class="container">
        <div class="box-produit">
            <table>
                <thead>
                    <tr>
                        <th>numcli</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Adresse</th>
                        <th>Telephone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_client as $client) {  ?>
                        <tr>
                            <td><?= $client['numcli'] ?></td>
                            <td><?= $client['nom'] ?></td>
                            <td><?= $client['prenom'] ?></td>
                            <td><?= $client['adresse'] ?></td>
                            <td><?= $client['telephone'] ?></td>
                            <td>
                                <div class="action">
                                    <a href="form_update_client.php?ref_numcli=<?= $client['numcli'] ?>" class="modifier">Modifier</a>

                                    <a href="php/trt_supprimer_client.php?ref_numcli=<?= $client['numcli'] ?>" class="supprimer ">Supprimer</a>
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