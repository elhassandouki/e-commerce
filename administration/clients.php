<?php
namespace GestionStock\administration;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ClientDA as ClientDA;
use GestionStock\DA\CommandeDA as CommandeDA;
require_once '../library/Client.php';
require_once '../DA/ClientDA.php';
require_once '../DA/CommandeDA.php';
session_start();
if(!isset($_SESSION['client'])){
    header('location:../site/moncompte.php');
    exit;
}
$client = 0;
if(isset($_POST['client'])){
    $client = (int)$_POST['client'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'headClient.php'; ?>
    </head>
    <body>
        <?php
            require 'menu.php';
        ?>
        
        <div id="d_content">
            
            <div id="d_content_top" >
                <div onclick="document.getElementById('d_ajouter').style.display='block'" title="ajouter nouveau client">
                    <img src="images/plus.png"/>
                </div>
                <form id="formrechercheclient" method="post" action="clients.php">
                    <div>
                        <?php
                            if($client != 0){
                                echo '<input type="text" name="client" value="'.$client.'"/>';
                            }
                            else
                            {
                                echo '<input type="text" name="client" placeholder="Rechercher par code"/>';
                            }
                        ?>
                        <span onclick="document.getElementById('formrechercheclient').submit()">Recherche</span>
                    </div>
                </form>
            </div>
            <div id="d_content_center">
                <table>
                    <tr>
                        <th>N°</th>
                        <th>Civilite</th>
                        <th><span>Nom et Prénom</span></th>
                        <th>Nombre Commandes</th>
                        <th>Total Commandes</th>
                        <th>Dernier Connection</th>
                        <th>Admin</th>
                        <th>Information</th>
                        <th>Nouveau Commande</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php
                        $clDA = new ClientDA();
                        $cmdDA = new CommandeDA();
                        $tblclients = array();
                        if($client != 0){
                            $tblclients = $clDA->getClientsByCode($client);
                        }
                        else{
                            $tblclients = $clDA->getClients();
                        }
                        for($i=0;$i < count($tblclients);$i++){
                                echo '<tr>
                                        <td><span>'.($i + 1).'</span></td>
                                        <td>'.$tblclients[$i]->getCivilite().'</td>
                                        <td>
                                            '.$tblclients[$i]->getNomComplet().'
                                        </td>';
                                        if($tblclients[$i]->getNbrCommandes() > 0){
                                        echo '<td>
                                                <a href="commandes.php?client='.$tblclients[$i]->getClientId().'">'.$tblclients[$i]->getNbrCommandes().'</a>
                                              </td>';
                                        }
                                        else
                                        {
                                            echo '<td>'.$tblclients[$i]->getNbrCommandes().'</td>';     
                                        }
                                   echo '<td>
                                            '.$cmdDA->getTotalCommandesByClient($tblclients[$i]->getClientId()).' Dhs
                                        </td>
                                        <td>
                                            '.$tblclients[$i]->getDateConnect().'
                                        </td>';
                                        if($tblclients[$i]->getAdministrateur() == 1){
                                            echo '<td>  
                                                     <input type="checkbox" name="administrateur" checked="checked"/>
                                                  </td>';
                                        }
                                        else{
                                            echo '<td>  
                                                     <input type="checkbox" name="administrateur"/>
                                                  </td>';
                                        }
                                   echo '
                                        <td>
                                            <div>
                                                <a href="compte.php?client='.$tblclients[$i]->getClientId().'"><img src="images/info.png" /></a>
                                            <div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="ajouterCommande.php?client='.$tblclients[$i]->getClientId().'"><img src="images/ajouter.png" /></a>
                                            <div>
                                        </td>
                                        <td>
                                            <div id="d_confirmersupprission'.$i.'" class="c_confirmersupprission">
                                                <div class="c_confirmersupprission_content">
                                                    <div class="c_confirmersupprission_content_message">
                                                        <p>Voulez-vous supprimer cet enregistrement ?</p>
                                                    </div>
                                                    <div class="c_confirmersupprission_content_oui" onclick="document.getElementById(\'d_confirmersupprission'.$i.'\').style.display=\'none\'">
                                                        <span>Annuler</span> 
                                                    </div>
                                                    <a href="supprimerClient.php?clientId='.$tblclients[$i]->getClientId().'">
                                                        <div class="c_confirmersupprission_content_annuler">
                                                            <span>Oui</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div onclick="document.getElementById(\'d_confirmersupprission'.$i.'\').style.display=\'block\'">
                                                <img src="images/delete.png" />
                                            <div>
                                        </td>
                                     </tr>';
                        }
                    ?>
                </table>
            </div>
            
            <div id="d_content_bottom">
                <?php
                    if(isset($_SESSION['message'])){
                        echo '<p style="color:green">'.$_SESSION['message'].'</p>';
                    }
                    if(isset($_SESSION['messageError'])){
                        echo '<p style="color:red">'.$_SESSION['messageError'].'</p>';
                    }
                ?>
            </div>
            
        </div>                  
                            
         <form id="formClient" method="post" action="ajouterClient.php">  
            <div id="d_ajouter">
                <div id="d_ajouter_content">
                    <div id="d_ajouter_content_top">
                        <h1>Client</h1>
                    </div>
                    <div id="d_ajouter_content_center">
                        <p>Ajouter nouveau Client</p>
                        <table>
                            <tr>
                                <td>
                                    <label>Civilite</label>
                                </td>
                                <td>
                                    <select name="civilite">
                                        <option>Monsieur</option>    
                                        <option>Madame</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Nom</label>
                                </td>
                                <td>
                                    <input type="text" name="nom"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Prénom</label>
                                </td>
                                <td>
                                    <input type="text" name="prenom"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Date de Naissance</label>
                                </td>
                                <td>
                                    <select class="dateNaissance" name="jour">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                    </select>
                                    <select class="dateNaissance" name="mois">
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                    </select>
                                    <select class="dateNaissanceYear" name="annee">
                                        <option>1992</option>
                                        <option>1991</option>
                                        <option>1990</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Ville</label>
                                </td>
                                <td>
                                    <input type="text" name="ville"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Code Postal</label>
                                </td>
                                <td>
                                    <input type="text" name="codepostal"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Adresse</label>
                                </td>
                                <td>
                                    <textarea rows="2" style="width:150px;" name="adresse">
                                        
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Nom Adresse</label>
                                </td>
                                <td>
                                    <input type="text" name="nomadresse"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Telephone</label>
                                </td>
                                <td>
                                    <input type="text" name="telephone"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Password</label>
                                </td>
                                <td>
                                    <input type="text" name="password"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Administration</label>
                                </td>
                                <td>
                                    <input type="checkbox" name="administrateur" />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="d_ajouter_content_bottom">
                        <div id="d_ajouter_content_left" onclick="document.getElementById('d_ajouter').style.display='none'">
                            <span>Anuller</span>
                        </div>
                        <div id="d_ajouter_content_right" onclick="document.getElementById('formClient').submit()">
                            <span>Ajouter</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>                      
    </body>
</html>



