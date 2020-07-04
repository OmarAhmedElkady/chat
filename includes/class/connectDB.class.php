<?php

trait connectDB {
        
    private $host  ;
    private $dsn ;
    private $user ; 
    private $psw ;
    protected $con ;
    
    private $arrayOptions = array (
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ) ;
    
    protected function conncet ( $dsn , $host = "localhost" ,  $user = "root" , $psw = "" )    {
        
        $this->dsn = $dsn ;
        $this->host = $host ;
        $this->user = $user ;
        $this->psw = $psw ;
        
        try {
            $this->con = new PDO("mysql:host=" . $this->host . ";dbname=". $this->dsn , $this->user , $this->psw , $this->arrayOptions  ) ;
            
        }
        
        catch ( PDOException $e )   {
            echo "No : - " . $e->getMessage() ;
        }
    }
}