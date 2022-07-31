<?php
namespace GestionStock\Site;
use GestionStock\DA\LigneDA as LigneDA;
require_once '../DA/LigneDA.php';
session_start();
$reference = 0;
if(isset($_GET['id'])){
    $reference = (int)$_GET['id'];
}
$lDA = new LigneDA();
$r = $lDA->ajouterLigneSession($reference, session_id());
if($r != 0){
    $count_produit = 1;
    if(isset($_SESSION['count_produit'])){
        $count_produit = (int)$_SESSION['count_produit'];
        $count_produit++;
    }
    $_SESSION['count_produit'] = $count_produit;
    echo '<a href="details.php">Mon panier ( '.$count_produit.' )</a>';
}