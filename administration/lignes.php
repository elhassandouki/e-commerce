<?php
namespace GestionStock\administration;
use GestionStock\DA\LigneDA as LigneDA;
use GestionStock\Library\Ligne as Ligne;
use GestionStock\Library\Produit as Produit;
use GestionStock\DA\ProduitDA as ProduitDA;
use GestionStock\Library\Commande as Commande;
use GestionStock\Library\Client as Client;
require_once '../library/Client.php';
require_once '../library/Produit.php';
require_once '../DA/ProduitDA.php';
require_once '../library/Ligne.php';
require_once '../DA/LigneDA.php';
require_once '../library/Commande.php';
session_start();
if(!isset($_SESSION['client'])){
    header('location:../site/moncompte.php');
    exit;
}
$commande = 0;
if(isset($_GET['commande'])){
    $commande = (int)$_GET['commande'];
}
if($commande == 0){
    header("location:commandes.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'headLigne.php'; ?>
    </head>
    <body>
        <?php
            require 'menu.php';
        ?>
        <div id="d_content">
            <div id="d_content_top" title="ajouter nouveau ligne">
                    <?php
                        echo '<div onclick="location.href=\'selectionnerProduit.php?commande='.$commande.'\'">'
                                .'<img src="images/plus.png"/>
                             </div>';
                    ?>
            </div>
            <div id="d_content_center">
                <table>
                    <tr>
                        <th>N°</th>
                        <th>Code Commande</th>
                        <th><span>Reference de Produit</span></th>
                        <th><span>Quantite</span></th>
                        <th><span>Total</span></th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php                        
                        $numligne = 0;
                        if(isset($_GET['numligne'])){
                            $numligne = (int)$_GET['numligne'];
                        }
                        $ligneDA = new LigneDA();
                        $tbllignes = array();
                        $tbllignes = $ligneDA->getLignesByCommande($commande);
                        for($i=0;$i < count($tbllignes);$i++){
                            if($numligne == $tbllignes[$i]->getNumero()){
                            echo '<form id="formModifierLigne" method="post" action="modifierLigne.php?numeroLigne='.$tbllignes[$i]->getNumero().'&commande='.$commande.'">
                                    <tr>
                                        <td>
                                            <span>'.($i + 1).'</span>
                                        </td>
                                        <td>
                                            '.$tbllignes[$i]->getCommande()[0]->getCodeCommande().'
                                        </td>
                                        <td>
                                            '.$tbllignes[$i]->getProduit()[0]->getDesignation().'
                                        </td>
                                        <td>
                                            <input type="text" name="quantite" value="'.$tbllignes[$i]->getQuantite().'"/>
                                        </td>
                                        <td>
                                            '.$tbllignes[$i]->getTotal().' Dhs
                                        </td>
                                        <td>
                                            <div onclick="document.getElementById(\'formModifierLigne\').submit()">
                                                <img src="images/save.png"/>
                                            <div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="lignes.php?commande='.$commande.'"><img src="images/cancel.png" /></a>
                                            <div>
                                        </td>
                                    </tr>
                                 </form>';
                            }
                            else{
                            echo '<tr>
                                     <td>
                                            <span>'.($i + 1).'</span>
                                        </td>
                                        <td>
                                            '.$tbllignes[$i]->getCommande()[0]->getCodeCommande().'
                                        </td>
                                        <td>
                                            '.$tbllignes[$i]->getProduit()[0]->getDesignation().'
                                        </td>
                                        <td>
                                            '.$tbllignes[$i]->getQuantite().'
                                        </td>
                                        <td>
                                            '.$tbllignes[$i]->getTotal().' Dhs
                                        </td>
                                    <td>
                                        <div>
                                            <a href="lignes.php?numligne='.$tbllignes[$i]->getNumero().'&commande='.$commande.'"><img src="images/modifier.png" /></a>
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
                                                <a href="supprimerLigne.php?numeroLigne='.$tbllignes[$i]->getNumero().'&commande='.$commande.'">
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
                            
         <form id="formClient" method="post" <?php echo 'action="selectionnerLigne.php?commande='.$commande.'"'; ?>  >  
            <div id="d_ajouter">
                <div id="d_ajouter_content">
                    <div id="d_ajouter_content_top">
                        <h1>Ligne</h1>
                    </div>
                    <div id="d_ajouter_content_center">
                        <p>Ajouter nouveau Ligne</p>
                        <table>
                            <tr>
                                <td>
                                    <label>Code Commande</label>
                                </td>
                                <td>
                                    <?php echo $commande; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Produit</label>
                                </td>
                                <td>
                                    <select name="produit">
                                        <?php
                                            $prodDA = new ProduitDA();
                                            $tblproduits = array();
                                            $tblproduits = $prodDA->getProduits();
                                            for($i=0;$i < count($tblproduits);$i++){
                                                echo '<option value='.$tblproduits[$i]->getproduitId().'>'.$tblproduits[$i]->getproduitId() .' - '. $tblproduits[$i]->getDesignation().'</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Quantite</label>
                                </td>
                                <td>
                                    <input type="text" name="quantite"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="d_ajouter_content_bottom">
                        <div id="d_ajouter_content_left" onclick="document.getElementById('d_ajouter').style.display='none'">
                            <span>Annuler</span>
                        </div>
                        <div id="d_ajouter_content_right" onclick="document.getElementById('formClient').submit()">
                            <span>Ajouter</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>                      
    </body>
</html>





