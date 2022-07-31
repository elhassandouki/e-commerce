<?php 
namespace GestionStock\Site;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ProduitDA as ProduitDA;
require_once '../library/Client.php';
require_once '../DA/ProduitDA.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once 'head_details.php'; ?>
    </head>
    <body>
        
        <?php require_once 'header.php'; ?>
        
        <div id="d_menu">
            <?php require_once 'menu.php'; ?>
        </div>
        
        <div id ="d_content">
            
            <div id="d_left">
                
                <div id="d_left_top">
                    <span style="background-color:#fb565a;color:#FFF"><a style="color:#FFF;text-decoration: none" href="details.php">1.Votre panier</a></span><img src="img/end_active_start_plein.jpg"/>
                        <span>2. Coordonnées</span><img src="img/end_start_plein.jpg"/>
                        <span>3. Livraison</span><img src="img/end_start_plein.jpg"/>
                        <span>4. Paiement sécurisé</span><img src="img/end_start_plein.jpg"/>
                        <span>5. Confirmation</span>
                </div> 
                    <?php
                        $total = 0;
                        $prodDA = new ProduitDA();
                        $pls = $prodDA->getPLSbySession(session_id());
                        if($pls != null)
                        {
                            echo '<div id="d_left_center">
                                 <table>
                                    <tr>
                                        <td id="d_left_center_table_tr_td_ref">Référence</td><td><td>Disponibilité</td><td>Prix</td><td>Quantité</td><td>Total</td> 
                                    </tr>';
                            for($i = 0; $i < count($pls); $i++)
                            {
                                echo '<tr><td><div><img src="../administration/images/produits/'.$pls[$i][6].'"/>'
                                    . '<span style="display:block;">'.$pls[$i][2].'</span></td></div><div><td><a id="'.$pls[$i][1].'simg" href="#" onclick="visible('.$pls[$i][1].')"><img src="img/bell.gif"/></a>'
                                    . '<div id="'.$pls[$i][1].'on" style="display:none;position:relative;left:30px"><a href="supprimerproduit.php?id='.$pls[$i][1].'&s_id='.$pls[$i][8].'"><span id="supoui" style="background-color:#fb565a;color:#fff;padding:3px;border:solid 1px #ccc;margin-right:3px;border-radius:0 10px 0 10px;cursor:pointer">Oui</span></a>'
                                        . '<span style="background-color:green;color:#fff;padding:3px;border:solid 1px #ccc;border-radius:0 10px 0 10px;cursor:pointer" onclick="invisible('.$pls[$i][1].')">Non</span></div></div></td><td>';
                                    if($pls[$i][4] > 0) 
                                    {
                                        echo 'En Stock' ;
                                    }
                                    else 
                                    {
                                        echo '1-2 jour(s)';
                                    }
                                echo '</td><td>'.number_format($pls[$i][3],2).' Dh</td><td><a href="Quantite.php?op=p'.'&id='.$pls[$i][1].'&s_id='.$pls[$i][8].'&qte='.$pls[$i][7].'&stock='.$pls[$i][4].'" class="p_m">+</a>'
                                        .$pls[$i][7].'<a href="Quantite.php?op=m'.'&id='.$pls[$i][1].'&s_id='.$pls[$i][8].'&qte='.$pls[$i][7].'&stock='.$pls[$i][4].'" class="p_m">-</a></td>'
                                    . '<td>'.number_format(((float)$pls[$i][3] * (int)$pls[$i][7]),2).' Dh</td></tr><tr><td></td><td></td><td></td><td></td><td style="color:red">';
                                
                                if($pls[$i][7] == $pls[$i][4])
                                {
                                    echo "article epuisé";
                                }
                                
                                echo '</td><td></td></tr>';
                                $total += ((float)$pls[$i][3] * (int)$pls[$i][7]);
                            }
                            echo '</table></div>';  
                    ?>  
                
                <div id="d_left_bottom">
                    
                    <div id="d_left_bottom_top">
                        <table>
                            <tr>
                                <td>
                                   sous-total 
                                </td>
                                <?php 
                                    echo '<td>'.number_format($total,2).' Dh</td>';
                                ?>
                            </tr>
                            <tr>
                                <td>
                                    Frais de port pour une livraison en:
                                    <select name="city" >
                                        <?php 
                                            $offert = 0;
                                            if(isset($_GET['offert'])){
                                                 $offert = $_GET['offert'];
                                            }
                                            $_SESSION['offert'] = $offert;
                                            switch ($offert) {
                                                case 80:
                                                    echo    '<option onclick="location.href=\'details.php?offert=80\'" selected="selected">Agadir</option>'
                                                            .'<option onclick="location.href=\'details.php?offert=100\'">Marrakech</option>'
                                                            .'<option onclick="location.href=\'details.php?offert=150\'">Casablanca</option>';
                                                    break;
                                                case 100:
                                                    echo    '<option onclick="location.href=\'details.php?offert=80\'" >Agadir</option>'
                                                            .'<option onclick="location.href=\'details.php?offert=100\'" selected="selected">Marrakech</option>'
                                                            .'<option onclick="location.href=\'details.php?offert=150\'">Casablanca</option>';
                                                    break;
                                                case 150:
                                                    echo    '<option onclick="location.href=\'details.php?offert=80\'" >Agadir</option>'
                                                            .'<option onclick="location.href=\'details.php?offert=100\'">Marrakech</option>'
                                                            .'<option onclick="location.href=\'details.php?offert=150\'" selected="selected">Casablanca</option>';
                                                    break;
                                                default :
                                                        echo '<option selected="selected">Maroc</option>'   
                                                            .'<option onclick="location.href=\'details.php?offert=80\'" >Agadir</option>'
                                                            .'<option onclick="location.href=\'details.php?offert=100\'">Marrakech</option>'
                                                            .'<option onclick="location.href=\'details.php?offert=150\'">Casablanca</option>';
                                                break;
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                   <?php
                                        if($offert != 0){
                                            echo number_format($offert,2) . ' Dh';
                                        }
                                        else{
                                            echo 'OFFERT';
                                        }
                                   ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <div id="d_left_bottom_center">
                        <table>
                            <tr>
                                <td>
                                    TOTAL TTC
                                </td>
                                <?php 
                                    echo '<td>'.number_format(($total + $offert),2).' Dh</td>';
                                ?>
                            </tr>
                        </table>
                    </div>
                    
                    <div id="d_left_bottom_bottom">
                        <div id="d_left_bottom_bottom_left" onclick="location.href='listproduit.php'">
                            <img src="img/next.png" />
                            <span>CONTINUER VOS ACHATS</span>
                        </div>
                        <div id="d_left_bottom_bottom_right" onclick="location.href='livraison.php'">
                            <span>PASSER VOTRE COMMANDE</span>
                            <img src="img/next.png" />
                        </div>
                    </div>
                    
                </div>
                <?php
                }
                else
                {
                    echo '<div id="d_left_center" style="font-size:20px">Aucun article dans le panier</div>';
                }
                ?>
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
        
        <?php
            require 'footer.php';
        ?>
    </body>
</html>



