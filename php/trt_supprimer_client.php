<?php
// Vérifier si l'identifiant  de la client à supprimer est passé en paramètre GET
if (isset($_GET['ref_numcli'])) {
    // Inclure la connexion à la base de données
    require 'bdd.php';

    // Récupérer l'identifiant de la client à supprimer
    $ref_numcli = $_GET['ref_numcli'];

    // Préparer et exécuter la requête de suppression
    $query = "DELETE FROM client WHERE numcli = ?";
    $stmt = $bdd->prepare($query);
    $stmt->execute([$ref_numcli]);

    // Rediriger vers la page des clients après la suppression
    echo "<script>alert('client supprimé avec succès.')</script>";
    header("refresh:.5; url=../clients.php");
    exit();
} else {
    // Redirection si l'identifiant de la client n'est pas spécifié
    echo "<script>alert('Identifiant de la client non spécifié.')</script>";
    header("refresh:.5; url=../clients.php");
    exit();
}
?>
