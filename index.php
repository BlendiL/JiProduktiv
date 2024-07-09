<?php
require("config/session.php");
require("config/constant.php");
require("config/helper.php");

//redirect to template page if the user is logged in
if(logged_in()){
    header( "Location: home.php" ); die;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body class="hold-transition login-page">
<div class="login-box">
   
    <!-- /.login-logo -->
    <div class="login-box-body">
        
        <!-- start display error message -->
        <?php
        $error_code = @$_GET['error']; 
        if($error_code==ERROR_CODE_LOGIN){
            display_error('alert-danger',ERROR_MSG_LOGIN);      
        }elseif ($error_code==ERROR_CODE_BLOCKED) {
            display_error('alert-danger',ERROR_MSG_BLOCKED);
        } 
        ?>
        <!-- end display error message -->

        <div class="wrapper">
        <header>Forma e Kyçjes</header>
        <form action="process_login.php" method="post">
            <div class="field email">
                <div class="input-area">
                    <input type="text" name="email" id="email" placeholder="Email">
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Emaili s'mund te jete i zbrazet</div>
            </div>
            <div class="field password">
                <div class="input-area">
                    <input type="password" name="password" id="password" placeholder="Fjalëkalimi">
                    <i class="icon fas fa-lock"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Passwordi s'mund te jete i zbrazet</div>
            </div>
            <div class="pass-txt"><a href="#">Keni harruar fjalëkalimin?</a></div>
            <input type="submit" name="submit" value="Login">
        </form>
        <div class="sign-txt">Nuk jeni ende te regjistruar? <a href="signup.php">Regjistrohuni</a></div>
    </div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});
</script>
</body>
</html>
