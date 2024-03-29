<?php
// Vérifier si l'identifiant  de la categorie à supprimer est passé en paramètre GET
if (isset($_GET['ref_cat'])) {
    // Inclure la connexion à la base de données
    require 'bdd.php';

    // Récupérer l'identifiant de la categorie à supprimer
    $ref_cat = $_GET['ref_cat'];

    // Préparer et exécuter la requête de suppression
    $query = "DELETE FROM categorie WHERE code = ?";
    $stmt = $bdd->prepare($query);
    $stmt->execute([$ref_cat]);

    // Rediriger vers la page des categories après la suppression
    echo "<script>alert('categorie supprimé avec succès.')</script>";
    header("refresh:.5; url=../categorie.php");
    exit();
} else {
    // Redirection si l'identifiant de la categorie n'est pas spécifié
    echo "<script>alert('Identifiant de la categorie non spécifié.')</script>";
    header("refresh:.5; url=../categorie.php");
    exit();
}
?>
