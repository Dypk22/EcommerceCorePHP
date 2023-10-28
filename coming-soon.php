<?php 
   require'connection.php';
   require 'functions.php';
    $title='Online Recharge, Bill Payments , DTH, Prepaid &amp; Postpaid Mobile Recharge - '.SITE_NAME;
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
      <link href="images/favicon.png" rel="icon" />
      <title><?php echo  $title; ?></title>
      <meta name="robots" content="noindex">
      <meta name="googlebot" content="noindex">
      <!-- Web Fonts -->
      <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>
      <!-- Stylesheet -->
      <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
      <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
      <link rel="stylesheet" type="text/css" href="css/custom.css" />
      <script src="vendor/jquery/jquery.min.js"></script>
   </head>
   <body>
      <!-- Document Wrapper    -->
      <div id="main-wrapper" style="background: #fff;">
         <header id="header" class="bg-transparent header-text-light border-0 py-4">
            <div class="container">
               <div class="header-row">
                  <div class="header-column justify-content-start">
                     <!-- Logo -->
                     <div class="logo"> <a href="<?php echo SITE_PATH; ?>" class="d-flex text-capitalize text-primary" style="font-size: 1.6rem;font-weight: 600;" title="<?php echo SITE_NAME; ?> - Mobile Recharge & Bill Payment"><?php echo SITE_NAME; ?></a> </div>
                     <!-- Logo end --> 
                  </div>
                  <div class="header-column justify-content-end">
                     <div class="d-flex flex-column">
                        <ul class="social-icons social-icons-colored justify-content-center">
                           <li class="social-icons-twitter"><a href="javascript:void(0)" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                           <li class="social-icons-facebook"><a href="javascript:void(0)" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                           <li class="social-icons-google"><a href="javascript:void(0)" title="Google"><i class="fab fa-google"></i></a></li>
                           <li class="social-icons-instagram"><a href="javascript:void(0)" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <section class="d-flex flex-column min-vh-100">
            <div class="container text-center my-auto py-5">
               <div class="row mt-5">
                  <div class="col-lg-10 mx-auto">
                     <p class="text-7 text-muted font-weight-500 mb-3">Coming Soon!</p>
                     <h2 class="text-10 mb-5">Our new <u class="text-primary">Recharge</u> & <u class="text-primary">Bill Payment</u> website is on its way.</h2>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-8 col-lg-6 col-xl-5 mx-auto">
                     <button class="btn btn-primary px-4 mx-auto shadow-none" onclick="window.location.href='<?php echo SITE_PATH; ?>';"><i class="fas fa-angle-double-left"></i> Go Back To Home</button>
                  </div>
               </div>
            </div>
         </section>
         <div class="container-fluid shadow bg-white py-2">
            <p class="text-center text-muted mb-0">Copyright © 2020 <a href="<?php echo SITE_PATH; ?>"><?php echo SITE_NAME; ?></a>. All Rights Reserved.</p>
         </div>
      </div>
      <!-- Document Wrapper end -->
      <!-- Back to Top -->
      <a id="back-to-top" data-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a>
      <!-- Script -->
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/owl.carousel/owl.carousel.min.js"></script> 
      <script src="js/theme.js"></script> 
      <script src="js/custom.js"></script> 
   </body>
</html>