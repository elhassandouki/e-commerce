<?php
namespace GestionStock\DA;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Categorie as Categorie;
require_once '../library/Connexion.php';
require_once '../library/Categorie.php';

class CategorieDA{
    
    private $connexion;
    private $query;
    private $result;
    
    public function __construct() {
        $this->connexion =  new Connexion("localhost", "root", "", "site");
    }
    
    public function ajouter(Categorie $categorie){
        $this->query = "Insert Into categories (categorie,parent) Values ('".$categorie->getCategorie()."',".$this->getCategorieIdByParentCategorie($categorie).")";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function modifier(Categorie $categorie){
        $this->query = "Update categories set categorie = '".$categorie->getCategorie()."',parent = ".$this->getCategorieIdByParentCategorie($categorie)." Where CategorieId = ".$categorie->getCategorieId();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function supprimer(Categorie $categorie){
        $this->query = "Delete From categories Where categorieId = ".$categorie->getCategorieId();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    } 
    
    public function getCategorieIdByParentCategorie($parentCategorie){
        $this->query = "Select * From categories Where categorie = '".$parentCategorie->getParent()."'";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $row = mysqli_fetch_object($this->result);
        if($row != null)
            return $row->categorieId;
        else
            return 0;
    }
    
    public function getCategorieIdByCategorie($categorie){
        $this->query = "Select categorieId From categories Where categorie = '".$categorie."'";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $row = mysqli_fetch_object($this->result);
        if($row != null)
            return $row->categorieId;
        else
            return 0;
    }
    
    public function getCategories(){
        $this->query = "Select categorieId,categorie,parent From categories";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $categories = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $cat = new Categorie();
            $cat->setCategorieId($row->categorieId);
            $cat->setCategorie($row->categorie);
            $cat->setParent($row->parent);
            $categories[$i] = $cat;
            $i++;
        }
        return $categories;
    }
    
    public function getCategorieById($parent){
        $this->query = "Select * From categories Where categorieId = ".$parent;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $row = mysqli_fetch_object($this->result);
        if($row != null){
            return $row->categorie;
        }
        else{
            return "Root";
        }
    }
}

