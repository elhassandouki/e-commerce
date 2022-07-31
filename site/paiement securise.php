<?php 
namespace GestionStock\Site;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ProduitDA as ProduitDA;
require_once '../library/Client.php';
require_once '../DA/ProduitDA.php';
session_start();
$c = null;
if(!isset($_SESSION['client']))
{
    header('location:coordonnees.php');
}
else{
    $c = $_SESSION['client'];    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
        require_once 'head_paiementsecurise.php';
        ?>
    </head>
    <body>
    <?php
        require_once 'header.php';
    ?>      
        <div id ="d_content">
            
            <div id="d_left">
                
                <div id="d_left_top">
                    <span><a style="color:#000;text-decoration:none" href="details.php">1.Votre panier</a></span><img src="img/end_start_plein.jpg"/>
                    <span>2. Coordonnées</span><img src="img/end_start_plein.jpg"/>
                    <span >3. Livraison</span><img src="img/end_start_active_plein.jpg"/>
                    <span style="background-color:#fb565a;color:#FFF">4. Paiement sécurisé</span><img src="img/end_active_start_plein.jpg"/>
                    <span>5. Confirmation</span>
                </div>
                
                
                <div id="d_left_center">
                    <h3>Livraison prévue au plus tard le <span style="color:#fb565a">
                         <?php
                            $aujourdhui = getdate();
                            $mois = $aujourdhui['month'];
                            $jour = $aujourdhui['mday'];
                            $annee = $aujourdhui['year'];
                            echo "$jour/$mois/$annee";
                        ?>
                        </span></h3>
                    <img src="img/picto_imprimante.gif"/>
                </div>
                
                <div id="d_left_bottom">
                        
                        <div id="d_left_bottom_top">
                           
                            <div id="d_left_bottom_top_top">
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
                                        $pls = $prodDA->getPLSbySession(session_id());
                                        $total = 0;
                                        for($i = 0 ; $i < count($pls) ; $i++) 
                                        {
                                            echo '<tr><td><div><div id="d_img"><img src="../administration/images/produits/'.$pls[$i][6].'"/></div>';
                                            echo '<div id="d_reference"><label>'.$pls[$i][2].'</label><br/>';
                                            echo '<label>Quantite : '.$pls[$i][7].'</label></div></div></td>';
                                            echo '<td><label>'.number_format(((float)$pls[$i][3] * (int)$pls[$i][7]),2).' Dh</label></td></tr>';
                                            $total += ((float)$pls[$i][3] * (int)$pls[$i][7]);
                                        }
                                    ?>
                                </table>
                            </div>
                            
                            
                            
                            
                            
                            <div id="d_left_bottom_top_bottom">
                                    <table>
                                        <tr>
                                            <td>sous-total</td>
                                            <td><span><?php echo number_format($total,2).' Dh'; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Frais de port</td>
                                            <td><span>
                                                    <?php 
                                                        $offert = 10;
                                                        if(isset($_SESSION['offert'])){
                                                            $offert = (float)$_SESSION['offert'];
                                                        }
                                                        echo number_format($offert,2).' Dh'; 
                                                    ?>
                                                </span></td>
                                        </tr>
                                        <tr>
                                            <td><label>TOTAL TTC</label></td>
                                            <td><p><?php echo number_format($total + $offert,2).' Dh'; ?></p></td>
                                        </tr>    
                                    </table>   
                            </div>
                            
                            
                            
                        </div>
                        
                        <div id="d_top_adresselivraison">
                            
                            <div id="d_top_adresselivraison_top">
                                <h3>Récapitulatif de votre adresse de livraison</h3>
                            </div>
                            <div id="d_top_adresselivraison_center">
                                <table>
                                    <tr>
                                        <td>
                                            <?php
                                            echo "<label>".$c->getNom()." ".$c->getPrenom()."</label>";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                            echo "<label>".$c->getAdresse()."</label>";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                            echo "<label>".$c->getCodePostal()." ".$c->getVille()."</label>";
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                            echo "<label>Telephone : ".$c->getTelephone()."</label>";
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                         </div>
                    
                        <div id="confirmation" onclick="location.href='confirmation.php'">
                                <span>ETAPE SUIVANTE</span>
                        </div>
                </div>
                
            </div>
            
            <div id="d_right">
                
                <div id="d_right_top">
                    <div>
                        <img src="img/telephoneSAV.png" />
                        <span> 06 20 74 18 67</span>
                        <p>du Lundi au Samedi,de<br/> 8h30 à 20h00</p>
                    </div>        
                </div>
                
                <div id="d_right_bottom">
                    <h3>Mes Aventages</h3>
                    <img src="img/livraison_retours.jpg" />
                </div>
                
            </div>
        </div>
        
        <?php require 'footer.php' ?>
    </body>
</html>

