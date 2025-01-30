
<?php

include("connect.php");

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_statut'] != '1') {
    header('Location: connexion.php');
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_produit = $_GET['id']; 

    try {
        
        $sql = "DELETE FROM Details_Commande WHERE id_produit = :id_produit";
        $statement_delete_details = $connect->prepare($sql);
        $statement_delete_details->execute([
            'id_produit' => $id_produit
        ]);

        $sql = "DELETE FROM Commande WHERE id_commande = :id_commande";
        $statement_delete_order = $connect->prepare($sql);
        $statement_delete_order->execute(['id_commande' => $_SESSION['id_command']]);

        $sql = "DELETE FROM Produit WHERE id_produit = :id_produit";
        $statement_delete_produit = $connect->prepare($sql);
        $statement_delete_produit->execute(['id_produit' => $id_produit]);

        header('Location: gestion_boutique.php');
        exit();
    } catch(PDOException $e) {
        echo "Erreur de suppression : " . $e->getMessage();
    }
} else {
    echo "ID de produit non valide.";
}
?>
