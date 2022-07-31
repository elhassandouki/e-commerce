<?php
namespace GestionStock\administration;
use GestionStock\Library\Ligne as Ligne;
use GestionStock\DA\LigneDA as LigneDA;
require_once '../library/Ligne.php';
require_once '../DA/LigneDA.php';

session_start();

$commande = 0;
if(isset($_GET["commande"])){
    $commande = (int)$_GET["commande"];
}
$produit = $quantite = $numero = 0;
if(isset($_GET["produit"])){
    $produit = (int)$_GET["produit"];
}
if(isset($_GET["numero"])){
    $numero = (int)$_GET["numero"];
}

if(isset($_POST["quantite$numero"])){
    $quantite = (int)$_POST["quantite$numero"];
}

$ligne = new Ligne();
$ligne->setCommande($commande);
$ligne->setProduit($produit);
$ligne->setQuantite($quantite);

$ligneDA = new LigneDA();
$r = $ligneDA->ajouter($ligne);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Ligne bien ajouter.";
    header("location:selectionnerProduit.php?commande=".$commande);
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:selectionnerProduit.php?commande=".$commande);
}