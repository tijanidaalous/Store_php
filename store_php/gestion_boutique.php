<?php
    include("connect.php");

    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['user_statut'] != '1') {
        header('Location: connexion.php');
        exit();
    }
    
    try {
        
        $sql = "SELECT * FROM Produit";
        $statement = $connect->prepare($sql);
        $statement->execute();
        $produits = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Boutique</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
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
    <h2>Gestion de Boutique</h2>
    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Catégorie</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>Public</th>
                <th>Photo</th>
                <th>Prix</th>
                <th>Quantité en stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($produits as $produit){ ?>
            <tr>
                <td><?php echo $produit["reference"]; ?></td>
                <td><?php echo $produit["categorie"]; ?></td>
                <td><?php echo $produit["titre"]; ?></td>
                <td><?php echo $produit["description"]; ?></td>
                <td><?php echo $produit["couleur"]; ?></td>
                <td><?php echo $produit["taille"]; ?></td>
                <td><?php echo $produit["public"]; ?></td>
                <td><img src="<?php echo $produit["photo"]; ?>" alt="Photo du produit"></td>
                <td><?php echo $produit["prix"]; ?></td>
                <td><?php echo $produit["stock"]; ?></td>
                <td>
                    <a href="modifier_produit.php?id=<?php echo $produit["id_produit"]; ?>">Modifier</a> |
                    <a href="supprimer_produit.php?id=<?php echo $produit["id_produit"]; ?>">Supprimer</a>
                </td>
            </tr>
            <?php }
                } catch(PDOException $e) {
                    echo "Erreur de requperatopn des la base de données: " . $e->getMessage();
                }            
            ?>
        </tbody>
    </table>
</body>
</html>