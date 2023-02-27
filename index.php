<?php
// Connexion à la base literie3000
$dsn = "mysql:host=localhost;dbname=literie3000";
$db = new PDO($dsn, "root", "");

// DERNIERS MATELAS
// Récupérer les matelas de la table produits (pour l'affichage des derniers matelas)
$query = $db->query("SELECT * 
                    FROM produits
                    GROUP BY produits.id
                    ORDER BY produits.id DESC");

// Le paramètre PDO::FETCH_ASSOC permet de récupérer les résultats au format associatif et non les deux (sinon on se retrouve avec un mix tableau associatif et numérique en même temps)
$produits = $query->fetchAll(PDO::FETCH_ASSOC);


// Inclure le template header
include("templates/header.php");

?>
<div class="ajoutproduit">
    <div class="image">
        <img src="img/img.jpg" alt="Belle image de lit wahou">
    </div>
    <div class="bouton">
    <a href="ajout_produit.php"> <p>+</p> </a>
    </div>

</div>


<h1>Découvrez nos matelas</h1>
<div class="matelas">
    <?php
    foreach ($produits as $produit) {
    ?>
        <div class="produit">
            <h2>
                <?= $produit["nom"] ?>
            </h2>
            <a href="produit.php?id=<?= $produit["id"] ?>"> <img src="<?= $produit["photo"] ?>" alt="" class="recipe-picture"> </a>
        </div>
    <?php
    }
    ?>
</div>