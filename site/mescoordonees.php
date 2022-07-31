<?php 
namespace GestionStock;
use GestionStock\Library\Client as Client;
require_once '../library/Client.php';
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
            require_once 'head_mescoordonees.php';
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
                        <div>
                            <span>Mes commandes</span>
                        </div>
                    </div>

                    <div id="d_left_center_top" onclick="location.href='mescoordonees.php'">
                        <div style="background-color: #FFF2E9;">
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

                    <form id="form1" method="post" action="modifierclient.php">
                    <div id="d_coordonnee">
                        <div id="d_top_coordonnee">
                            <h4>Gerer mes informations personnelles</h4>
                            <p>Vous pouvez mettre à jour les informations ci-dessous:</p>
                        </div>
                        <div id="d_center_coordonnee">
                            <div id="d_center_left_coordonnee">
                                <div class="champsobligatoire">
                                    <h4>Modifier mes coordonnées</h4>
                                    <p><span>*</span>champs obligatoires</p>
                                </div>
                                <table>
                                    <tr>
                                        <td>
                                            <label>Civilité<span>*</span></label>
                                        </td>
                                        <td>
                                            <select name="civilite">
                                                <?php
                                                    if($c->getCivilite() == 'Monsieur')
                                                    {
                                                        echo '<option selected="selected">Monsieur</option><option>Madame</option>';
                                                    }
                                                    else
                                                    {
                                                       echo '<option>Monsieur</option><option selected="selected">Madame</option>';
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nom<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<input type="text" name="nom" value="'.$c->getNom().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Prénom<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<input type="text" name="prenom" value="'.$c->getPrenom().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Telephone<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<input type="text" name="tel" value="'.$c->getTelephone().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Date de Naissance<span>*</span></label>
                                        </td>
                                        <td>
                                            <select name="day">
                                                <?php
                                                    for($i = 1 ; $i <= 31 ; $i++ ){
                                                        if($i < 10){
                                                            if(($i + "") == substr($c->getDateNaissance(), 8, 2)){
                                                                echo '<option selected="selected">0'.$i.'</option>';
                                                            }
                                                            else{
                                                                echo '<option>0'.$i.'</option>';
                                                            }
                                                        }
                                                        else{
                                                            if(($i + "") == substr($c->getDateNaissance(), 8, 2)){
                                                                echo '<option selected="selected">'.$i.'</option>';
                                                            }
                                                            else{
                                                                echo '<option>'.$i.'</option>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select >
                                            <select name="month">
                                                <?php
                                                    for($i = 1 ; $i <= 12 ; $i++ ){
                                                        if($i < 10){
                                                            if(($i + "") == substr($c->getDateNaissance(), 5, 2)){
                                                                echo '<option selected="selected">0'.$i.'</option>';
                                                            }
                                                            else{
                                                                echo '<option>0'.$i.'</option>';
                                                            }
                                                        }
                                                        else{
                                                            if(($i + "") == substr($c->getDateNaissance(), 5, 2)){
                                                                echo '<option selected="selected">'.$i.'</option>';
                                                            }
                                                            else{
                                                                echo '<option>'.$i.'</option>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <select name="year">
                                                <?php
                                                    for($i = 2000 ; $i >= 1980 ; $i-- ){
                                                        if(($i + "") == substr($c->getDateNaissance(), 0, 4)){
                                                            echo '<option selected="selected">'.$i.'</option>';
                                                        }
                                                        else{
                                                            echo '<option>'.$i.'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr> 
                                </table>
                            </div>
                            <div id="d_center_right_coordonnee">
                                <div class="champsobligatoire">
                                    <h4>Modifier mon adresse email</h4>
                                    <p><span>*</span>champs obligatoires</p>
                                </div>
                                <table>
                                    <tr>
                                        <td>
                                            <label>Email Actuel<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<input type="text" name="currentemail" value="'.$c->getEmail().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nouvel email<span>*</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="newemail"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="d_bottom_coordonnee">
                            <div id="d_bottom_left_coordonnee">
                                <div class="champsobligatoire">
                                    <h4>Modifier mon mot de passe</h4>
                                    <p><span>*</span>champs obligatoires</p>
                                </div>
                                <table>
                                    <tr>
                                        <td>
                                            <label>Mot de passe actuel<span>*</span></label>
                                        </td>
                                        <td>
                                            <input type="password" name="currentpw"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nouveau mot de passe<span>*</span></label>
                                        </td>
                                        <td>
                                            <input type="password" name="newpw"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Confirmation de nouveau<span>*</span> mot<span>*</span> de passe</label>
                                        </td>
                                        <td>
                                            <input type="password" name="confpw"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id="d_bottom_right_coordonnee" onclick="document.getElementById('form1').submit()">
                                <div>
                                    <span>Valider les modifications</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                </div>
            </div>    
        </div>
        
        <?php
            require 'footer.php';
        ?>
    </body>
</html>


