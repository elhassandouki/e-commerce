<?php
namespace GestionStock\DA;
use GestionStock\Library\Connexion as Connexion;
use GestionStock\Library\Client as Client;
require_once '../library/Connexion.php';
require_once '../library/Client.php';
class ClientDA{
    
    private $connexion;
    private $query;
    private $result;
    
    public function __construct() {
        $this->connexion =  new Connexion("localhost", "root", "", "site");
    }
    
    public function ajouter(Client $client){
        $this->query = "INSERT INTO clients (civilite, nom, prenom, dateNaissance, telephone, ville, codepostal, Adresse, NomAdresse, Email, password, administrateur) VALUES "
                . "('".$client->getCivilite()."','".$client->getNom()."','".$client->getPrenom()."','".$client->getDateNaissance()."','".$client->getTelephone()."'"
                . ",'".$client->getVille()."','".$client->getCodePostal()."','".$client->getAdresse()."','".$client->getNomAdresse()."'"
                . ",'".$client->getEmail()."','".$client->getPassword()."',".$client->getAdministrateur().")";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function modifier(Client $client){
        $this->query = "Update clients Set civilite = '".$client->getCivilite()."', nom = '".$client->getNom()."', prenom = '".$client->getPrenom()."'"
                . ",dateNaissance = '".$client->getDateNaissance()."',telephone = '".$client->getTelephone()."'"
                . ",ville = '".$client->getVille()."',codepostal = '".$client->getCodePostal()."'"
                . ",Adresse = '".$client->getAdresse()."',nomAdresse = '".$client->getNomAdresse()."'"
                . ",Email = '".$client->getEmail()."',password = '".$client->getPassword()."'"
                . ",administrateur = ".$client->getAdministrateur().""
                . " Where codeClient = ".$client->getClientId();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    }
    
    public function supprimer(Client $client){
        $this->query = "Delete From clients Where codeClient = ".$client->getClientId();
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        return $this->result;
    } 
    
    public function getClients(){
        $this->query = "Select codeClient,civilite,nom,prenom,dateNaissance,ville,codepostal,adresse,nomadresse,telephone,"
                     . "email,password,dateconnect,datedisconnect,nbrcommandes,totalcommandes,administrateur From clients";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $clients = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $cl = new Client();
            $cl->setclientId($row->codeClient);
            $cl->setCivilite($row->civilite);
            $cl->setNom($row->nom);
            $cl->setPrenom($row->prenom);
            $cl->setDateNaissance($row->dateNaissance);
            $cl->setVille($row->ville);
            $cl->setCodePostal($row->codepostal);
            $cl->setAdresse($row->adresse);
            $cl->setNomAdresse($row->nomadresse);
            $cl->setTelephone($row->telephone);
            $cl->setEmail($row->email);
            $cl->setPassword($row->password);
            $cl->setDateConnect($row->dateconnect);
            $cl->setDateDisconnect($row->datedisconnect);
            $cl->setNbrCommandes($row->nbrcommandes);
            $cl->setTotalCommandes($row->totalcommandes);
            $cl->setAdministrateur($row->administrateur);
            $clients[$i] = $cl;
            $i++;
        }
        return $clients;
    }
    
    public function getClientsByCode($codeClient){
        $this->query = "Select codeClient,civilite,nom,prenom,dateNaissance,ville,codepostal,adresse,nomadresse,telephone,"
                     . "email,password,dateconnect,datedisconnect,nbrcommandes,totalcommandes,administrateur From clients Where codeClient = ".$codeClient;
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        $clients = array();
        $i = 0;
        while ($row = mysqli_fetch_object($this->result)) {
            $cl = new Client();
            $cl->setClientId($row->codeClient);
            $cl->setCivilite($row->civilite);
            $cl->setNom($row->nom);
            $cl->setPrenom($row->prenom);
            $cl->setDateNaissance($row->dateNaissance);
            $cl->setVille($row->ville);
            $cl->setCodePostal($row->codepostal);
            $cl->setAdresse($row->adresse);
            $cl->setNomAdresse($row->nomadresse);
            $cl->setTelephone($row->telephone);
            $cl->setEmail($row->email);
            $cl->setPassword($row->password);
            $cl->setDateConnect($row->dateconnect);
            $cl->setDateDisconnect($row->datedisconnect);
            $cl->setNbrCommandes($row->nbrcommandes);
            $cl->setTotalCommandes($row->totalcommandes);
            $cl->setAdministrateur($row->administrateur);
            $clients[$i] = $cl;
            $i++;
        }
        return $clients;
    
    }
    
    // -----------------------------------------------------------------
    
    public function isClient(Client $client){
        $this->dernierConnexion($client);
        $this->query = "Select codeClient,civilite,nom,prenom,dateNaissance,ville,codepostal,adresse,nomadresse,telephone,"
                     . "email,password,dateconnect,datedisconnect,nbrcommandes,totalcommandes,administrateur From clients Where email = '".$client->getEmail()."' And password =  '".$client->getPassword()."'";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
        while ($row = mysqli_fetch_object($this->result)) {    
            $client->setClientId($row->codeClient);
            $client->setCivilite($row->civilite);
            $client->setNom($row->nom);
            $client->setPrenom($row->prenom);
            $client->setDateNaissance($row->dateNaissance);
            $client->setVille($row->ville);
            $client->setCodePostal($row->codepostal);
            $client->setAdresse($row->adresse);
            $client->setNomAdresse($row->nomadresse);
            $client->setTelephone($row->telephone);
            $client->setEmail($row->email);
            $client->setPassword($row->password);
            $client->setDateConnect($row->dateconnect);
            $client->setDateDisconnect($row->datedisconnect);
            $client->setNbrCommandes($row->nbrcommandes);
            $client->setTotalCommandes($row->totalcommandes);
            $client->setAdministrateur($row->administrateur);
            return $client;
        }
        return null;
    }
    
    public function ajouterClient(Client $client){
        $this->query = "Insert into Clients (civilite,nom,prenom,dateNaissance,telephone,email,password,ville,codepostal,adresse,nomAdresse) Values ('"
                .$client->getCivilite()."','".$client->getNom()."','".$client->getPrenom()
                ."',dateNaissance='".$client->getDateNaissance()."','".$client->getTelephone()."','".$client->getEmail()."','".$client->getPassword()."','".$client->getVille()
                ."','".$client->getCodePostal()."','".$client->getAdresse()."','".$client->getNomAdresse()."')";
        $this->result =mysqli_query($this->connexion->connect(), $this->query);
        if($this->result != 0){
            $this->query = "select codeclient from clients order by codeclient desc";
            $this->result = mysqli_query($this->connexion->connect(),$this->query);
            $row = mysqli_fetch_object($this->result);
            $client->setClientId($row->codeClient);
            return $this->isClient($client);
        }
        else{
            return null;
        }
    }
    
    public function dernierConnexion($client){
        $this->query = "Update clients set dateconnect = default Where email = '".$client->getEmail()."' And password =  '".$client->getPassword()."'";
        $this->result = mysqli_query($this->connexion->connect(), $this->query);
    }
}

