<?php
include("connect.php");

try {
    $sql_categories = "SELECT DISTINCT categorie FROM Produit";
    $statement_categories = $connect->prepare($sql_categories);
    $statement_categories->execute();
    $categories = $statement_categories->fetchAll(PDO::FETCH_ASSOC);

    $selected_category = isset($_GET['categorie']) ? $_GET['categorie'] : false;

    if ($selected_category) {
        $sql_products = "SELECT * FROM Produit WHERE categorie = :categorie";
        $statement_products = $connect->prepare($sql_products);
        $statement_products->bindParam(':categorie', $selected_category);
    } else {
        $sql_products = "SELECT * FROM Produit";
        $statement_products = $connect->prepare($sql_products);
    }

    $statement_products->execute();
    $products = $statement_products->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erreur d'exécution de requête: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
        nav {
            background-color: #202b38;
            padding: 10px;
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        form {
            display: flex;
            background-color: rgba(54, 71, 92, 0.09);
            color: #dbdbdb;
            padding: 20px;
            box-shadow: 0 0 5px #526980;
            border-radius: 10px;
            margin: 20px;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="password"],
        input[type="file"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: #dbdbdb;
            cursor: pointer;
            align-self: center;
        }
        .categories {
            position: fixed;
            left: 0;
            top: 0;
            width: max-content;
            height: 100%;
            background: rgba(54, 71, 92, 0.09);
            padding: 20px;
        }
        .products {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            height: 100vh;
            padding: 20px;
        }
        .product {
            display: flex;
            text-align: center;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: max-content;
            padding: 20px;
            margin: 20px;
            border: 2px solid black;
        }
        .product img {
            width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <nav>
        <a href="profil.php">Profil</a>
        <a href="boutique.php">Boutique</a>
        <a href="gestion_boutique.php">Gestion Boutique</a>
        <a href="ajout_produit.php">Ajouter Produit</a>
        <a href="panier.php">Panier</a>
        <a href="deconnexion.php">Déconnecter</a>
    </nav>
    <div class="categories">
        <h3>Catégories</h3>
        <ul>
            <li><a href="boutique.php">all</a></li>
            <?php foreach ($categories as $category): ?>
                <li>
                    <a href="boutique.php?categorie=<?php echo htmlspecialchars($category['categorie']); ?>">
                        <?php echo htmlspecialchars($category['categorie']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h4><?php echo htmlspecialchars($product['titre']); ?></h4>
                <img src="<?php echo htmlspecialchars($product['photo']); ?>" alt="<?php echo htmlspecialchars($product['titre']); ?>">
                <p><?php echo htmlspecialchars($product['prix']); ?> €</p>
                <a href="fiche_produit.php?id=<?php echo htmlspecialchars($product['id_produit']); ?>">Voir la fiche</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
