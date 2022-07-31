<?php
namespace GestionStock\administration;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ClientDA as ClientDA;
require_once '../library/Client.php';
require_once '../DA/ClientDA.php';
session_start();
if(!isset($_SESSION['client'])){
    header('location:../site/moncompte.php');
    exit;
}
$client = 0;
if(isset($_GET['client'])){
    $client = (int)$_GET['client'];
}
if($client == 0){
    header("location:clients.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'headCompte.php'; ?>
    </head>
    <body>
        <?php
            require 'menu.php';
        ?>
        <?php
            $clDA = new ClientDA();
            $tblclients = array();
            $tblclients = $clDA->getClientsByCode($client); 
        ?>
        <div id="d_content">

            <form id="formModifierCompte" method="post" <?php  echo 'action="modifierClient.php?clientId='.$tblclients[0]->getClientId().'"'; ?> >
                    <div id="d_coordonnee">
                        <div id="d_top_coordonnee">
                            <h4>Gerer informations personnelles</h4>
                            <p>Vous pouvez mettre à jour les informations ci-dessous:</p>
                        </div>
                        <div id="d_center_coordonnee">
                            <div id="d_center_left_coordonnee">
                                <div class="champsobligatoire">
                                    <h4>Modifier coordonnées</h4>
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
                                                    if($tblclients[0]->getCivilite() == 'Monsieur')
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
                                            echo '<input type="text" name="nom" value="'.$tblclients[0]->getNom().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Prénom<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<input type="text" name="prenom" value="'.$tblclients[0]->getPrenom().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Telephone<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<input type="text" name="telephone" value="'.$tblclients[0]->getTelephone().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Date de Naissance<span>*</span></label>
                                        </td>
                                        <td>
                                            <select name="jour">
                                                <?php
                                                    for($i = 1 ; $i <= 31 ; $i++ ){
                                                        if($i < 10){
                                                            if(($i + "") == substr($tblclients[0]->getDateNaissance(), 8, 2)){
                                                                echo '<option selected="selected">0'.$i.'</option>';
                                                            }
                                                            else{
                                                                echo '<option>0'.$i.'</option>';
                                                            }
                                                        }
                                                        else{
                                                            if(($i + "") == substr($tblclients[0]->getDateNaissance(), 8, 2)){
                                                                echo '<option selected="selected">'.$i.'</option>';
                                                            }
                                                            else{
                                                                echo '<option>'.$i.'</option>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select >
                                            <select name="mois">
                                                <?php
                                                    for($i = 1 ; $i <= 12 ; $i++ ){
                                                        if($i < 10){
                                                            if(($i + "") == substr($tblclients[0]->getDateNaissance(), 5, 2)){
                                                                echo '<option selected="selected">0'.$i.'</option>';
                                                            }
                                                            else{
                                                                echo '<option>0'.$i.'</option>';
                                                            }
                                                        }
                                                        else{
                                                            if(($i + "") == substr($tblclients[0]->getDateNaissance(), 5, 2)){
                                                                echo '<option selected="selected">'.$i.'</option>';
                                                            }
                                                            else{
                                                                echo '<option>'.$i.'</option>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <select name="annee">
                                                <?php
                                                    for($i = 2000 ; $i >= 1980 ; $i-- ){
                                                        if(($i + "") == substr($tblclients[0]->getDateNaissance(), 0, 4)){
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
                                    <h4>Modifier adresse email et  mot de passe</h4>
                                    <p><span>*</span>champs obligatoires</p>
                                </div>
                                <table>
                                    <tr>
                                        <td>
                                            <label>Nouvel email<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<input type="text" name="email" value="'.$tblclients[0]->getEmail().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nouveau mot de passe<span>*</span></label>
                                        </td>
                                        <td>
                                            <input type="password" name="password"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="d_bottom_coordonnee">
                            <div id="d_bottom_left_coordonnee">
                                <div class="champsobligatoire">
                                    <h4>Modifier adresse facturation</h4>
                                    <p><span>*</span>champs obligatoires</p>
                                </div>
                                <table>
                                    <tr>
                                        <td>
                                            <label>Ville<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<input type="text" name="ville" value="'.$tblclients[0]->getVille().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Code Postal<span>*</span></label>
                                        </td>
                                        <td>
                                             <?php
                                            echo '<input type="text" name="codepostal" value="'.$tblclients[0]->getCodePostal().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Adresse<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<textarea name="adresse" >'.$tblclients[0]->getAdresse().'</textarea>';
                                            ?>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nom Adresse<span>*</span></label>
                                        </td>
                                        <td>
                                            <?php
                                            echo '<input type="text" name="nomadresse" value="'.$tblclients[0]->getNomAdresse().'"/>';
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id="d_bottom_right_coordonnee" onclick="document.getElementById('formModifierCompte').submit()">
                                <div>
                                    <span>Valider les modifications</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

         </div>          
    </body>
</html>






