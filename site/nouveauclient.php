<form id="form1" method="post" action="ajouterclient.php"/>
<div id="d_bottom_jax">
                    <div id="d_bottom_left_jax">   
                        <div id="d_bottom_left_jax_top">
                            <h2>NOUVEAU CLIENT ?</h2>
                        </div> 
                    
                        <div id="d_bottom_left_jax_bottom">
                            <div id="d_bottom_left_jax_bottom_top">
                                <h4>1.Mes information personnelles</h4>
                                <table>
                                    <tr>
                                        <td>
                                            <label>Civilité<span> *</span></label>
                                        </td>
                                        <td>
                                            <select name="civilite">
                                                <option value="Monsieur" selected="selected">Monsieur</option>
                                                <option value="Madame">Madame</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nom<span> *</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="nom"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Prénom<span> *</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="prenom"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Date de naissance<span> *</span></label>
                                        </td>
                                        <td>
                                            <select name="days">
                                                <?php
                                                for($i = 1 ; $i <= 31 ; $i++ ){
                                                    if($i < 10){    
                                                        echo '<option>0'.$i.'</option>';
                                                    }
                                                    else{
                                                        echo '<option>'.$i.'</option>';
                                                    }
                                                   
                                                }
                                                ?>
                                            </select>
                                            <select name="months">
                                                <?php
                                                for($i = 1 ; $i <= 12 ; $i++ ){
                                                    if($i < 10){    
                                                        echo '<option>0'.$i.'</option>';
                                                    }
                                                    else{
                                                        echo '<option>'.$i.'</option>';
                                                    }
                                                   
                                                }
                                                ?>
                                            </select>
                                            <select name="years">
                                                <?php
                                                    for($i = 2000 ; $i >= 1980 ; $i-- ){
                                                        echo '<option>'.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <img src="img/cadeau.gif"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id="d_bottom_left_jax_bottom_bottom">
                                <h4>2.Mes identifiants </h4>
                                <table>
                                    <tr>
                                        <td>
                                            <label>Email<span> *</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="email"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Mot de passe<span> *</span></label>
                                        </td>
                                        <td>
                                            <input type="password" name="pw"/>
                                        </td>
                                        <td><label class="c_m">(6 caracteres minimum)</label></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>confirmer le mot de passe<span> *</span></label>
                                        </td>
                                        <td>
                                            <input type="password" name="confpw"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Telephone<span> *</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="tel"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="d_bottom_righ_jaxt">
                        <div id="d_bottom_righ_jaxt_top">
                            <span>*champs obligatoires</span>
                        </div>
                        <div id="d_bottom_righ_jaxt_center">
                            <h4>3.Mes Adresse de facturation</h4>
                            <table>
                                    <tr>
                                        <td>
                                            <label>Ville<span> *</span></label>
                                        </td>
                                        <td>
                                            <select name="ville">
                                                <option>Agadir</option>
                                                <option>Casablanca</option>
                                                <option>Marrakech</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Code postal<span> *</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="cp"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Adresse de facturation<span> *</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="adrfacture"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nommer cette adresse<span> *</span></label>
                                        </td>
                                        <td>
                                            <input type="text" name="nomadr" placeholder="Maison,Travail"/>
                                        </td>
                                    </tr>
                                </table>
                        </div>
                        <div id="d_bottom_righ_jaxt_bottom">
                            <div id="d_bottom_righ_jaxt_bottom_valide" onclick="document.getElementById('form1').submit();" style="border-radius: 5px;">
                                <span>VALIDE</span>
                                <img src="img/next.png" />
                            </div>
                        </div>
                   
                    </div>
    </div>
 </form>
