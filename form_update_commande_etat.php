<?php
require 'php/bdd.php';

$ref_numcmd = $_GET['ref_numcmd'];
$req_select_commande_modif = "SELECT * FROM commande where numcmd = ?";
$stmt_commande_modif = $bdd->prepare($req_select_commande_modif);
$stmt_commande_modif->execute([$ref_numcmd]);
$commande = $stmt_commande_modif->fetch();

if (!$commande) {
    echo "<script>alert(Commande non retrouvé.')</script>";
    header("refresh:.2; url=commande.php");
    exit();
}


// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inclure la connexion à la base de données
    require 'php/bdd.php';

    // Récupérer les données du formulaire
    $numcmd = $_POST['numcmd']; // numcmd commande
    $etat = $_POST['etat']; // etat commande


        $query = "UPDATE commande SET etat = ? WHERE numcmd = ?";
        $stmt = $bdd->prepare($query);
        $stmt->execute([$etat, $numcmd]);

        // Redirection après la modification
        echo "<script>alert('Modification effectuée avec succès.')</script>";
        header("refresh:.5; url=commande.php");
        exit();
    
} 

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Etat</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <section class="container " style="height: auto !important;">
        <div class="box">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" id="numcmd" name="numcmd" required value="<?= $commande['numcmd'] ?>">
                <div class="input-group">
                    <label for="etat">Etat</label>
                    <input type="text" id="etat" name="etat" required value="<?= $commande['etat'] ?>">
                </div>
                <div class="input-group btn">
                    <button type="submit">Valider la modification</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>