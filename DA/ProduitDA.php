<?php
namespace GestionStock\DA;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Produit as Produit;
require_once '../library/Connexion.php';
require_once '../library/Produit.php';
require_once 'MarqueDA.php';
require_once 'CategorieDA.php';

class ProduitDA{
    
    private $connexion;
    private $query;
    private $result;
    
    public function __construct() {
        $this->connexion =  new Connexion("localhost", "root", "", "site");
    }
    
    public function ajouter(Produit $produit){
        $marqDA = new MarqueDA($this->connexion);
        $catDA = new CategorieDA($this->connexion);
        $this->query = "Insert Into produits (designation,marque,categorie,prixunitaire,stock,image)Values"
                . "('".$produit->getDesignation()."'"
                . ", ".$marqDA->getMarqueIdByMarque($produit->getMarque()).""
                . ", ".$catDA->getCategorieIdByCategorie($produit->getCategorie()).""
                . ", ".$produit->getPrixUnitaire().""
                . ", ".$produit->getStock().""
                . ", '".$produit->getImage()."')";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function modifier(Produit $produit){
        $marqDA = new MarqueDA($this->connexion);
        $catDA = new CategorieDA($this->connexion);
        $this->query = "Update produits set designation = '".$produit->getDesignation()."'"
                . ", marque = ".$marqDA->getMarqueIdByMarque($produit->getMarque()).""
                . ", categorie = ".$catDA->getCategorieIdByCategorie($produit->getCategorie()).""
                . ", prixunitaire = ".$produit->getPrixUnitaire().""
                . ", stock = ".$produit->getStock().""
                . ", image = '".$produit->getImage()."'"
                . " Where reference = ".$produit->getproduitId();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function supprimer(Produit $produit){
        $this->query = "Delete From produits Where reference = ".$produit->getproduitId();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    } 
    
    public function getProduits(){
        $this->query = "Select reference,image,designation,marque,categorie,prixunitaire,stock From produits";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $produits = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $prod = new Produit();
            $prod->setproduitId($row->reference);
            $prod->setImage($row->image);
            $prod->setDesignation($row->designation);
            $prod->setMarque($row->marque);
            $prod->setCategorie($row->categorie);
            $prod->setPrixUnitaire($row->prixunitaire);
            $prod->setStock($row->stock);
            $produits[$i] = $prod;
            $i++;
        }
        return $produits;
    }
    
    public function getProduitByRef($reference){
        $this->query = "Select reference,image,designation,marque,categorie,prixunitaire,stock From produits"
                . " Where reference = ".$reference;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $produits = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $prod = new Produit();
            $prod->setproduitId($row->reference);
            $prod->setImage($row->image);
            $prod->setDesignation($row->designation);
            $prod->setMarque($row->marque);
            $prod->setCategorie($row->categorie);
            $prod->setPrixUnitaire($row->prixunitaire);
            $prod->setStock($row->stock);
            $produits[$i] = $prod;
            $i++;
        }
        return $produits;
    }
    
    public function getProduitByMarque($marque){
        $marqDA = new MarqueDA($this->connexion);
        $this->query = "Select reference,image,designation,marque,categorie,prixunitaire,stock From produits"
                . " Where marque = ".$marqDA->getMarqueIdByMarque($marque);
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $produits = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $prod = new Produit();
            $prod->setproduitId($row->reference);
            $prod->setImage($row->image);
            $prod->setDesignation($row->designation);
            $prod->setMarque($row->marque);
            $prod->setCategorie($row->categorie);
            $prod->setPrixUnitaire($row->prixunitaire);
            $prod->setStock($row->stock);
            $produits[$i] = $prod;
            $i++;
        }
        return $produits;
    }
    
    public function getProduitByCategorie($categorie){
        $catDA = new CategorieDA($this->connexion);
        $this->query = "Select reference,image,designation,marque,categorie,prixunitaire,stock From produits"
                . " Where categorie = ".$catDA->getCategorieIdByCategorie($categorie);
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $produits = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $prod = new Produit();
            $prod->setproduitId($row->reference);
            $prod->setImage($row->image);
            $prod->setDesignation($row->designation);
            $prod->setMarque($row->marque);
            $prod->setCategorie($row->categorie);
            $prod->setPrixUnitaire($row->prixunitaire);
            $prod->setStock($row->stock);
            $produits[$i] = $prod;
            $i++;
        }
        return $produits;
    }
    
    public function getCountProduitsByCategorieId($categorie){
        $this->query = "SELECT * FROM produits Where categorie = $categorie";
        $this->result = mysqli_query($this->connexion->connect(),$this->query);
        return mysqli_num_rows($this->result);
    }
    
    public function getProduitsByCategorieId($categorie){
        $this->query = "Select reference,image,designation,marque,categorie,prixunitaire,stock From produits" 
                . " Where categorie = ".$categorie;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $produits = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $prod = new Produit();
            $prod->setproduitId($row->reference);
            $prod->setImage($row->image);
            $prod->setDesignation($row->designation);
            $prod->setMarque($row->marque);
            $prod->setCategorie($row->categorie);
            $prod->setPrixUnitaire($row->prixunitaire);
            $prod->setStock($row->stock);
            $produits[$i] = $prod;
            $i++;
        }
        return $produits;
    }
    
    // ---------------------------SESSION----------------------------------
    
    public function getPLSbySession($session){
        $this->query = "Select * From vProduitLignesSession Where session_id = '".$session."'";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $pls = array();
        $i = 0;
        if(mysqli_num_rows($this->result) > 0){ 
            while ($row = mysqli_fetch_object($this->result)) {
                $pls[$i][0] = $row->categorie;
                $pls[$i][1] = $row->reference;
                $pls[$i][2] = $row->designation;
                $pls[$i][3] = $row->prixunitaire;
                $pls[$i][4] = $row->stock;
                $pls[$i][5] = $row->marque;
                $pls[$i][6] = $row->image;
                $pls[$i][7] = $row->qte;
                $pls[$i][8] = $row->session_id;
                $i++;
            }
            return $pls;
        }
        return null;
    }  
    
    public function supprimerProduitLignesSession($reference,$session){
        $this->query = "Select qte From lignessession Where ref = ".$reference." and session_id = '".$session."'";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $row = mysqli_fetch_object($this->result);
        $this->query = "Delete From lignessession Where ref = ".$reference." and session_id = '".$session."'";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        if($this->result != 0){
            return $row->qte;
        }
        else
        {
            return 0;
        }
    }
    
    public function getProduitsByCodeCommande($codecommande){
        $this->query = "Select * From vProduitCommande Where numcommande = ".$codecommande;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $tblproduits = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)){
            $p = new Produit();
            $p->getproduitId($row->reference);
            $p->setImage($row->image);
            $p->setDesignation($row->designation);
            $p->setPrixUnitaire($row->prixunitaire);
            $p->setStock($row->quantite);
            $tblproduits[$i] = $p;
            $i++;
        }
        return $tblproduits;
    }
}


