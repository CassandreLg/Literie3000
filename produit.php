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


?>


<!-- PARTIE AFFICHAGE -->

<h1><?= $data["nom"] ?></h1>
<?php
if ($find) {
?>
    <div class="produit">
        <img src="<?= $data["photo"] ?>" alt="" class="image-produit">
        <p><?= $data["prix"] ?> €</p>
        <p><?= $data["promo"] ?> €</p>

        <a href="delete.php" class="bouton"> Supprimer le produit </a>

        <form action="" method="post">
            <input type="submit" value="Modifier le produit" class="bouton">
        </form>
    </div>


<?php
}
