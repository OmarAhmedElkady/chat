<?php


if ( ! isset ( $_SESSION ) )  {
    
    session_start () ;
}


$class = "includes/class/" ;

require_once ( $class . "error-messages.class.php" ) ;
require_once ( $class . "connectDB.class.php" ) ;
require_once ( $class . "selectDB.class.php" ) ;


$select = new selectDB () ;
    
$userID = $select->get_userID ( $_SESSION [ "userName" ] , $_SESSION [ "password" ] ) ;

if ( isset ( $userID ) && is_array ( $userID ) && ! empty ( $userID ) && count ( $userID ) > 0 )    {
    
    $_SESSION [ "userID" ] = $userID [ "userID" ] ;
    
}   else    {
    header ( "Location: sign-out.php" ) ;
    exit () ;
}

$moreUsers = 15 ;

if ( isset ( $_POST [ "moreUsers" ] ) && ! empty ( $_POST [ "moreUsers" ] ) )   {
    $moreUsers = $_POST [ "moreUsers" ] ;
}

$allUsers = $select->getAllUsers( $moreUsers ) ;

if ( isset ( $allUsers ) && is_array ( $allUsers ) && ! empty ( $allUsers ) && count ( $allUsers ) > 0 )    {
    ?>
    <!-- <div class = "index"> -->
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
                                    <img src = "<?php echo 'uploads/123456789.jpg' ; ?>" class = "img"  alt = "image">
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
                
                $countUsers = $select->countUsers( $_SESSION [ "userID" ] ) ;
                
                if ( $moreUsers < $countUsers )     {
                    ?>
                    <p class = "more-users">عرض المزيد</p>
                    <?php
                }
                ?>
            </div>      <!-- End allUsers -->
        </div>
        <div class = "messages-exchanged-with-the-other-party">
            
        </div>      <!-- messages exchanged with the other party -->
        
    <!--</div>  -->         <!-- End Index -->
    <?php
}



?>