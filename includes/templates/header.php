<?php

    if (  isset ( $_POST [ "night_mode" ] ) && ! isset ( $_COOKIE [ "nightMode" ] ) )     {
        setcookie ( "nightMode" , "true" , time() + ( 60 * 60 * 24 * 30 * 12 ) ) ;
    }   else {
        if (  isset ( $_POST [ "default_mode" ] ) &&  isset ( $_COOKIE [ "nightMode" ] ) )   {
            unset(  $_COOKIE [ 'nightMode' ] ) ;
            setcookie ( "nightMode" , "" , time() - ( 60 * 60 * 24 * 30 * 12 ) ) ;
        }
    }

?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset = "UTF-8">
            <title>chat</title>
            <link rel = "stylesheet" href = "<?php echo $css . 'font-awesome.min.css' ; ?>">
            <link rel = "stylesheet" href = "<?php echo $css . 'default.css' ; ?>" >
            <link rel = "stylesheet" href = "<?php echo $css . 'PC.css' ; ?>" >
            <link rel = "stylesheet" href = "<?php echo $css . 'phone.css' ; ?>" >
            <?php
                
                if (  isset ( $_POST [ "night_mode" ]  )  ||  isset ( $_COOKIE [ "nightMode" ] )  )   {
                    ?>
                    <link rel = "stylesheet" href = "<?php echo $css . 'color/night-mode.css' ; ?>" >
                    <?php
                }   else    {
                    ?>
                    <link rel = "stylesheet" href = "<?php echo $css . 'color/default-mode.css' ; ?>" >
                    <?php
                }
            
            ?>
            <link rel="shortcut icon" type="image/x-icon" href="uploads/logo-default.png" />
        </head>
        <body dir = "rtl">
            
            <div class = "header">
                <div class = "contaner" >
                    <ul class = "record">
                        <?php
                            /*
                            if ( isset ( $_SESSION [ "userName" ] ) && ! empty ( $_SESSION [ "userName" ] ) )   {
                                ?>
                                <li><button class = "align-justify action-all-users" id = "align-justify"><i class = "fa fa-bars"></i></button></li>
                                <li class = "sign-out"><a href = "sign-out.php"><i class = "fa fa-sign-out"></i> تسجيل الخروج </a></li>
                                <?php
                            }   else    {
                                ?>
                                <li><a href = "sign-up-and-login.php?page=login"><i class = "fa fa-sign-in"></i> تسجيل الدخول </a></li>
                                <li><a href = "sign-up-and-login.php?page=new-account"><i class = "fa fa-user-plus"></i> انشاء حساب جديد </a></li>
                                <?php
                            }
                            */
                        ?>
                    </ul>
                    
                    <ul class = "logo-and-color">
                        <li>
                            <?php
                                if ( isset ( $_POST [ "night_mode" ] ) ||  isset ( $_COOKIE [ "nightMode" ] ) )   {
                                    ?>
                                    <img src = "uploads/night-logo.jpg" class = "logo"></li>
                                    <?php
                                }   else    {
                                    ?>
                                    <img src = "uploads/logo-default.png" class = "logo"></li>
                                    <?php
                                }
                            ?>
                        <li class = "option-color">
                            <i class = "fa fa-sort-down"></i>
                            <p>لون</p>
                            <div class = "color">
                                <form action = "" method = "POST">
                                    <input type = "submit" name = "default_mode" value = "الوضع الافتراضى">
                                    <input type = "submit" name = "night_mode" value = "الوضع الليلى">
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
