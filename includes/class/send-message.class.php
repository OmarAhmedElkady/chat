<?php

class sendMessage {
    
    use errorMessages , connectDB ;
    
    private $myID = "" ;
    private $receiverID = "" ;
    private $message = "" ;
    
    public function __construct ( $myID = "" , $receiverID = "" , $message = "" ) {
        
        $this->myID          = filter_var ( trim ( $myID ) , FILTER_SANITIZE_NUMBER_INT ) ;
        $this->receiverID = filter_var ( trim ( $receiverID ) , FILTER_SANITIZE_NUMBER_INT ) ;
        $this->message     = filter_var ( trim ( $message ) , FILTER_SANITIZE_STRING ) ;
    }
    
    public function insertMessageInDatabase ()   {
        
        if ( ! empty ( $this->myID ) && ! empty ( $this->receiverID ) && ! empty ( $this->message ) )   {
            
            $this->conncet ( "chat" ) ;
            
            $stmt = $this->con->prepare ( "INSERT INTO `messages` ( `messages`.`message` , `messages`.`sender` , `messages`.`receiver` )
                                                                        VALUES ( :message , :sender , :receiver )" ) ;
            
            $stmt->bindParam ( ":message" , $this->message ) ;
            $stmt->bindParam ( ":sender" , $this->myID ) ;
            $stmt->bindParam ( ":receiver" , $this->receiverID ) ;
            
            $stmt->execute () ;
            $stmt->closeCursor () ;
        }
    }
}