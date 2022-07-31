<?php
namespace GestionStock\DA;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Ligne as Ligne;
use GestionStock\Library\Produit as Produit;
require_once '../library/Connexion.php';
require_once '../library/Ligne.php';
require_once 'CommandeDA.php';
require_once 'ProduitDA.php';
require_once '../library/Produit.php';

class LigneDA{
    
    private $connexion;
    private $query;
    private $result;
    
    public function __construct() {
        $this->connexion =  new Connexion("localhost", "root", "", "site");
    }
    
    public function ajouter(Ligne $ligne){
        $this->query = "Insert Into lignes (numCommande,refProduit,quantite) Values "
                . "(".$ligne->getCommande().",".$ligne->getProduit().",".$ligne->getQuantite().")";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function modifier(Ligne $ligne){
        $this->query = "Update lignes set quantite = ".$ligne->getQuantite()." Where numLigne = ".$ligne->getNumero();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function supprimer(Ligne $ligne){
        $this->query = "Delete From Lignes Where numLigne = ".$ligne->getNumero();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function getLignesByCommande($commande){
        $this->query = "Select numLigne,numCommande,refProduit,quantite,totalLigne From lignes"
                . " Where numCommande = ".$commande;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $lignes = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $ligne = new Ligne();
            $ligne->setNumero($row->numLigne);
            $ligne->setCommande((new CommandeDA())->getCommandeByCode($row->numCommande));
            $ligne->setProduit((new ProduitDA())->getProduitByRef($row->refProduit));
            $ligne->setQuantite($row->quantite);
            $ligne->setTotal($ligne->getProduit()[0]->getPrixUnitaire() * $row->quantite);
            $lignes[$i] = $ligne;
            $i++;
        }
        return $lignes;
    }
    
    // -----------------------------------------------------------------------
    
    public function ajouterLigneSession($reference,$session){
        $this->query = "Select * From Lignessession";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        while($row = mysqli_fetch_object($this->result))
        {
            if($reference == $row->ref && $session == $row->session_id)
            {
                $this->query = "Update Lignessession set qte = qte + 1 Where ref = $reference and session_id ='".$session."'";
                $r = mysqli_query($this->connexion->connect(), $this->query);
                return $r;
            }
        }
        if($reference != 0){
            $this->query = "Insert Into Lignessession (session_id,ref,qte) Values ('".$session."',$reference,1)";
            $r = mysqli_query($this->connexion->connect(), $this->query);
            return $r;
        }
    }
    
    public function supprimerLignesSession($session){
        $this->query = "Delete From Lignessession Where session_id = '".$session."'";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
    }
    
}



