<?php 
namespace GestionStock\Site;
use GestionStock\Library\Client as Client;
use GestionStock\Library\Commande as Commande;
use GestionStock\DA\ProduitDA as ProduitDA;
use GestionStock\DA\MarqueDA as MarqueDA;
require_once '../library/Client.php'; 
require_once '../library/Commande.php';
require_once '../DA/ProduitDA.php';
require_once '../DA/MarqueDA.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>  
        <?php require 'head_home.php'; ?>
    </head>
    <body>              
        <!-- Header page -->
        <?php  require 'header.php'; ?>
        
        <!-- Menu -->
        <?php require 'menu.php'; ?>
        
        <!-- Vedio -->
        <div id ="d_content">
            
            <div id="d_content_top">
                    <div id="d_content_top_video">
                        <video autoplay>
                            <source src="vedio/movie.ogv" type="video/ogg">
                        </video> 
                    </div>
            </div>
            
            <div id="d_content_center">
                <div id="d_content_center_left">
                    <div class="c_content_center_left_top">
                        <?php 
                            $prodDA = new ProduitDA();
                            $marqDA = new MarqueDA();
                            $p1 = 3;
                            $p2 = 7;
                            $p3 = 0;
                            $p4 = 6;
                            $tblproduits = $prodDA->getProduits();
                            echo '<img src="../administration/images/produits/'.$tblproduits[$p1]->getImage().'"/>';
                        ?>
                    </div>
                    <div class="c_content_center_left_bottom">
                        <table>
                            <tr>
                                <td><?php echo $marqDA->getMarqueById($tblproduits[$p1]->getMarque())->getMarque(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $tblproduits[$p1]->getDesignation() ?></td>
                            </tr>
                            <tr>
                                <?php
                                echo '<td><a href="listproduit.php?categorie='.$tblproduits[$p1]->getCategorie().'">Voir les nouveautés de la semaine</a></td>';
                                ?>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="d_content_center_lcenter">
                    <div class="c_content_center_left_top">
                        <?php 
                            echo '<img src="../administration/images/produits/'.$tblproduits[$p2]->getImage().'"/>';
                        ?>
                    </div>
                    <div class="c_content_center_left_bottom">
                        <table>
                            <tr>
                                <td><?php echo $marqDA->getMarqueById($tblproduits[$p2]->getMarque())->getMarque(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $tblproduits[$p2]->getDesignation() ?></td>
                            </tr>
                            <tr>
                                <?php
                                echo '<td><a href="listproduit.php?categorie='.$tblproduits[$p2]->getCategorie().'">Voir les nouveautés de la semaine</a></td>';
                                ?>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="d_content_center_rcenter">
                    <div class="c_content_center_left_top">
                        <?php 
                            echo '<img src="../administration/images/produits/'.$tblproduits[$p3]->getImage().'"/>';
                        ?>
                    </div>
                    <div class="c_content_center_left_bottom">
                         <table>
                            <tr>
                                <td><?php echo $marqDA->getMarqueById($tblproduits[$p3]->getMarque())->getMarque(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $tblproduits[$p3]->getDesignation() ?></td>
                            </tr>
                            <tr>
                                <?php
                                echo '<td><a href="listproduit.php?categorie='.$tblproduits[$p3]->getCategorie().'">Voir les nouveautés de la semaine</a></td>';
                                ?>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="d_content_center_right">
                   <div class="c_content_center_left_top">
                       <?php 
                            echo '<img src="../administration/images/produits/'.$tblproduits[$p4]->getImage().'"/>';
                        ?>
                    </div>
                    <div class="c_content_center_left_bottom">
                        <table>
                            <tr>
                                <td><?php echo $marqDA->getMarqueById($tblproduits[$p4]->getMarque())->getMarque(); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $tblproduits[$p4]->getDesignation() ?></td>
                            </tr>
                            <tr>
                                <?php
                                echo '<td><a href="listproduit.php?categorie='.$tblproduits[$p4]->getCategorie().'">Voir les nouveautés de la semaine</a></td>';
                                ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div id="d_content_bottom">
                <p>Avec maison plus, vous commandez en toute simplicité, grâce à un panier unique regroupant tous vos achats.
                    La livraison est effectuée en 24h chrono à votre domicile.</p>
            </div> 
        </div>
        
        <?php
            require 'footer.php';
        ?>
    </body>
</html>

