<?php require 'connection.php'; require 'functions.php'; $referral_code=''; if (isset($_GET['referral']) && $_GET['referral']!='') { $referral_code=get_safe_value($con,$_GET['referral']); } $title='Join Us - '.SITE_NAME; if (isset($_SESSION['USER_LOGIN'])) { header('Location:'.SITE_PATH); } echo "<base href='".SITE_PATH."'/signup'"; $check_referal="select * from users where refer_code='$referral_code' and status=1"; ?><!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
      <link href="images/favicon.png" rel="icon"/>
      <title><?php echo $title; ?></title>
      <meta name="keywords" content="billincharge, billincharge.com, signup, register">
      <meta name="description" content="Online Recharge, Bill Payments , DTH, Prepaid &amp; Postpaid Mobile Recharge - <?php echo SITE_NAME ?>. SignUp to start saving now">
      <meta name="author" content="Deepak Nawani">
      <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
      <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="vendor/sweetalert2/sweetalert2.min.css"/>
      <link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css"/>
      <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css"/>
      <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.theme.default.min.css"/>
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css"/>
      <link rel="stylesheet" type="text/css" href="css/custom.css"/>
   </head>
   <body>
      <div id="preloader">
         <div data-loader="dual-ring"></div>
      </div>
      <div id="main-wrapper">
         <header id="header">
            <div class="container">
               <div class="header-row">
                  <div class="header-column justify-content-start">
                     <div class="logo"> <a href="<?php echo SITE_PATH; ?>" class="d-flex text-capitalize text-primary" style="font-size: 1.5rem;font-weight: 600;" title="<?php echo SITE_NAME; ?> - Mobile Recharge & Bill Payment"><?php echo SITE_NAME; ?></a> </div>
                  </div>
                  <div class="header-column justify-content-end">
                     <nav class="primary-menu navbar navbar-expand-lg">
                        <div id="header-nav" class="collapse navbar-collapse">
                           <ul class="navbar-nav">
                              <li class="zindex <?php echo $home_active; ?>"> <a href="<?php echo SITE_PATH; ?>">Home</a></li>
                              <li class="zindex <?php echo $offers_active; ?>"><a href="<?php echo SITE_PATH; ?>offers">Offers</a></li>
                              <li class="zindex <?php echo $about_active; ?>"><a href="<?php echo SITE_PATH; ?>about">About</a></li>
                              <li class="zindex <?php echo $contact_active; ?>"><a href="<?php echo SITE_PATH; ?>contact">Contact</a></li>
                           </ul>
                        </div>
                     </nav>
                     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> <span></span> <span></span> <span></span> </button> 
                     <nav class="login-signup navbar navbar-expand separator ml-sm-2 pl-sm-2">
                        <ul class="navbar-nav">
                           <li class="align-items-center h-auto ml-sm-2" ><a href="login" class="btn btn-sm btn-primary" >Login</a> </li>
                           <li class="active"><a style="cursor: default;">Register</a></li>
                        </ul>
                     </nav>
                  </div>
               </div>
            </div>
         </header>
         <div id="content">
            <div class="container py-5">
               <div class="row">
                  <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
                     <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
                        <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
                           <li class="nav-item"> <a class="nav-link text-5 line-height-3" href="login">Login</a> </li>
                           <li class="nav-item"> <a class="nav-link text-5 line-height-3 active">Sign Up</a> </li>
                        </ul>
                        <?php if (!isset($_GET['type'])) {  } else if (isset($_GET['type']) && $_GET['type']=='user' && mysqli_num_rows(mysqli_query($con,$check_referal))>0) { ?> 
                        <div class="alert alert-warning text-center" role="alert"> <strong class="mr-1">Hurray!</strong> Referral code Applied Successfully. <br>Sign-up to procced </div>
                        <?php } else { /*header('Location:'.SITE_PATH.'error');*/ } ?> 
                        <p class="text-4 font-weight-300 text-muted text-center mb-4">Looks like you're new here!</p>
                        <form id="signupForm" method="post">
                           <div class="form-group"> <input type="text" class="form-control border-2" id="reg_name" placeholder="Your Name"> <label id="reg_name_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="reg_name"></label> </div>
                           <div class="form-group"> <input type="email" class="form-control border-2" id="reg_email" placeholder="Email Id"> <label id="reg_email_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="reg_email"></label> </div>
                           <div class="form-group"> <input type="number" class="form-control border-2" id="reg_mobile" placeholder="mobile"> <label id="reg_mobile_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="reg_mobile"></label> </div>
                           <div class="form-group"> <input type="password" class="form-control border-2" id="reg_password" placeholder="Password"> <label id="reg_password_error" style="display: none;" class="error text-primary m-1 text-capitalize" for="reg_password"></label> </div>
                           <div class="form-group my-4">
                              <div class="form-check text-2 custom-control custom-checkbox"> <input id="agree" name="agree" value="agree" class="custom-control-input" type="checkbox"> <label class="custom-control-label" for="agree">I agree to the <a href="terms">Terms</a> and <a href="privacy">Privacy Policy</a>.</label> </div>
                              <label id="tnc_error" style="display: none;" class="error text-primary mx-1" for="tnc">Please accept our Terms & Conditions*</label> 
                           </div>
                           <button class="btn btn-primary btn-block my-4" type="button" id="RegisterUserBtn" onclick="submitRegisterForm()">Sign Up</button> <input type="hidden" id="refered_by" value="<?php echo $referral_code; ?>"> 
                        </form>
                        <p class="text-2 text-center mb-0">Already have an account? <a class="btn-link" href="login">Log In</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div id="otp-modal" data-backdrop="static" data-keyboard="false" class="modal fade" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
               <div class="modal-body py-4 px-0">
                  <div class="row">
                     <div class="col-11 col-md-10 mx-auto">
                        <h3 class="text-center mt-3 mb-4">Two-Step Verification</h3>
                        <p class="text-center"><img class="img-fluid" src="images/otp-icon.png" alt="verification - <?php echo SITE_NAME; ?>"></p>
                        <p class="text-muted text-3 text-center">Please enter the OTP (one time password) to verify your account. A Code has been sent to <span class="text-dark text-4 d-block"><span id="mbn" class="text-lowercase"></span> <span></p>
                        <form id="otp-screen" class="form-border" method="post">
                           <div class="form-row">
                              <div class="col form-group"> <input type="number" class="form-control border-2 text-center text-6 px-0 py-2" id="otp_val_1" maxlength="1" required autocomplete="off"> </div>
                              <div class="col form-group"> <input type="number" class="form-control border-2 text-center text-6 px-0 py-2" id="otp_val_2" maxlength="1" required autocomplete="off"> </div>
                              <div class="col form-group"> <input type="number" class="form-control border-2 text-center text-6 px-0 py-2" id="otp_val_3" maxlength="1" required autocomplete="off"> </div>
                              <div class="col form-group"> <input type="number" class="form-control border-2 text-center text-6 px-0 py-2" id="otp_val_4" maxlength="1" required autocomplete="off"> </div>
                           </div>
                           <button class="btn btn-primary btn-block shadow-none my-4" id="VerifyUserBtn" onclick="verifyuser()" type="button">Verify</button> 
                        </form>
                        <p class="text-2 text-center">Not received your code? <a class="btn-link" href="javascript:void(0);" onclick="resendOtp()">Resend code</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="vendor/jquery/jquery.min.js"></script> <script src="vendor/jquery/jquery.validate.js"></script> <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> <script src="vendor/owl.carousel/owl.carousel.min.js"></script> <script src="js/theme.js"></script> <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script> <script src="js/custom.js"></script> <script type="text/javascript">$(document).on('keypress',function(e) { if(e.which==13) { submitRegisterForm(); }  } );</script> 
   </body>
</html>