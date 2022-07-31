<?php
namespace GestionStock\Library;
class Produit{
    
    private $produitId;
    private $image;
    private $designation;
    private $marque;
    private $categorie;
    private $prixunitaire;
    private $stock;
   
    
    function __construct() {
        
    }
    
    public function setproduitId($produitId){
        $this->produitId = $produitId;
    }
    
    public function getproduitId(){
        return $this->produitId;
    }
    
    public function setDesignation($designation){
        $this->designation = $designation;
    }
    
    public function getDesignation(){
        return $this->designation;
    }
    
    public function setPrixUnitaire($prixunitaire){
        $this->prixunitaire = $prixunitaire;
    }
    
    public function getPrixUnitaire(){
        return $this->prixunitaire;
    }
    
    public function setStock($stock){
        $this->stock = $stock;
    }
    
    public function getStock(){
        return $this->stock;
    }
    
    public function setMarque($marque){
        $this->marque = $marque;
    }
    
    public function getMarque(){
        return $this->marque;
    }
    
    public function setCategorie($categorie){
        $this->categorie = $categorie;
    }
    
    public function getCategorie(){
        return $this->categorie;
    }
    
    public function setImage($image){
        $this->image = $image;
    }
    
    public function getImage(){
        return $this->image;
    } 
}
