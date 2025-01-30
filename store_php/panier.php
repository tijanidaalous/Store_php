<?php
include("connect.php");
session_start();

try {
    $sql = "SELECT c.id_commande, c.date_enregistrement, c.montant, dc.id_produit, dc.quantite, dc.prix, p.titre, p.categorie,
                   (dc.quantite * dc.prix) AS total
            FROM Commande c
            JOIN Details_Commande dc ON c.id_commande = dc.id_commande
            JOIN Produit p ON dc.id_produit = p.id_produit
            WHERE c.id_membre = :id_membre";
    $statement_orders = $connect->prepare($sql);
    $statement_orders->execute(['id_membre' => $_SESSION['user_id']]);
    $orders = $statement_orders->fetchAll(PDO::FETCH_ASSOC);

    // Calculate the grand total
    $grand_total = 0;
    foreach ($orders as $order) {
        $grand_total += $order['total'];
    }
} catch(PDOException $e) {
    echo "Erreur SQL: " . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
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
        <a href="gestion_boutique.php">gestion boutique</a>
        <a href="ajout_produit.php">Ajouter Produit</a>
        <a href="panier.php">Panier</a>
        <a href="deconnexion.php">Deconnecter</a>
    </nav>
    <div class="container">
        <h2>Votre Panier</h2>
        <table>
            <thead>
                <tr>
                    <th>Commande ID</th>
                    <th>Date</th>
                    <th>Titre</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id_commande']); ?></td>
                        <td><?php echo htmlspecialchars($order['date_enregistrement']); ?></td>
                        <td><?php echo htmlspecialchars($order['titre']); ?></td>
                        <td><?php echo htmlspecialchars($order['prix']); ?> €</td>
                        <td><?php echo htmlspecialchars($order['quantite']); ?></td>
                        <td><?php echo htmlspecialchars($order['total']); ?> €</td>
                        <td class="action"><a href="retirer.php?id=<?php echo htmlspecialchars($order['id_produit']); ?>&id_commande=<?php echo htmlspecialchars($order['id_commande']); ?>">Retirer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="grand-total">
            <strong>Total à payer: <?php echo htmlspecialchars($grand_total); ?> €</strong>
            <button><a onclick="alert('commande confirmer')" href="confirmer.php">Confirmer</a></button>
        </div>
        <a href="boutique.php">Retour à la boutique</a>
    </div>
</body>
</html>
