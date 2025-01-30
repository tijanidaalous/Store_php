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

    foreach ($orders as $order) {
        $sql = "UPDATE Produit SET stock = stock - :quantite WHERE id_produit = :id_produit";
        $statement_update = $connect->prepare($sql);
        $statement_update->execute([
            'quantite' => $order['quantite'],
            'id_produit' => $order['id_produit']
        ]);
    }

    echo "<script> commande cnfirmer</script>";
    header("Location: panier.php");
} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
}
?>
