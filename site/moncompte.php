<?php 
namespace GestionStock;
use GestionStock\Library\Client as Client;
use GestionStock\Library\Commande as Commande;

require_once '../library/Client.php';
require_once '../library/Commande.php';

session_start();

if(isset($_SESSION['client'])){
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head_compte.php'; ?>
    </head>
    <body>
        <?php  require_once 'header.php'; ?>
        
        <div id ="d_content">
            
            <div id="d_top">
                <form id="form_dejaclient" method="post" action="cookies.php">    
                <div id="d_top_top">
                    
                    <div id="d_top_top_left">
                        
                        <div id="d_top_top_left_top">
                            <h2>DEJA CLIENT ?</h2>
                        </div>
                        <div id="d_top_top_left_bottom">
                            <div id="d_top_top_left_bottom_top">
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
                                        <td>
                                            <span>(6 caracteres minimum)</span>
                                        </td>
                                        <?php
                                            if(isset($_GET['compteinconnu']))
                                            {
                                        echo '<td>
                                                <span>Compte inconnu</span>
                                              </td>';
                                            }
                                        ?>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="#" style="float:right;color:#000">Mot de passe oublié?</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="d_top_top_left_bottom_center">
                                <input type="checkbox" id="ck" name="save"/>
                                <label for="ck">Je souhaite être identifié automatiquement</label>
                            </div>
                            <div id="d_top_top_left_bottom_bottom">
                                <div id="d_top_top_left_bottom_bottom_connect" onclick="document.getElementById('form_dejaclient').submit()">
                                    <span>CONNECTEZ-VOUS</span>
                                    <img src="img/next.png" />
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div> 
             </form>   
                <div id="d_bottom">
                    <?php 
                        if(isset($_GET['nclient']))
                        {
                            require_once 'nouveauClient.php';
                        }
                        else {
                    ?>
                    <div id="d_bottom_bottom_right">
                        
                        <div id="d_bottom_bottom_right_top">
                            <h2>NOUVEAU CLIENT ?</h2>
                        </div>
                        <div id="d_bottom_bottom_right_center">
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
                        <div id="d_bottom_bottom_right_bottom">
                            <div id="d_bottom_bottom_left_bottom_bottom_nouveaucompte" onclick="nouveauclient()">
                                    <span>CREEZ VOTRE COMPTE EN UN CLIC</span>
                                    <img src="img/next.png" />
                                </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>  
            </div>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>

