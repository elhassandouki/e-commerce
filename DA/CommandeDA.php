<?php
namespace GestionStock\DA;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Commande as Commande;
use GestionStock\Library\Client as Client;
require_once '..\library\Connexion.php';
require_once '..\library\Commande.php';
require_once '..\library\Client.php';
require_once 'ClientDA.php';

class CommandeDA{
    
    private $connexion;
    private $query;
    private $result;
    
    public function __construct() {
        $this->connexion =  new Connexion("localhost", "root", "", "site");
    }
    
    public function ajouter(Commande $commande){
        $this->query = "Insert Into commandes (client) Values (".$commande->getClient().")";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        if($this->result != 0){
            return $this->getLastCodeCommande();
        }
        else{
            return 0;
        }
    }
    
    public function modifier(){
        // ...
    }
    
    public function supprimer(Commande $commande){
        $this->query = "Delete From commandes Where numCommande = ".$commande->getCodeCommande();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function getCommandes(){
        $this->query = "Select numcommande,client,dateCommande,totalCommande From commandes";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $commandes = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $cmd = new Commande();
            $cmd->setCodeCommande($row->numcommande);
            $cmd->setClient((new ClientDA())->getClientsByCode($row->client));
            $cmd->setDateCommande($row->dateCommande);
            $this->query = "Select * From vProduitCommande Where numcommande = ".$row->numcommande;
            $r = mysqli_query($this->connexion->connect(), $this->query);
            $total = 0;
            while ($row = mysqli_fetch_object($r)){
                $t = $row->prixunitaire * $row->quantite;
                $total = $total + $t;
            }
            $cmd->setTotalCommande($total);
            $commandes[$i] = $cmd;
            $i++;
        }
        return $commandes;
    }
    
    public function getCommandeByCode($codeCommande){
        $this->query = "Select numcommande,client,dateCommande,totalCommande From commandes"
                . " Where numcommande = ".$codeCommande;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $commandes = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $cmd = new Commande();
            $cmd->setCodeCommande($row->numcommande);
            $cmd->setClient((new ClientDA())->getClientsByCode($row->client));
            $cmd->setDateCommande($row->dateCommande);
            $this->query = "Select * From vProduitCommande Where numcommande = ".$row->numcommande;
            $r = mysqli_query($this->connexion->connect(), $this->query);
            $total = 0;
            while ($row = mysqli_fetch_object($r)){
                $t = $row->prixunitaire * $row->quantite;
                $total = $total + $t;
            }
            $cmd->setTotalCommande($total);
            $commandes[$i] = $cmd;
            $i++;
        }
        return $commandes;
    }
    
    public function getCommandesByClient($client){
        $this->query = "Select numcommande,client,dateCommande,totalCommande From commandes"
                . " Where client = ".$client;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $commandes = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $cmd = new Commande();
            $cmd->setCodeCommande($row->numcommande);
            $cmd->setClient((new ClientDA())->getClientsByCode($row->client));
            $cmd->setDateCommande($row->dateCommande);
            $this->query = "Select * From vProduitCommande Where numcommande = ".$row->numcommande;
            $r = mysqli_query($this->connexion->connect(), $this->query);
            $total = 0;
            while ($row = mysqli_fetch_object($r)){
                $t = $row->prixunitaire * $row->quantite;
                $total = $total + $t;
            }
            $cmd->setTotalCommande($total);
            $commandes[$i] = $cmd;
            $i++;
        }
        return $commandes;
    }
    
    public function getTotalCommandesByClient($client){
        $this->query = "Select numcommande From commandes"
                . " Where client = ".$client;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $i = 0;
        $totalcommandes = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $this->query = "Select * From vProduitCommande Where numcommande = ".$row->numcommande;
            $r = mysqli_query($this->connexion->connect(), $this->query);
            $total = 0;
            while ($row = mysqli_fetch_object($r)){
                $t = $row->prixunitaire * $row->quantite;
                $total = $total + $t;
            }
            $totalcommandes += $total;
            $i++;
        }
        return $totalcommandes;
    }
    
    public function getLastCodeCommande(){
        $this->query = "Select numcommande From commandes order by numcommande desc";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $row = mysqli_fetch_object($this->result);
        return $row->numcommande;
    }
    
    public function getTotalCommande($codecommande){
        $this->query = "Select * From vProduitCommande Where numcommande = ".$codecommande;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $total = 0;
        while ($row = mysqli_fetch_object($this->result)){
            $t = $row->prixunitaire * $row->quantite;
            $total = $total + $t;
        }
        return $total;
    }
    
    // -----------------------------------------------------------------------
    
    public function ajoutercommande($client,$session){
        $pe = false;
        $this->query = "Select * From lignesession where session_id ='".$session."'";
        $this->result = mysqli_query($this->connexion->connect(),$this->query);
        while($row = mysqli_fetch_object($this->result))
        {
            //mysqli_begin_transaction();
            $this->query = "Select stock from produits where reference = ".$row->ref;
            $r = mysqli_query($this->connexion->connect(),$this->query);
            $ligne = mysqli_fetch_object($r);
            if($ligne->stock < $row->qte){
                $this->query = "Delete From lignessession Where session_id = '".$session."', and ref = ".$row->ref;
                mysqli_query($this->connexion->connect(),$this->query); 
                $pe = true;
            }
        }
        if($pe == true){
            header("location:details.php");
            exit;
        }
        else{
            $codecmd = 0;
            $this->query = "Insert into commandes (client) values (".$client->getClientId().")";
            $this->result = mysqli_query($this->connexion->connect(),$this->query);
            if($this->result != 0){
                $this->query = "select numcommande from commandes order by numcommande desc";
                $this->result = mysqli_query($this->connexion->connect(),$this->query);
                $row = mysqli_fetch_object($this->result);
                $codecmd = $row->numcommande;
            }
            $this->query = "Select * From lignessession where session_id ='".$session."'";
            $this->result = mysqli_query($this->connexion->connect(),$this->query);
            while($row = mysqli_fetch_object($this->result))
            {
                $this->query = "INSERT INTO lignes (numcommande, refproduit, quantite) VALUES (".$codecmd.",".$row->ref.",".$row->qte.")";
                mysqli_query($this->connexion->connect(),$this->query);
            }
            $this->query = "Delete From lignessession Where session_id = '".$session."'";
            mysqli_query($this->connexion->connect(),$this->query);
            $_SESSION['count_produit'] = null;
            header("location:mescommandes.php");
        }
    }
    
    
}

