<div id="d_header">
    <a href="index.php"><img src="img/shop.jpg" id="maison_img"/></a>
        <table>
            <tr>
                <td>
                    <a href="#">Aide</a>
                </td>
                    <?php 
                        if(isset($_SESSION['client']))
                        {
                            $client = $_SESSION['client'];
                            echo '<td>|</td><td>'
                                    . '<select>'
                                        . '<option>Bonjour '.$client->getNom().'</option>'
                                        . '<option onclick="location.href=\'mescoordonees.php\'">Mon compte</option>'
                                        . '<option onclick="location.href=\'mescommandes.php\'">Mes Commandes</option>'
                                        . '<option onclick="location.href=\'mesadresses.php\'">Mes Adresses</option>'
                                        . '<option onclick="location.href=\'deconnexion.php\'">Déconnexion</option>'
                                    . '</select>'
                                 . '</td>';
                            if($client->getAdministrateur() == 1)
                            {
                                echo '<td>|</td>'
                                     . '<td>'
                                        . '<span onclick="location.href=\'../administration/compte.php?client='.$client->getClientId().'\'" style="cursor:pointer;color:red">Administration</span>'
                                     . '</td>';
                            }
                        }
                        else
                        {
                           echo '<td>|</td><td><a href="moncompte.php">Mon compte</a></td>';     
                        }
                    ?>
                    <td >|</td>
                    <td id="jax">
                        <?php
                            if(isset($_SESSION["count_produit"])){
                                echo '<a href="details.php">Mon panier( '.$_SESSION["count_produit"].' )</a>';
                            }
                            else{
                                echo '<a href="details.php">Mon panier( 0 )</a>';
                            }
                        ?>
                    </td>
                </tr>
            </table>
            <p></p>
            <a href="index.php"><img src="img/home.png" id="accueil_img"/></a>
</div>