<?php
namespace GestionStock\administration;
use GestionStock\Library\Produit as Produit;
use GestionStock\DA\ProduitDA as ProduitDA;
use GestionStock\Library\Marque as Marque;
use GestionStock\DA\MarqueDA as MarqueDA;
use GestionStock\Library\Categorie as Categorie;
use GestionStock\DA\CategorieDA as CategorieDA;
use GestionStock\Library\Client as Client;
require_once '../library/Client.php';
require_once '../library/Produit.php';
require_once '../DA/ProduitDA.php';
require_once '../library/Marque.php';
require_once '../DA/MarqueDA.php';
require_once '../library/Categorie.php';
require_once '../DA/CategorieDA.php';
session_start();
if(!isset($_SESSION['client'])){
    header('location:../site/moncompte.php');
    exit;
}
$produit = 0;
if(isset($_POST['produit'])){
    $produit = (int)$_POST['produit'];
}  
$marque = "Select Marque";
if(isset($_POST['marque'])){
    $marque = $_POST['marque'];
}
$categorie = "Select Categorie";
if(isset($_POST['categorie'])){
    $categorie = $_POST['categorie'];
}
$commande = 0;
if(isset($_GET['commande'])){
    $commande = $_GET['commande'];
}
$marqDA = new MarqueDA();
$catDA = new CategorieDA();
$tblmarques = array();
$tblcategories = array();
$tblmarques = $marqDA->getMarques();
$tblcategories = $catDA->getCategories();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'headProduit.php'; ?>
    </head>
    <body>
        <?php
            require 'menu.php';
        ?>
        
        <div id="d_content">
            
            <div id="d_content_top">
                <?php
                    echo '<div onclick="location.href=\'lignes.php?commande='.$commande.'\'">
                            <img src="images/cancel.png"/>
                          </div>';
                ?>
                <form id="formrechercheproduit" method="post" action="selectionnerProduit.php">
                    <div>
                        <?php
                            if($produit != 0){
                                echo '<input type="text" name="produit" value="'.$produit.'"/>';
                            }
                            else
                            {
                                echo '<input type="text" name="produit" placeholder="Rechercher par reference"/>';
                            }
                        ?>
                    </div>
                    <div>
                        <select name="marque">
                            <option>Select Marque</option>
                                <?php    
                                        for($i=0;$i < count($tblmarques);$i++){
                                            if($marque == $tblmarques[$i]->getMarque()){
                                                echo '<option selected="selected">'.$tblmarques[$i]->getMarque().'</option>';
                                            }
                                            else{
                                                echo '<option>'.$tblmarques[$i]->getMarque().'</option>';
                                            }
                                        }
                                ?>    
                        </select>
                    </div>
                    <div>
                        <select name="categorie">
                            <option>Select Categorie</option>
                                <?php    
                                        for($i=0;$i < count($tblcategories);$i++){
                                            if($categorie == $tblcategories[$i]->getCategorie()){
                                                echo '<option selected="selected">'.$tblcategories[$i]->getCategorie().'</option>';
                                            }
                                            else{
                                                echo '<option>'.$tblcategories[$i]->getCategorie().'</option>';
                                            }
                                        }
                                ?>    
                        </select>
                    </div>
                    <div>
                        <span onclick="document.getElementById('formrechercheproduit').submit()">Recherche</span>
                    </div>
                </form>
            </div>
            <div id="d_content_center">
                <table>
                    <tr>
                        <th>N°</th>
                        <th>Image</th>
                        <th>Designation</th>
                        <th>Marque</th>
                        <th>Categorie</th>
                        <th>Prix Unitaire</th>
                        <th>Stock</th>
                        <th>Quantite</th>
                        <th>Select</th>
                    </tr>
                    <?php 
                        $prodid = 0;
                        if(isset($_GET['prodid'])){
                            $prodid = (int)$_GET['prodid'];
                        }
                        $prodDA = new ProduitDA();
                        $tblproduits = array();
                        if($produit != 0){
                            $tblproduits = $prodDA->getProduitByRef($produit);
                        }
                        else if($marque != "Select Marque"){
                            $tblproduits = $prodDA->getProduitByMarque($marque);
                        }
                        else if($categorie != "Select Categorie"){
                            $tblproduits = $prodDA->getProduitByCategorie($categorie);
                        }
                        else{
                           $tblproduits = $prodDA->getProduits(); 
                        }
                        for($i=0;$i < count($tblproduits);$i++){
                          echo '<form id="formajouterligne'.($i+1).'" method="post" action="ajouterLigne.php?numero='.($i+1).'&commande='.$commande.'&produit='.$tblproduits[$i]->getProduitId().'">
                                 <tr>
                                    <td><span>'.($i + 1).'</span></td>
                                    <td>
                                        <img src="images/Produits/'.$tblproduits[$i]->getImage().'"/>
                                    </td>
                                    <td>
                                        '.$tblproduits[$i]->getDesignation().'
                                    </td> 
                                    <td>';
                                        for($j=0;$j < count($tblmarques);$j++){
                                            if($tblproduits[$i]->getMarque() == $tblmarques[$j]->getMarqueId()){
                                                echo $tblmarques[$j]->getMarque();
                                            }
                                        }
                                    echo '</td>
                                    <td>';
                                        for($j=0;$j < count($tblcategories);$j++){
                                            if($tblproduits[$i]->getCategorie() == $tblcategories[$j]->getCategorieId()){
                                                echo $tblcategories[$j]->getCategorie();
                                            }
                                        }
                                    echo '</td>
                                    <td>
                                        '.$tblproduits[$i]->getPrixUnitaire().' Dhs
                                    </td>
                                    <td>
                                        '.$tblproduits[$i]->getStock().'
                                    </td>
                                    <td>
                                        <input type="text" name="quantite'.($i+1).'"  >
                                    </td>
                                    <td>
                                        <div>
                                            <img src="images/ajouter.png" onclick="document.getElementById(\'formajouterligne'.($i+1).'\').submit()"/>
                                        <div>
                                    </td>
                                 </tr>
                               </form>';
                        }
                    ?>
                </table>
            </div>
            
            <div id="d_content_bottom">
                <?php
                    if(isset($_SESSION['message'])){
                        echo '<p style="color:green">'.$_SESSION['message'].'</p>';
                    }
                    if(isset($_SESSION['messageError'])){
                        echo '<p style="color:red">'.$_SESSION['messageError'].'</p>';
                    }
                ?>
            </div>
            
        </div>                                      
    </body>
</html>



