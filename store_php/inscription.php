<?php
    include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
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

    <form method="post">
        Pseudo: <input type="text" name="pseudo" ><br>
        Password: <input type="password" name="mdp" ><br>
        Name: <input type="text" name="nom"><br>
        First Name: <input type="text" name="prenom"><br>
        Email: <input type="text" name="email"><br>
        Gender: <select name="civilite">
            <option value="m">Male</option>
            <option value="f">Female</option>
        </select><br>
        City: <input type="text" name="ville"><br>
        Postal Code: <input type="text" name="code_postal"><br>
        Address: <input type="text" name="adresse"><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $civilite = $_POST['civilite'];
        $ville = $_POST['ville'];
        $code_postal = $_POST['code_postal'];
        $adresse = $_POST['adresse'];

        if(empty($_POST['pseudo']) || empty($_POST['mdp']) || empty($_POST['nom']) || empty($_POST['prenom']) | empty($_POST['email']) || empty($_POST['civilite']) || empty($_POST['ville']) || empty($_POST['code_postal']) || empty($_POST['adresse'])){
            echo "<script>alert(\"Tous les champs sont obligatoire\")</script>"; 
        }
        elseif(preg_match('/^[a-zA-Z]+$/g', $pseudo)){
            echo "le pseudo doit contenir que des lettre"; 
        }
        elseif(strlen($mdp) < 8){
            echo "le Mot de pass doit contenir 8 ou plus character"; 
        }
        elseif(preg_match('/^[a-zA-Z]+$/g', $nom)){
            echo "le nom doit contenir que des alphabet"; 
        }
        elseif(preg_match('/^[a-zA-Z]+$/g', $prenom)){
            echo "le nom doit contenir que des alphabet";
        }
        elseif(preg_match('/^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/g', $email)){
            echo "l'email doit avoir la forme example@example.com";
        }

        elseif(preg_match('/^[a-zA-Z]+$/g', $ville)){
            echo "la ville doit contenir que des alphabet";
        }
        elseif(preg_match('/^[0-9]{5}$/g', $code_postal)){
            echo "la code postal doit contenir que 5 digit";
        }
        else{
            try{
                $nom = ucfirst(strtolower($nom));
                $prenom = ucfirst(strtolower($prenom));
                $ville = ucfirst(strtolower($ville));

                $sql= "INSERT INTO Membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse);";
                $stmt = $connect->prepare($sql);
        
                $stmt->execute([
                    "pseudo"=>$pseudo,
                    "mdp"=> $mdp,
                    "nom"=>$nom,
                        "prenom"=>$prenom,
                        "email"=>$email,
                        "civilite"=>$civilite,
                        "ville"=>$ville,
                            "code_postal"=>$code_postal,
                            "adresse"=>$adresse
                ]);
                header("Location: connexion.php");
                exit();
            }
            catch(PDOException){
                echo "non accepter";
            }
        }
    }
?>