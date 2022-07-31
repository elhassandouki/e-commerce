<?php
namespace GestionStock\Client;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ClientDA as ClientDA;
require '../library/Client.php';
require_once '../DA/ClientDA.php';
session_start();
$email = $password = "";
if(isset($_GET['e'])){
    $email = $_GET['e'];
}
if(isset($_GET['pw'])){
    $password = $_GET['pw'];
}
$client = new Client();
$client->setEmail($email);
$client->setPassword($password);
$clDA = new ClientDA();
$_SESSION['client'] = $clDA->isClient($client);
if(isset($_SESSION['client'])){
    header("location:mescommandes.php");
}
else {
     header("location:moncompte.php?compteinconnu=compteinconnu");
}



