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
        <a href="inscription.php">Inscription</a>
        <a href="connexion.php">Connexion</a>
    </nav>
        
    <h2>Connexion</h2>
    <form method="post">
        <label for="pseudo">Pseudo:</label>
        <input type="text" id="pseudo" name="pseudo" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        try{

            $erreur_connexion = false;
            $sql = "SELECT EXISTS (SELECT 1 FROM Membre WHERE pseudo = :pseudo)";
            $sqlex = $connect->prepare($sql);
            $sqlex->execute(["pseudo" => $pseudo]);

           
           if($sqlex) { 

                $sql = "SELECT * FROM Membre WHERE pseudo = :pseudo";
                $stmt = $connect->prepare($sql);
                $stmt->execute(["pseudo" => $pseudo]);
                $info = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($info && $password == $info["mdp"]) {
                    
                    $_SESSION["username"] = $info["pseudo"];
                    $_SESSION["email"] = $info["email"];
                    $_SESSION["city"] = $info["ville"];
                    $_SESSION["postalCode"] = $info["code_postal"];
                    $_SESSION["adresse"] = $info["adresse"];
                    $_SESSION['user_id'] = $info["id_membre"];
                    $_SESSION['user_statut'] = $info["statut"];
        
                    header('Location: profil.php');
                    exit();
                }
                else {
                    echo "<script>alert('LES DONNÉES SONT INVALIDES')</script>";
                    header('Location: connexion.php');

                }

           }
           else {
            echo "<script>alert('LES DONNÉES SONT INVALIDES')</script>";
            header('Location: connexion.php');
        }
        
        }
        catch(PDOException){
            echo "error de connection";
        }
    }
?>