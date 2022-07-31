<?php
namespace GestionStock\administration;
use GestionStock\Library\Categorie as Marque;
use GestionStock\DA\MarqueDA as MarqueDA;
use GestionStock\Library\Client as Client;
require_once '../library/Client.php';
require_once '../library/Marque.php';
require_once '../DA/MarqueDA.php';
session_start();
if(!isset($_SESSION['client'])){
    header('location:../site/moncompte.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'headMarque.php'; ?>
    </head>
    <body>
        <?php
            require 'menu.php';
        ?>
        
        <div id="d_content">
            
            <div id="d_content_top" title="ajouter nouveau marque">
                <div onclick="document.getElementById('d_ajouter').style.display='block'">
                    <img src="images/plus.png"/>
                </div>
            </div>
             
            <div id="d_content_center">
                <table>
                    <tr>
                        <th>N°</th>
                        <th>Marque</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php 
                        $marqid = 0;
                        if(isset($_GET['marqid'])){
                            $marqid = (int)$_GET['marqid'];
                        }
                        $marqDA = new MarqueDA();
                        $tblmarques = array();
                        $tblmarques = $marqDA->getMarques();
                        for($i=0;$i < count($tblmarques);$i++){
                            if($marqid == $tblmarques[$i]->getMarqueId()){
                            echo '<form id="formModifierMarque" method="post" action="modifierMarque.php?marqueId='.$tblmarques[$i]->getMarqueId().'">
                                    <tr>
                                    <td><span>'.($i + 1).'</span></td>
                                    <td>
                                        <input type="text" name="marque" value="'.$tblmarques[$i]->getMarque().'"/>
                                    </td>
                                    <td>
                                        <div onclick="document.getElementById(\'formModifierMarque\').submit()">
                                            <img src="images/save.png"/>
                                        <div>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="marques.php"><img src="images/cancel.png" /></a>
                                        <div>
                                    </td>
                                 </tr>
                                 </form>';
                            }
                            else{
                            echo '<tr>
                                    <td><span>'.($i + 1).'</span></td>
                                    <td>
                                        '.$tblmarques[$i]->getMarque().'
                                    </td>                                    
                                    <td>
                                        <div>
                                            <a href="marques.php?marqid='.$tblmarques[$i]->getMarqueId().'"><img src="images/modifier.png" /></a>
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
                                                <a href="supprimerMarque.php?marqueId='.$tblmarques[$i]->getMarqueId().'">
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
                            
        
         <form id="formMarque" method="post" action="ajouterMarque.php">  
            <div id="d_ajouter">
                <div id="d_ajouter_content">
                    <div id="d_ajouter_content_top">
                        <h1>Marque</h1>
                    </div>
                    <div id="d_ajouter_content_center">
                        <p>Ajouter nouveau marque</p>
                        <table>
                            <tr>
                                <td>
                                    <label>Marque</label>
                                </td>
                                <td>
                                    <input type="text" name="marque"/>
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



