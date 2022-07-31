<?php
namespace GestionStock\administration;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Produit as Produit;
use GestionStock\DA\ProduitDA as ProduitDA;
require_once '../library/Connexion.php';
require_once '../library/Produit.php';
require_once '../DA/ProduitDA.php';

session_start();

$produitId = $marque = $categorie = $prixUnitaire = $stock = 0;
$designation = $image = "";

$target_dir = "images/Produits/";
$image = $_FILES["ajouterimage"]["name"];
$file_tmp_name = $_FILES["ajouterimage"]["tmp_name"];
move_uploaded_file($file_tmp_name, $target_dir.$image);

if(isset($_POST["designation"])){
    $designation = $_POST["designation"];
}
if(isset($_POST["marque"])){
    $marque = $_POST["marque"];
}
if(isset($_POST["categorie"])){
    $categorie = $_POST["categorie"];
}
if(isset($_POST["prixUnitaire"])){
    $prixUnitaire = $_POST["prixUnitaire"];
}
if(isset($_POST["stock"])){
    $stock = $_POST["stock"];
}

//echo $produitId ."</br>"; echo $designation."</br>"; echo $marque."</br>"; echo $categorie."</br>";
//echo $prixUnitaire ."</br>"; echo $stock."</br>"; 

$prod = new Produit();
$prod->setImage($image);
$prod->setDesignation($designation);
$prod->setMarque($marque);
$prod->setCategorie($categorie);
$prod->setPrixUnitaire($prixUnitaire);
$prod->setStock($stock);

$con = new Connexion("localhost","root","","site");

$prodDA = new ProduitDA($con);
    $r = $prodDA->ajouter($prod);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Produit bien ajouter";
    header("location:produits.php");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:produits.php");
}

