<?php
// Inclure le template header
include("templates/header.php");

$find = false;
$data = array("name" => "Produit introuvable");
if (isset($_GET["id"])) {
    // Connexion à la base literie3000
    $dsn = "mysql:host=localhost;dbname=literie3000";
    $db = new PDO($dsn, "root", "");


    // RETROUVER LE PRODUIT SELECTIONNE

    // 1) On prépare la requête SQL avec des paramètres
    $query = $db->prepare("SELECT * FROM produits WHERE id= :id");
    // 2) On donne des valeurs à nos paramètres
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    // 3) On exécute notre requête préalablement préparée
    $query->execute();
    $produit = $query->fetch(); // Retourne un tableau associatif de la recette concernée ou false si il n'y a pas de correspondance


    if ($produit) {
        // nous avons trouvé le produit
        $find = true;
        $data = $produit;
    }
}


// METHODE POUR SUPPRIMER DE LA BDD


    // Requête de supression de la ligne de ma base de données

    // Connexion à la base literie3000
    $dsn = "mysql:host=localhost;dbname=literie3000";
    $db = new PDO($dsn, "root", "");

    // On prépare la méthode
    $suppr = $db->prepare("DELETE FROM `produits` WHERE `id` = :id");

    $suppr->bindParam(":id", $id);

    // On exécute la méthode
    if ($suppr->execute()) {
        // La requête s'est bien déroulée, on affiche un message de confirmation
        echo ("Le produit a été supprimé");
    }

    ?>