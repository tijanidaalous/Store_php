<?php
include("connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produit = $_POST['id_produit'];
    $quantite = $_POST['quantite'];

    try {
        $sql = "SELECT * FROM Produit WHERE id_produit = :id";
        $statement_product = $connect->prepare($sql);
        $statement_product->execute(['id' => $id_produit]);
        $product = $statement_product->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $montant = $product['prix'] * $quantite;

            $sql = "INSERT INTO Commande (id_membre, montant, date_enregistrement) VALUES (:id_membre, :montant, :date_enregistrement)";
            $statement_order = $connect->prepare($sql);
            $statement_order->execute([
                'id_membre' => $_SESSION['user_id'],
                'montant' => $montant,
                'date_enregistrement' => date("Y-m-d H:i:s")
            ]);

            $id_commande = $connect->lastInsertId();
            $_SESSION["id_command"] = $id_commande;

            $sql = "INSERT INTO Details_Commande (id_commande, id_produit, quantite, prix) VALUES (:id_commande, :id_produit, :quantite, :prix)";
            $statement_details = $connect->prepare($sql);
            $statement_details->execute([
                "id_commande" => $id_commande,
                "id_produit" => $id_produit,
                "quantite" => $quantite,
                "prix" => $product['prix']
            ]);

            $sql = "SELECT c.id_commande, c.date_enregistrement, c.montant, dc.id_produit, dc.quantite, dc.prix, p.titre, p.categorie,
                           (dc.quantite * dc.prix) AS total
                    FROM Commande c
                    JOIN Details_Commande dc ON c.id_commande = dc.id_commande
                    JOIN Produit p ON dc.id_produit = p.id_produit
                    WHERE c.id_membre = :id_membre";
            $statement_orders = $connect->prepare($sql);
            $statement_orders->execute(['id_membre' => $_SESSION['user_id']]);
            $orders = $statement_orders->fetchAll(PDO::FETCH_ASSOC);

            $grand_total = 0;
            foreach ($orders as $order) {
                $grand_total += $order['total'];
            }
        }
        header("Location: fiche_produit.php");
        exit();
    }
        catch (PDOException $e){
            echo "query problem: " . $e->getMessage();
        }
        }
?>