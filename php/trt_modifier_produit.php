<?php
// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inclure la connexion à la base de données
    require 'bdd.php';

    // Récupérer les données du formulaire
    $ref = $_POST['ref']; // Référence du produit
    $design = $_POST['design']; // Désignation du produit
    $pu = $_POST['pu']; // Prix unitaire du produit
    $cat = $_POST['cat']; // Catégorie du produit

    // Vérifier si une nouvelle image est téléchargée
    if (!empty($_FILES["img"]["name"])) {
        // Gérer le téléchargement de la nouvelle image
        $targetDir = "uploads/"; // Répertoire de destination pour les images téléchargées
        $fileName = basename($_FILES["img"]["name"]); // Nom du fichier téléchargé
        $targetFilePath = $targetDir . $fileName; // Chemin complet du fichier sur le serveur
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); // Type de fichier téléchargé

        // Vérifier si le fichier est une image réelle
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif'); // Types de fichiers d'images autorisés
        if (in_array($fileType, $allowTypes)) {
            // Télécharger la nouvelle image sur le serveur
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
                // Mettre à jour les données du produit avec la nouvelle image
                $query = "UPDATE produit SET design = ?, pu = ?, imageprod = ?, code = ? WHERE ref = ?";
                $stmt = $bdd->prepare($query);
                $stmt->execute([$design, $pu, $targetFilePath, $cat, $ref]);

                // Redirection après la modification
                echo "<script>alert('Modification effectuée avec succès.')</script>";
                header("refresh:.5; url=../produits.php");
                exit();
            } else {
                echo "<script>alert('Désolé, une erreur s'est produite lors du téléchargement de votre nouvelle image.')</script>";
                header("refresh:.5; url=../produits.php");
                exit();
            }
        } else {
            echo "<script>alert('Désolé, seuls les fichiers de type JPG, JPEG, PNG et GIF sont autorisés.')</script>";
            header("refresh:.5; url=../produits.php");
            exit();
        }
    } else {
        // Si aucune nouvelle image n'est téléchargée, mettre à jour les autres données du produit sans changer l'image
        $query = "UPDATE produit SET design = ?, pu = ?, code = ? WHERE ref = ?";
        $stmt = $bdd->prepare($query);
        $stmt->execute([$design, $pu, $cat, $ref]);

        // Redirection après la modification
        echo "<script>alert('Modification effectuée avec succès.')</script>";
        header("refresh:.5; url=../produits.php");
        exit();
    }
} else {
    // Redirection si le formulaire n'est pas soumis
    echo "<script>alert('Le formulaire n'a pas été soumis.')</script>";
    header("refresh:.5; url=../produits.php");
    exit();
}
?>
