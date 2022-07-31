<?php
namespace GestionStock\Library;
class Commande{
    
    private $codeCommande;
    private $client;
    private $dateCommande;
    private $totalCommande;
    
    public function __construct() {
        
    }
    
    public function setCodeCommande($codeCommande){
        $this->codeCommande = $codeCommande;
    }
    
    public function getCodeCommande(){
        return $this->codeCommande;
    }
    
    public function setClient($client){
        $this->client = $client;
    }
    
    public function getClient(){
        return $this->client ;
    }
    
    public function setDateCommande($dateCommande){
        $this->dateCommande = $dateCommande;
    }
    
    public function getDateCommande(){
        return $this->dateCommande;
    }
    
    public function setTotalCommande($totalCommande){
        $this->totalCommande = $totalCommande;
    }
    
    public function getTotalCommande(){
        return  $this->totalCommande;
    }
  
}

