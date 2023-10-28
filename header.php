<?php require 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
      <link href="images/favicon.png" rel="icon"/>
      <title><?php echo $title; ?></title>
      <meta name="keywords" content="<?php echo SITE_NAME ?>, <?php echo SITE_NAME ?>.com, mobile recharge <?php echo SITE_NAME ?>, online recharge <?php echo SITE_NAME ?>, online recharge, mobile recharge, prepaid mobile recharge, airtel recharge, airtel recharge plans, jio plans, bsnl recharge, idea recharge, vi recharge, airtel online recharge, online recharge">
      <meta name="description" content="Online Recharge, Bill Payments, DTH, Prepaid &amp; Postpaid Mobile Recharge - <?php echo SITE_NAME ?>. Fastest Online Mobile Recharge on <?php echo SITE_NAME ?>. Simple and Quick way to do an Prepaid Recharge for Airtel, Vodafone Idea, BSNL, Reliance and other Prepaid Operator">
      <meta name="author" content="<?php echo ADMIN_NAME; ?>">
      <?php echo (isset($extraMetaTags))?$extraMetaTags:''; ?> 
      <link rel="canonical" href="<?php echo SITE_PATH; ?>">
      <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
      <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
      <link rel="stylesheet" href="vendor/sweetalert2/sweetalert2.min.css"/>
      <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.carousel.min.css"/>
      <link rel="stylesheet" type="text/css" href="vendor/owl.carousel/assets/owl.theme.default.min.css"/>
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css"/>
      <link rel="stylesheet" type="text/css" href="css/custom.css"/>
      <script src="vendor/jquery/jquery.min.js"></script> 
   </head>
   <?php if(isset($_SESSION['USER_ID'])) {
    $uid=$_SESSION['USER_ID']; $is_mobile_verified=mysqli_fetch_assoc(mysqli_query($con,"select email_status from users where id='$uid'")); 
    if ($is_mobile_verified['email_status']=='unverified') { ?> <body onload="showOTPModal()"> <?php } else { ?> <body> <?php } ?><?php } else { ?> <body> <?php } ?> 
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
                           <li class="zindex <?php echo (isset($home_active))? $home_active:''; ?>"> <a href="<?php echo SITE_PATH; ?>">Home</a></li>
                           <li class="zindex <?php echo (isset($offers_active))? $offers_active:''; ?>"><a href="<?php echo SITE_PATH; ?>offers">Offers</a></li>
                           <li class="zindex <?php echo (isset($about_active))? $about_active:''; ?>"><a href="<?php echo SITE_PATH; ?>about">About</a></li>
                           <li class="zindex <?php echo (isset($contact_active))? $contact_active:''; ?>"><a href="<?php echo SITE_PATH; ?>contact">Contact</a></li>
                        </ul>
                     </div>
                  </nav>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav"> <span></span> <span></span> <span></span> </button> 
                  <nav class="login-signup navbar navbar-expand separator ml-sm-2 pl-sm-2">
                     <ul class="navbar-nav">
                        <?php if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes') { ?>
                        <li class="profile <?php echo (isset($dashboard_active))? $dashboard_active:''; ?>"><a class="pr-0" href="<?php echo SITE_PATH.'dashboard'; ?>" title="Dashboard"><span class="d-none d-sm-inline-block">Dashboard</span> <span class="user-icon ml-sm-2"><i class="fas fa-user my-2"></i></span></a></li>
                        <?php } else { ?>
                        <li><a data-toggle="modal" data-target="#login-modal" class="pointer" title="Login">Login</a> </li>
                        <li class="align-items-center h-auto ml-sm-2"><a class="btn btn-sm btn-primary signup_name" title="Sign Up" href="<?php echo SITE_PATH.'signup'; ?>">Register</a></li>
                        <?php } ?>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </header>
