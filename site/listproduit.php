<?php 
namespace GestionStock;
use GestionStock\Library\Client as Client;
use GestionStock\Library\Categorie as Categorie;
use GestionStock\DA\CategorieDA as CategorieDA;
use GestionStock\DA\ProduitDA as ProduitDA;
require_once '../library/Categorie.php';
require_once '../DA/CategorieDA.php';
require_once '../DA/ProduitDA.php';
require_once '../library/Client.php';
session_start();
$categorie = 3;
if(isset($_GET['categorie'])){
    $categorie = $_GET['categorie'];
}
if($categorie == 0){
    $categorie = 3;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require 'head_listproduit.php'; ?>
    </head>
    <body>
        <!-- Header page -->
        <?php require 'header.php'; ?>
        
        <!-- Menu -->
        <?php require 'menu.php'; ?>
        
        <div id ="d_content">
            
           <div id="d_left">
                
                <div id="d_leftt_top">
                    <?php
                        $catDA = new CategorieDA();
                        $tblcategories = $catDA->getCategories();
                        for($i = 0 ; $i < count($tblcategories); $i++){
                            if($tblcategories[$i]->getCategorieId() == $categorie){
                                echo '<h1>'.$tblcategories[$i]->getCategorie().'</h1>';
                            }
                        }
                    ?>
                </div>
                
                <div id="d_left_center">
                    
                </div>
                
                <div id="d_left_bottom">
                    <img src="img/livraison_retours.jpg"/>
                </div>
                
            </div>
            
            <div id="d_right">
                <div id="d_right_top">
                    
                    <div id="d_right_top_left">
                        <?php
                            $prodDA = new ProduitDA();
                            $count_produit = $prodDA->getCountProduitsByCategorieId($categorie);
                            echo '<table><tr><td><div>'.$count_produit.' Article(s)</div></td></tr><tr><td><div>';
                            for($i = 0 ; $i < count($tblcategories); $i++){
                                if($tblcategories[$i]->getCategorieId() == $categorie){
                                            echo 'SHOP &blacktriangleright; '.$catDA->getCategorieById($tblcategories[$i]->getParent()).' &blacktriangleright; '.$tblcategories[$i]->getCategorie();
                                } 
                            }
                            echo '</div></td></tr></table>';
                        ?>
                    </div>
                    
                    <div id="d_right_top_right">
                        <?php
                            $page = 1;
                            if(isset($_GET['page'])){
                                $page = $_GET['page'];
                            }
                            if($page == 0){
                                $page = 1;
                            }
                            $next = $prev = $page;
                            $records_at_page = 9;
                            if(isset($_GET['affichage']))
                            {
                                $records_at_page = $_GET['affichage'];
                            }
                            if($records_at_page == 0){
                                $records_at_page = 9;
                            }
                            $pages_count = ceil($count_produit / $records_at_page);
                            echo '<table><tr>'
                                    . '<td>Affichage :</td>'
                                    . '<td><a href="listproduit.php?page='.$page.'&categorie='.$categorie.'&affichage=9" style="display:block;padding-left:5px;padding-right:5px;border:solid 1px #e8e8e8;text-decoration:none;color:grey">9</a></td>'
                                    . '<td><a href="listproduit.php?page='.$page.'&categorie='.$categorie.'&affichage=18" style="display:block;padding-left:5px;padding-right:5px;border:solid 1px #e8e8e8;text-decoration:none;color:grey">18</a></td>'
                                    . '<td><a href="listproduit.php?page='.$page.'&categorie='.$categorie.'&affichage=24" style="display:block;padding-left:5px;padding-right:5px;border:solid 1px #e8e8e8;text-decoration:none;color:grey">24</a></td>'
                                    . '<td style="display:block;width:40px"></td>';
                            if($prev > 1)
                            {
                                $prev--;
                                echo '<td><a href="listproduit.php?page='.$prev.'&categorie='.$categorie.'&affichage='.$records_at_page.'" style="display:block;padding-left:5px;padding-right:5px;border:solid 1px #e8e8e8;text-decoration:none;color:grey"><< précédente</a></td>';
                                //echo '<td>|</td>';
                            }
                            for($i = 1; $i <= $pages_count;$i++)
                            {
                                if($i == $page)
                                {
                                    echo '<td style="color:#e8e8e8">'.$i.'</td>';
                                }
                                else
                                {
                                    echo '<td><a href="listproduit.php?page='.$i.'&categorie='.$categorie.'&affichage='.$records_at_page.'" style="display:block;padding-left:5px;padding-right:5px;border:solid 1px #e8e8e8;text-decoration:none;color:grey">'.$i.'</a></td>';
                                }
                                if($i != $pages_count)
                                {
                                  //echo '<td>|</td>';
                                }
                            }

                            if($next < $pages_count)
                            {
                                $next++;
                                //echo '<td>|</td>';
                                echo '<td><a href="listproduit.php?page='.$next.'&categorie='.$categorie.'&affichage='.$records_at_page.'" style="display:block;padding-left:5px;padding-right:5px;border:solid 1px #e8e8e8;text-decoration:none;color:grey">suivante >></a></td>';
                            }
                        ?>
                        </tr></table>
                    </div>
                            
                </div>
                
                <div id="d_right_center">
                    <?php
                        $start = ($page - 1) * $records_at_page;
                        $tblproduits = $prodDA->getProduitsByCategorieId($categorie);
                        for($i = 0 ; $i < $records_at_page; $i++){
                            if($start < count($tblproduits)){
                                echo '<div class="d_produit">';
                                        echo '<img src="../administration/images/produits/'.$tblproduits[$start]->getImage().'"/>';
                                        echo '<table>'
                                                . '<tr>'
                                                    . '<td colspan="2" style="font-size:14px;border:solid 1px #ccc;border-radius:5px 5px 5px 5px">'.$tblproduits[$start]->getDesignation().'</td>'
                                                . '</tr>';
                                             echo '<tr>'
                                                    . '<td style="border:solid 1px #ccc;border-radius:5px 5px 5px 10px;color:#fb565a">'.number_format($tblproduits[$start]->getPrixUnitaire(),2).' Dh</td>';
                                                 echo '<td>'
                                                        . '<div onclick="add('.$tblproduits[$start]->getproduitId().',\''.$tblproduits[$start]->getImage().'\')" style="padding:5px;float:left;color:#fff;background-color:#fb565a;cursor:pointer;border-radius:5px 5px 10px 5px;">'
                                                            . '<span>Ajouter au panier</span>'
                                                        . '</div>'
                                                    . '</td>'
                                                . '</tr>'
                                              . '</table>'
                                    . '</div>';
                                    $start++;
                            }
                        }
                    ?>
                </div>
                
                <div id="d_right_bottom">
                    <?php
                        $next = $prev = $page;
                        echo '<table><tr>';
                        if($prev > 1)
                            {
                                $prev--;
                                echo '<td><a href="listproduit.php?page='.$prev.'&categorie='.$categorie.'&affichage='.$records_at_page.'" style="display:block;padding-left:5px;padding-right:5px;border:solid 1px #e8e8e8;text-decoration:none;color:grey"><< précédente</a></td>';
                                //echo '<td>|</td>';
                            }
                            for($i = 1; $i <= $pages_count;$i++)
                            {
                                if($i == $page)
                                {
                                    echo '<td style="color:#e8e8e8">'.$i.'</td>';
                                }
                                else
                                {
                                    echo '<td><a href="listproduit.php?page='.$i.'&categorie='.$categorie.'&affichage='.$records_at_page.'" style="display:block;padding-left:5px;padding-right:5px;border:solid 1px #e8e8e8;text-decoration:none;color:grey">'.$i.'</a></td>';
                                }
                                if($i != $pages_count)
                                {
                                  //echo '<td>|</td>';
                                }
                            }

                            if($next < $pages_count)
                            {
                                $next++;
                                //echo '<td>|</td>';
                                echo '<td><a href="listproduit.php?page='.$next.'&categorie='.$categorie.'&affichage='.$records_at_page.'" style="display:block;padding-left:5px;padding-right:5px;border:solid 1px #e8e8e8;text-decoration:none;color:grey">suivante >></a></td>';
                            }
                        ?>
                        <td class="td_space"></td><td class="td_space"></td>
                        <td><a class="back-to-top" href="#">Haut de page</a></td>
                        <td>
                            <img src="img/FlecheTop.png"/>
                        </td>
                        </tr>
                    </table>
                </div>
                
                
            </div>

        </div>
        
        <?php
            require 'footer.php';
        ?>
        
        <div id="dmsg">
            <div id="dmsg_top">
                <h2>Article ajouté à mon panier</h2>
            </div>
            <div id="dmsg_center">
                <img id="msgimg" src="img/produits/Pure Box T.jpg" />
            </div>
            <div id="dmsg_bottom">
                <div id="dmsg_bottom_left" onclick="document.getElementById('dmsg').style.display = 'none';document.getElementById('block').style.display = 'none'" style="border-radius:5px">
                    <span>Continuer mes achats</span>
                </div>
                <div id="dmsg_bottom_right" onclick="location.href='details.php'" style="border-radius:5px">
                    <span>Finaliser ma commande</span>
                </div>
            </div>
        </div>
        <div id="block"></div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>
        jQuery(document).ready(function() {
            var offset = 250;
            var duration = 300;
            jQuery(window).scroll(function() {
                if (jQuery(this).scrollTop() > offset) {
                    jQuery('.back-to-top').fadeIn(duration);
                } else {
                    jQuery('.back-to-top').fadeOut(duration);
                }
            });

            jQuery('.back-to-top').click(function(event) {
                event.preventDefault();
                jQuery('html, body').animate({scrollTop: 0}, duration);
                return false;
            })
        });
        </script>
    </body>
</html>

