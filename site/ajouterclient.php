<?php
namespace GestionStock\Client;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ClientDA as ClientDA;
require_once '../library/Client.php';
require_once '../DA/ClientDA.php';
session_start();
$c = new Client();
$c->setCivilite($_POST["civilite"]);
$c->setNom($_POST["nom"]);
$c->setPrenom($_POST["prenom"]);
$c->setTelephone($_POST["tel"]);
$c->setEmail($_POST["email"]);
$c->setPassword($_POST["pw"]);
$c->setVille($_POST["ville"]);
$c->setCodePostal($_POST["cp"]);
$c->setDateNaissance($_POST['years'].'-'.$_POST['months'].'-'.$_POST['days']);
$c->setAdresse($_POST["adrfacture"]);
$c->setNomAdresse($_POST["nomadr"]);
$c->setAdministrateur(0);
$clDA = new ClientDA();
$_SESSION['client'] = $clDA->ajouterClient($c);
if(isset($_SESSION['client'])){
    header("location:mescommandes.php");
}
else {
     header("location:moncompte.php");
}
exit;