<?php 
namespace GestionStock;
use GestionStock\Library\Client as Client;
use GestionStock\DA\CommandeDA as CommandeDA;
use GestionStock\DA\ProduitDA as ProduitDA;
use GestionStock\Library\Commande as Commande;
use GestionStock\Library\Produit as Produit;
require_once '../library/Client.php';
require_once '../DA/CommandeDA.php';
require_once '../DA/ProduitDA.php';
require_once '../library/Commande.php';
require_once '../library/Produit.php';
session_start();
$c = null;
if(isset($_SESSION['client']))
{
    $c = $_SESSION['client'];
}
else
{
    header('location:moncompte.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            require_once 'head_mescommandes.php';
        ?>
    </head>
    <body>
    <?php
        require_once 'header.php';
    ?>
        <div id ="d_content">
            
            <div id="d_top">
                
                <div id="d_top_left">
                    <h4>Mon compte</h4>
                </div>
                
                <div id="d_top_right">
                    <?php   
                        echo "<h4>Bonjour ".$c->getNomComplet()." </h4>";
                    ?>
                </div>
            </div>
            
            <div id="d_bottom">
                <div id="d_left">
                
                    <div id="d_left_top" onclick="location.href='mescommandes.php'">
                        <div style="background-color: #FFF2E9;">
                            <span>Mes commandes</span>
                        </div>
                    </div>

                    <div id="d_left_center_top" onclick="location.href='mescoordonees.php'">
                        <div>
                            <span>Mes coordonnés<br/>Mon mot de passe</span>
                        </div>
                    </div>

                    <div id="d_left_center_bottom" onclick="location.href='mesadresses.php'">
                        <div>
                            <span>Mes adresses</span>
                        </div>
                    </div>

                    <div id="d_left_bottom" onclick="location.href='serviceclient.php'">
                        <div>
                            <span>Contacter<br/>le service Client</span>
                        </div>
                    </div>
                    
                </div>
            
                <div id="d_right">
                    <?php
                        $cmdDA = new CommandeDA();
                        $commande = $cmdDA->getCommandesByClient($c->getClientId());
                        if($commande == null){
                    ?>
                    <div style="padding: 10px;" > 
                        <p>Bienvenue.<br/>
                           Vous n'avez aucune commande enregistrée à ce jour.<br/>
                           N'hésitez pas à cliquer sur les menus à gauche pour découvrir tous les services de mon compte.
                           <br/><br/>
                           Ou retourner sur la page d'accueil en <a href="#">cliquant ici</a>
                        </p>
                    </div>
                    <?php 
                        }
                        else{
                            for($i = 0; $i < count($commande); $i++){
                        
                    ?>
                    <div id="d_right_mescommandes">
                        <div class="d_right_commande">
                            <table>
                                <tr>
                                    <?php
                                    echo '<td>N° Commande : '.$commande[$i]->getCodeCommande().'</td><td>Date : '.$commande[$i]->getDateCommande().'</td><td>Total : '.$cmdDA->getTotalCommande($commande[$i]->getCodeCommande()).' Dh</td><td><span style="border:1px solid #ccc;color:#fff;background-color:#fb565a;padding:1px;cursor:pointer" onclick="document.getElementById(\'dc'.$commande[$i]->getCodeCommande().'\').style.display=\'block\'">details</span></td>';
                                    ?>
                                </tr>
                            </table>
                        </div>
                        <div class="d_right_detailscommande" <?php echo 'id="dc'.$commande[$i]->getCodeCommande().'"'; ?> >
                                <table>
                                    <tr>
                                        <td>
                                            <span>Référence</span>
                                        </td>
                                        <td>
                                            <label>Total</label>
                                        </td>
                                    </tr>
                                    <?php
                                        $prodDA = new ProduitDA();
                                        $produits = $prodDA->getProduitsByCodeCommande($commande[$i]->getCodeCommande());
                                        for($j = 0 ; $j < count($produits) ; $j++) 
                                        {
                                            echo '<tr><td><div><div id="d_img"><img src="../administration/images/produits/'.$produits[$j]->getImage().'"/></div>';
                                            echo '<div id="d_reference"><label>'.$produits[$j]->getDesignation().'</label><br/>';
                                            echo '<label>Quantite : '.$produits[$j]->getStock().'</label></div></div></td>';
                                            echo '<td><label>'.number_format(((float)$produits[$j]->getPrixUnitaire() * (int)$produits[$j]->getStock()),2).' Dh</label></td></tr>';
                                            
                                        }
                                    ?>
                                </table>
                            </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>    
        </div>
        
        <?php
            require 'footer.php';
        ?>
    </body>
</html>
