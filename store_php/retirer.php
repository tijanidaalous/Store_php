<?php
include("connect.php");
session_start();

if (isset($_GET['id']) && isset($_GET['id_commande'])) {
    $id_produit = $_GET['id'];
    $id_commande = $_GET['id_commande'];

    try {

            $sql = "DELETE FROM Details_Commande WHERE id_commande = :id_commande AND id_produit = :id_produit";
            $statement_delete = $connect->prepare($sql);
            $statement_delete->execute([
                'id_commande' => $id_commande,
                'id_produit' => $id_produit
            ]);
             
            
            $sql = "DELETE FROM Commande WHERE id_commande = :id_commande";
            $statement_delete_order = $connect->prepare($sql);
            $statement_delete_order->execute(['id_commande' => $id_commande]);
            

            header("Location: panier.php");
            exit();

    } catch(PDOException $e) {
        header("Location: panier.php");
        exit();
    }}
 else {
    header("Location: panier.php");
    exit();
}
?>