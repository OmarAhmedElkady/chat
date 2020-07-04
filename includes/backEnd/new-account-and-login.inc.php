<?php

session_start () ;

if ( isset ( $_POST [ "userName" ] ) && isset ( $_POST [ "password" ] ) )   {
    
    $userName = $_POST [ "userName" ] ;
    $password = $_POST [ "password" ] ;
    
    require_once ( "../class/error-messages.class.php" ) ;
    require_once ( "../class/filter.class.php" ) ;
    require_once ( "../class/connectDB.class.php" ) ;
    require_once ( "../class/login.class.php" ) ;
    require_once ( "../class/new-account.class.php" ) ;
    
    if ( isset ( $_POST [ "page" ] ) && $_POST [ "page" ] == "new_account" )    {
        
        $new_account = new new_account ( $userName , $password ) ;
        
        $returnNew_account =  $new_account->addUser () ;
        
        if ( isset ( $returnNew_account ) && is_array ( $returnNew_account ) && count ( $returnNew_account ) === 3 && $returnNew_account [ 1 ] == true )    {
            
            $_SESSION [ "userName" ] = $returnNew_account [ 1 ] ;
            $_SESSION [ "password" ]  = $returnNew_account [ 2 ] ;
            
            echo true ;
            
        }   else    {
            echo $returnNew_account ;
        }
        
    }   else    {
        
        if ( isset ( $_POST [ "page" ] ) && $_POST [ "page" ] == "login" )  {
            
            $login = new login ( $userName , $password )    ;
            
            $returnLogin =  $login->login() ;
            
            if ( isset ( $returnLogin ) && is_array ( $returnLogin ) &&  count ( $returnLogin ) === 3 && $returnLogin [ 0 ] == true )    {
                
                $_SESSION [ "userName" ] = $returnLogin [ 1 ] ;
                $_SESSION [ "password" ]  = $returnLogin [ 2 ] ;
                
                echo true ;
            }   else    {
                
                echo $returnLogin ;
            }
        }
    }
    
    
}