<?php
namespace GestionStock\Library;
class Ligne{
    
    private $numero;
    private $commande;
    private $produit;
    private $quantite;
    private $total;
    
    public function __construct() {
        
    }
    
    public function setNumero($numero){
        $this->numero = $numero;
    }
    
    public function getNumero(){
        return $this->numero;
    }
    
    public function setCommande($commande){
        $this->commande = $commande;
    }
    
    public function getCommande(){
        return $this->commande;
    }
    
    public function setProduit($produit){
        $this->produit = $produit;
    }
    
    public function getProduit(){
        return $this->produit ;
    }
    
    public function setQuantite($quantite){
        $this->quantite = $quantite;
    }
    
    public function getQuantite(){
        return $this->quantite;
    }
    
    public function setTotal($total){
        $this->total = $total;
    }
    
    public function getTotal(){
        return  $this->total;
    }
  
}



