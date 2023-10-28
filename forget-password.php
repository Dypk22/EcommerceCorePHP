<?php 
   require 'connection.php';
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
      <link href="images/favicon.png" rel="icon" />
      <title>Reset Password - <?php echo SITE_NAME; ?></title>
      <meta name="keywords" content="billincharge, billincharge.com, reset password">
      <meta name="description" content="Online Recharge, Bill Payments , DTH, Prepaid &amp; Postpaid Mobile Recharge - <?php echo SITE_NAME ?>. Reset your password">
      <meta name="author" content="Deepak Nawani"> 
      <!-- Web Fonts
         ============================================= -->
      <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
      <!-- Stylesheet
         ============================================= -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
      <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
      <link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />
      <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css" />
      <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.theme.default.min.css" />
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
      <link rel="stylesheet" type="text/css" href="css/custom.css" />
   </head>
   <body class="bg-light-2">
      <!-- Document Wrapper   
         ============================================= -->
      <div id="main-wrapper">
         <header id="header">
            <div class="container">
               <div class="header-row">
                  <div class="header-column justify-content-start">
                     <!-- Logo
                        ============================================= -->
                     <div class="logo"> <a href="<?php echo SITE_PATH; ?>" class="d-flex text-capitalize text-primary" style="font-size: 1.5rem;font-weight: 600;" title="<?php echo SITE_NAME; ?> - Mobile Recharge & Bill Payment"><?php echo SITE_NAME; ?></a> </div>
                     <!-- Logo end --> 
                  </div>
                  <div class="header-column justify-content-end">
                     <!-- Primary Navigation
                        ============================================= -->
                     <nav class="primary-menu navbar navbar-expand-lg">
                        <div id="header-nav" class="collapse navbar-collapse">
                           <ul class="navbar-nav">
                              <li class="zindex"> <a href="<?php echo SITE_PATH; ?>">Home</a></li>
                              <li class="zindex"><a href="<?php echo SITE_PATH; ?>offers">Offers</a></li>
                              <li class="zindex"><a href="<?php echo SITE_PATH; ?>about">About</a></li>
                              <li class="zindex"><a href="<?php echo SITE_PATH; ?>contact">Contact</a></li>
                           </ul>
                        </div>
                     </nav>
                     <!-- Primary Navigation end -->
                     <!-- Collapse Button
                        =============================== -->
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> <span></span> <span></span> <span></span> </button>
                     <nav class="login-signup navbar navbar-expand separator ml-sm-2 pl-sm-2">
                        <ul class="navbar-nav">
                           <?php if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){ ?>
                           <li class="profile <?php echo (isset($dashboard_active))? $dashboard_active:''; ?>"><a class="pr-0" href="<?php echo SITE_PATH.'dashboard'; ?>" title="Dashboard"><span class="d-none d-sm-inline-block">Dashboard</span> <span class="user-icon ml-sm-2"><i class="fas fa-user my-2"></i></span></a></li>
                           <?php } else{ ?>
                           <li ><a data-toggle="modal" data-target="#login-modal" class="pointer" title="Login">Login</a> </li>
                           <li class="align-items-center h-auto ml-sm-2"><a class="btn btn-sm btn-primary signup_name"  title="Sign Up" href="signup">Register</a></li>
                           <!-- <li class="align-items-center h-auto ml-sm-2"><a class="btn btn-sm btn-primary" href="login">Login</a></li> -->
                           <?php } ?>
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </header>
         <!-- Content
            ============================================= -->
         <div id="content">
            <div class="container py-5">
               <div class="row py-5">
                  <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                     <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <h3 class="text-center mt-3 mb-4">Forgot your password?</h3>
                        <?php if (!isset($_SESSION['USER_LOGIN'])) { ?>
                        <p class="text-center text-3 text-muted">Enter your Email or Mobile <br> we’ll help you reset your password.</p>
                        <form id="forgotForm" class="form-border" method="post">
                           <div class="form-group">
                              <input type="text" class="form-control border-2" id="forgetEmail" required placeholder="Enter Email or Mobile Number">
                           </div>
                           <label id="forget_msg" class="error text-primary m-1 mb-2 text-capitalize" style="position: relative; bottom: 7px; display: none;"></label>
                           <button class="btn btn-primary btn-block mb-4" type="button" onclick="forget_password()">Continue</button>
                        </form>
                        <p class="text-center mb-0"><a class="btn-link" href="login">Return to Log In</a></p>
                        <?php } else { ?>
                        <form class="form-border" method="post">
                           <label style="position: relative; bottom: 7px;display: flex;justify-content: center;font-size: 1rem;" class="text-primary m-1 mb-2 text-capitalize">Please logout first to continue</label>
                           <button class="btn btn-primary btn-block mb-4" type="button" onclick="window.location.href='logout';">Click here to Logout</button>
                        </form>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content end -->
      </div>
      <!-- Document Wrapper end -->
      <!-- Login Modal
         =========================== -->
      <div id="login-modal" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <!-- <button type="button" class="close close-outside" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> -->
                  <!-- Login Form
                     ====================== -->
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
                           <li class="nav-item"> <a class="nav-link text-5 line-height-3 active">Login</a> </li>
                           <li class="nav-item"> <a class="nav-link text-5 line-height-3 pointer" data-toggle="modal" data-target="#signup-modal" data-dismiss="modal">Sign Up</a> </li>
                        </ul>
                        <p class="text-4 font-weight-300 text-muted text-center mb-4">We are glad to see you again!</p>
                        <form id="loginForm" method="post">
                           <div class="form-group">
                              <input type="email" class="form-control" id="loginemail" value="<?php echo (isset($_COOKIE['u32323s3223e54442rtrtr'])) ? base64_decode($_COOKIE['u32323s3223e54442rtrtr']) : '' ; ?>" required placeholder="Mobile or Email">
                              <label id="login_name_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="loginemail"></label>
                           </div>
                           <div class="form-group">
                              <input type="password" class="form-control" id="loginpassword" required value="<?php echo (isset($_COOKIE['p323s7934w0340343df043'])) ? base64_decode($_COOKIE['p323s7934w0340343df043']) : '' ; ?>" placeholder="Password">
                              <label id="login_password_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="loginpassword"></label>
                           </div>
                           <div class="row my-4">
                              <div class="col">
                                 <div class="form-check text-2 custom-control custom-checkbox">
                                    <input id="rememberme" <?php echo (isset($_COOKIE['u32323s3223e54442rtrtr'])) ? 'checked=""' : '' ; ?> name="remember" value="yes" class="custom-control-input" type="checkbox">
                                    <label class="custom-control-label" for="rememberme">Remember Me</label>
                                 </div>
                              </div>
                              <div class="col text-2 text-right"><a class="btn-link pointer" data-toggle="modal" data-dismiss="modal" data-target="#forgot-password-modal">Forgot Password ?</a></div>
                           </div>
                           <div id="login_error_msg" class="alert alert-danger alert-dismissible fade show" style="display: none;" role="alert">
                              <strong>Alert!</strong> <?php echo $_SESSION["msg"]; ?>
                           </div>
                           <button class="btn btn-primary btn-block mb-4" id="loginBtn" type="button" onclick="siginin('login')">Login</button>
                        </form>
                        <!-- <div class="d-flex align-items-center my-3">
                           <hr class="flex-grow-1">
                           <span class="mx-2 text-2 text-muted">Or Login with Social Profile</span>
                           <hr class="flex-grow-1">
                           </div> -->
                        <!-- <div class="d-flex  flex-column align-items-center mb-3">
                           <ul class="social-icons social-icons-colored social-icons-circle">
                             <li class="social-icons-facebook"><a href="#" data-toggle="tooltip" data-original-title="Log In with Facebook"><i class="fab fa-facebook-f"></i></a></li>
                             <li class="social-icons-twitter"><a href="#" data-toggle="tooltip" data-original-title="Log In with Twitter"><i class="fab fa-twitter"></i></a></li>
                             <li class="social-icons-google"><a href="#" data-toggle="tooltip" data-original-title="Log In with Google"><i class="fab fa-google"></i></a></li>
                             <li class="social-icons-linkedin"><a href="#" data-toggle="tooltip" data-original-title="Log In with Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                           </ul>
                           </div> -->
                        <p class="text-2 text-center mb-0">New to <?php echo SITE_NAME; ?>? <a class="btn-link" href="" data-toggle="modal" data-target="#signup-modal" data-dismiss="modal">Sign Up</a></p>
                     </div>
                  </div>
                  <!-- Login Form End --> 
               </div>
            </div>
         </div>
      </div>
      <!-- Login Modal End -->
      <!-- Script -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/jquery/jquery.validate.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/owl.carousel/owl.carousel.min.js"></script> 
      <script src="js/theme.js"></script> 
      <script src="js/custom.js"></script> 
      <script type="text/javascript">$(document).on('keypress',function(e) { if(e.which == 13) { forget_password(); }});</script>
   </body>
</html>