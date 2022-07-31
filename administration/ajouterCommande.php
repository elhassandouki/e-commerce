<?php
namespace GestionStock\administration;
use GestionStock\Library\Commande as Commande;
use GestionStock\DA\CommandeDA as CommandeDA;
require_once '../library/Commande.php';
require_once '../DA/CommandeDA.php';

session_start();

$commande = $client = 0;
if(isset($_GET['client'])){
    $client = (int)$_GET['client']; 
}

$cmd = new Commande();
$cmd->setClient($client);

$cmdDA = new CommandeDA();
$commande = $cmdDA->ajouter($cmd);
if($commande != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Commande bien Ajouter.";
    header("location:selectionnerProduit.php?commande=$commande");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:selectionnerProduit.php?commande=$commande");
}

