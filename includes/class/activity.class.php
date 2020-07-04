<?php


class activity {
    
    use errorMessages , connectDB ;
    
    public function activity_update ( $active , $myID )   {
        
        $active = filter_var ( trim ( $active ) , FILTER_SANITIZE_STRING ) ;
        $myID = filter_var ( trim ( $myID ) , FILTER_SANITIZE_NUMBER_INT ) ;
        
        if ( ! empty ( $myID ) )    {
            
            $this->conncet( "chat" ) ;
            
            $stmt = $this->con->prepare ( "UPDATE `activity` SET `activity`.`active` = :active , `activity`.`last_active_time` = CURRENT_TIMESTAMP() 
                                                                        WHERE `activity`.`userID` = :myID") ;
            
            $stmt->bindValue ( ":active" , $active ) ;
            $stmt->bindValue ( ":myID" , $myID ) ;
            
            $stmt->execute () ;
            $stmt->closeCursor () ;
        }
    }
    
}