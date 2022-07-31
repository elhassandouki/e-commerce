<?php
namespace GestionStock\administration;
use GestionStock\Library\Commande as Commande;
use GestionStock\DA\CommandeDA as CommandeDA;
use GestionStock\Library\Client as Client;
use GestionStock\DA\ClientDA as ClientDA;
require_once '../library/Client.php';
require_once '../DA/ClientDA.php';
require_once '../library/Commande.php';
require_once '../DA/CommandeDA.php';
session_start();
if(!isset($_SESSION['client'])){
    header('location:../site/moncompte.php');
    exit;
}
$client = 0;
if(isset($_GET['client'])){
    $client = (int)$_GET['client']; 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'headCommande.php'; ?>
    </head>
    <body>
        <?php
            require 'menu.php';
        ?>
        
        <div id="d_content">
            
            <div id="d_content_top" title="ajouter nouveau commande">
                <?php
                    if($client != 0){
                    echo '<div onclick="location.href=\'ajouterCommande.php?client='.$client.'\'">'
                          . '<img src="images/plus.png"/>
                         </div>';
                    }
                ?>
            </div>
            <div id="d_content_center">
                <table>
                    <tr>
                        <th>N°</th>
                        <th>Client</th>
                        <th><span>Date de Commande</span></th>
                        <th><span>Total de Commande</span></th>
                        <th>Details</th>
                        <th>Supprimer</th>
                    </tr>
                    <?php 
                        $clDA = new ClientDA();
                        $tblclients = array();
                        $tblclients = $clDA->getClients();                        
                        $codecmd = 0;
                        if(isset($_GET['codecmd'])){
                            $codecmd = (int)$_GET['codecmd'];
                        }
                        $cmdDA = new CommandeDA();
                        $tblcommandes = array();
                        if($client != 0){
                            $tblcommandes = $cmdDA->getCommandesByClient($client);
                        }
                        else{
                            $tblcommandes = $cmdDA->getCommandes();
                        }
                        for($i=0;$i < count($tblcommandes);$i++){
                            echo '<tr>
                                    <td>
                                        <span>'.($i + 1).'</span>
                                    </td>
                                    <td>
                                        <a href="clients.php?client='.$tblcommandes[$i]->getClient()[0]->getClientId().'">'.$tblcommandes[$i]->getClient()[0]->getNomComplet().'</a>
                                    </td>
                                    <td>
                                        '.$tblcommandes[$i]->getDateCommande().'
                                    </td>
                                    <td>
                                        '.$tblcommandes[$i]->getTotalCommande().' Dhs
                                    </td>
                                    <td>
                                        <div>
                                            <a href="lignes.php?commande='.$tblcommandes[$i]->getCodeCommande().'"><img src="images/list.png" /></a>
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
                                                <a href="supprimerCommande.php?codeCommande='.$tblcommandes[$i]->getCodeCommande().'&client='.$client.'">
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
                            
         <form id="formCommande" method="post" action="ajouterCommande.php">  
            <div id="d_ajouter">
                <div id="d_ajouter_content">
                    <div id="d_ajouter_content_top">
                        <h1>Commande</h1>
                    </div>
                    <div id="d_ajouter_content_center">
                        <p>Ajouter nouveau Commande</p>
                        <table>
                            <tr>
                                <td>
                                    <label>Client</label>
                                </td>
                                <td>
                                    <select name="client">
                                        <?php
                                            for($i=0;$i < count($tblclients);$i++){
                                                echo '<option value="'.$tblclients[$i]->getClientId().'">'.$tblclients[$i]->getClientId() .' - '. $tblclients[$i]->getNomComplet().'</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="d_ajouter_content_bottom">
                        <div id="d_ajouter_content_left" onclick="document.getElementById('d_ajouter').style.display='none'">
                            <span>Anuller</span>
                        </div>
                        <div id="d_ajouter_content_right" onclick="">
                            <span>Ajouter</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>                      
    </body>
</html>



