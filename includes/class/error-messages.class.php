<?php

trait errorMessages {
    
    public function __call ( $method , $arguments )  {
        
        echo "The Method [ " . $method . " ] Not Found Or Not Accessible" ;
    }
    
    public function __set ( $variable , $value )    {
        echo "The Property [ " . $variable . " ] Is Not Found Or Not Accessible<br>" ;
    }
    
    public function __get ( $variable )     {
        echo "The Property [ " . $variable . " ] Is Not Found Or Not Accessible<br>" ;
    }
}