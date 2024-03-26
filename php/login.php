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
        echo "<script>alert('Admin')</script>";
        header("refresh:0.5; url=../produits.php");
    } else {
        echo "<script>alert('Client')</script>";
        header("refresh:0.5; url=../index.php");
    }
} else {
    echo "<script>alert('Utilisateur non retrouvé')</script>";
    header("refresh:0.5; url=../index.php");
}
