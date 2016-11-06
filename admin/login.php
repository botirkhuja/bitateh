<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
ini_set('display_errors', 'On');

require './functions/functions.php';
    
        if(isset($_POST['admin_email']) && isset($_POST['admin_password'])){
             if(filter_input(INPUT_POST, 'admin_email', FILTER_VALIDATE_EMAIL) &&  
                            filter_input(INPUT_POST,'admin_password')){

            $email = strip_tags( trim( $_POST[ 'admin_email' ] ) );
            $password = strip_tags( trim( $_POST[ 'admin_password' ] ) );

            $admin = array("email"=>$email, "password"=> $password);
             
             $result = admin_login($admin);

             if ($result)
                echo "<script> window.location ='./index.php';</script>";
             else 
                $error = "error";
            }
        }
?>

<!DOCTYPE html>
<html lang="">
<head>

    <?php include "header.php"; ?>
    <title> Login </title>

</head>


<body>

<div class="container wrapper">

    <img src="images/banner.png" class="img-responsive" width="100%" height="250">

    <div class="jumbotron main">
        <div class="row">
            <header>
                <p class="text-center h1"> Administrator Login </p>
            </header>

                    <div class="row">
                          <?php

                                if(isset($error)){
                                    echo "<p class='text-center alert-danger'>You entered an invalid email or password.</p>";
                                   }

                            ?>
                        <div class="col-sm-6 col-md-4 col-md-offset-4">
                            <p class="h3 text-center login-title"> Sign in to your account </p>

                            <div class="account-wall">
                                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                                    alt="">
                       
                                <form id="login_form" class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post" id="form">
                                   
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="admin_email" id="admin_email" placeholder="Email"
                                          type="text" data-validation="email">
                                        <input type="password" class="form-control" name="admin_password" id="admin_password" placeholder="Password" 
                                                data-validation="length" data-validation-length="min5" data-validation="confirmation">
                                    </div>
                                       
                                    <button class="btn btn-lg btn-primary btn-block" type="submit"> Sign in </button>
                                    
                                    <div class="form-group">
                                        <label class="checkbox pull-left" style="margin-left: 20px;"> <input type="checkbox" value="remember-me"> Remember me </label>
                                    </div>
                                        <a href="#" class="pull-right need-help"> Need help? </a><span class="clearfix"></span>
                                </form>
                            </div>
                            <a href="#" class="text-center new-account" style="font-size: 18px"> Create an account </a>
                        </div>
                    </div>
        </div>

        </div>
            <!-- FOOTER STARTS -->
             <div class="row footer">

                 <?php include "footer.php"; ?>

            </div>
    </div>

    <!-- FOOTER ENDS -->

<!-- jQuery Form Validation code -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
<script> 
    $.validate(); 


</script>

</body>
</html>
