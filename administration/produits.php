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
            
            <div id="d_content_top" title="ajouter nouveau produit">
                <div onclick="document.getElementById('d_ajouter').style.display='block'">
                    <img src="images/plus.png"/>
                </div>
                <form id="formrechercheproduit" method="post" action="produits.php">
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
                        <th>Modifier</th>
                        <th>Supprimer</th>
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
                            if($prodid == $tblproduits[$i]->getProduitId()){
                            echo '<form enctype="multipart/form-data" id="formModifierProduit" method="post" action="modifierProduit.php?produitId='.$tblproduits[$i]->getProduitId().'&numero='.($i+1).'">
                                    <tr>
                                    <td><span>'.($i + 1).'</span></td>
                                    <td>
                                        <input type="file" name="fileToUpload'.($i+1).'" id="fileToUpload'.($i+1).'" >   
                                        <input type="hidden" name="img'.($i+1).'" value="'.$tblproduits[$i]->getImage().'"/>
                                    </td>
                                    <td>
                                        <input type="text" name="designation" value="'.$tblproduits[$i]->getDesignation().'"/>
                                    </td>
                                    <td>
                                        <select name="marque">';
                                        for($j=0;$j < count($tblmarques);$j++){
                                            if($tblproduits[$i]->getMarque() == $tblmarques[$j]->getMarqueId()){
                                                echo '<option selected="selected">'.$tblmarques[$j]->getMarque().'</option>';
                                            }
                                            else{
                                                echo '<option>'.$tblmarques[$j]->getMarque().'</option>';
                                            }
                                        }
                                    echo '</select>
                                    </td>
                                    <td>
                                        <select name="categorie">';
                                        for($j=0;$j < count($tblcategories);$j++){
                                            if($tblproduits[$i]->getCategorie() == $tblcategories[$j]->getCategorieId()){
                                                echo '<option selected="selected">'.$tblcategories[$j]->getCategorie().'</option>';
                                            }
                                            else{
                                                echo '<option>'.$tblcategories[$j]->getCategorie().'</option>';
                                            }
                                        }
                                    echo '</select>
                                    </td>
                                    <td>
                                        <input type="text" name="prixUnitaire" value="'.$tblproduits[$i]->getPrixUnitaire().'"/>
                                    </td>
                                    <td>
                                        <input type="text" name="stock" value="'.$tblproduits[$i]->getStock().'"/>
                                    </td>
                                    <td>
                                        <div onclick="document.getElementById(\'formModifierProduit\').submit()">
                                            <img src="images/save.png"/>
                                        <div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="produits.php"><img src="images/cancel.png" /></a>
                                        <div>
                                    </td>
                                 </tr>
                                 </form>';
                            }
                            else{
                            echo '<tr>
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
                                        <div>
                                            <a href="produits.php?prodid='.$tblproduits[$i]->getProduitId().'"><img src="images/modifier.png" /></a>
                                        <div>
                                    </td>
                                    <td>
                                        <div id="d_confirmersupprission'.$i.'" class="c_confirmersupprission">
                                            <div class="c_confirmersupprission_content">
                                                <div class="c_confirmersupprission_content_message">
                                                    <p>Voulez-vous supprimer cet enregistrement ?</p>
                                                </div>
                                                <div class="c_confirmersupprission_content_oui" onclick="document.getElementById(\'d_confirmersupprission'.$i.'\').style.display=\'none\'">
                                                    <span>Annuler</span> 
                                                </div>
                                                <a href="supprimerProduit.php?produitId='.$tblproduits[$i]->getProduitId().'">
                                                    <div class="c_confirmersupprission_content_annuler">
                                                        <span>Oui</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div onclick="document.getElementById(\'d_confirmersupprission'.$i.'\').style.display=\'block\'">
                                            <img src="images/delete.png" />
                                        <div>
                                    </td>
                                 </tr>';
                            }
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
                            
        
         <form id="formMarque" method="post" action="ajouterProduit.php" enctype="multipart/form-data">  
            <div id="d_ajouter">
                <div id="d_ajouter_content">
                    <div id="d_ajouter_content_top">
                        <h1>Produit</h1>
                    </div>
                    <div id="d_ajouter_content_center">
                        <p>Ajouter nouveau Produit</p>
                        <table>
                            <tr>
                                <td>
                                    <label>Designation</label>
                                </td>
                                <td>
                                    <input type="text" name="designation"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Prix Unitaire</label>
                                </td>
                                <td>
                                    <input type="text" name="prixUnitaire"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Stock</label>
                                </td>
                                <td>
                                    <input type="text" name="stock"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Marque</label>
                                </td>
                                <td>
                                    <select name="marque">
                                        <?php    
                                            for($i=0;$i < count($tblmarques);$i++){
                                                    echo '<option>'.$tblmarques[$i]->getMarque().'</option>';
                                            }
                                        ?>    
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Categorie</label>
                                </td>
                                <td>
                                    <select name="categorie">
                                        <?php    
                                            for($i=0;$i < count($tblcategories);$i++){
                                                    if($tblcategories[$i]->getParent() != 0):
                                                        echo '<option>'.$tblcategories[$i]->getCategorie().'</option>';
                                                    endif;
                                            }
                                        ?> 
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Image</label>
                                </td>
                                <td>
                                    <input type="file" id="ajouterimage" name="ajouterimage" style="width: 250px" />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="d_ajouter_content_bottom">
                        <div id="d_ajouter_content_left" onclick="document.getElementById('d_ajouter').style.display='none'">
                            <span>Anuller</span>
                        </div>
                        <div id="d_ajouter_content_right" onclick="document.getElementById('formMarque').submit()">
                            <span>Ajouter</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>                      
    </body>
</html>

