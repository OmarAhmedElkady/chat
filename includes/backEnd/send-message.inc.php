<?php

session_start () ;

require_once ( "../class/error-messages.class.php" ) ;
require_once ( "../class/connectDB.class.php" ) ;

require_once ( "../class/send-message.class.php" ) ;

$send = new sendMessage ( $_SESSION [ "userID" ] , $_POST [ "receiverID" ]  , $_POST [ "textareaMessage" ] ) ;

$send->insertMessageInDatabase () ;