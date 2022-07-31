<?php
namespace GestionStock\administration;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Produit as Produit;
use GestionStock\DA\ProduitDA as ProduitDA;
require_once '../library/Connexion.php';
require_once '../library/Produit.php';
require_once '../DA/ProduitDA.php';

session_start();

$produitId = $marque = $categorie = $prixUnitaire = $stock = $numero = 0;
$designation = $image = $img = "";

if(isset($_GET["numero"])){
    $numero = (int)$_GET["numero"];
}
if(isset($_POST["img$numero"])){
    $img = $_POST["img$numero"];
}
$target_dir = "images/Produits/";
$image = $_FILES["fileToUpload$numero"]["name"];
if($image == ""){
    $image = $img;
}
else{
    $file_tmp_name = $_FILES["fileToUpload$numero"]["tmp_name"];
    move_uploaded_file($file_tmp_name, $target_dir.$image);
}

if(isset($_GET["produitId"])){
    $produitId = (int)$_GET["produitId"];
}

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

$prod = new Produit();
$prod->setproduitId($produitId);
$prod->setImage($image);
$prod->setDesignation($designation);
$prod->setMarque($marque);
$prod->setCategorie($categorie);
$prod->setPrixUnitaire($prixUnitaire);
$prod->setStock($stock);

$con = new Connexion("localhost","root","","site");

$prodDA = new ProduitDA($con);
$r = $prodDA->modifier($prod);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Produit bien ajouter.";
    header("location:produits.php");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:produits.php");
}