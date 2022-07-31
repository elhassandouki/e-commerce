<?php
namespace GestionStock\administrateur;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Categorie as Categorie;
use GestionStock\DA\CategorieDA as CategorieDA;
require_once '../library/Connexion.php';
require_once '../library/Categorie.php';
require_once '../DA/CategorieDA.php';

session_start();

$categorieId = 0;

if(isset($_GET["categorieId"])){
    $categorieId = (int)$_GET["categorieId"];
}

$cat = new Categorie();
$cat->setCategorieId($categorieId);

$con = new Connexion("localhost","root","","site");

$catDA = new CategorieDA($con);
$r = $catDA->supprimer($cat);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Categorie bien supprimer.";
    header("location:categories.php");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:categories.php");
}