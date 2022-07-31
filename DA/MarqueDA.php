<?php
namespace GestionStock\DA;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Marque as Marque;
require_once '../library/Connexion.php';
require_once '../library/Marque.php';

class MarqueDA{
    
    private $connexion;
    private $query;
    private $result;
    
    public function __construct() {
        $this->connexion =  new Connexion("localhost", "root", "", "site");
    }
    
    public function ajouter(Marque $marque){
        $this->query = "Insert Into marques (marque) Values ('".$marque->getMarque()."')";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function modifier(Marque $marque){
        $this->query = "Update marques set marque = '".$marque->getMarque()."' Where MarqueId = ".$marque->getMarqueId();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function supprimer(Marque $marque){
        $this->query = "Delete From marques Where marqueId = ".$marque->getMarqueId();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    } 
    
    public function getMarques(){
        $this->query = "Select marqueId,marque From marques";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $marques = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $marq = new Marque();
            $marq->setMarqueId($row->marqueId);
            $marq->setMarque($row->marque);
            $marques[$i] = $marq;
            $i++;
        }
        return $marques;
    }
    
    public function getMarqueIdByMarque($marque){
        $this->query = "Select marqueId From marques Where marque = '".$marque."'";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $row = mysqli_fetch_object($this->result);
        if($row != null){
            return $row->marqueId;
        }
        else{
            return 0;
        }
    }
    
    public function getMarqueById($marqueId){
        $this->query = "Select marqueId,marque From marques Where MarqueId = ".$marqueId;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $marq = new Marque(); 
       while ($row = mysqli_fetch_object($this->result)) {     
            $marq->setMarqueId($row->marqueId);
            $marq->setMarque($row->marque);
        }
        return $marq;
    }
}


