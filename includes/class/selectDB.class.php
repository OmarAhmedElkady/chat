<?php

class selectDB {
    
    use errorMessages  , connectDB ;
    
    public function get_userID ( $userName , $password )    {
        
        $this->conncet ( "chat" ) ;
        
        $userName = filter_var ( trim ( $userName ) , FILTER_SANITIZE_STRING ) ;
        $password  = filter_var ( trim ( $password) , FILTER_SANITIZE_STRING ) ;
        
        $stmt = $this->con->prepare ( "SELECT `users`.`userID` FROM `users` WHERE `userName` = :userName AND password = :password" ) ;
        $stmt->bindValue ( ":userName" , $userName ) ;
        $stmt->bindValue ( ":password" , $password ) ;
        $stmt->execute () ;
        $userID = $stmt->fetch() ;
        $stmt->closeCursor() ;
        
        if ( isset ( $userID ) && is_array ( $userID ) && ! empty ( $userID ) && count ( $userID ) > 0 )    {
            return $userID ;
        
        }   else    {
            return false ;
        }
    }
    
    
    public function getAllUsers ( $count = 15 )  {
        
        $counter = filter_var ( trim ( $count ) , FILTER_SANITIZE_NUMBER_INT ) ;
        
        $this->conncet ( "chat" ) ;
        
        $stmt = $this->con->prepare ( "SELECT `users`.`userID` , `users`.`userName` , `image`.`image` FROM `users`
                                                               INNER JOIN `image` ON `image`.`userID` = `users`.`userID`
                                                               WHERE `users`.`userID` != :myID LIMIT $counter" ) ;
        $stmt->bindValue ( ":myID" , $_SESSION [ "userID" ] ) ;
        $stmt->execute () ;
        $allUsers = $stmt->fetchAll () ;
        $stmt->closeCursor () ;
        
        if ( isset ( $allUsers ) && is_array ( $allUsers ) && ! empty ( $allUsers ) && count ( $allUsers ) > 0 )    {
            
            return $allUsers ;
            
        }   else    {
            return false ;
        }
    }
    
    
    public function countUsers ( $myID )   {
        
        $myID = filter_var ( trim ( $myID ) , FILTER_SANITIZE_NUMBER_INT ) ;
        
        $stmt = $this->con->prepare ( "SELECT COUNT( `users`.`userID` ) FROM `users` WHERE `users`.`userID` != :myID" ) ;
        $stmt->bindParam ( ":myID" , $myID ) ;
        $stmt->execute () ;
        $countUsers = $stmt->fetchColumn() ;
        $stmt->closeCursor () ;
        
        return $countUsers ;
    }
    
}