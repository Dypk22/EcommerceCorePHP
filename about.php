         <?php
            $about_active='active';
            require 'connection.php';
            $title='About Us | '.SITE_NAME;
            require'header.php';
            ?>  
         <!-- Page Header -->
         <section class="page-header page-header-text-light bg-secondary">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-md-8">
                     <h1>About Us</h1>
                  </div>
                  <div class="col-md-4">
                     <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="<?php echo SITE_PATH; ?>">Home</a></li>
                        <li class="active">About Us</li>
                     </ul>
                  </div>
               </div>
            </div>
         </section>
         <!-- Page Header end -->
         <!-- Content -->
         <div id="content">
            <div class="container">
               <div class="bg-light shadow-md rounded p-4">
                  <h2 class="text-6 pt-3 pb-2">What is <?php echo SITE_NAME; ?>?</h2>
                  <p><?php echo SITE_NAME; ?> is India’s emerging spot to make utillity payments. It is India's leading recharge service provider. The Company provides pan India all types of recharge services across 2G, 3G and 4G and so on. Customers across the country use <?php echo SITE_NAME; ?> to make prepaid, postpaid, DTH, metro recharge and utility bill payments for numerous service providers. <br>We start out operations in November 2021 and customers are exicted to use our service, the list of user is growing by the day.</p>
                  <p>We are on a mission to get all millions of users to be a part of the digital payments ecosystem. Our service is all about social payments. It is an engaging and secure way for you to seamlessly make  payment to prepaid, electricity bill and merchants in less than 5 seconds. <br>You can use to make payments in less than 1 minute after registering on the <?php echo SITE_NAME; ?>..</p>
                  <p>
                  <h6>Why Choose Us?</h6>
                  <ul>
                     <li class="py-2">An easy and instant recharging process</li>
                     <li class="py-2">Hassle-free, simple, delightful online experience</li>
                     <li class="py-2">Safe & Secure payment process</li>
                     <li class="py-2">Best discounts & Offers</li>
                     <li class="py-2">No hidden costs or complex terms and conditions</li>
                     <li class="py-2">And a 100% satisfied customer, who'll want to come back to us again and again</li>
                  </ul>
                  </p>
                  <h2 class="text-6 mb-3">Leadership</h2>
                  <div class="row">
                     <div class="col-sm-6 col-md-3">
                        <div class="team">
                           <img class="img-fluid rounded" alt="" src="images/team/leader.jpg">
                           <h3>Deepak Nawani</h3>
                           <p class="text-muted">CTO & Founder</p>
                           <ul class="social-icons social-icons-sm d-inline-flex">
                              <li class="social-icons-facebook"><a data-toggle="tooltip" href="javascript:void(0)" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                              <li class="social-icons-twitter"><a data-toggle="tooltip" href="javascript:void(0)" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                              <li class="social-icons-google"><a data-toggle="tooltip" href="javascript:void(0)" title="Google"><i class="fab fa-google"></i></a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-3">
                        <div class="team">
                           <img class="img-fluid rounded" alt="" src="images/team/leader-2.jpg">
                           <h3>James Maxwell</h3>
                           <p class="text-muted">Co-Founder</p>
                           <ul class="social-icons social-icons-sm d-inline-flex">
                              <li class="social-icons-facebook"><a data-toggle="tooltip" href="javascript:void(0)" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                              <li class="social-icons-twitter"><a data-toggle="tooltip" href="javascript:void(0)" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                              <li class="social-icons-google"><a data-toggle="tooltip" href="javascript:void(0)" title="Google"><i class="fab fa-google"></i></a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-3">
                        <div class="team">
                           <img class="img-fluid rounded" alt="" src="images/team/leader-3.jpg">
                           <h3><?php echo ADMIN_NAME; ?></h3>
                           <p class="text-muted">CEO & Director</p>
                           <ul class="social-icons social-icons-sm d-inline-flex">
                              <li class="social-icons-facebook"><a data-toggle="tooltip" href="javascript:void(0)" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                              <li class="social-icons-twitter"><a data-toggle="tooltip" href="javascript:void(0)" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                              <li class="social-icons-google"><a data-toggle="tooltip" href="javascript:void(0)" title="Google"><i class="fab fa-google"></i></a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-3">
                        <div class="team">
                           <img class="img-fluid rounded" alt="" src="images/team/leader-4.jpg">
                           <h3>Miky Sheth</h3>
                           <p class="text-muted">Support</p>
                           <ul class="social-icons social-icons-sm d-inline-flex">
                              <li class="social-icons-facebook"><a data-toggle="tooltip" href="javascript:void(0)" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                              <li class="social-icons-twitter"><a data-toggle="tooltip" href="javascript:void(0)" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                              <li class="social-icons-google"><a data-toggle="tooltip" href="javascript:void(0)" title="Google"><i class="fab fa-google"></i></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Content end -->
         <?php 
            require'footer.php';
              ?>