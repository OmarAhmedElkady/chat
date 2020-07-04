<?php

class messages {
    
    use errorMessages  , connectDB ;
    
    private $userID = "" ;
    private $userName = "" ;
    private $myID = "" ;
    private $counter = 0 ;
    private $moreMessages = 20 ; 
    
    public function check_the_other_end ( $userID , $userName )     {
        
        $this->userID = filter_var ( trim ( $userID ) , FILTER_SANITIZE_NUMBER_INT ) ;
        $this->userName = filter_var ( trim ( $userName ) , FILTER_SANITIZE_STRING ) ;
        
        if ( ( isset ( $this->userID ) && ! empty ( $this->userID ) && filter_var ( $this->userID , FILTER_VALIDATE_INT ) ) &&
            ( isset ( $this->userName ) && ! empty ( $this->userName ) ) )    {
            
            $this->conncet ( "chat" ) ;
            
            //$stmt = $this->con->prepare ( "SELECT `users`.`userID`  FROM `users` WHERE `users`.`userID` = :userID AND `users`.`userName` = :userName" ) ;
            $stmt = $this->con->prepare ( "SELECT `users`.`userID` , `image`.`image` FROM `users`
                                         INNER JOIN `image` ON `image`.`userID` = `users`.`userID`
                                         WHERE `users`.`userID` = :userID AND `users`.`userName` = :userName" ) ;
            
            $stmt->bindValue ( ":userID" , $this->userID ) ;
            $stmt->bindValue ( ":userName" , $this->userName ) ;
            $stmt->execute () ;
            $checkUser = $stmt->fetch() ;
            $stmt->closeCursor () ;
            
            if ( isset ( $checkUser ) && is_array ( $checkUser ) && count ( $checkUser ) > 0 )  {
                
                return $checkUser ;
            
            }   else    {
                return false ;
            }
        }   else    {
            return false ;
        }
    }
    
    
    
    public function bringing_messages_exchanged_with_the_other_party ( $myID , $userID , $moreMessages )    {
        
        $this->myID   = filter_var ( trim ( $myID) , FILTER_SANITIZE_NUMBER_INT ) ;
        $this->userID = filter_var ( trim ( $userID ) , FILTER_SANITIZE_NUMBER_INT ) ;
        $this->moreMessages = filter_var ( trim ( $moreMessages ) , FILTER_SANITIZE_NUMBER_INT ) ;
        
        if ( ! empty ( $this->myID ) && ! empty ( $this->userID ) && ! empty ( $this->moreMessages ) )     {
            
            $stmt = $this->con->prepare ( "SELECT * FROM `messages`
                                         WHERE `messages`.`sender` = :sender_myID AND `messages`.`receiver` = :userID_receiver OR
                                         `messages`.`sender` = :sender_userID AND `messages`.`receiver` = :receiver_myID
                                         ORDER BY `messages`.`date` DESC LIMIT  $moreMessages ") ;
            
            $stmt->bindValue ( ":sender_myID" , $this->myID ) ;
            $stmt->bindValue ( ":userID_receiver" , $this->userID ) ;
            $stmt->bindValue ( ":sender_userID" , $this->userID ) ;
            $stmt->bindValue ( ":receiver_myID" , $this->myID ) ;
            
            $stmt->execute () ;
            $exchanged_messages = $stmt->fetchAll () ;
            $stmt->closeCursor () ;
            
            return $exchanged_messages ;
            
        }   else    {
            return false ;
        }
    }
    
    
    public function count_messages ( $sender , $receiver )  {
        
        $this->myID = filter_var ( trim ( $sender ) , FILTER_SANITIZE_NUMBER_INT ) ;
        $this->userID = filter_var ( trim ( $receiver ) , FILTER_SANITIZE_NUMBER_INT ) ;
        
        if ( ! empty ( $this->myID ) && ! empty ( $this->userID ) )     {
            
            $stmt = $this->con->prepare ( "SELECT COUNT( `messageID` ) FROM `messages`
                                                                    WHERE `messages`.`sender` = :sender_myID AND `messages`.`receiver` = :userID_receiver OR
                                                                    `messages`.`sender`= :sender_userID AND `messages`.`receiver` = :receiver_myID" ) ;
            
            $stmt->bindValue ( ":sender_myID" , $this->myID ) ;
            $stmt->bindValue ( ":userID_receiver" , $this->userID ) ;
            $stmt->bindValue ( ":sender_userID" , $this->userID ) ;
            $stmt->bindValue ( ":receiver_myID" , $this->myID ) ;
            
            $stmt->execute () ;
            $this->counter = $stmt->fetchColumn () ;
            $stmt->closeCursor () ;
            
            return $this->counter ;
        }
        
    }
}