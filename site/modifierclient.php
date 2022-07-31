<?php
namespace GestionStock\Client;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ClientDA as ClientDA;
require_once '../library/Client.php';
require_once '../DA/ClientDA.php';
session_start();
$c = null;
$email = "";
$password = "";
if(isset($_POST['currentpw']) && isset($_POST['currentemail'])){
    $email = $_POST['currentemail'];
    $password = $_POST['currentpw'];
}
if(isset($_SESSION['client'])){
        $c = $_SESSION['client'];
        if($email == $c->getEmail() && $password == $c->getPassword() ){

            // Modifier mes coordonees
            
            if(isset($_POST['civilite'])){
                $c->setCivilite($_POST['civilite']);
            }
            if(isset($_POST['nom'])){
                $c->setNom($_POST['nom']);
            }
            if(isset($_POST['prenom'])){
                $c->setPrenom($_POST['prenom']);
            }
            if(isset($_POST['tel'])){
                $c->setTelephone($_POST['tel']);
            }
            $c->setDateNaissance($_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']);
            if(isset($_POST['newpw'])){
                $c->setPassword($_POST['newpw']);
            }
            if(isset($_POST['newemail'])){
                $c->setEmail($_POST['newemail']);
            }
        }
            // Modifier mes adresses
            
            if(isset($_POST['ville'])){
                $c->setVille($_POST['ville']);
            }
            
            if(isset($_POST['cp'])){
                $c->setCodePostal($_POST['cp']);
            }
            
            if(isset($_POST['adresse'])){
                $c->setAdresse($_POST['adresse']);
            }
            
            if(isset($_POST['nomadresse'])){
                $c->setNomAdresse($_POST['nomadresse']);
            }
            $clDA = new ClientDA();
            $r = $clDA->modifier($c);
            if($r == 1){
                $_SESSION['client'] = $c;
                header("location:mescommandes.php");
            }
            else{
                header("location:mescoordonees.php");
            }
    }
else{
        header("location:index.php");
}

