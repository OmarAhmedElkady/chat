<?php

session_start () ;

if ( isset ( $_SESSION [ "userName" ] ) && ! empty ( $_SESSION [ "userName" ] ) )   {
    
    
    session_unset () ;
    session_destroy () ;
}

header ( "Location: sign-up-and-login.php?page=login" ) ;
exit () ;