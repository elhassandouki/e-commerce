<?php 
namespace GestionStock;
use GestionStock\Library\Client as Client;
use GestionStock\DA\CommandeDA as CommandeDA;
require_once '../library/Client.php';
require_once '../DA/CommandeDA.php';
session_start();
$c = null;
if(isset($_SESSION['client']))
{
   $c = $_SESSION['client'];
}
$cmdDA = new CommandeDA();
$cmdDA->ajoutercommande($c,session_id());

