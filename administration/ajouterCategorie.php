<?php
namespace GestionStock\administrateur;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Categorie as Categorie;
use GestionStock\DA\CategorieDA as CategorieDA;
require_once '../library/Connexion.php';
require_once '../library/Categorie.php';
require_once '../DA/CategorieDA.php';

session_start();

$categorie = $parentCategorie = "";
if(isset($_POST["categorie"])){
    $categorie = $_POST["categorie"];
}
if(isset($_POST["parentCategorie"])){
    $parentCategorie = $_POST["parentCategorie"];
}


$cat = new Categorie();
$cat->setCategorie($categorie);
$cat->setParent($parentCategorie);

$con = new Connexion("localhost","root","","site");

$catDA = new CategorieDA($con);
$r = $catDA->ajouter($cat);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Categorie bien ajouter";
    header("location:categories.php");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:categories.php");
}
