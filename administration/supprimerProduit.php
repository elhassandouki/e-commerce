<?php
namespace GestionStock\administration;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Produit as Produit;
use GestionStock\DA\ProduitDA as ProduitDA;
require_once '../library/Connexion.php';
require_once '../library/Produit.php';
require_once '../DA/ProduitDA.php';

session_start();

$produitId = 0;

if(isset($_GET["produitId"])){
    $produitId = (int)$_GET["produitId"];
}

$prod = new Produit();
$prod->setproduitId($produitId);

$con = new Connexion("localhost","root","","site");

$prodDA = new ProduitDA($con);
$r = $prodDA->supprimer($prod);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Produit bien supprimer.";
    header("location:produits.php");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:produits.php");
}

