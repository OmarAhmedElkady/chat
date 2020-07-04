<?php

//namespace user ;

class new_account extends login {
    
    public function addUser ()  {
        
        if ( isset ( $this->userName ) && isset ( $this->password )  && isset ( $this->error ) )   {
            if ( ! empty ( $this->userName ) && ! empty ( $this->password ) && is_array ( $this->error ) && empty ( $this->error )  )     {
                
                $this->conncet ("chat") ;
                
                $stmt = $this->con->prepare("SELECT `users`.`userName` FROM `users` WHERE `users`.`userName` = :userName") ;
                $stmt->bindValue ( ":userName" , $this->userName )  ;
                $stmt->execute () ;
                $checkUser = $stmt->fetch() ;
                $stmt->closeCursor () ;
                
                if ( isset ( $checkUser ) && is_array ( $checkUser ) && ! empty ( $checkUser ) && count ( $checkUser ) > 0 )    {
                    return "يوجد شخص لدية هذا الاسم . <br> من فضلك قم بإختيار اسم اخر" ;
                    
                }   else    {
                    
                    $stmt = $this->con->prepare( "INSERT INTO `users` ( `userName` , `password` ) VALUES ( :userName , :password )" ) ;
                    $stmt->bindValue ( ":userName" , $this->userName ) ;
                    $stmt->bindValue ( ":password" , $this->password ) ;
                    $stmt->execute() ;
                    $stmt->closeCursor() ;
                    
                    return  array ( true , $this->userName , $this->password ) ;
                }
            }   else    {
                
                return $this->error [ 0 ] ;
            }
        }
    }
}