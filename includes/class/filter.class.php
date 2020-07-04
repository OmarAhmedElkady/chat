<?php

trait filter {
    
    private $minNumber = 4 ;
    private $maxNumber = 30 ;
    
    
    protected function filterText ( $string )     {
        
        return filter_var ( trim ( $string ) , FILTER_SANITIZE_STRING ) ;
    }
    
    
    protected function filterUserName ( $userName )   {
        
        if ( filter_var ( trim ( $userName ) , FILTER_VALIDATE_INT ) || filter_var ( trim ( $userName ) , FILTER_VALIDATE_FLOAT ) )     {
            
            return "أسف . يجب أن يتكون إسمك من حروف فقط وليس ارقام" ;
        }
        
        $userName = filter_var ( trim ( $userName ) , FILTER_SANITIZE_STRING ) ;
        
        return array ( true , $userName ) ;
        
        /*
        if ( strlen ( $userName ) > $this->minNumber && strlen ( $userName ) < $this->maxNumber )  {
            return array ( true , $userName ) ;
            
        }   else if (  strlen ( $userName ) <= $this->minNumber && strlen ( $userName ) > 0 )  {
            return "يجب أن يكون عدد حروف إسمك اكبر من " . $this->minNumber ;
            
        }   else if ( strlen ( $userName ) >= $this->maxNumber )    {
            return "يجب أن يكون عدد حروف إسمك أقل من " . $this->maxNumber ;
            
        }   else    {
            return "من فضلك . قم بإدخال اسمك" ;
        }
        */
    }
    
    
    
    protected function filterPassword ( $password )   {
        
        $password = filter_var ( trim ( $password ) , FILTER_SANITIZE_STRING ) ;
        
        $shaPassword = sha1 ( $password ) ;
            
        return array ( true , $shaPassword ) ;
        
        /*
        if ( strlen ( $password ) > $this->minNumber && strlen ( $password ) < 20 )  {
            
            $shaPassword = sha1 ( $password ) ;
            
            return array ( true , $shaPassword ) ;
            
        }   else if (  strlen ( $password ) <= $this->minNumber && strlen ( $password ) > 0 )  {
            return "يجب أن يكون عدد حروف الرقم السرى أكبر من " . $this->minNumber ;
            
        }   else if ( strlen ( $password ) >= 20 )    {
            return "يجب أن يكون عدد حروف الرقم السرى أقل من 20"  ;
            
        }   else    {
            return "من فضلك . قم بإدخال الرقم السرى" ;
        }
        */
    }

}