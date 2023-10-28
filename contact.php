      <?php
         $contact_active='active';
         require 'connection.php';
         $title='Contact Us - '.SITE_NAME;
         require'header.php';
         ?>  
      <!-- Page Header -->
      <div class="page-header page-header-text-light bg-secondary">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-md-8">
                  <h1>Contact Us</h1>
               </div>
               <div class="col-md-4">
                  <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                     <li><a href="<?php echo SITE_PATH; ?>">Home</a></li>
                     <li class="active">Contact Us</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- Secondary Navigation end -->
      <!-- Content -->
      <div id="content">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="bg-light shadow-md rounded h-100 p-3">
                     <iframe class="h-100 w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3507.81186507328!2d77.08201418720884!3d28.45508717641397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d18c188f7a155%3A0x3006cce1febfba51!2sVyapar%20Kendra%20Rd%2C%20Block%20C%2C%20Sushant%20Lok%20Phase%20I%2C%20Sector%2043%2C%20Gurugram%2C%20Haryana%20122022!5e0!3m2!1sen!2sin!4v1634559058581!5m2!1sen!2sin" allowfullscreen></iframe>
                  </div>
               </div>
               <div class="col-md-6 mt-4 mt-md-0">
                  <div class="bg-light shadow-md rounded p-4">
                     <h2 class="text-6">Get in touch</h2>
                     <p class="text-3">For Customer Support and Query, Get in touch with us : <a href="support">Help</a></p>
                     <div class="featured-box style-1">
                        <div class="featured-box-icon text-primary"> <i class="fas fa-map-marker-alt"></i></div>
                        <h3><?php echo SITE_NAME; ?></h3>
                        <p><?php echo SITE_ADD1; ?><br>
                           <?php echo SITE_ADD2; ?><br>
                           <?php echo SITE_ADD3; ?><br>
                           <?php echo SITE_ADD4; ?>
                        </p>
                     </div>
                     <div class="featured-box style-1">
                        <div class="featured-box-icon text-primary"> <i class="fas fa-phone"></i> </div>
                        <h3>Telephone</h3>
                        <p><?php echo SITE_MOBILE; ?></p>
                     </div>
                     <div class="featured-box style-1">
                        <div class="featured-box-icon text-primary"> <i class="fas fa-envelope"></i> </div>
                        <h3 class="text-capitalize">Business Inquiries</h3>
                        <a href="mailto:<?php echo strtolower(SITE_EMAIL); ?>"><?php echo ucfirst(SITE_EMAIL); ?></a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Content end -->
      <?php
         require 'footer.php';
         ?>