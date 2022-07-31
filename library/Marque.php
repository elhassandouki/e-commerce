<?php
namespace GestionStock\Library;
class Marque{
    
    private $marqueId;
    private $marque;
    
    public function __construct() {
    
    }
    
    public function setMarqueId($marqueId){
        $this->marqueId = $marqueId;
    }
    
    public function getMarqueId(){
        return $this->marqueId;
    }
    
    public function setMarque($marque){
        $this->marque = $marque;
    }
    
    public function getMarque(){
        return $this->marque;
    }
}
