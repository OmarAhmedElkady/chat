<?php

session_start () ;

if ( isset ( $_FILES [ 'image' ] ) && is_array ( $_FILES [ "image" ] ) && count ( $_FILES [ "image" ] ) > 0 )    {
    
    require_once ( "../class/error-messages.class.php" ) ;
    require_once ( "../class/connectDB.class.php" ) ;
    require_once ( "../class/image.class.php" ) ;
    
    $image = $_FILES [ "image" ] ;

    $image = new image ( $image ) ;
    
    $uploadToFolder = $image->UploadTheImageToTheNewFolder ( "../../uploads/") ;
    
    if ( is_array ( $uploadToFolder ) && count ( $uploadToFolder ) == 2 && $uploadToFolder [ 0 ] == true )   {
        
        if ( isset ( $_SESSION [ "userName" ] ) && ! empty ( $_SESSION [ "userName" ] ) && isset ( $_SESSION [ "password" ] ) && ! empty ( $_SESSION [ "password" ] ) )     {
            
            $returnDB = $image->uploadTheImageToDB ( $_SESSION [ "userName" ] , $_SESSION [ "password" ] , $uploadToFolder [ 1 ] ) ;
            
            if ( $returnDB == true )    {
                
                echo true ;
                
            }   else    {
                echo $returnDB ;
            }
        }  else     {
            echo "من فضلك قم بإعادة تسجيل الدخول" ;
        }
    }   else    {
        echo $uploadToFolder ;
    }
}   else {
    echo "من فضلك . قم بإختيار الصورة" ;
}
