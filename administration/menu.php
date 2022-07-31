<?php
$cl = null;
if(isset($_SESSION['client'])){
    $cl = $_SESSION['client'];
}
?>
<div id="d_sidemenu">
            <div class="d_category" onclick="location.href='../site'">
                <div class="d_title">
                    <span>Site</span>
                </div>
                <div class="d_image">
                    <img src="images/site.png">
                </div>
            </div>
            <div class="d_category" <?php echo 'onclick="location.href=\'compte.php?client='.$cl->getClientId().'\'"'; ?> >
                <div class="d_title">
                    <span>Compte</span>
                </div>
                <div class="d_image">
                    <img src="images/compte.png">
                </div>
            </div>
            <div class="d_category" onclick="location.href='categories.php'">
                <div class="d_title">
                    <span>Categories</span>
                </div>
                <div class="d_image">
                    <img src="images/categorie.png">
                </div>
            </div>
            <div class="d_category" onclick="location.href='marques.php'">
                <div class="d_title">
                    <span>Marques</span>
                </div>
                <div class="d_image">
                    <img src="images/marque.png">
                </div>
            </div>
            <div class="d_category" onclick="location.href='produits.php'">
                <div class="d_title">
                    <span>Produits</span>
                </div>
                <div class="d_image">
                    <img src="images/produit.png">
                </div>
            </div>
            <div class="d_category" onclick="location.href='clients.php'">
                <div class="d_title">
                    <span>Clients</span>
                </div>
                <div class="d_image">
                    <img src="images/client.png">
                </div>
            </div>
            <div class="d_category" onclick="location.href='commandes.php'">
                <div class="d_title">
                    <span>Commandes</span>
                </div>
                <div class="d_image">
                    <img src="images/commande.png">
                </div>
            </div>
</div>

