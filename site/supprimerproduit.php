<?php
namespace GestionStock\Site;
use GestionStock\DA\ProduitDA as ProduitDA;
require_once '../DA/ProduitDA.php';
session_start();
$reference = 0;
if(isset($_GET['id'])){
    $reference = (int)$_GET['id'];
}
if(isset($_SESSION['count_produit'])){
    $count_produit = (int)$_SESSION['count_produit'];
    $prodDA = new ProduitDA();
    $count_produit -= $prodDA->supprimerProduitLignesSession($reference, session_id());
    $_SESSION['count_produit'] = $count_produit;
}
header('Location:details.php');
exit;

