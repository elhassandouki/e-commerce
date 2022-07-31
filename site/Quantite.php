<?php
namespace GestionStock\Site;
session_start();
$con = mysqli_connect("localhost", "root", "", "site") or die("Error" . mysqli_connect_error());
$op = $_GET['op'];
$qte = $_GET['qte'];
$stock = $_GET['stock'];
$ref_produit = (int)$_GET['id'];
$s_id = $_GET['s_id'];
$count_produit = (int)$_SESSION['count_produit'];
switch ($op) {
    case "p":
        if($qte < $stock)
        {
            $query = "Update lignessession Set qte = qte + 1  Where ref = ".$ref_produit." and session_id = '".$s_id."'";
            mysqli_query($con,$query);
            $count_produit++;
        }
        break;
    case "m":
        if($qte > 1)
        {
            $query = "Update lignessession Set qte = qte - 1 Where ref = ".$ref_produit." and session_id = '".$s_id."'";
            mysqli_query($con,$query);
            $count_produit--;
        }
        break;
    default:        
        break;
}
$_SESSION['count_produit'] = $count_produit;
mysqli_close($con);
header('location:details.php');
exit;
