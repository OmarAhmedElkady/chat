<?php

//namespace user ;

class login {
    
    use errorMessages , filter , connectDB ;
    
    protected $userName = "" ;
    protected $password = "" ;
    protected $error = array () ;
    
    public function __construct ( $userName , $password )   {
        
        $returnUserName = $this->filterUserName ( $userName ) ;
        
        if ( is_array ( $returnUserName ) && $returnUserName [ 0 ] == true )    {
            
            $this->userName = $returnUserName [ 1 ] ;
            
        }   else    {
            $this->error [] = $returnUserName ; 
        }
        
        $returnPassword  = $this->filterPassword ( $password ) ;
        
        if ( is_array ( $returnPassword ) && $returnPassword [ 0 ] == true )    {
            
            $this->password = $returnPassword [ 1 ] ;
            
        }   else    {
            $this->error [] = $returnPassword ; 
        }
    }
    
    public function login ()  {
        
        if ( isset ( $this->userName ) && isset ( $this->password )  && isset ( $this->error ) )   {
            if ( ! empty ( $this->userName ) && ! empty ( $this->password ) && is_array ( $this->error ) && empty ( $this->error )  )     {
                
                $this->conncet ("chat") ;
                
                $stmt = $this->con->prepare("SELECT * FROM `users` WHERE `users`.`userName` = :userName") ;
                $stmt->bindValue ( ":userName" , $this->userName )  ;
                $stmt->execute () ;
                $checkUser = $stmt->fetch() ;
                $stmt->closeCursor () ;
                
                if ( isset ( $checkUser ) && is_array ( $checkUser ) && ! empty ( $checkUser ) && count ( $checkUser ) > 0 )    {
                    
                    if ( $this->password === $checkUser [ "password" ] )    {
                        return array ( TRUE , $this->userName , $this->password ) ;
                        
                    }   else    {
                        return "الرقم السرى خطأ" ;
                    }
                    
                }   else    {
                    
                    return "اسف لا يوجد هذا الاسم [ " . $this->userName . " ]" ;
                }
            }   else    {
                
                return $this->error [ 0 ] ;
            }
        }
    }
}