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

$numeroLigne = 0;
$quantite = 0;

if(isset($_GET["numeroLigne"])){
    $numeroLigne = (int)$_GET["numeroLigne"];
}

if(isset($_POST["quantite"])){
    $quantite = (int)$_POST["quantite"];
}

$ligne = new Ligne();
$ligne->setNumero($numeroLigne);
$ligne->setQuantite($quantite);

$ligneDA = new LigneDA();
$r = $ligneDA->modifier($ligne);

if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Ligne bien modifier.";
    header("location:lignes.php?commande=".$commande);
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:lignes.php?commande=".$commande);
}




