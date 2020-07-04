<?php


class image {
    
    use errorMessages , connectDB ;
    
    private $imageName = "" ;
    private $imageType   = "" ;
    private $imageTMP   = "" ;
    private $imageError = "" ;
    private $imageSize    = "" ;
    private $imageExtension = "" ;
    private $errorsArray = array () ;
    const     _SIZE = ( 1024 * 1024 ) * 2 ;
    private $allExtension = array ( "RAW" , "DNG" , "TIFF" , "GIF" , "PNG" , "JPEG" , "JPG" ) ;
    
    public function __construct ( $image )  {
        
        $this->imageName = filter_var ( trim ( $image [ "name" ] ) , FILTER_SANITIZE_STRING ) ;
        $this->imageType  = filter_var ( trim ( $image [ "type" ] ) , FILTER_SANITIZE_STRING ) ;
        $this->imageTMP  = filter_var ( trim ( $image [ "tmp_name" ] ) , FILTER_SANITIZE_STRING ) ;
        $this->imageError = filter_var ( trim ( $image [ "error" ] ) , FILTER_SANITIZE_NUMBER_INT ) ;
        $this->imageSize   = filter_var ( trim ( $image [ "size" ] ) , FILTER_SANITIZE_NUMBER_INT ) ;
        
    }
    
    
    private function checkExtension ()   {
        
        if ( isset ( $this->imageName ) && ! empty ( $this->imageName ) )   {
            
            $this->imageExtension = strtoupper ( end ( explode ( "." , $this->imageName ) ) ) ;
            
            if ( isset ( $this->allExtension ) &&
                is_array ( $this->allExtension ) && count ( $this->allExtension ) > 0 &&
                in_array ( $this->imageExtension , $this->allExtension ) )    {
                
                return TRUE ;
                
            }   else    {
                $this->errorsArray [] =  " يجب ان يكون امتداد الصورة بهذة الامتدادات فقط <br> [ RAW , DNG , TIFF , GIF , PNG , JPEG , JPG ]  " ;
            }
        }
    }
    
    
    
    private function checkSize ()  {
        
        if ( $this->imageSize > 0 && $this->imageSize < self::_SIZE )   {
            return TRUE ;
            
        }   else    {
            
            if ( ! empty ( $this->imageName ) && $this->imageError == 1 && $this->imageSize == 0  )   {
                
                $this->errorsArray[] =  "يجب ان يكون حجم الصورة اقل من 2M" ;
            }
        }
    }
    
    public function UploadTheImageToTheNewFolder ( $folder )     {
        
        if ( is_dir ( $folder ) )   {
            
            $r_checkExtension = $this->checkExtension () ;
            $r_checkSize            = $this->checkSize () ;
            
            if ( empty ( $this->errorsArray ) && count ( $this->errorsArray ) == 0 )  {
                
                if ( $r_checkExtension === true && $r_checkSize === true )  {
                    
                    $this->imageName = rand ( 0 , 1000000000 ) . "." . $this->imageExtension ;
                    
                    while ( file_exists ( $folder . $this->imageName ) )   {
                        
                        $this->imageName = rand ( 0 , 1000000000 ) . "." . $this->imageExtension ;
                    }
                    
                    move_uploaded_file ( $this->imageTMP , $folder . $this->imageName ) ;
                    
                    return array ( true , $this->imageName ) ;
                    
                }   else    {
                    return "حدث خطأ اثناء تحمل الصورة . يرجى المحاولة مرة اخرى" ;
                }
            }   else    {
                return $this->errorsArray [ 0 ] ;
            }
        }   else    {
            
            return "لا يوجد هذا المجلد [ " . $folder . " ] <br> يرجى التأكد من المسار" ;
        }
        
    }
    
    
    public function uploadTheImageToDB ( $userName , $password , $image )    {
        
        $this->conncet ( "chat" ) ;
        
        $userName = filter_var ( trim ( $userName ) , FILTER_SANITIZE_STRING ) ;
        $password = filter_var ( trim ( $password ) , FILTER_SANITIZE_STRING ) ;
        $image       = filter_var ( trim ( $image ) , FILTER_SANITIZE_STRING ) ;
        
        $stmt = $this->con->prepare( "SELECT * FROM `users` WHERE `users`.`userName` = :userName AND `users`.`password` = :password" ) ;
        $stmt->bindParam ( ":userName" , $userName ) ;
        $stmt->bindParam ( ":password" , $password ) ;
        $stmt->execute () ;
        $user = $stmt->fetch () ;
        $stmt->closeCursor () ;
        
        if ( is_array ( $user ) && ! empty ( $user ) && count ( $user ) > 0 )   {
            
            $userID = $user [ "userID" ] ;
            
            $stmt = $this->con->prepare ( "INSERT INTO `image` ( `image` , `userID` ) VALUES ( :image , :userID ) " ) ;
            $stmt->bindValue ( ":image" , $image ) ;
            $stmt->bindValue ( ":userID" , $userID )  ;
            $stmt->execute () ;
            $stmt->closeCursor () ;
            
            return true ;
            
        }   else    {
            return "من فضلك قم بإعادة تسجيل الدخول" ;
        }
        
    }
    
}