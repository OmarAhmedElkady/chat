<?php

session_start () ;

if ( isset ( $_SESSION [ "userName" ] ) && ! empty ( $_SESSION [ "userName" ] ) )   {
    
    header ( "Location: index.php" ) ;
    exit () ;
    
}   else    {
    
    require_once ( "init.php" ) ;
    
    if ( isset ( $_GET [ "page" ] ) && ! empty ( $_GET [ "page" ] ) )  {
        
        $page = filter_var ( trim ( $_GET [ 'page' ] ) , FILTER_SANITIZE_STRING ) ;
    }
    
    ?>
    <div class = "new_account-login">
        <div class = "contaner">
            
            <form action = "" class = "new_account-login-text" method = "POST">
                <button id = "login-text" class = "delete-button-style<?php if ( isset ( $page ) && $page == 'login' )   { echo ' selection' ;  } ?>">
                    <i class = "fa fa-sign-in"></i> تسجيل الدخول
                </button> <h1>|</h1>
                <button id = "new-account-text" class = "delete-button-style<?php if ( isset ( $page ) && $page == 'new-account' )   { echo ' selection' ;  } ?>">
                    <i class = "fa fa-user-plus"></i> انشاء حساب جديد
                </button>
            </form>
            
            <form action = "" method = "POST" class = "login" style = "<?php if ( isset ( $page ) && $page == "new-account" )   { echo 'display : none' ;  } ?>">
                <input type = "text" name = "userName" class = "login-userName" placeholder = "ادخل اسمك..." required = "required" autocomplete = "off"><br>
                <div>
                    <input type = "password" name = "password" class = "login-password" placeholder = "الرقم السرى..." required = "required" autocomplete = "new-password"><br>
                    <i class = "fa fa-eye" id = "showPassword"></i><br>
                </div>
                <button class = "but-login" name = "but-login"><i class = "fa fa-sign-in"></i> تسجيل الدخول </button><br>
                <div class = "login-errors"></div>
            </form>
            
            <form action = "" method = "POST" class = "new-account" style = "<?php if ( isset ( $page ) && $page == "login" )   { echo 'display : none' ;  } ?>">
                <input type = "text" name = "userName" class = "new-userName" placeholder = "ادخل اسمك..." required = "required" autocomplete = "off"><br>
                <div>
                    <input type = "password" name = "password" class = "new-passowrd" placeholder = "الرقم السرى..." required = "required" autocomplete = "new-password"><br>
                    <i class = "fa fa-eye" id = "showPassword"></i><br>
                </div>
                <button class = "but-new-account" name = "but-new-account"><i class = "fa fa-user-plus"></i> انشاء حساب جديد </button><br>
                <div class = "new-account-errors"></div>
            </form>
            
            <form action = "" method = "POST" class = "form-image" style = "display:none;" enctype = "multipart/form-data">
                <label class = "image" for = "image"><i class = "fa fa-image"></i> إضافة صورة شخصية </label>
                <input type = 'file' class = 'image' id = 'image'  style = "display : none ;" accept= 'image/*' >
                <div class = "buttons">
                    <button class = "skip"><i class = "fa fa-forward"></i> تخطى </button>
                    <button class = "send"><i class = "fa fa-share-square"></i> إرسال </button>
                </div>
                <div class = "image-errors"></div>
            </form>
            
        </div>
    </div>
    
    <?php
    
    require_once ( $templates . "footer.php" ) ;

}
