<?php 

session_start();

include('config.php');

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            
             // Define $username and $password
            $username = mysqli_real_escape_string($mysqli, $_POST['username']);
            $password = mysqli_real_escape_string($mysqli, $_POST['password']);
            
            $hashFormat = "$2y$10$";
                
            $salt = "mijnpapakomteraanblijfnumaarstaan";
                
            $hash_and_salt = $hashFormat . $salt;
                
            $password = crypt($password,$hash_and_salt);
            

            
             //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            // //Get Ip adress from User
            function get_client_ip() {
                $ipaddress = '';
                if (getenv('HTTP_CLIENT_IP'))
                    $ipaddress = getenv('HTTP_CLIENT_IP');
                else if(getenv('HTTP_X_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                else if(getenv('HTTP_X_FORWARDED'))
                    $ipaddress = getenv('HTTP_X_FORWARDED');
                else if(getenv('HTTP_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_FORWARDED_FOR');
                else if(getenv('HTTP_FORWARDED'))
                  $ipaddress = getenv('HTTP_FORWARDED');
                else if(getenv('REMOTE_ADDR'))
                    $ipaddress = getenv('REMOTE_ADDR');
                else
                    $ipaddress = 'UNKNOWN';
                return $ipaddress;
            }
            
            //$passw = password_verify($password, $hashed_password);
            
            // SQL query to fetch information of registerd users and finds user match.
            $query =mysqli_query($mysqli, "select * from `login` where username='$username' and password='$password'");
            
            $count = mysqli_num_rows($query);
            
            // Als wachtwoord en/of gebruikersnaam niet juist is
            if ($count == 1 ){
                //session_register("username");
                $_SESSION['login_user'] = $username;
                $_SESSION['ip'] = $ipaddress;
                
                header('location: dashboard.php');
            }
            // Indien deze wel juist zijn
            
            else{
                $error = "De Gebruikersnaam of Wachtwoord is onjuist";
            }
        }



?>



<?php include('includes/header.php'); ?>


<style type="text/css" rel="stylesheet">
    
    body{
        height: 100vh;
    }
    .intro-2{
        background: url("images/D60A8876 (2500 x 1667).jpg")no-repeat center center;
        background-size: cover;
    }
    .card {
        background-color: rgba(229, 228, 255, 0.2);
    }
    .md-form label {
    color: #ffffff;
    }
    h6 {
        line-height: 1.7;
    }
    
    
    .card {
        margin-top: 30px;
        /*margin-bottom: -45px;*/
    
    }
    
    .md-form input[type=text]:focus:not([readonly]),
    .md-form input[type=password]:focus:not([readonly]) {
        border-bottom: 1px solid #8EDEF8;
        box-shadow: 0 1px 0 0 #8EDEF8;
    }
    .md-form input[type=text]:focus:not([readonly])+label,
    .md-form input[type=password]:focus:not([readonly])+label {
        color: #8EDEF8;
    }
    
    .md-form .form-control,
    .md-form .form-check-input {
        color: #fff;
    }
        
    
</style>
<!--    Start Project Here     -->
    


        <!--Intro Section-->
        
        <section class="h-100 intro-2">
          <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
            <div class="container">
              <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">
    
                  <!--Form with header-->
                  <div class="card wow fadeIn" data-wow-delay="0.3s">
                    <div class="card-body">
    
                      <!--Header-->
                      <div class="form-header blue-gradient">
                        <h3><i class="fas fa-user mt-2 mb-2"></i> Log in:</h3>
                      </div>
                        <form action="" method="post">                    
                            <!--Body-->
                            <div class="md-form">
                                <i class="fas fa-user prefix white-text"></i>
                                <input type="text" id="username" name="username" class="form-control">
                                <label for="orangeForm-name">Username</label>
                            </div>
            
                            <div class="md-form">
                                <i class="fas fa-lock prefix white-text"></i>
                                <input type="password" id="password" name="password" class="form-control">
                                <label for="orangeForm-pass">Your password</label>
                            </div>
                            <div class="md-form">
                                <input type="checkbox" class="form-check-input" id="remember-me" name="remember">
                                <label class="form-check-label" for="remember-me">Remember me</label>
                            </div>
            
                            <div class="text-center">
                                <input type="submit" name="submit" class="btn blue-gradient btn-lg" value="login">
                                <hr>
                            </div>
                        </form>
    
                    </div>
                    <div class="card-footer text-center text-white">
                        <?php echo $error ?>
                    </div>
                  </div>
                  <!--/Form with header-->
    
                </div>
              </div>
            </div>
          </div>
          
           <span>
              <?
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
                unset($_SESSION['message']);
              ?>
            </span>
        </section>




<!--    /Start Project Here    -->



<?php include('includes/scripts.php'); ?>

<script type="text/javascript">
    $(document).ready(function (){ 
        new WOW().init();
        
    });
    
</script>

<?php include('includes/footer.php'); ?>