<?php
namespace GestionStock\administration;
use GestionStock\Library\Commande as Commande;
use GestionStock\DA\CommandeDA as CommandeDA;
require_once '../library/Commande.php';
require_once '../DA/CommandeDA.php';

session_start();

$codeCommande = $client = 0;

if(isset($_GET["codeCommande"])){
    $codeCommande = (int)$_GET["codeCommande"];
}

if(isset($_POST["client"])){
    $client = (int)$_POST["client"];
}

echo $client;

$cmd = new Commande();
$cmd->setCodeCommande($codeCommande);

$cmdDA = new CommandeDA();
$r = $cmdDA->supprimer($cmd);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Commande bien supprimer.";
    header("location:commandes.php");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:commandes.php");
}





