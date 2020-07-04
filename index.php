<?php

session_start () ;

if ( isset ( $_SESSION [ "userName" ] ) && ! empty ( $_SESSION [ 'userName' ] ) )   {

    require_once ( "init.php" ) ;
    
    ?>
    
    <div class = "index">
        
        <?php
            require_once ( "all-users.php" ) ;
        ?>
        
        
        
    </div>
    
    <?php
    
    
    
    /*
    require_once ( $class . "error-messages.class.php" ) ;
    require_once ( $class . "connectDB.class.php" ) ;
    require_once ( $class . "selectDB.class.php" ) ;
    
    $user = new selectDB () ;
    
    $userID = $user->get_userID ( $_SESSION [ "userName" ] , $_SESSION [ "password" ] ) ;
    
    if ( isset ( $userID ) && is_array ( $userID ) && ! empty ( $userID ) && count ( $userID ) > 0 )    {
        
        $_SESSION [ "userID" ] = $userID [ "userID" ] ;
        
    }   else    {
        header ( "Location: sign-out.php" ) ;
        exit () ;
    }
    
    
    $allUsers = $user->getAllUsers() ;
    
    if ( isset ( $allUsers ) && is_array ( $allUsers ) && ! empty ( $allUsers ) && count ( $allUsers ) > 0 )    {
        ?>
        <div class = "index">
            <div>
                <div class = "all-users">
                    <?php
                    foreach ( $allUsers AS $user )  {
                        ?>
                        <a class = "user" userID = "<?php echo $user [ 'userID' ] ; ?>" userName = "<?php echo $user [ 'userName' ] ;?>">
                            <div class = "image">
                                <?php
                                    if ( ! empty ( $user [ 'image' ] ) && file_exists ( "uploads/" . $user [ "image" ] ) )  {
                                        ?>
                                        <img src = "<?php echo 'uploads/' . $user [ 'image' ] ; ?>" class = "img"  alt = "image">
                                        <?php
                                    }   else    {
                                        ?>
                                        <i class = "fa user-circle"></i>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class = "data">
                                <p class = "userName"><?php echo $user [ "userName" ] ; ?></p>
                            </div>
                        </a>        <!-- End User -->
                        
                        <?php
                    }           // End ForEeach
                    ?>
                </div>      <!-- End allUsers -->
            </div>
            <div class = "messages-exchanged-with-the-other-party">
                
            </div>      <!-- messages exchanged with the other party -->
            
        </div>          <!-- End Index -->
        <?php
    }
    
    
    */
    require_once ( $templates . "footer.php" ) ;    
    
}   else    {
    
    header ( "Location: sign-up-and-login.php?page=login" ) ;
    exit () ;
}