<?php
require 'bdd.php';
$email = $_POST['email'];
$mdp = $_POST['mdp'];

$req = "SELECT * FROM utilisateur WHERE email = '$email' AND mdp = '$mdp'";
$stmt = $bdd->prepare($req);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $result  = $stmt->fetch();
    if ($result['profil'] === "Admin") {
        echo "<script>alert('Bienvenus chère Admin')</script>";
        header("refresh:0.5; url=../produits.php");
    } else {
        #je récupère son compte client afin d'avoir son numcli

        $req_client = "SELECT * FROM client WHERE email = '$email'";
        $stmt_client = $bdd->prepare($req_client);
        $stmt_client->execute();
        if ($stmt_client->rowCount() > 0) {
            $user_info = $stmt_client->fetch();
            #on démmare une session et on passe numcli dans la variable global grâce à $user_info qui contient les informations récupéré de la table client
            #Ce si nous permettra d'avoir numcli sur toute les page on écrira session_start() si le client se connecte
            #Ainsi on pourra utiliser numcli lors du placement de sa commande
            session_start();
            $_SESSION['numcli'] = $user_info['numcli'];
            $nom = $user_info['nom'];
            #on le redirige en suite
            echo "<script>alert('Bienvenus $nom')</script>";
            header("refresh:0.1; url=../recherche_produit.php");
        }
    }
} else {
    echo "<script>alert('Utilisateur non retrouvé, veuillez renseigner les bons identifiant')</script>";
    header("refresh:0.5; url=../index.php");
}
