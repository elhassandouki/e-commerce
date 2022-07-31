<?php 
namespace GestionStock\Site;
use GestionStock\Library\Client as Client;
require_once '../library/Client.php';
session_start();
if(!isset($_SESSION['client']))
{
    header('location:coordonnees.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
        require_once 'head_confirmation.php';
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
                    <span>3. Livraison</span><img src="img/end_start_plein.jpg"/>
                    <span>4. Paiement sécurisé</span><img src="img/end_start_active_plein.jpg"/>
                    <span style="background-color:#fb565a;color:#FFF">5. Confirmation</span>
                </div>
                
                <div id="d_left_center">
                    <img src="img/image-livreur.png"/>
                </div>
                
                <div id="d_left_bottom">
                    <div id="d_left_bottom_right" onclick="location.href='ajoutercommande.php'">
                        <span>Valider</span>
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
        
        <?php
            require 'footer.php';
        ?>
    </body>
</html>

