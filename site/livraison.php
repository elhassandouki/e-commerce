<?php 
namespace GestionStock;
use GestionStock\Library\Client as Client;
require_once '../library/Client.php';
session_start();
$c = null;
if(!isset($_SESSION['client']))
{
    header('location:coordonnees.php');        
}
else
{
    $c = $_SESSION['client'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
        require_once 'head_livraison.php';
        ?>
    </head>
    <body>
    <?php
        require_once 'header.php';
    ?>      
        <div id ="d_content">
            
            <div id="d_left">
                
                <div id="d_leftt_top">
                    <span><a style="color:#000;text-decoration:none" href="details.php">1.Votre panier</a></span><img src="img/end_start_plein.jpg"/>
                    <span>2. Coordonnées</span><img src="img/end_start_active_plein.jpg"/>
                    <span style="background-color:#fb565a;color:#FFF">3. Livraison</span><img src="img/end_active_start_plein.jpg"/>
                    <span>4. Paiement sécurisé</span><img src="img/end_start_plein.jpg"/>
                    <span>5. Confirmation</span>
                </div>
                
                <div id="d_left_bottom">
                        <div id="d_top_adresselivraison">
                            <div id="d_top_adresselivraison_top">
                                <h3>Adresse de livraison</h3>
                            </div>
                            <div id="d_top_adresselivraison_center">
                                <table>
                                    <tr>
                                        <td>
                                           <?php
                                                echo "<b>".$c->getNomAdresse()." (adresse de livraison par defaut)</b>";
                                           ?>
                                        </td>
                                    </tr>
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
                                            echo "<label>".$c->getTelephone()."</label>";
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div >
                            <div id="d_top_adresselivraison_bottom" onclick="document.getElementById('modifierAdresse').style.display='block'">
                                <div>
                                    <span>Modifier</span>
                                </div>
                            </div>

                        </div>

                        <div id="d_bottom_adressefacturation">

                            <div id="d_bottom_adressefacturation_top">
                                <h3>Adresse de facturation</h3>
                            </div>
                            <div id="d_bottom_adressefacturation_center">
                                <table>
                                      <tr>
                                        <td>
                                           <?php
                                                echo "<b>".$c->getNomAdresse()." (adresse de facturation par defaut)</b>";
                                           ?>
                                        </td>
                                    </tr>
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
                                            echo "<label>".$c->getTelephone()."</label>";
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div >
                            <div id="d_bottom_adressefacturation_bottom" onclick="document.getElementById('modifierAdresse').style.display='block'" >
                                <div>
                                    <span>Modifier</span>
                                </div>
                            </div>
        
                         </div>
    
                    </div>
                <div class="etapesuivante" onclick="location.href='paiement securise.php'">
                            <span>ETAPE SUIVANTE</span>
                            <img src="img/next.png" />
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
        
        <?php require 'footer.php'; ?>
        
        <form id="form1" method="post" action="Client/modifierclient.php">
        <div id="modifierAdresse">
            <h4>Modifier mes adresses</h4>
                            <table>
                                    <tr>
                                        <td>
                                            <label>Ville<span> *</span></label>
                                        </td>
                                        <td>
                                            <select name="ville">
                                                <?php
                                                $villes = array('Agadir','Marrakech','Casablanca');
                                                for($i = 0; $i < count($villes); $i++){
                                                    if($villes[$i] == $c->getVille()){
                                                        echo '<option selected="selected">'.$villes[$i].'</option>';
                                                    }
                                                    else {
                                                        echo '<option>'.$villes[$i].'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Code postal<span> *</span></label>
                                        </td>
                                        <td>
                                            <?php echo '<input type="text" name="cp" value="'.$c->getCodePostal().'"/>' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Adresse de facturation<span> *</span></label>
                                        </td>
                                        <td>
                                            <?php echo '<input type="text" name="adresse" value="'.$c->getAdresse().'"/>' ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nommer cette adresse<span> *</span></label>
                                        </td>
                                        <td>
                                            <?php echo '<input type="text" name="nomadresse" placeholder="Maison,Travail" value="'.$c->getNomAdresse().'"/>' ?>
                                        </td>
                                    </tr>
                                </table>
            <div style="cursor: pointer" onclick="document.getElementById('form1').submit()">
                <span>Modifier</span>
            </div>
            <p style="cursor: pointer" onclick="document.getElementById('modifierAdresse').style.display='none'">Fermer</p>
        </div>
      </form>
    </body>
</html>


