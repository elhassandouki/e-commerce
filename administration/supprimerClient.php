<?php
namespace GestionStock\administration;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ClientDA as ClientDA;
require_once '../library/Client.php';
require_once '../DA/ClientDA.php';

session_start();

$clientId = 0;

if(isset($_GET["clientId"])){
    $clientId = (int)$_GET["clientId"];
}

$cl = new Client();
$cl->setClientId($clientId);

$clDA = new ClientDA();
$r = $clDA->supprimer($cl);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Client bien supprimer.";
    header("location:clients.php");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:clients.php");
}


