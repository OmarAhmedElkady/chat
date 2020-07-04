<?php

session_start () ;

require_once ( "includes/class/error-messages.class.php" ) ;
require_once ( "includes/class/connectDB.class.php" ) ;
require_once ( "includes/class/messages-exchanged-with-the-ther-party.class.php" ) ;


$messages = new messages () ;

$check_the_other_end  = $messages->check_the_other_end ( $_POST [ "receiverID" ] , $_POST [ "receiverName" ] )  ;

$userImage = $check_the_other_end [ "image" ] ;
?>

<!--  <div class = "all-messages"> -->
    <?php
        $exchanged_messages_receiver = $messages->bringing_messages_exchanged_with_the_other_party ( $_SESSION [ "userID" ] , $check_the_other_end [ "userID" ] , $_POST [ "moreMessages" ]  )  ;
        
        $exchanged_messages = array_reverse ( $exchanged_messages_receiver ) ;
        
        if ( isset ( $exchanged_messages ) && is_array ( $exchanged_messages ) && count ( $exchanged_messages ) > 0 )   {
            
            $countMessages = $messages->count_messages ( $_SESSION [ "userID" ] , $check_the_other_end [ "userID" ]  ) ;
            
            if ( $_POST [ "moreMessages" ] < $countMessages )   {
                ?>
                <p class = "more-messages">عرض المزيد</p>
                <?php
            }
            
            $myID = filter_var ( trim ( $_SESSION [ "userID" ] ) , FILTER_SANITIZE_NUMBER_INT )  ;
            //print_r ( $exchanged_messages ) ;
            foreach ( $exchanged_messages as $messages )   {
                
                if ( $messages [ "sender" ] == $myID )  {
                    ?>
                    <div class = "sender">
                        <p class = "message"><?php echo nl2br ( $messages [ "message" ] ) ; ?></p>
                    </div>
                    <?php
                }   else    {
                    ?>
                    <div class = "user-other-end">
                        <div class = "image">
                            <?php
                                if ( isset ( $userImage ) && ! empty ( $userImage ) && file_exists ( "uploads/" . $userImage ) )  {
                                    ?>
                                    <img src = "<?php echo 'uploads/' . $userImage ; ?>" class = "img"  alt = "image">
                                    <?php
                                }   else    {
                                    ?>
                                    <img src = "<?php echo 'uploads/123456789.jpg' ; ?>" class = "img"  alt = "image">
                                    <?php
                                }
                            ?>
                        </div>      <!--  End Image-->
                        <p><?php echo nl2br ( $messages [ "message" ] ) ; ?></p>
                    </div>  <!--   End user other end    -->
                    <?php
                }
            }
        }   else    {
            echo "<p class = 'there-are-no-messages'> يمكنك بدء مراسلة الان</p>"  ;
        }
    ?>
<!-- </div> -->      <!--  End Messages  -->
