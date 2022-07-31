<?php
namespace GestionStock\Library;

class Connexion {
    
    private $host;
    private $user;
    private $password;
    private $database;
    //private $port; 
    //private $socket;
    
    public function __construct($host,$user,$password,$database) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }
    
    // set & get 
    
    public function connect()
    {
        return mysqli_connect($this->host,$this->user,$this->password,$this->database);
    }
    
    
}

