<?php
namespace GestionStock\administration;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ClientDA as ClientDA;
require_once '../library/Client.php';
require_once '../DA/ClientDA.php';

session_start();

$civilite = $nom = $prenom = $dateNaissance = $ville = $codepostal = $adresse = $nomadresse = $telephone = 
$email = $password = ""; 
$clientId = $administrateur = 0;

if(isset($_GET["clientId"])){
    $clientId = $_GET["clientId"];
}

if(isset($_POST["civilite"])){
    $civilite = $_POST["civilite"];
}

if(isset($_POST["nom"])){
    $nom = $_POST["nom"];
}
if(isset($_POST["prenom"])){
    $prenom = $_POST["prenom"];
}
if(isset($_POST["jour"]) && isset($_POST["mois"]) && isset($_POST["annee"]) ){
    $dateNaissance = $_POST["annee"] ."-". $_POST["mois"] ."-". $_POST["jour"];
}
if(isset($_POST["ville"])){
    $ville = $_POST["ville"];
}
if(isset($_POST["codepostal"])){
    $codepostal = $_POST["codepostal"];
}
if(isset($_POST["adresse"])){
    $adresse = $_POST["adresse"];
}
if(isset($_POST["nomadresse"])){
    $nomadresse = $_POST["nomadresse"];
}
if(isset($_POST["telephone"])){
    $telephone = $_POST["telephone"];
}
if(isset($_POST["email"])){
    $email = $_POST["email"];
}
if(isset($_POST["password"])){
    $password = $_POST["password"];
}
if(isset($_POST["administrateur"])){
    if($_POST["administrateur"]){
        $administrateur = 1;
    }
    else
    {
        $administrateur = 0;
    }
}

$cl = new Client();
$cl->setClientId($clientId);
$cl->setCivilite($civilite);
$cl->setNom($nom);
$cl->setPrenom($prenom);
$cl->setDateNaissance($dateNaissance);
$cl->setVille($ville);
$cl->setCodePostal($codepostal);
$cl->setAdresse($adresse);
$cl->setNomAdresse($nomadresse);
$cl->setTelephone($telephone);
$cl->setEmail($email);
$cl->setPassword($password);
$cl->setAdministrateur($administrateur);


$clDA = new ClientDA();
$r = $clDA->modifier($cl);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Client bien modifier";
    header("location:clients.php");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:clients.php");
}