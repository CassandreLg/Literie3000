<?php
// Inclure le template header
include("templates/header.php");

if (!empty($_POST)) {
    // Le formulaire est envoyé
    // Utilisation de la fonction strip_tags pour supprimer d'éventuelles balises html qui se seraient glissées dans le champ de saisie (pour la sécurité, pour pallier à la faille XSS)
    // Utilisation de la fonction trim pour supprimer d'éventuels espaces en début et fin de chaine
    $nom = trim(strip_tags($_POST["nom"]));
    $photo = trim(strip_tags($_POST["photo"]));
    $prix = trim(strip_tags($_POST["prix"]));
    $promo = trim(strip_tags($_POST["promo"]));
    $marque = trim(strip_tags($_POST["marque"]));

    $errors = [];

    // Valider que le champ nom est bien renseigné
    if (empty($nom)) {
        $errors["nom"] = "Veuillez entrer le nom du matelas";
    }

     // Requête d'insertion en BDD (base de données) de la recette si il n'y a aucune erreur (si le tableau d'erreurs est vide)
     if (empty($errors)) {
        // Connexion à la base literie3000
        $dsn = "mysql:host=localhost;dbname=literie3000";
        $db = new PDO($dsn, "root", "");

        // On prépare la méthode
        $query = $db->prepare("INSERT INTO produits (nom, photo, prix, promo, marque) VALUES (:nom, :photo, :prix, :promo, :marque)");

        $query->bindParam(":nom", $nom);
        $query->bindParam(":photo", $photo);
        $query->bindParam(":prix", $prix);
        $query->bindParam(":promo", $promo);
        $query->bindParam(":marque", $marque);

        // On exécute la méthode
        if ($query->execute()) {
            // La requête s'est bien déroulée, on affiche un message de confirmation
            echo("Le produit a été ajouté");
        }
    }
}

?>

<h1>Ajouter un produit au catalogue</h1>