<?php 
namespace GestionStock;
use GestionStock\Library\Client as Client;
require_once '../library/Client.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
        require_once 'head_serviceClient.php';
        ?>
    </head>
    <body>
    <?php
        require_once 'header.php';
    ?>
        <div id ="d_content">
        
            <div id="d_serviceclient">
                
                <div id="d_serviceclient_left">
                    <table>
                        <tr>
                            <td>
                                <b>Choisir le sujet*</b>   
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="sujet">
                                    <option>--- Sélectionnez ---</option>
                                    <option>Statut de livraison</option>
                                    <option>Modification de l'adresse de livraison</option>
                                    <option>Annulation de commande</option>
                                    <option>Problèmes techniques</option>
                                    <option>Retour d'un article</option>
                                    <option>Réception d'un article non-conforme</option>
                                    <option>Informations générales</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div id="d_serviceclient_center">
                    <table>
                        <tr>
                            <td>
                                <b>Votre civilité *</b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name="civilite">
                                    <option>Monsieur</option>
                                    <option>Madame</option>
                                </select>   
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nom" placeholder="Votre nom *"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="prenom" placeholder="Votre prénom *"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="email" placeholder="Votre email *"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="numcmd" placeholder="N° de commande (si disponible)"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Votre Message *</b>
                                <br/><br/>
                                <textarea cols="30" rows="10"></textarea>
                            </td>
                        </tr>
                    </table>
                    <div>
                        <span>Envoyer</span>
                    </div>
                </div>
                
                <div id="d_serviceclient_right">
                    <div id="d_serviceclient_right_top">
                        <h3>Vous avez une question ?</h3>
                        <p>06 20 74 18 67 (prix d'un appel local ou national)<br/>
                        Vous pouvez nous joindre<br/>
                        du Lundi au Samedi, de 8h30 à 20h00</p>
                    </div>
                    <div id="d_serviceclient_right_bottom">
                        <img src="img/img_service_client.png"/>
                    </div>
                </div>
              
            </div>
        </div>
        
        <?php    require 'footer.php'; ?>   
        
    </body>
</html>

