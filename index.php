<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="script.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>

        <div class="container">    
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
                    <div class="panel-heading">
                        <div class="panel-title">Вход в APOGEE</div>
                        
                    </div>
                    
                    <div style="padding-top:30px" class="panel-body" >
                        
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form id="loginform" class="form-horizontal" role="form" action="login.php" onsubmit="return existUser();" method="post">
                            <div id="login-error" style="font-size: 85%;color: red; padding-bottom: 10px;margin-top: -10px;"></div>
                            <div style="margin-bottom: 25px" class="inputs">
                                <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="email">
                            </div>
                            <div style="margin-bottom: 25px" class="inputs">
                                <input id="login-password" type="password" class="form-control" name="password" placeholder="парола">
                            </div>
                            <div class="input-group">
                                <button type="submit" class="btn" id="reg_user" name="reg_user" style="margin-bottom: 15px;background-color: rgb(63, 81, 181);border-color: rgb(63, 81, 181);color:#fff;padding: 6px 40px;">вход</button>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px;" >
                                        Нямаш профил в APOGEE?
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">Регистрирай се тук</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>                     
                </div>  
            </div>
            
            <div id="signupbox" style="margin-top:50px;display: none;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" style="border-color: rgb(63, 81, 181);">
                    <div class="panel-heading">
                        <div class="panel-title">Регистрация в APOGEE</div>
                        
                    </div>
                    
                    <div style="padding-top:30px" class="panel-body" >
                        
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form id="registrationform" class="form-horizontal" role="form" action="registration.php" onsubmit="return validateForm();"  method="post">
                            <div style="margin-bottom: 25px" class="inputs">
                                <input id="fullname" type="text" class="form-control" name="fullname" value="" placeholder="Име и фамилия">
                                <span id="error-name" style="font-size: 85%;color: red;"></span>
                            </div>
                            <div style="margin-bottom: 25px" class="inputs">
                                <input id="reg-username" type="text" class="form-control" name="email" value="" placeholder="email">
                                <span id="error-email" style="font-size: 85%;color: red;"></span>
                            </div>
                            <div style="margin-bottom: 25px" class="inputs">
                                <input id="reg-password" type="password" class="form-control" name="password" placeholder="парола">
                                <span id="error-password" style="font-size: 85%;color: red;"></span>
                            </div>
                            <div style="margin-bottom: 25px" class="inputs">
                                <input id="reg-password-r" type="password" class="form-control" name="password_r" placeholder="повтори парола">
                                <span id="error-password-r" style="font-size: 85%;color: red;"></span>
                            </div>
                            <div class="input-group">
                                <button type="submit" class="btn" id="reg_user" name="reg_user" style="margin-bottom: 15px;background-color: rgb(63, 81, 181);border-color: rgb(63, 81, 181);color:#fff;padding: 6px 40px;">Регистрация</button>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px;" >
                                        Имаш профил в APOGEE?
                                        <a href="#" onClick="$('#loginbox').show(); $('#signupbox').hide()">Вход</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>                     
                </div>  
            </div>
        </div>
    </body>
</html>
    