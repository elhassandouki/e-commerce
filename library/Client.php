<?php
namespace GestionStock\Library;

class Client {
    
    private $clientId;
    private $civilite;
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $email;
    private $password;
    private $telephone;
    private $ville;
    private $codePostal;
    private $adresse;
    private $nomAdresse;
    private $dateConnect;
    private $dateDisonnect;
    private $nbrCommandes;
    private $totalCommandes;
    private $administrateur;
    
    public function __construct(){
        
    }
    
    public function setClientId($clientId){
        $this->clientId = $clientId;
    }
    
    public function getClientId(){
        return $this->clientId;
    }
    
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }
    
    public function getCivilite(){
        return $this->civilite;
    }
    
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    
    public function getNom(){
        return $this->nom;
    }
    
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    
    public function getPrenom(){
        return $this->prenom;
    }
    
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }
    
    public function getDateNaissance(){
        return $this->dateNaissance;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }
    
    public function getTelephone(){
        return $this->telephone;
    }
    
    public function setVille($ville)
    {
        $this->ville = $ville;
    }
    
    public function getVille(){
        return $this->ville;
    }
    
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }
    
    public function getCodePostal(){
        return $this->codePostal;
    }
    
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }
    
    public function getAdresse(){
        return $this->adresse;
    }
    
    public function setNomAdresse($nomAdresse)
    {
        $this->nomAdresse = $nomAdresse;
    }
    
    public function getNomAdresse(){
        return $this->nomAdresse;
    }
    
    public function setDateConnect($dateConnect)
    {
        $this->dateConnect = $dateConnect;
    }
    
    public function getDateConnect(){
        return $this->dateConnect;
    }
    
    public function setDateDisconnect($dateDisonnect)
    {
        $this->dateDisonnect = $dateDisonnect;
    }
    
    public function getDateDisconnect(){
        return $this->dateDisonnect;
    }
    
    public function setNbrCommandes($nbrCommandes)
    {
        $this->nbrCommandes = $nbrCommandes;
    }
    
    public function getNbrCommandes(){
        return $this->nbrCommandes;
    }
    
    public function setTotalCommandes($totalCommandes)
    {
        $this->totalCommandes = $totalCommandes;
    }
    
    public function getTotalCommandes(){
        return $this->totalCommandes;
    }
    
    public function setAdministrateur($administrateur){
        $this->administrateur = $administrateur;
    }
    
    public function getAdministrateur(){
        return $this->administrateur;
    }
    
    public function getNomComplet(){
        return $this->nom . " " . $this->prenom; 
    }
}

