<?php


class skip {
    
    use errorMessages , connectDB ;
    
    private $imageName = "123456789.jpg" ;
    private $userID = "" ;
    
    public function __construct ( $userID )     {
        
        $this->userID = filter_var ( trim ( $userID ) , FILTER_SANITIZE_NUMBER_INT ) ;
    }
    
    public function insert_default_image ()     {
        
        $this->conncet ( "chat" ) ;
        
        $stmt = $this->con->prepare ( "INSERT INTO `image` ( `image` , `userID` ) VALUES ( :image , :userID )" ) ;
        
        $stmt->bindValue ( ":image" , $this->imageName ) ;
        $stmt->bindValue ( ":userID" , $this->userID ) ;
        
        $stmt->execute () ;
        $stmt->closeCursor () ;
        
        return true ;
    }
}