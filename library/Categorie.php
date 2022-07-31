<?php
namespace GestionStock\Library;
class Categorie{
    
    private $categorieId;
    private $categorie;
    private $parent;
    
    public function __construct() {
        $this->categorieId = 0;
    } 
    
    public function setCategorieId($categorieId){
        $this->categorieId = $categorieId;
    }
    
    public function getCategorieId(){
        return $this->categorieId;
    }
    
    public function setCategorie($categorie){
        $this->categorie = $categorie;
    }
    
    public function getCategorie(){
        return $this->categorie;
    }
    
    public function setParent($parent){
        $this->parent = $parent;
    }
    
    public function getParent(){
        return $this->parent;
    }
    
    
}

