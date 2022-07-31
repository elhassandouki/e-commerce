<?php 
namespace GestionStock;
use GestionStock\Library\Client as Client;
require_once '../library/Client.php';
session_start();
if(isset($_SESSION['client'])){
    header("location:moncompte.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
            require_once 'head_coordonnees.php';
        ?>
    </head>
    <body>
      
        <?php
            require 'header.php';
        ?>
        
        <div id ="d_content">
            
            <div id="d_left">
                
                <div id="d_leftt_top">
                    <span><a style="color:#000;text-decoration:none" href="details.php">1.Votre panier</a></span><img src="img/end_start_active_plein.jpg"/>
                    <span style="background-color:#fb565a;color:#FFF">2. Coordonnées</span><img src="img/end_active_start_plein.jpg"/>
                    <span>3. Livraison</span><img src="img/end_start_plein.jpg"/>
                    <span>4. Paiement sécurisé</span><img src="img/end_start_plein.jpg"/>
                    <span>5. Confirmation</span>
                </div>
                
                <div id="d_left_bottom">
                  <form id="form_dejaclient" method="post" action="cookies.php">     
                    <div id="d_left_bottom_left">
                        
                        <div id="d_left_bottom_left_top">
                            <h2>DEJA CLIENT ?</h2>
                        </div>
                        <div id="d_left_bottom_left_bottom">
                            <div id="d_left_bottom_left_bottom_top">
                                <table>
                                    <tr>
                                        <td>
                                            Votre adresse email :
                                        </td>
                                        <td>
                                            <?php
                                                $email = "";
                                                if(isset($_COOKIE['email']))
                                                {
                                                    $email = $_COOKIE['email'];
                                                }
                                                echo '<input type="text" name="email" value="'.$email.'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Votre mot de passe :
                                        </td>
                                        <td>
                                            <?php
                                            $password = "";
                                            if(isset($_COOKIE['password']))
                                            {
                                                $password = $_COOKIE['password'];
                                            }
                                            echo '<input type="password" name="password" value="'.$password.'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span>(6 caracteres minimum)</span>
                                        </td>
                                        <?php
                                            if(isset($_GET['compteinconnu']))
                                            {
                                        ?>
                                        <td>
                                            <span>Compte inconnu</span>
                                        </td>
                                        <?php
                                            }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="#" style="float:right;color:#000">Mot de passe oublié?</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="d_left_bottom_left_bottom_center">
                                <input type="checkbox" id="ck" name="save"/>
                                <label for="ck">Je souhaite être identifié automatiquement</label>
                            </div>
                            <div id="d_left_bottom_left_bottom_bottom">
                                <div id="d_left_bottom_left_bottom_bottom_connect" onclick="document.getElementById('form_dejaclient').submit()">
                                    <span>CONNECTEZ-VOUS</span>
                                    <img src="img/next.png" />
                                </div>
                            </div>
                        </div>
                        
                    </div>
                  </form> 
                    <div id="d_left_bottom_right">
                        
                        <div id="d_left_bottom_right_top">
                            <h2>NOUVEAU CLIENT ?</h2>
                        </div>
                        <div id="d_left_bottom_right_center">
                            <ul>
                                <li>
                                    Bénéficiez d'avantages exclusifs
                                </li>
                                <li>
                                    Suivez en ligne l'historique de vos commandes
                                </li>
                                <li>
                                    Consultez votre facture
                                </li>
                                <li>
                                    Conservez vos données en toute confidentialité
                                </li>
                            </ul>
                        </div>
                        <div id="d_left_bottom_right_bottom">
                            <div id="d_left_bottom_left_bottom_bottom_nouveaucompte" onclick="location.href='moncompte.php?nclient=nc'">
                                    <span>CREEZ VOTRE COMPTE EN UN CLIC</span>
                                    <img src="img/next.png" />
                                </div>
                        </div>
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

