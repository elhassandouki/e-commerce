<?php
namespace GestionStock\administration;
use GestionStock\Library\Categorie as Categorie;
use GestionStock\DA\CategorieDA as CategorieDA;
use GestionStock\Library\Client as Client;
require_once '../library/Categorie.php';
require_once '../DA/CategorieDA.php';
require_once '../library/Client.php';
session_start();
if(!isset($_SESSION['client'])){
    header('location:../site/moncompte.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'headCategorie.php'; ?>
    </head>
    <body>
        <?php
            require 'menu.php';
        ?>
        
        <div id="d_content">
            
            <div id="d_content_top" title="Ajouter nouveau categorie">
                <div onclick="document.getElementById('d_ajouter').style.display='block'">
                    <img src="images/plus.png"/>
                </div>
            </div>
             
            <div id="d_content_center">
                <table>
                    <tr>
                        <th>N°</th>
                        <th>Categorie</th>
                        <th>Parent Categorie</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php 
                        $catid = 0;
                        if(isset($_GET['catid'])){
                            $catid = (int)$_GET['catid'];
                        }
                        $catDA = new CategorieDA();
                        $tblcategories = array();
                        $tblcategories = $catDA->getCategories();
                        for($i=0;$i < count($tblcategories);$i++){
                            if($catid == $tblcategories[$i]->getCategorieId()){
                            echo '<form id="formModifierCategorie" method="post" action="modifierCategorie.php?categorieId='.$tblcategories[$i]->getCategorieId().'">
                                    <tr>
                                    <td><span>'.($i + 1).'</span></td>
                                    <td>
                                        <input type="text" name="categorie" value="'.$tblcategories[$i]->getCategorie().'"/>
                                    </td>
                                    <td>
                                        <select name="parentCategorie">
                                        <option>Select categorie</option>';
                                        for($j=0;$j < count($tblcategories);$j++){
                                            if($tblcategories[$i]->getparent() == $tblcategories[$j]->getCategorieId()){
                                                echo '<option selected="selected">'.$tblcategories[$j]->getCategorie().'</option>';
                                            }
                                            else if($tblcategories[$i]->getCategorieId() == $tblcategories[$j]->getCategorieId()){
                                                //...
                                            }
                                            else{
                                                echo '<option>'.$tblcategories[$j]->getCategorie().'</option>';
                                            }
                                        }
                                    echo '</select>
                                    </td>
                                    <td>
                                        <div onclick="document.getElementById(\'formModifierCategorie\').submit()">
                                            <img src="images/save.png"/>
                                        <div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="categories.php"><img src="images/cancel.png" /></a>
                                        <div>
                                    </td>
                                 </tr>
                                 </form>';
                            }
                            else{
                            echo '<tr>
                                    <td><span>'.($i + 1).'</span></td>
                                    <td>
                                        '.$tblcategories[$i]->getCategorie().'
                                    </td>
                                    <td>
                                        '.$catDA->getCategorieById($tblcategories[$i]->getParent()).'
                                    </td>                                    
                                    <td>
                                        <div>
                                            <a href="categories.php?catid='.$tblcategories[$i]->getCategorieId().'"><img src="images/modifier.png" /></a>
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
                                                <a href="supprimerCategorie.php?categorieId='.$tblcategories[$i]->getCategorieId().'">
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
                            
        
         <form id="formCategorie" method="post" action="ajouterCategorie.php">  
            <div id="d_ajouter">
                <div id="d_ajouter_content">
                    <div id="d_ajouter_content_top">
                        <h1>Categorie</h1>
                    </div>
                    <div id="d_ajouter_content_center">
                        <p>Ajouter nouveau categorie</p>
                        <table>
                            <tr>
                                <td>
                                    <label>Categorie</label>
                                </td>
                                <td>
                                    <input type="text" name="categorie"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Parent</label>
                                </td>
                                <td>
                                    <select name="parentCategorie">
                                        <option>Select categorie</option>
                                            <?php
                                                for($i=0;$i < count($tblcategories);$i++){
                                                    if($tblcategories[$i]->getParent() == 0){
                                                        echo '<option>'.$tblcategories[$i]->getCategorie().'</option>';
                                                    }
                                                }
                                            ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="d_ajouter_content_bottom">
                        <div id="d_ajouter_content_left" onclick="document.getElementById('d_ajouter').style.display='none'">
                            <span>Anuller</span>
                        </div>
                        <div id="d_ajouter_content_right" onclick="document.getElementById('formCategorie').submit()">
                            <span>Ajouter</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>                      
    </body>
</html>

