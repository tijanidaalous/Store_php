<?php
include("connect.php");

session_start();

$id_produit = $_GET['id'];


try {
    $sql_product = "SELECT * FROM Produit WHERE id_produit = :id";
    $statement_product = $connect->prepare($sql_product);
    $statement_product->bindParam(':id', $id_produit);
    $statement_product->execute();
    $product = $statement_product->fetch(PDO::FETCH_ASSOC);

    $_SESSION["id_produit"] = $product['id_produit'];

    if (!$product) {
        header('Location: boutique.php');
        exit();
    }
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['titre']); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <style>
        nav {
            
            background-color: #202b38;
            padding: 10px;
            text-align: center;
        }

        h2{
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
            /* border: 1px solid #dbdbdb; */
            box-shadow: 0 0 5px #526980;;
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
        input[type="password"],input[type="file"],select {
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
        /* Add your CSS styling here */
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
        .product-info img {
            width: 300px;
            height: auto;
        }
        .product-info form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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

    <div class="product-detail">
        <h2><?php echo htmlspecialchars($product['titre']); ?></h2>
        <div class="product-info">
            <img src="<?php echo htmlspecialchars($product['photo']); ?>" alt="<?php echo htmlspecialchars($product['titre']); ?>">
            <p>Catégorie: <?php echo htmlspecialchars($product['categorie']); ?></p>
            <p>Couleur: <?php echo htmlspecialchars($product['couleur']); ?></p>
            <p>Taille: <?php echo htmlspecialchars($product['taille']); ?></p>
            <p>Description: <?php echo htmlspecialchars($product['description']); ?></p>
            <p>Prix: <?php echo htmlspecialchars($product['prix']); ?> €</p>
            <p>Nombre de produits disponible: <?php echo htmlspecialchars($product['stock']); ?></p>
            <form action="ajouter_auxpanier.php" method="post">
                <input type="hidden" name="id_produit" value="<?php echo htmlspecialchars($product['id_produit']); ?>">
                <label for="quantite">Quantité:</label>
                <input type="number" id="quantite" name="quantite" class="quantity" value="1" min="1" max="<?php echo htmlspecialchars($product['stock']); ?>">
                <button type="submit">Ajouter au panier</button>
            </form>
            <a href="boutique.php?categorie=<?php echo htmlspecialchars($product['categorie']); ?>">Retour vers la sélection de <?php echo htmlspecialchars($product['categorie']); ?></a>
        </div>
    </div>
</body>
</html>
