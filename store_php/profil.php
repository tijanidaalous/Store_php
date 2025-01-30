<?php
    include("connect.php");

    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
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
        <a href="gestion_boutique.php">gestion boutique</a>
        <a href="ajout_produit.php">Ajouter Produit</a>
        <a href="panier.php">Panier</a>
        <a href="deconnexion.php">Deconnecter</a>
    </nav>
    <h2>Bonjour <?php echo $_SESSION["username"]; ?></h2>
    <div>
        <table border="">
                <tr><th>vos informations du profil</th></tr>            
                <tr><td>votre email : <?php echo $_SESSION["email"]; ?></td></tr>
                <tr><td>votre ville est : <?php echo $_SESSION["city"]; ?></td></tr>
                <tr><td> votre cp est : <?php echo $_SESSION["postalCode"]; ?></td></tr>
                <tr><td>votre adresse est : <?php echo $_SESSION["adresse"]; ?></td></tr>
            </tbody>
        </table>
    </div>
        
    
</body>
</html>