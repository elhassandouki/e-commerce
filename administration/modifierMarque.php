<?php
namespace GestionStock\administrateur;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Marque as Marque;
use GestionStock\DA\MarqueDA as MarqueDA;
require_once '../library/Connexion.php';
require_once '../library/Marque.php';
require_once '../DA/MarqueDA.php';

session_start();

$marqueId = 0;
$marque = "";

if(isset($_GET["marqueId"])){
    $marqueId = (int)$_GET["marqueId"];
}
if(isset($_POST["marque"])){
    $marque = $_POST["marque"];
}

$marq = new Marque();
$marq->setMarqueId($marqueId);
$marq->setMarque($marque);

$con = new Connexion("localhost","root","","site");

$marqDA = new MarqueDA($con);
$r = $marqDA->modifier($marq);
if($r != 0){
    $_SESSION['messageError'] = null;
    $_SESSION['message'] = "Marque bien ajouter.";
    header("location:marques.php");
}
else
{
    $_SESSION['message'] = null;
    $_SESSION['messageError'] = "Opération échoue.";
    header("location:marques.php");
}

