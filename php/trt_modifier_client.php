<?php
// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inclure la connexion à la base de données
    require 'bdd.php';

    // Récupérer les données du formulaire
    $numcli = $_POST['numcli']; // Numéro du client
    $nom = $_POST['nom']; // Nom du client
    $prenom = $_POST['prenom']; // Prénom du client
    $adresse = $_POST['adresse']; // Adresse du client
    $telephone = $_POST['telephone']; // Téléphone du client

    // Préparer et exécuter la requête de mise à jour
    $query = "UPDATE client SET nom = ?, prenom = ?, adresse = ?, telephone = ? WHERE numcli = ?";
    $stmt = $bdd->prepare($query);
    $stmt->execute([$nom, $prenom, $adresse, $telephone, $numcli]);

    // Redirection après la modification
    echo "<script>alert('Modification effectuée avec succès.')</script>";
    header("refresh:.5; url=../clients.php");
    exit();
    
} else {
    // Redirection si le formulaire n'est pas soumis
    echo "<script>alert('Le formulaire n'a pas été soumis.')</script>";
    header("refresh:.5; url=../clients.php");
    exit();
}
?>
