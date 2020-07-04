<?php

session_start () ;

$class = "includes/class/" ;

require_once ( "../class/error-messages.class.php" ) ;
require_once ( "../class/connectDB.class.php" ) ;
require_once ( "../class/selectDB.class.php" ) ;
require_once ( "../class/skip.class.php" ) ;


$select = new selectDB () ;
    
$userID = $select->get_userID ( $_SESSION [ "userName" ] , $_SESSION [ "password" ] ) ;

if ( isset ( $userID ) && is_array ( $userID ) && ! empty ( $userID ) && count ( $userID ) > 0 )    {
    
    $_SESSION [ "userID" ] = $userID [ "userID" ] ;
    
    $skip = new skip ( $_SESSION [ "userID" ] ) ;
    
    $skip->insert_default_image() ;
    
}   else    {
    
    header ( "Location: sign-out.php" ) ;
    exit () ;
}