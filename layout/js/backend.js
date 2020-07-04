$(document).ready(function(){
    
    
    var minNumber  = 4 ;
    var maxNumber = 30 ; 
    /*************************************Start Function**************************************/
    
    
    /*************************************Start Check User Name**************************************/
    
    function checkUserName( userName )    {
        
        if ( $.isNumeric ( userName ) )    {
            return "أسف . يجب أن يتكون إسمك من حروف فقط وليس ارقام" ;
        }
        
        if ( userName.length > minNumber && userName.length < maxNumber )  {
            return true ;
            
        }   else if (  userName.length <= minNumber && userName.length > 0 )  {
            return "يجب أن يكون عدد حروف إسمك اكبر من " + minNumber ;
            
        }   else if ( userName.length >= maxNumber )    {
            return "يجب أن يكون عدد حروف إسمك أقل من " + maxNumber ;
            
        }   else    {
            return "من فضلك . قم بإدخال اسمك" ;
        }
        
    }
    
    /*************************************Start Check User Name**************************************/
    
    
    /*************************************Start Check Password**************************************/
    
    function checkPassword( password )    {
        
        if ( password.length > minNumber && password.length < 20 )  {
            return true ;
            
        }   else if (  password.length <= minNumber && password.length > 0 )  {
            return "يجب أن يكون عدد حروف الرقم السرى اكبر من" + minNumber ;
        
        }   else if ( password.length >= 20 )    {
            return "يجب أن يكون عدد حروف الرقم السرى أقل من ٢٠ " ;
        
        }   else    {
            return "من فضلك . قم بإدخال الرقم السرى" ;
        }
        
    }
    
    /*************************************End Check Password**************************************/
    
    /*************************************End Function**************************************/
    
    
    
    $(document).on("click" , "button[id='align-justify']" , function (){
        
        $(this).toggleClass( "action-all-users" ) ;
        
        $( "div[class='all-users']" ).removeAttr( "id" ) ;
        
        if ( $(this).hasClass( "action-all-users" ) )   {
            
            
            
            $( "div[class='all-users']" ).show() ;
            
        }   else    {
            $( "div[class='all-users']" ).hide() ;
        }
        
        return false ;
    }) ;
    
    
    
    
    $(document).on("click" , "button[id='login-text']" , function(){
        
        $(this).addClass( "selection" ) ;
        
        $("button[id='new-account-text']").removeClass( "selection" ) ;
        
        $("form[class='login']").show() ;
        
        $("form[class='new-account']").hide() ;
        
        return false ;
    }) ;
    
    $(document).on("click" , "button[id='new-account-text']" , function(){
        
        $(this).addClass( "selection" ) ;
        
        $("button[id='login-text']").removeClass( "selection" ) ;
        
        $("form[class='login']").hide() ;
        
        $("form[class='new-account']").show() ;
        
        return false ;
    }) ;
    
    
    
    $(document).on("click" , "i[id='showPassword']" , function(){
        
        $(this).toggleClass( "active" ) ;
        
        if ( $(this).hasClass( "active" ) )     {
            
            $("input[name='password']").attr( "type" , "text" ) ;
            
        }   else    {
            $("input[name='password']").attr( "type" , "password" ) ;
        }
        
        return false ;
    }) ;
    



    $(document).on("click" , "button[class='but-login']" , function() {
        
        var userName = $("input[class='login-userName']").val() ;
        var password  = $("input[class='login-password']").val() ;
        
        var returnCheckUserName = checkUserName ( userName ) ;
        var returnCheckPassword   = checkPassword ( password ) ;
        
        if ( returnCheckUserName == true && returnCheckPassword == true  )   {
            
            $.ajax({
                
                type : "POST" ,
                url   : "includes/backEnd/new-account-and-login.inc.php" ,
                data : {
                    page           : "login" ,
                    userName : userName ,
                    password  : password
                } , success:function ( data )    {
                    
                    if ( data == true )     {
                        
                        window.location.href = "index.php" ;
                        
                    }   else    {
                        $("div[class='login-errors']").html("<p>" + data + "</p>") ;
                    }
                }
            }) ;
            
        }   else if ( returnCheckUserName != true )    {
            $("div[class='login-errors']").html("<p>" + returnCheckUserName + "</p>") ;
            
        }   else    {
            $("div[class='login-errors']").html("<p>" + returnCheckPassword + "</p>") ;
        }
        
        return false ;
    }) ;


    
    
    
    $(document).on("click" , "button[class='but-new-account']" , function() {
        
        var userName = $("input[class='new-userName']").val() ;
        var password  = $("input[class='new-passowrd']").val() ;
        
        var returnCheckUserName = checkUserName ( userName ) ;
        var returnCheckPassword   = checkPassword ( password ) ;
        
        if ( returnCheckUserName == true && returnCheckPassword == true  )   {
            
            $.ajax({
                
                type : "POST" ,
                url   : "includes/backEnd/new-account-and-login.inc.php" ,
                data : {
                    page           : "new_account" ,
                    userName : userName ,
                    password  : password
                } , success:function ( data )    {
                    
                    if ( data == true )     {
                        
                        $("form[class='new-account']").hide() ;
                        
                        $("form[class='new_account-login-text']").hide() ;
                        
                        $("form[class='form-image']").show() ;
                        
                    }   else    {
                        $("div[class='new-account-errors']").html("<p>" + data + "</p>") ;
                    }
                }
            }) ;
            
        }   else if ( returnCheckUserName != true )    {
            $("div[class='new-account-errors']").html("<p>" + returnCheckUserName + "</p>") ;
            
        }   else    {
            $("div[class='new-account-errors']").html("<p>" + returnCheckPassword + "</p>") ;
        }
        return false ;
    }) ;
    
    
    
    
    $(document).on("click" , "button[class='skip']" , function(){
        
        $.ajax({
            
            type : "POST" ,
            url   : "includes/backEnd/skip.inc.php" ,
            date: "skip" ,
            success:function()    {
                
                window.location.href = "index.php" ;
            }
            
        }) ;
        
        return false ;
    })  ;
    
    
    
    $(document).on("click" , "button[class='send']" , function() {
        
        var image = new FormData() ;
        var files    = $("input[id='image']")[0].files[0];
        
        image.append('image',files);
        
        $.ajax({
            
            type : "POST" ,
            url    : "includes/backEnd/image.inc.php" ,
            data : image ,
            contentType: false,
            processData: false,
            success:function ( data )   {
                
                if ( data == true )     {
                    window.location.href = "index.php" ;
                    
                }   else    {
                    $("div[class='image-errors']").html("<p>" + data + "</p>") ;
                }
            }
        }) ;
        
        return false ;
    }) ;
    
    
    
    var condition = false ;
    var receiverID ;
    var receiverName ;
    
    $(document).on("click" , "a[class='user']" , function () {
        
        var userID = $(this).attr( "userID" ) ;
        var userName = $(this).attr( "userName" ) ;
        receiverID = userID ;
        receiverName = userName ;
        moreMessages = 20 ;
        
        if ( $.isNumeric ( userID ) )  {
            
            if ( ! $.isNumeric ( userName ) )    {
                
                $.ajax({
                    
                    type : "POST" ,
                    url   : "messages-exchanged-with-the-ther-party.php" ,
                    data :{
                        userID       : userID ,
                        userName : userName ,
                        moreMessages : moreMessages
                    } , success:function ( data )   {
                        
                        $( "button[id='align-justify']").toggleClass( "action-all-users" ) ;
                        
                        $( "div[class='all-users']" ).attr( "id" , "hide-all-users" ) ;
                        
                        $("div[class='messages-exchanged-with-the-other-party']").html( data ) ;
                        
                        
                        $("html, body").animate({
                            scrollTop: $( 'html, body').get(0).scrollHeight 
                        }, 0);
                        
                        ///////////////////////////////////////////////////////////////////////
                        
                        if ( condition == false )   {
                            
                            condition = true ;
                            
                            interval = setInterval(function(){
                                
                                $("div[class='all-messages']").load("reload-the-messages.php" , { receiverID , receiverName , moreMessages });
                                
                                $("html, body").animate({ 
                                    scrollTop: $( 
                                      'html, body').get(0).scrollHeight 
                                }, 0);
                                
                            } , 2000 ) ;
                        }
                        
                        /////////////////////////////////////////////////////////
                        
                    }
                }) ;
                
            }   else    {
                alert ( "يجب ان يتكون userName من حروف" ) ;
            }
        }   else {
            
            alert ( "يجب ان يكون userID رقم" ) ;
        }
        
        return false ; 
    }) ;
    
    
    
    
    $(document).on("click" , "button[class='button-send-message']" , function () {
        
        var receiverID = $(this).attr( "receiverID" ) ;
        var receiverName = $(this).attr( "receiverName" ) ;
        var textareaMessage = $("textarea[class='textarea-message']").val() ;
        
        if ( receiverID != "" && textareaMessage != "" ) {
            
            $.ajax({
                
                type : "POST" ,
                url   : "includes/backEnd/send-message.inc.php" ,
                data:{
                    receiverID : receiverID ,
                    textareaMessage : textareaMessage
                } , success:function ()   {
                    
                    $("textarea[class='textarea-message']").val( "" ) ;
                    
                    $("html, body").animate({ 
                        scrollTop: $( 
                          'html, body').get(0).scrollHeight 
                    }, 0);
                    
                    
                    if ( condition == false )   {
                
                        condition = true ;
                        
                        interval = setInterval(function(){
                            
                            $("div[class='all-messages']").load("reload-the-messages.php" , { receiverID , receiverName , moreMessages });
                            
                            $("html, body").animate({ 
                                scrollTop: $( 
                                  'html, body').get(0).scrollHeight 
                            }, 0);
                            
                        } , 2000 ) ;
                    }
                    
                }
            }) ;
        }
        
        return false ;
    }) ;
    
    
    $(document).on("keypress" , "textarea[class='textarea-message']" , function (event) {
        
        if (event.keyCode == 13){
            $("button[class='button-send-message']").click() ;
            return false ;
        }
        
    }) ;
    
    
    
    var moreMessages = 20 ;
    
    $(document).on("click" , "p[class='more-messages']" , function (){
        
        moreMessages = moreMessages + 20 ;
        
        $("div[class='all-messages']").load("reload-the-messages.php" , { receiverID , receiverName , moreMessages });
        
        return false ;
    }) ;
    
    
    
    var moreUsers = 15 ;
    
    $(document).on("click" , "p[class='more-users']" , function (){
        
        moreUsers = moreUsers + 15 ;
        
        $("div[class='index']").load("all-users.php" , { moreUsers });
        
        return false ;
    }) ;
    
    
    
    /*
    $(window).scroll(function() {
        // $(window).scrollTop() + $(window).height() > $(document).height() - 100
        // $(window).scrollTop() + $(window).height() == $(document).height()
        if( $(window).scrollTop() + $(window).height() != $(document).height() ) {
                
            if ( condition === true )   {
                
                clearInterval ( interval ) ;
                condition = false ;
            }
        }   
    });*/

    
    
    
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100 || $(window).scrollTop() + $(window).height() == $(document).height() ) {
            
            if ( condition == false )   {
                
                condition = true ;
                
                interval = setInterval(function(){
                    
                    $("div[class='all-messages']").load("reload-the-messages.php" , { receiverID , receiverName , moreMessages });
                    
                    $("html, body").animate({ 
                        scrollTop: $( 
                          'html, body').get(0).scrollHeight 
                    }, 0);
                    
                } , 2000 ) ;
            }
        }   else    {
            
            if ( condition === true )   {
                
                clearInterval ( interval ) ;
                condition = false ;
            }
        }
    });
    
    
}) ;