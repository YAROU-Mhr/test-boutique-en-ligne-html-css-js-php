<?php
// Vérifier si l'identifiant du produit à supprimer est passé en paramètre GET
if (isset($_GET['ref_prod'])) {
    // Inclure la connexion à la base de données
    require 'bdd.php';

    // Récupérer l'identifiant du produit à supprimer
    $ref_prod = $_GET['ref_prod'];

    // Préparer et exécuter la requête de suppression
    $query = "DELETE FROM produit WHERE ref = ?";
    $stmt = $bdd->prepare($query);
    $stmt->execute([$ref_prod]);

    // Rediriger vers la page des produits après la suppression
    echo "<script>alert('Produit supprimé avec succès.')</script>";
    header("refresh:.5; url=../produits.php");
    exit();
} else {
    // Redirection si l'identifiant du produit n'est pas spécifié
    echo "<script>alert('Identifiant du produit non spécifié.')</script>";
    header("refresh:.5; url=../produits.php");
    exit();
}
?>
