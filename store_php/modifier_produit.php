<?php
    include("connect.php");

    session_start();

    if (!isset($_SESSION['user_id']) || $_SESSION['user_statut'] != '1') {
        header('Location: connexion.php');
        exit();
    }

    $id_produit = $_GET['id'];

    try {
        $sql_select = "SELECT * FROM Produit WHERE id_produit = :id";
        $statement_select = $connect->prepare($sql_select);
        $statement_select->bindParam(':id', $id_produit);
        $statement_select->execute();
        $produit = $statement_select->fetch(PDO::FETCH_ASSOC);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le produit</title>
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
    <h2>Modifier le produit</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . htmlspecialchars($id_produit); ?>" method="post" enctype="multipart/form-data">
        <label for="reference">Référence:</label>
        <input type="text" id="reference" name="reference" value="<?php echo htmlspecialchars($produit['reference']); ?>" required><br><br>

        <label for="categorie">Catégorie:</label>
        <input type="text" id="categorie" name="categorie" value="<?php echo htmlspecialchars($produit['categorie']); ?>" required><br><br>

        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($produit['titre']); ?>" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required><?php echo htmlspecialchars($produit['description']); ?></textarea><br><br>

        <label for="couleur">Couleur:</label>
        <input type="text" id="couleur" name="couleur" value="<?php echo htmlspecialchars($produit['couleur']); ?>"><br><br>

        <label for="taille">Taille:</label>
        <input type="text" id="taille" name="taille" value="<?php echo htmlspecialchars($produit['taille']); ?>"><br><br>

        <label for="public">Public cible:</label>
        <select id="public" name="public">
            <option value="m" <?php if ($produit['public'] === 'm') echo 'selected'; ?>>Homme</option>
            <option value="f" <?php if ($produit['public'] === 'f') echo 'selected'; ?>>Femme</option>
            <option value="mixte" <?php if ($produit['public'] === 'mixte') echo 'selected'; ?>>Mixte</option>
        </select><br><br>
        
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required><br><br>
        
        <img src="<?php echo $produit["photo"]; ?>" alt="Photo du produit"><br><br>

        <label for="prix">Prix:</label>
        <input type="text" id="prix" name="prix" value="<?php echo htmlspecialchars($produit['prix']); ?>" required><br><br>

        <label for="quantite">Quantité en stock:</label>
        <input type="number" id="quantite" name="quantite" value="<?php echo htmlspecialchars($produit['stock']); ?>" required><br><br>

        <button type="submit">Modifier le produit</button>
    </form>
</body>
</html>
<?php

        if (!$produit) {
            header('Location: gestion_boutique.php');
            exit();
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $photo_tmp = $_FILES['photo']['tmp_name'];
                $photo_name = $_FILES['photo']['name'];
                $photo_path = 'uploads/' . $photo_name; // Dossier où sera stockée la photo
                move_uploaded_file($photo_tmp, $photo_path);
            } else {
                echo "<script>alert('Erreur lors de l'upload de la photo.')</script>";
            }
    
            $reference = $_POST['reference'];
            $categorie = $_POST['categorie'];
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $couleur = $_POST['couleur'];
            $taille = $_POST['taille'];
            $public = $_POST['public'];
            $prix = $_POST['prix'];
            $quantite = $_POST['quantite'];
    
            $sql_update = "UPDATE Produit SET 
                            reference = :reference,
                            categorie = :categorie,
                            titre = :titre,
                            description = :description,
                            couleur = :couleur,
                            taille = :taille,
                            public = :public,
                            photo = :photo,
                            prix = :prix,
                            stock = :quantite
                          WHERE id_produit = :id";
            
            $statement_update = $connect->prepare($sql_update);
            $statement_update->bindParam(':reference', $reference);
            $statement_update->bindParam(':categorie', $categorie);
            $statement_update->bindParam(':titre', $titre);
            $statement_update->bindParam(':description', $description);
            $statement_update->bindParam(':couleur', $couleur);
            $statement_update->bindParam(':taille', $taille);
            $statement_update->bindParam(':public', $public);
            $statement_update->bindParam(':prix', $prix);
            $statement_update->bindParam(':photo', $photo_path);
            $statement_update->bindParam(':quantite', $quantite);
            $statement_update->bindParam(':id', $id_produit);
            
            $statement_update->execute();
    
            header('Location: gestion_boutique.php');
            exit();
        }
    } catch(PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
    }
?>
