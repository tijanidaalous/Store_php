<?php
include("connect.php");
session_start();

// Vérifie si l'utilisateur est connecté et s'il a le statut d'administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['user_statut'] != '1') {
    header('Location: connexion.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter produit</title>
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
    <!-- <link /rel="stylesheet" href="style.css"> -->
</head>
<body>
    <nav>
        <a href="profil.php">Profil</a>
        <a href="boutique.php">Boutique</a>
        <a href="gestion_boutique.php">gestion boutique</a>
        <a href="ajout_produit.php">Ajouter Produit</a>
        <a href="deconnexion.php">Deconnecter</a>
    </nav>
    
    <h2>Ajouter produit</h2>

    <form method="post" enctype="multipart/form-data">
        <label for="reference">Référence:</label>
        <input type="text" id="reference" name="reference" required><br><br>

        <label for="categorie">Catégorie:</label>
        <input type="text" id="categorie" name="categorie" required><br><br>

        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <label for="couleur">Couleur:</label>
        <input type="text" id="couleur" name="couleur"><br><br>

        <label for="taille">Taille:</label>
        <input type="text" id="taille" name="taille"><br><br>

        <label for="public">Public cible:</label>
        <select id="public" name="public">
            <option value="m">Homme</option>
            <option value="f">Femme</option>
            <option value="mixte">Mixte</option>
        </select><br><br>

        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required><br><br>

        <label for="prix">Prix:</label>
        <input type="text" id="prix" name="prix" required><br><br>

        <label for="quantite">Quantité en stock:</label>
        <input type="number" id="quantite" name="quantite" min="0" required><br><br>

        <button type="submit">Ajouter le produit</button>
    </form>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reference = $_POST['reference'];
        $categorie = $_POST['categorie'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $couleur = $_POST['couleur'];
        $taille = $_POST['taille'];
        $public = $_POST['public'];
        $prix = $_POST['prix'];
        $quantite = $_POST['quantite'];
    
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photo_tmp = $_FILES['photo']['tmp_name'];
            $photo_name = $_FILES['photo']['name'];
            $photo_path = 'uploads/' . $photo_name; 
            move_uploaded_file($photo_tmp, $photo_path);
        } else {
            echo "<script>alert('Erreur lors de l'upload de la photo.')</script>";
        }
    
        try {
    
            $sql = "INSERT INTO Produit (reference, categorie, titre, description, couleur, taille, public, photo, prix, stock)
                    VALUES (:reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :quantite)";
            
            $statement = $connect->prepare($sql);
    
            $statement->bindParam(':reference', $reference);
            $statement->bindParam(':categorie', $categorie);
            $statement->bindParam(':titre', $titre);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':couleur', $couleur);
            $statement->bindParam(':taille', $taille);
            $statement->bindParam(':public', $public);
            $statement->bindParam(':photo', $photo_path);
            $statement->bindParam(':prix', $prix);
            $statement->bindParam(':quantite', $quantite);
    
            $statement->execute();
            echo "<script>alert('Produit ajouté avec succès!')</script>";
        } 
        catch (PDOException) {
            echo "<script>alert('Erreur de connexion à la base de données:') </script>";
            header('Location: ajout_produit.php');
        }
    }
?>
