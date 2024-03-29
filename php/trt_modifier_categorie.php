<?php
// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inclure la connexion à la base de données
    require 'bdd.php';

    // Récupérer les données du formulaire
    $code = $_POST['code']; // code categorie
    $libelle = $_POST['libelle']; // libelle categorie


        // Si aucune nouvelle image n'est téléchargée, mettre à jour les autres données du produit sans changer l'image
        $query = "UPDATE categorie SET code = ?, libelle = ? WHERE code = ?";
        $stmt = $bdd->prepare($query);
        $stmt->execute([$code, $libelle, $code]);

        // Redirection après la modification
        echo "<script>alert('Modification effectuée avec succès.')</script>";
        header("refresh:.5; url=../categorie.php");
        exit();
    
} else {
    // Redirection si le formulaire n'est pas soumis
    echo "<script>alert('Le formulaire n'a pas été soumis.')</script>";
    header("refresh:.5; url=../categorie.php");
    exit();
}
?>
