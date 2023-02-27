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
    // $marque = trim(strip_tags($_POST["marque"]));

    $errors = [];

    // Valider que le champ nom est bien renseigné
    if (empty($nom)) {
        $errors["nom"] = "Veuillez entrer le nom du matelas";
    }; 

    if (empty($photo)) {
        $errors["photo"] = "Veuillez ajouter une photo du matelas";
    };

    // if (empty($marque)) {
    //     $errors["marque"] = "Veuillez entrer la marque du matelas";
    // };


    if (empty($prix)) {
        $errors["prix"] = "Veuillez indiquer le prix du matelas";
    };

     // Requête d'insertion en BDD (base de données) de la recette si il n'y a aucune erreur (si le tableau d'erreurs est vide)
     if (empty($errors)) {
        // Connexion à la base literie3000
        $dsn = "mysql:host=localhost;dbname=literie3000";
        $db = new PDO($dsn, "root", "");

        // On prépare la méthode
        $query = $db->prepare("INSERT INTO produits (nom, photo, prix, promo) VALUES (:nom, :photo, :prix, :promo)");

        $query->bindParam(":nom", $nom);
        $query->bindParam(":photo", $photo);
        $query->bindParam(":prix", $prix);
        $query->bindParam(":promo", $promo);
        // $query->bindParam(":marque", $marque);

        // On exécute la méthode
        if ($query->execute()) {
            // La requête s'est bien déroulée, on affiche un message de confirmation
            echo("Le produit a été ajouté");
        }
    }
}

?>

<h1>Ajouter un produit au catalogue</h1>

<form action="" method="post" >
    <div class="form-group">
        <label for="inputName">Nom du produit :</label>
        <input type="text" id="inputName" name="nom" value="<?= isset($name) ? $nom : "" ?>">
        <?php
        if (isset($errors["name"])) {
        ?>
            <span class="info-error"><?= $errors["name"] ?></span>
        <?php
        }
        ?>
    </div>

    <div class="form-group">
        <label for="inputPhoto">Photo du produit :</label>
        <input type="text" id="inputPhoto" name="photo" value="<?= isset($photo) ? $photo : "" ?>">
        <?php
        if (isset($errors["photo"])) {
        ?>
            <span class="info-error"><?= $errors["photo"] ?></span>
        <?php
        }
        ?>
    </div>

    <!-- <div class="form-group">
        <label for="inputMarque">Marque du produit :</label>
        <input type="text" id="inputMarque" name="marque" value="<?= isset($marque) ? $marque : "" ?>">
        <?php
        if (isset($errors["marque"])) {
        ?>
            <span class="info-error"><?= $errors["marque"] ?></span>
        <?php
        }
        ?>
    </div> -->

    <div class="form-group">
        <label for="inputPrix">Prix du produit :</label>
        <input type="text" id="inputPrix" name="prix" value="<?= isset($prix) ? $prix : "" ?>">
        <?php
        if (isset($errors["prix"])) {
        ?>
            <span class="info-error"><?= $errors["prix"] ?></span>
        <?php
        }
        ?>
    </div>

    <div class="form-group">
        <label for="inputPromo">Promotion :</label>
        <input type="text" id="inputPromo" name="promo" value="">
    </div>

   

    <input type="submit" value="Ajouter le produit" class="bouton">

</form>