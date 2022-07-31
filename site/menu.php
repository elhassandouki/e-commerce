<?php
namespace GestionStock\Site;
use GestionStock\Library\Categorie as Categorie;
use GestionStock\DA\CategorieDA as CategorieDA;
require_once '../library/Categorie.php';
require_once '../DA/CategorieDA.php';
?>
<div id="d_menu">
    <nav id="primary_nav_wrap">
        <ul>
          <li class="current-menu-item">S H O P</li>
          <?php 
            $catDA = new CategorieDA();
            $tblcategories = $catDA->getCategories();
            for($i = 0; $i < count($tblcategories); $i++)
            {
                if($tblcategories[$i]->getParent() == 0)
                {
                    echo '<li><a>'.$tblcategories[$i]->getCategorie().'</a><ul>';
                    for($j = 0; $j < count($tblcategories); $j++)
                    {
                        if($tblcategories[$i]->getCategorieId() == $tblcategories[$j]->getParent())
                        {
                            echo '<li><a href="listproduit.php?categorie='.$tblcategories[$j]->getCategorieId().'">'.$tblcategories[$j]->getCategorie().'</a></li>';
                        }
                    }
                    echo "</ul></li>";
                }
            }
          ?>
        </ul>
    </nav>
</div>